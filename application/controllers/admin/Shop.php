<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Shop extends CI_Controller{

        public function __construct(){
            parent::__construct();
            $this->load->library('session');
            if(!isset($_SESSION['acount'])){
                header("Location:/admin/login");
            }
        }

        public function shoplist(){
            $this->load->database();
            $typeid = $this->input->get('typeid');
            $wheretypeid = $typeid?array('typeid'=>$typeid):'';

            $this->db->select('zs_classtype.id as typeid,zs_classinfo.id as id,zs_classtype.name as typename,zs_classinfo.name as classname,price,discount,discountdate,pic,zs_classinfo.time as time');
            $this->db->join('zs_classtype','zs_classtype.id = zs_classinfo.typeid','left');
            if($typeid) $this->db->where('typeid',$typeid);
            $query = $this->db->get('zs_classinfo');
            $res = $query->result_array();
            echo '<pre>';var_dump($res);exit;
            $this->load->view('admin/head.php' ,array('site'=>'商品列表'));
            $this->load->view('admin/Shop/shopList.php',array('Shop'=>$res));
            $this->load->view('admin/foot.php');
         }
        public function editShop(){
            $this->load->database();
            $id = $this->input->get('id');
            $query = $this->db->get_where('zs_classinfo',array('id'=>$id));
            $res = $query->result_array();
            $this->load->view('admin/head.php' ,array('site'=>'编辑课程信息'));
            $this->load->view('admin/Shop/editShop.php',array('Shop'=>$res[0]));
            $this->load->view('admin/foot.php');
        }
        public function  addShop(){
            $this->load->database();
            $query = $this->db->get_where('zs_classtype',array('pid !='=>0));
            $resarr = $query->result_array();
            $this->load->view('admin/head.php' ,array('site'=>'添加课程'));
            $this->load->view('admin/shop/addShop.php',array('type'=>$resarr));
            $this->load->view('admin/foot.php');
        }

        public function doaddShop(){
            $this->load->database();
            $this->load->library('form_validation');
            $data['typeid'] = $this->input->post('typeid');
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
                ),
                array(
                    'field' => 'tag',
                    'label' => 'tag',
                    'rules' => 'max_length[24]',
                    'errors' => array(
                                    'max_length' => '分类名字太长'
                                )
                ),
                array(
                    'field' => 'price',
                    'label' => 'price',
                    'rules' => 'required|decimal',
                    'errors' => array(
                                    'required' => '价格不能为空',
                                    'decimal' => '请填写规范的价格'
                                )
                ),
                array(
                    'field' => 'discount',
                    'label' => 'discount',
                    'rules' => 'decimal',
                    'errors' => array(
                                    'decimal' => '请填写规范的优惠价格',
                                )
                )
            );
            $this->form_validation->set_rules($config);
            if($this->form_validation->run() == true){
                $data['name'] = $this->input->post('name');
                $data['tag'] = $this->input->post('tag');
                $data['price'] = $this->input->post('price');
                $data['discount'] = $this->input->post('discount');
                $data['discountdate'] = $this->input->post('discountdate')."23:59:59";

                $config['upload_path']      = './static/uploadimg';
                $config['allowed_types']    = 'gif|jpg|png';
                $config['max_size']     = 1000;
                $config['max_width']        = 1024;
                $config['max_height']       = 768;
                $config['file_name']  = time().rand(1000,9999);
                $this->load->library('upload', $config);
                if ( $this->upload->do_upload('pic'))
                {
                    $upload_data=$this->upload->data();
                    $data['pic'] = '/static/uploadimg/'.$upload_data['file_name'];
                }
                $res = $this->db->insert('zs_classinfo',$data);
                if($res){
                    $this->load->view("admin/notice.php",array('url'=>"/admin/Shop/Shoplist?typeid=0",'msg'=>'商品添加成功','status'=>'1'));
                }else{
                    $this->load->view("admin/notice.php",array('url'=>"/admin/Shop/addShop",'msg'=>"商品添加失败\r\n联系管理员",'status'=>'0'));
                }
            }else{
                $msg=validation_errors();
                $this->load->view("admin/notice.php",array('url'=>"/admin/Shop/addShop",'msg'=>$msg,'status'=>'0'));
            }
        }
        public  function doeditShop(){
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
                $config['allowed_Shops']    = 'gif|jpg|png';
                $config['max_size']     = 1000;
                $config['max_width']        = 1024;
                $config['max_height']       = 768;
                $config['file_name']  = time().rand(1000,9999);
                $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('img'))
                {
                    $msg = $this->upload->display_errors();
                    $this->load->view("admin/notice.php",array('url'=>"/admin/Shop/editShop?id={$id}",'msg'=>$msg,'status'=>'0'));
                }
                else
                {
                    $upload_data=$this->upload->data();
                    $data['img'] = '/static/uploadimg/'.$upload_data['file_name'];
                    $this->db->where('id',$id);
                    if($this->db->update('zs_classinfo',$data)){
                        $this->load->view("admin/notice.php",array('url'=>"/admin/Shop/Shoplist?pid=0",'msg'=>'分类信息修改成功','status'=>'1'));
                    }else{
                        $this->load->view("admin/notice.php",array('url'=>"/admin/Shop/editShop?id={$id}",'msg'=>"信息修改失败\r\n联系管理员",'status'=>'0'));
                    }
                }
            }else{
                $msg=validation_errors();
                $this->load->view("admin/notice.php",array('url'=>"/admin/Shop/editShop?id={$id}",'msg'=>$msg,'status'=>'0'));
            }
        }
        public function  delShop(){
            $id = $this->input->get('id');
            $this->load->database();
            $res = $this->db->get_where('zs_classinfo',array('pid'=>$id));
            if(!$res->result_array()){
                $res = $this->db->delete('zs_classinfo', array('id' => $id));
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