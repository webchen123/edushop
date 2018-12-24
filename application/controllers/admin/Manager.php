<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends CI_Controller {

    public function login()
    {
        $this->load->view('welcome_message');
    }
    public function addManager(){
        $this->load->view('admin/addManager.php');
    }
    public function index(){

    }
}
