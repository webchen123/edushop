<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Order extends CI_Controller{

        public function __construct(){
            parent::__construct();
            $this->load->library('session');
            if(!isset($_SESSION['acount'])){
                header("Location:/admin/login");
            }
        }

        public function index(){
            $this->load->database();
            $this->load->library('pagination');
            $where = array();
            $page = array();
            $order = array();
            $page["per_page"] = (int)$this->input->get('per_page');
            

            $status = $this->input->get('status');
            switch ($status) {
                case '1':
                    $where['ispay']='0';   
                    break;
                case '2':
                    $where['isdeal']='0';   
                    break;
                default:
                    break;
            }
            //搜索关键字

            $this->db->select('zs_order.id as id,zs_member.phone as phone,shopname,total,payid,orderid,createtime,isdeal,ispay');
            $this->db->join('zs_member','zs_member.id = zs_order.memberid');
            $this->db->where($where);
            if($this->input->get('phone')){
                $this->db->like('zs_member.phone',$this->input->get('phone'));
                $where['phone']=$this->input->get('phone');
            }
            $this->db->order_by('isdeal DESC, createtime DESC');

            $config['total_rows'] = $this->db->count_all_results('zs_order',FALSE);
            $config['base_url'] = '/admin/order/index/';
            $config['per_page'] = 5;
            $config['page_query_string'] = TRUE;
            $config['reuse_query_string'] = TRUE;
            $config['use_page_numbers'] = TRUE;

            $config['prev_link'] = '上一页';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = '下一页';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li  class="active"><a>';
            $config['cur_tag_close'] = '<span class="sr-only"></span> </a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $page['total_page'] = ceil($config['total_rows']/$config['per_page']);
            $page["per_page"]=$page["per_page"]?$page["per_page"]:1;
            $limit = ($page["per_page"]-1)*$config['per_page'];
            
            $this->db->limit($config['per_page'],$limit);         
            $query = $this->db->get();
            $resarr = $query->result_array();

            $this->pagination->initialize($config);
            $page['url'] = $this->pagination->create_links();
            $this->load->view('admin/head.php' ,array('site'=>'订单列表'));
            $this->load->view('admin/order/orderList.php',array('order'=>$resarr,'where'=>$where,'page'=>$page));
            $this->load->view('admin/foot.php');
        }
        public function edit(){
            


        }
    }
?>