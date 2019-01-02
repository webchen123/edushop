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
        
        public function index(){



        }
        public function typelist(){

        }
        public function edittype(){


        }
        public function  addtype(){

        }

        public function  deltype(){

        }

    }
 ?>