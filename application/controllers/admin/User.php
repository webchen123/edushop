<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->library('session');
        if(!isset($_SESSION['acount'])){
            header("Location:/admin/login");
        }
    }
    public function addUser(){

        $this->load->view('admin/head.php' ,array('site'=>'添加会员'));
        $this->load->view('admin/addUser.php');
        $this->load->view('admin/foot.php');
    }
    public function editUser(){
        $this->load->database();
        $id = $this->input->get('id');
        $query = $this->db->get_where('zs_member',array('id'=>$id));
        $data = $query->result_array();
        $this->load->view('admin/head.php',array('site'=>'修改会员信息'));
        $this->load->view('admin/editUser.php',array('data'=>$data[0]));
        $this->load->view('admin/foot.php');
    }
    public function delUser(){
        $this->load->database();
        $id = $this->input->get('id');
        $res = $this->db->delete('zs_member', array('id' => $id));
        if($res){
            echo 1;
        }else{
            echo 0;
        }
    }
    public function doaddUser(){
        $this->load->library('form_validation');
        $this->load->database();
        $config = array(
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required',
                'errors' => array(
                                'required' => '密码不能为空',
                            ),
            ),
            array(
                'field' => 'passconf',
                'label' => 'Password Confirmation',
                'rules' => 'required|matches[password]',
                'errors' => array(
                                'required' => '重复密码不能为空',
                                'matches' => '前后密码不一致'
                            ),
            ),
            array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'max_length[24]',
                'errors' => array(
                                'max_length' => '姓名过长',
                            ),
            ),
            array(
                'field' => 'phone',
                'label' => 'Phone',
                'rules' => 'exact_length[11]',
                'errors' => array(
                                'exact_length' => '请输入手机号为11位',
                            ),
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == true)
        {
            $data['passwd']=md5($this->input->post('password'));
            $data['phone']=$this->input->post('phone');
            $data['name']=$this->input->post("name");
            $data['source']=$this->input->post('source');
            $data['status']=$this->input->post("status");
            $data['time']=date('Y-m-d H:i:s');
            $phoneres = $this->db->get_where('zs_member',array('phone'=>$data['phone']));
            if($phoneres->result_array()){
                $this->load->view("admin/notice.php",array('url'=>"/admin/User/addUser",'msg'=>"添加失败\r\n手机号已存在",'status'=>'1'));
            }else{
                $this->db->insert('zs_member', $data);
                $this->load->view("admin/notice.php",array('url'=>"/admin/User/index",'msg'=>"添加成功",'status'=>'1'));
            }

        }else{
            $msg=validation_errors();
            $this->load->view("admin/notice.php",array('url'=>"/admin/User/addUser",'msg'=>$msg,'status'=>'0'));
        }
    }
    public function doeditUser(){
        $this->load->library('form_validation');
        $this->load->database();
        $id = $this->input->get('id');
        $config = array(
            array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'max_length[24]',
                'errors' => array(
                                'max_length' => '姓名过长',
                            ),
            )
        );
        if($this->input->post('password')||$this->input->post('passconf')){
            $config[] = array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required',
                'errors' => array(
                                'required' => '密码不能为空',
                            ),
            );
            $config[] = array(
                'field' => 'passconf',
                'label' => 'Password Confirmation',
                'rules' => 'required|matches[password]',
                'errors' => array(
                                'required' => '重复密码不能为空',
                                'matches' => '前后密码不一致'
                            ),
            );
            $ispasswd = 1;
        }else{
            $ispasswd = 0;
        }
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == true)
        {
            $ispasswd ? $data['passwd']=md5($this->input->post('password')):'';
            $data['name']=$this->input->post("name");
            $data['status']=$this->input->post("status");
            $this->db->where('id',$id);
            $res = $this->db->update('zs_member',$data);
            if($res){
                $this->load->view("admin/notice.php",array('url'=>"/admin/User/",'msg'=>"修改成功",'status'=>'1'));
            }else{
                $this->load->view("admin/notice.php",array('url'=>"/admin/User/",'msg'=>"修改失败\r\n败联系会员",'status'=>'0'));    
            }   
        }else{
            $msg=validation_errors();
            $this->load->view("admin/notice.php",array('url'=>"/admin/User/editUser?id={$id}",'msg'=>$msg,'status'=>'0'));
        }
    }
    public function index(){
        $this->load->database();
        $this->db->select('id,name,phone,time,sex,source,status');
        $query = $this->db->get('zs_member');
        $data = $query->result_array();
        
        $this->load->view('admin/head.php',array('site'=>'会员列表'));
        $this->load->view('admin/userlist.php',array('data'=>$data));
        $this->load->view('admin/foot.php');
    }
}
