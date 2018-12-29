<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->library('session');
        if(!isset($_SESSION['acount'])){
            header(location)
        }
    }
    public function addManager(){

        $this->load->view('admin/head.php' ,array('site'=>'添加管理员'));
        $this->load->view('admin/addManager.php');
        $this->load->view('admin/foot.php');
    }
    public function editManager(){
        $this->load->database();
        $id = $this->input->get('id');
        $query = $this->db->get_where('zs_manager',array('id'=>$id));
        $data = $query->result_array();
        $this->load->view('admin/head.php',array('site'=>'修改管理员信息'));
        $this->load->view('admin/editManager.php',array('data'=>$data[0]));
        $this->load->view('admin/foot.php');
    }
    public function delManager(){
        $this->load->database();
        $id = $this->input->get('id');
        $res = $this->db->delete('zs_manager', array('id' => $id));
        if($res){
            echo 1;
        }else{
            echo 0;
        }
    }
    public function doaddManager(){
        $this->load->library('form_validation');
        $this->load->database();
        $config = array(
            array(
                'field' => 'acount',
                'label' => 'Acount',
                'rules' => 'required|min_length[3]|max_length[24]',
                'errors' => array(
                                'required' => '登录名不能为空',
                                'min_length'=>'登录名太短',
                                'max_length'=>'登录名太长'
                            ),
            ),
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
            $data['acount']=$this->input->post('acount');
            $data['passwd']=md5($this->input->post('password'));
            $data['phone']=$this->input->post('phone');
            $data['name']=$this->input->post("name");
            $data['status']=$this->input->post("status");
            $data['time']=date('Y-m-d H:i:s');
            $this->db->insert('zs_manager', $data);
            $this->load->view("admin/notice.php",array('url'=>"/admin/manager/index",'msg'=>"添加成功",'status'=>'1'));
        }else{
            $msg=validation_errors();
            $this->load->view("admin/notice.php",array('url'=>"/admin/manager/addmanager",'msg'=>$msg,'status'=>'0'));
        }
    }
    public function doeditManager(){
        $this->load->library('form_validation');
        $this->load->database();
        $id = $this->input->get('id');
        $config = array(
            array(
                'field' => 'acount',
                'label' => 'Acount',
                'rules' => 'required|min_length[3]|max_length[24]',
                'errors' => array(
                                'required' => '登录名不能为空',
                                'min_length'=>'登录名太短',
                                'max_length'=>'登录名太长'
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
            $data['acount']=$this->input->post('acount');
            $ispasswd ? $data['passwd']=md5($this->input->post('password')):'';
            $data['phone']=$this->input->post('phone');
            $data['name']=$this->input->post("name");
            $this->db->where('id',$id);
            $res = $this->db->update('zs_manager',$data);
            if($res){
                $this->load->view("admin/notice.php",array('url'=>"/admin/manager/",'msg'=>"修改成功",'status'=>'1'));
            }else{
                $this->load->view("admin/notice.php",array('url'=>"/admin/manager/",'msg'=>"修改失败\r\n败联系管理员",'status'=>'0'));    
            }
        }else{
            $msg=validation_errors();
            $this->load->view("admin/notice.php",array('url'=>"/admin/manager/editmanager?id={$id}",'msg'=>$msg,'status'=>'0'));
        }
    }
    public function index(){
        $this->load->database();
        $this->db->select('id,acount,name,phone,time,status');
        $query = $this->db->get('zs_manager');
        $data = $query->result_array();
        
        $this->load->view('admin/head.php',array('site'=>'管理员列表'));
        $this->load->view('admin/index.php',array('data'=>$data));
        $this->load->view('admin/foot.php');
    }
}
