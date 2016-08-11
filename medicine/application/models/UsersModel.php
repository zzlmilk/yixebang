<?php
/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $name
 */
class UsersModel extends CCModel
{
	protected $_time_type = array('CREATETIME');
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'popex_users';
	}
	
	/**
	 * 获取相关角色用户列表
	 * @param string $role
	 * @return boolean
	 */
	public function getPersonListByRole($role=''){
		if(!$role) return false;
		$sql = "SELECT T2.ID,T2.USERNAME FROM T_USERROLES T1,T_USERS T2 WHERE T1.USERID=T2.ID AND T2.DISABLED='0' AND T1.ROLEID='{$role}'";
		return $this->querySql($sql);
	}
	
	public function getMaxId(){
		$sql = "SELECT MAX(TO_NUMBER(ID))+1 MID FROM T_USERS";
		$command = $this->_connection->createCommand($sql);
		$res = $command->queryRow();
		return $res['MID'];
	}
	
	/**
	 * 用户任务统计
	 * @param string $whereSql
	 * @param number $pageNum
	 * @param number $pageSize
	 */
	public function getRoleUserList($whereSql = '' , $pageNum = 1 , $pageSize =10){
	    $beginNum = ($pageNum-1)*$pageSize+1;
	    $endNum   = $pageNum*$pageSize;
	    $sql = "SELECT * FROM (SELECT A.*, ROWNUM RN FROM (SELECT T1.ID,T1.USERNAME,T2.ROLEID FROM T_USERS T1,T_USERROLES T2 WHERE T1.ID=T2.USERID ".$whereSql." ORDER BY TO_NUMBER(T2.ROLEID) ASC,TO_NUMBER(T1.ID) ASC) A WHERE ROWNUM <= ".$endNum.")WHERE RN >= ".$beginNum;
	    $command = $this->_connection->createCommand($sql);
		return $command->queryAll(); 
	}
	
	/**
	 * 用户任务统计总数
	 * @param string $whereSql
	 * @param number $pageNum
	 * @param number $pageSize
	 */
	public function getRoleUserListCount($whereSql = ''){
	    $sql = "SELECT COUNT(*) AS COUNTS FROM T_USERS T1,T_USERROLES T2 WHERE T1.ID=T2.USERID ".$whereSql;
	    $command = $this->_connection->createCommand($sql);
		$res = $command->queryRow();
		return $res['COUNTS'];
	}
	
	
	/**
	 * 获取用户列表
	 * @param string $whereSql
	 */
	public function getUserListPageData($whereSql=FALSE , $pageNum = 1 , $pageSize =10 , $order_by=FALSE){
	    $beginNum = ($pageNum-1)*$pageSize+1;
	    $endNum   = $pageNum*$pageSize;
	    $sql = "SELECT * FROM (SELECT A.*, ROWNUM RN FROM (SELECT T1.ID,T1.USERNAME,TO_CHAR(T1.CREATETIME , 'YYYY-MM-DD HH24:MI:SS') AS CREATETIME FROM T_USERS T1,T_USERROLES T2 WHERE T1.ID=T2.USERID ".$whereSql." GROUP BY T1.ID,T1.USERNAME,T1.CREATETIME ORDER BY TO_NUMBER(T1.ID) DESC) A WHERE ROWNUM <= ".$endNum.")WHERE RN >= ".$beginNum;
	    $command = $this->_connection->createCommand($sql);
	    return $command->queryAll();
	}
	
	
	/**
	 *获取用户数量
	 * @param string $whereSql
	 */
	public function getUserListCount($whereSql = ''){
	    $sql = "SELECT COUNT(*) AS COUNTS FROM (SELECT T1.ID FROM T_USERS T1,T_USERROLES T2 WHERE T1.ID=T2.USERID ".$whereSql." GROUP BY T1.ID)";
	    $command = $this->_connection->createCommand($sql);
	    $res = $command->queryRow();
	    return $res['COUNTS'];
	}

}