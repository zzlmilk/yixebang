<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller {
	public function __construct() {
		parent::__construct();
	}
	public function index(){
		$this->load->model('ArticleModel');
		$data['menu']=1;
		$data['articleList']=$this->ArticleModel->getOne("*",'article_type=1');
		$this->load->view('baseFrame/header');
		$this->load->view('baseFrame/menu-1',$data);
		$this->load->view('index-1',$data);
		$this->load->view('baseFrame/footer');
	}
	public function menu($menu)
	{
		$menu=$menu?$menu:1;
		$this->load->model('ArticleModel');
		$data['menu']=$menu;
		$data['articleList']=$this->ArticleModel->getOne("*",'article_type='.$menu);
		$this->load->view('baseFrame/header');
		$this->load->view('baseFrame/menu-1');
		$this->load->view('index-1',$data);
		$this->load->view('baseFrame/footer');
	}
	public function cel($menu,$index=1)
	{
		$menu=$menu?$menu:1;
		$menu==1&&$data['title']="资讯";
		$menu==2&&$data['title']="导医";
		$menu==4&&$data['title']="专科";
		$menu==5&&$data['title']="名医";
		$menu==6&&$data['title']="疾病";
		$menu==7&&$data['title']="知识";
		$menu==8&&$data['title']="图片";
		$this->load->model('ArticleModel');
		if($menu==6){
			$data['celList']=array();
			$celMenu=$this->ArticleModel->commonQuery("SELECT md.type_id_1,mt.name,mt.img_file FROM (SELECT md.type_id_1 FROM medhelper_diseases md GROUP BY md.type_id_1) md LEFT JOIN medhelper_type mt ON md.type_id_1 = mt.id WHERE mt.belong_type = '6' AND mt.level = '1'");
			foreach($celMenu as $v){
				$menuArr=array();
				array_push($menuArr,$v);
				$menuCel=$this->ArticleModel->commonQuery("SELECT md.type_id_2,mt.name from medhelper_diseases md LEFT join medhelper_type mt on md.type_id_2 = mt.id WHERE md.type_id_1=".$v['type_id_1']);
				array_push($menuArr,$menuCel);
				array_push($data['celList'],$menuArr);
			}
			$this->load->view('baseFrame/header');
			$this->load->view('cel-2',$data);
			$this->load->view('baseFrame/footer');
		}else{
			$data['celList']=$this->ArticleModel->commonQuery('select * from medhelper_type where belong_type='.$menu);
			$this->load->view('baseFrame/header');
			$this->load->view('cel-1',$data);
			$this->load->view('baseFrame/footer');
		}
	}
	public function detail($id)
	{
		$data["article_id"]=$id;
		$this->load->model('ArticleModel');
		$data['articleDetail']=$this->ArticleModel->getOne("*",'id='.$id);
		$data['comment']=$this->ArticleModel->commonQuery('select * from medhelper_comment mc LEFT join medhelper_acount ma on mc.account_id = ma.id WHERE mc.article_id ='.$id);
		$this->load->view('baseFrame/header');
		$this->load->view('article-detail',$data);
		$this->load->view('baseFrame/footer');
	}

	public function commonDetail($type,$table_id)
	{
		$this->load->model('ArticleModel');
		$data['articleDetail']=$this->ArticleModel->getOne("*",'article_type='.$type." AND table_id=".$table_id);
		$id=$data['articleDetail'][0]['id'];
		$data['comment']=$this->ArticleModel->commonQuery('select * from medhelper_comment mc LEFT join medhelper_acount ma on mc.account_id = ma.id WHERE mc.article_id ='.$id);
		$data["article_id"]=$id;
		$this->load->view('baseFrame/header');
		$this->load->view('article-detail',$data);
		$this->load->view('baseFrame/footer');
	}
	public function comment($article_id){
		$this->load->library('session');
		if(empty($_SESSION['account_id'])){
			redirect('user/Login/1/'.$article_id);
		}else{
			$data['article_id']=$article_id;
			$this->load->view('baseFrame/header');
			$this->load->view('comment',$data);
			$this->load->view('baseFrame/footer');
		}
	}
	public function doComment(){
		$this->load->library('session');
		$this->load->model('ArticleModel');
		$commentInfo=$_POST['commentInfo'];
		$article_id=$_POST['article_id'];
		$this->db->set('account_id',$_SESSION['account_id']);
		$this->db->set('article_id', $article_id);
		$this->db->set('comment_content', $commentInfo);
		$this->db->insert('medhelper_comment');
		$data["errCode"] ="0000";
		$data["errMsg"] ="操作成功";
		echo json_encode($data);
	}
}
