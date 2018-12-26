<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends CI_Controller {

    public function login()
    {
        $this->load->view('welcome_message');
    }
    public function addManager(){

        $this->load->view('admin/head.php');
        $this->load->view('admin/addManager.php');
        $this->load->view('admin/foot.php');
    }
    public function editManager(){

        $this->load->view('admin/head.php');
        $this->load->view('admin/editManager.php');
        $this->load->view('admin/foot.php');
    }

    public function doaddManager(){
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->library('encryption');
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
            $data['time']=date('Y-m-d H:i:s');
            $this->db->insert('zs_manager', $data);
            $this->load->view("admin/notice.php",array('url'=>"/admin/manager/index",'msg'=>"添加成功",'status'=>'1'));
        }else{
            $msg=validation_errors();
            $this->load->view("admin/notice.php",array('url'=>"/admin/manager/addmanager",'msg'=>$msg,'status'=>'0'));
        }
    }
    public function doaddManager(){
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->library('encryption');
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
            $data['time']=date('Y-m-d H:i:s');
            $this->db->insert('zs_manager', $data);
            $this->load->view("admin/notice.php",array('url'=>"/admin/manager/managerlist",'msg'=>"修改成功",'status'=>'1'));
        }else{
            $msg=validation_errors();
            $this->load->view("admin/notice.php",array('url'=>"/admin/manager/addmanager",'msg'=>$msg,'status'=>'0'));
        }
    }
    public function index(){

    }
}
