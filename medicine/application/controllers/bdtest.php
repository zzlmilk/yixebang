<?php

/**
 * Created by PhpStorm.
 * User: itzhaocn
 * Date: 2016/1/15
 * Time: 14:20
 */
class bdtest extends CI_Controller
{
    public function __construct() {
        parent::__construct();
    }
    public function testquery(){
        $this->load->database();
        $this->db->select("phone");
//        $this->db->select("*");
        $this->db->limit(3);
        $this->db->offset(4);
        $query=$this->db->get('users');
        $data["dbResult"]=$query->result();
        print_r($query->result());
//        $this->load->view('dbtest',$data);
    }
    public  function commonQueryObj(){
        $this->load->database();
        $sql = "SELECT * FROM users";
        $query = $this->db->query($sql);
//        if ($query->num_rows() >0){
//        }
//        else{
//            //如果查询结果为空，就那样做... ...
//        }
        $data["dbResult"]=$query->result();
//        $data["dbResult"]=$query->row()->password;
//        print_r($query->result());
//        echo $data["dbResult"];
        $this->load->view('dbtestObject',$data);
    }
    public  function commonQueryArray(){
        $this->load->database();
        $sql = "SELECT * FROM users";
        $query = $this->db->query($sql);
//        if ($query->num_rows() >0){
//            //如果查询结果不为空，就这样做... ...
//        }
//        else{
//            //如果查询结果为空，就那样做... ...
//        }
        $data["dbResult"]=$query->result_array();
//        $data["dbResult"]=$query->row_array()->password;
//        print_r($query->row()->password);
//        echo $data["dbResult"];
        $this->load->view('dbtestArray',$data);
    }
}