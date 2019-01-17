<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Type extends CI_Controller{

        public function __construct(){
            parent::__construct();
            $this->load->library('session');
            if(!isset($_SESSION['acount'])){
                header("Location:/admin/login");
            }
        }

        public function typelist(){
            $this->load->database();
            $pid = $this->input->get('pid');
            $pid = $pid?$pid:'0';
            $query = $this->db->get_where('zs_classtype',array('pid'=>$pid));
            $res = $query->result_array();
            $this->load->view('admin/head.php' ,array('site'=>'商品分类列表'));
            $this->load->view('admin/type/typeList.php',array('type'=>$res));
            $this->load->view('admin/foot.php');
         }
        public function edittype(){
            $this->load->database();
            $id = $this->input->get('id');
            $query = $this->db->get_where('zs_classtype',array('id'=>$id));
            $res = $query->result_array();
            $this->load->view('admin/head.php' ,array('site'=>'编辑分类信息'));
            $this->load->view('admin/type/editType.php',array('type'=>$res[0]));
            $this->load->view('admin/foot.php');
        }
        public function  addtype(){
            $this->load->database();
            $query = $this->db->get_where('zs_classtype',array('pid'=>0));
            $resarr = $query->result_array();
            $this->load->view('admin/head.php' ,array('site'=>'添加商品类别'));
            $this->load->view('admin/type/addType.php',array('type'=>$resarr));
            $this->load->view('admin/foot.php');
        }

        public function doaddType(){
            $this->load->database();
            $this->load->library('form_validation');
            $data['pid'] = $this->input->post('type');
            $data['name'] = $this->input->post('name');
            $data['time'] = date('Y-m-d:h:i:s');
            $config = array(
                array(
                    'field' => 'name',
                    'label' => 'name',
                    'rules' => 'required|max_length[24]',
                    'errors' => array(
                                    'required' => '分类名字不能为空',
                                    'max_length' => '分类名字太长'
                                )
                )
            );
            $this->form_validation->set_rules($config);
            if($this->form_validation->run() == true){
                $res = $this->db->insert('zs_classtype',$data);
                if($res){
                    $this->load->view("admin/notice.php",array('url'=>"/admin/type/typelist?pid={$data['pid']}",'msg'=>'分类添加成功','status'=>'1'));
                }else{
                    $this->load->view("admin/notice.php",array('url'=>"/admin/type/addtype",'msg'=>"分类添加失败\r\n联系管理员",'status'=>'0'));
                }
            }else{
                $msg=validation_errors();
                $this->load->view("admin/notice.php",array('url'=>"/admin/type/addtype",'msg'=>$msg,'status'=>'0'));
            }
        }
        public  function doeditType(){
            $this->load->database();
            $this->load->library('form_validation');
            $data['name'] = $this->input->post('name');
            $data['recode'] = $this->input->post('recode');
            $id = $this->input->post('id');
          
            $this->form_validation->set_rules(array(
                array(
                    'field' => 'name',
                    'label' => 'name',
                    'rules' => 'required|max_length[24]',
                    'errors' => array(
                                    'required' => '分类名字不能为空',
                                    'max_length' => '分类名字太长'
                                )
                )
            ));
            if($this->form_validation->run() == true){
                $config['upload_path']      = './static/uploadimg';
                $config['allowed_types']    = 'gif|jpg|png';
                $config['max_size']     = 1000;
                $config['max_width']        = 1024;
                $config['max_height']       = 768;
                $config['file_name']  = time().rand(1000,9999);
                $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('img'))
                {
                    $msg = $this->upload->display_errors();
                    $this->load->view("admin/notice.php",array('url'=>"/admin/type/edittype?id={$id}",'msg'=>$msg,'status'=>'0'));
                }
                else
                {
                    $upload_data=$this->upload->data();
                    $data['img'] = '/static/uploadimg/'.$upload_data['file_name'];
                    $this->db->where('id',$id);
                    if($this->db->update('zs_classtype',$data)){
                        $this->load->view("admin/notice.php",array('url'=>"/admin/type/typelist?pid=0",'msg'=>'分类信息修改成功','status'=>'1'));
                    }else{
                        $this->load->view("admin/notice.php",array('url'=>"/admin/type/edittype?id={$id}",'msg'=>"信息修改失败\r\n联系管理员",'status'=>'0'));
                    }

                }
            }else{
                $msg=validation_errors();
                $this->load->view("admin/notice.php",array('url'=>"/admin/type/edittype?id={$id}",'msg'=>$msg,'status'=>'0'));
            }
        }
        public function  deltype(){
            $id = $this->input->get('id');
            $this->load->database();
            $res = $this->db->get_where('zs_classtype',array('pid'=>$id));
            if(!$res->result_array()){
                $res = $this->db->delete('zs_classtype', array('id' => $id));
                if($res){
                    echo 1;
                }else{
                    echo 0;
                }
            }else{
                    echo 3;
            }
        }

    }
 ?>