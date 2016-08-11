<?php
class User_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	//创建用户
	public function save($phone,$pwd) {
		$this->load->database();
		$query = $this->db->get_where('users', array('phone'=>$phone));
		if ($query->num_rows()>0) {
			return "账号已存在";
		} else {
			$this->db->set('phone', $phone);
			$this->db->set('password', $pwd);
			$this->db->insert('users');
			return "0000";
		}
	}

//	通过手机号获取用户信息
	public function getUserInfoByPhone($phone){
		$this->load->database();
		return $query = $this->db->get_where('users', array('phone'=>$phone))->row_array();
	}

	//验证手机号
	public function chk_mobile($spChnlNo, $mobile) {
		$query = $this->db->get_where('TBL_WMA_GLOBAL_3RDPARTY_USER', array('SP_CHNL_NO'=>$spChnlNo,'MOBILE_NO'=>$mobile));
		if ($query->num_rows()>0) {
			return false;
		}
		return true;
	}
	
	//添加手机号&创建用户
	public function save_mobile($pid, $mobile) {
		$this->db->trans_start();
		$query = $this->db->get_where('TBL_WMA_GLOBAL_USER', array('MOBILE_NO'=>$mobile));
		if ($query->num_rows()) {
			$guserno = $query->row()->GLOBAL_USER_NO;
		} else {
			$guserno = $this->get_userno();
			$this->db->set('PID', 'SYS_GUID()', false);
			$this->db->set('GLOBAL_USER_NO', $guserno);
			$this->db->set('MOBILE_NO', $mobile);
			$this->db->insert('TBL_WMA_GLOBAL_USER');
		}
		$this->db->set('UPDATED_AT', "TO_CHAR(SYSDATE,'YYYYMMDDHH24MISS')", false);
		$this->db->update('TBL_WMA_GLOBAL_3RDPARTY_USER', array('MOBILE_NO'=>$mobile, 'GLOBAL_USER_ID'=>$guserno), array('PID'=>$pid));
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){
			return false;
		}
		
		return true;
	}

	public function get_userno() {
		return $this->db->query("SELECT REPLACE(LPAD(SEQ_WMA_GLOBAL_USER_NO.Nextval, 20), ' ','0') AS USERNO FROM DUAL")->row()->USERNO;
	}

	//获取门店列表
	public function get_shop_list($where, $limit=5, $offset=0, $orderby='', $dist='') {
		$this->db->where($where); 
		if ($dist)  $this->db->select($dist); 
		$this->db->select('V_QMH_SHOP_LIST.PID,V_QMH_SHOP_LIST.GLOBAL_SHOP_NO,V_QMH_SHOP_LIST.GLOBAL_SHOP_NAME,V_QMH_SHOP_LIST.LONGITUDE_BD,V_QMH_SHOP_LIST.LATITUDE_BD,V_QMH_SHOP_LIST.SHOP_STAR');
		$this->db->join('V_QMH_SHOP_LIST', 'V_QMH_SHOP_LIST.GLOBAL_SHOP_NO = TBL_WMA_USER_SHOP.GLOBAL_SHOP_NO', 'inner');
		$this->db->limit($limit);
		$this->db->offset($offset);
		if ($orderby) $this->db->order_by($orderby);
		return $this->db->get('TBL_WMA_USER_SHOP')->result_array();
	}
	
	//获取门店总数
	public function get_shop_count($where) {
		if ($where) $this->db->where($where); 
		$this->db->select('COUNT(*) AS TOTAL_COUNT');
		$this->db->join('V_QMH_SHOP_LIST', 'V_QMH_SHOP_LIST.GLOBAL_SHOP_NO = TBL_WMA_USER_SHOP.GLOBAL_SHOP_NO', 'inner');
		$query = $this->db->get('TBL_WMA_USER_SHOP');
		if ($query->num_rows() == 1) {
			return $query->row()->TOTAL_COUNT;
		} else {
			return 0;
		}
	}

	//获取银行code
	public function get_bank_code($userid) {
		$query = $this->db->select('BANK_CODE')->get_where('TBL_WMA_GLOBAL_3RDPARTY_CARD', array('USER_ID'=>$userid));
		return $query->result_array();
	}
}
?>
