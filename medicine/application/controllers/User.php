<?php
/**
 * Created by PhpStorm.
 * User: itzhaocn
 * Date: 2016/1/27
 * Time: 10:07
 */
class User extends CI_Controller{
    function __construct() {
        parent::__construct();
    }
    public function index(){
        $this->load->model('UserModel');
        $data["dbResult"] = $this->UserModel->getAll();
//        print_r( $saveResult);
        $this->load->view('dbtestArray',$data);
    }
    public function login($type=0,$article_id=0){
        $data['type']=$type;
        $data['article_id']=$article_id;
        $this->load->view('baseFrame/header');
        $this->load->view('login',$data);
        $this->load->view('baseFrame/footer');
    }
    public function register(){
        $this->load->library('session');
        $this->session->set_userdata('sendCode','');
        $this->load->view('baseFrame/header');
        $this->load->view('register');
        $this->load->view('baseFrame/footer');
    }
    public function sendCode(){
        $phone=$_POST["phone"];
        $this->load->model('MsgModel');
        $this->load->library('session');
        $responseJSON=$this->MsgModel->send_sms($phone);
        $sendCode=$this->MsgModel->getCode();
        $this->session->set_userdata('sendCode',$sendCode);
        echo $responseJSON;
    }
    public function doRegister(){
        $this->load->library('session');
        $sendCode=$_SESSION['sendCode'];
        $this->load->library('session');
        $this->load->model('UserModel');
        $phone=$_POST["phone"];
        $nickname=$_POST["nickname"];
        $keyCode=$_POST["keyCode"];
        $email=$_POST["email"];
        $userPwd=md5($_POST["userPwd"]);
        if(empty($nickname)){
            $data["errCode"] ="0004";
            $data["errMsg"] ="用户名不能不空";
        }else if(empty($phone)){
            $data["errCode"] ="0004";
            $data["errMsg"] ="手机号不能不空";
        }else if(empty($keyCode)){
            $data["errCode"] ="0004";
            $data["errMsg"] ="验证码不能为空";
        }else if(empty($email)){
            $data["errCode"] ="0004";
            $data["errMsg"] ="邮箱不能为空";
        }else if(empty($userPwd)){
            $data["errCode"] ="0004";
            $data["errMsg"] ="用户密码不能为空";
        }else if($sendCode==$keyCode){
            if($this->UserModel->getOne('phone','phone='.$phone)){
                $data["errCode"] ="0001";
                $data["errMsg"] ="该账号已存在";
            }else{
                $this->db->set('phone', $phone);
                $this->db->set('nickname', $nickname);
                $this->db->set('email', $email);
                $this->db->set('password', $userPwd);
                $this->db->insert('medhelper_acount');
                $data["errCode"] ="0000";
                $data["errMsg"] ="注册成功";
            };
        }else{
            $data["errCode"] ="0002";
            $data["errMsg"] ="验证码不对";
        }
        echo json_encode($data);

    }
    public function doLogin(){
        $this->load->model('UserModel');
        $this->load->library('session');
        $phone=$_POST["phone"];
        $userPwd=md5($_POST["userPwd"]);
        $dbUserPwd=$this->UserModel->getOne('*','phone='.$phone);
        if($dbUserPwd){
            if($dbUserPwd[0]['password']==$userPwd){
                $data["errCode"] ="0000";
                $data["errMsg"] ="登录成功";
                $this->session->set_userdata('account_id',$dbUserPwd[0]['id']);
            }else{
                $data["errCode"] ="0002";
                $data["errMsg"] ="密码错误";
            }
        }else{
            $data["errCode"] ="0003";
            $data["errMsg"] ="登录失败，该账号不存在";
        };
        $data['data']["phone"] =$phone;
        $data['data']["pwd"] ="$userPwd";
        $data['data']["dbpwd"] ="$dbUserPwd";
        echo json_encode($data);
    }
}