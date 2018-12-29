<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index()
    {
        $this->load->view('admin/login.php');
    }
    public function dologin(){
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->database();
        $formrule = array(
            array(
                'field' => 'acount',
                'label' => 'acount',
                'rules' => 'required',
                'errors' => array(
                            'required' => '登录名不能为空',
                        ),
            ),
            array(
                'field' => 'password',
                'label' => 'password',
                'rules' => 'required',
                'errors' => array(
                            'required' => '密码不能为空',
                        ),
            ),
            array(
                'field' => 'captword',
                'label' => 'captword',
                'rules' => 'required',
                'errors' => array(
                            'required' => '验证码不能为空',
                        ),
            )
        );
        $this->form_validation->set_rules($formrule);
        if ($this->form_validation->run() == true)
        {   
            $captcha = $this->input->post('captword');
            $captword = $this->session->captword;
            if(trim(strtolower($captword)) != trim(strtolower($captcha))){
                $this->load->view("admin/notice.php",array('url'=>"/admin/login",'msg'=>"验证码错误",'status'=>'0'));
            }else{
                $acount = $this->input->post('acount');
                $passwd = md5($this->input->post('password'));
                $query = $this->db->get_where('zs_manager',array('acount'=>$acount,'passwd'=>$passwd));
                if($res = $query->result_array()){
                    $this->session->set_userdata($res[0]);
                    $this->load->view("admin/notice.php",array('url'=>"/admin/manager/",'msg'=>"登录成功",'status'=>'1'));
                }else{
                    $this->load->view("admin/notice.php",array('url'=>"/admin/login",'msg'=>"登录失败\r\n检查账号密码",'status'=>'0'));
                }
            }
        }else{
            $msg=validation_errors();
            $this->load->view("admin/notice.php",array('url'=>"/admin/login",'msg'=>$msg,'status'=>'0'));
        }
    }
    
    /*
    *生成验证码
    */
    public function captcha(){
        $this->load->helper('captcha');
        $this->load->library('session');
        $vals = array(
            'img_path'  => './captcha/',
            'img_url'   => '/captcha/',
            'expiration'    => 300,
            'img_width' => '126',
            'img_height'    => '33',
            'word_length'   =>4,
            'font_size' => 100,
            'img_id'    => 'Imageid',
            'pool'      => '23456789abcdefghjkmnpqrstuvwxyz',
            // White background and border, black text and red grid
            'colors'    => array(
                'background' => array(225, 225,225),
                'border' => array(255, 255, 255),
                'text' => array(rand(0,50), rand(0,50), rand(0,50)),
                'grid' => array(225, 225, 225)
            )
        );
        $cap = create_captcha($vals);
        $word = $cap['word'];
        $this->session->set_userdata('captword',$word);
        echo $cap['image'];
    }
    
}
