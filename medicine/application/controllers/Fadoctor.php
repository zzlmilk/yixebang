<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fadoctor extends CI_Controller {
	public function cel($menu=1)
	{
		$data['title']="名医";
		$this->load->model('ArticleModel');
			$data['celList']=array();
			$celMenu=$this->ArticleModel->commonQuery("SELECT * FROM (SELECT md.type_id_1 FROM medhelper_diseases md GROUP BY md.type_id_1) md LEFT JOIN medhelper_type mt ON md.type_id_1 = mt.id WHERE mt.belong_type = '6' AND mt.level = '1'");
			foreach($celMenu as $v){
				$menuArr=array();
				array_push($menuArr,$v);
				$menuCel=$this->ArticleModel->commonQuery("SELECT md.type_id_2,mt.name from medhelper_diseases md LEFT join medhelper_type mt on md.type_id_2 = mt.id WHERE md.type_id_1=".$v['type_id_1']);
				array_push($menuArr,$menuCel);
				array_push($data['celList'],$menuArr);
			}
			$this->load->view('baseFrame/header');
			$this->load->view('fadoctor/cel',$data);
			$this->load->view('baseFrame/footer');
	}
	public function col6($menu,$index=1){
		$data['type_id_1']=$menu;
		$data['type_id_2']=$index;
		$this->load->model('ArticleModel');
		$data['menu']=$this->ArticleModel->commonQuery("SElECT name,img_file from medhelper_type where id=".$menu);
		$data['colList']=$this->ArticleModel->commonQuery("SELECT md.type_id_3,mt.name from medhelper_diseases md LEFT join medhelper_type mt on md.type_id_3 = mt.id WHERE md.type_id_1=".$menu." AND md.type_id_2=".$index);
		$this->load->view('baseFrame/header');
		$this->load->view('disease/cel-2-1',$data);
		$this->load->view('baseFrame/footer');
	}
	public function cll($id3){
		$id1=$_GET["type_id_1"];
		$id2=$_GET["type_id_2"];
		$this->load->model('ArticleModel');
		$data['cllList']=$this->ArticleModel->commonQuery("SELECT md.id,mt.name from medhelper_diseases md LEFT join medhelper_type mt on md.type_id_4 = mt.id WHERE md.type_id_1=".$id1." AND md.type_id_2=".$id2." AND md.type_id_3=".$id3);
		$this->load->view('baseFrame/header');
		$this->load->view('disease/cel-3',$data);
		$this->load->view('baseFrame/footer');
	}
}
