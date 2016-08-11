<?php
/**
 * \brief all data models's parent class, privite base functions
 * @author Administrator
 *
 */
class MY_Model extends CI_Model
{
	var $_table = '';
	/**
	 * \brief construct a ative record object
	 * @param string $table
	 */
	public function __construct($table = false)
	{
		$this->_table = $this->tableName();
		$this->load->database();
		parent::__construct();
	}
	
	/**
	 * \brief translate the ative record object to an array
	 */
	public function toArray($object = '')
	{
		if(!$object) return array();
		$dataArray = array();
		if(is_array($object)){
			foreach ($object as $value){
				$dataArray[] = $value->attributes;
			}
		}else{
			$dataArray = $object->attributes;
		}
		return $dataArray;
	}

	
	/**
	 * \brief get all records contain the condition where sql
	 * @param string $whereSql, the where sql that identity the record
	 */
	public function getAll($whereSql=false , $condition = '*',$groupby='')
	{
		$condition = $condition ? $condition : '*';
		$sql = " select {$condition} from {$this->_table} ";
		if ($whereSql)
		{
			$sql .= " where $whereSql ";
			if($groupby){
				$sql .= " {$groupby}";
			}
		}
		//echo $sql;die;
		return $query = $this->db->query($sql)->result_array();
	}


//按条件查
	public function getOne( $condition = '*',$whereSql=false){
		$condition = $condition ? $condition : '*';
		$sql = " select $condition from {$this->_table} ";
		if ($whereSql)
		{
			$sql .= " where $whereSql ";
		}
		return $query = $this->db->query($sql)->result_array();
	}

//	通用的sql
	public function commonQuery($sql = ''){
		return $query = $this->db->query($sql)->result_array();
	}

//
//
//	/**
//	 * \brief count how many record
//	 * @param string $whereSql, the where sql
//	 */
//	public function get_count($whereSql='')
//	{
//		$sql = " select count(*) as counts from {$this->_table} ";
//		if ($whereSql)
//		{
//			$sql .= " where $whereSql ";
//		}
//		//echo $sql;
//		$connection = Yii::app()->db;
//		$command = $connection->createCommand($sql);
//		$result = $command->queryRow();
//		return $result['counts'];
//	}
//
//
//	public function querySql($sql = '' , $whereSql = false){
//		if ($whereSql)
//		{
//			$sql .= " where $whereSql ";
//		}
//		$connection = Yii::app()->db;
//		$command = $connection->createCommand($sql);
//		return $command->queryAll();
//	}
//
//	public function queryAddSql($sql = ''){
//		$connection = Yii::app()->db;
//		$command = $connection->createCommand($sql);
//		return $command->execute();
//	}
//
//
//	/**
//	 * \brief insert a record
//	 * @param array $data, record data, the array keys must the table column name.
//	 * @example array('column_name1' => value1);
//	 * @param string $sequence, prive key data, only need in oracle.
//	 */
//	public function setFrom($data)
//	{
//		foreach ($data as $key=>$value){
//			$this->$key = $value;
//		}
//	}
//
//
//	/**
//	 * \brief insert a record
//	 * @param array $data, record data, the array keys must the table column name.
//	 * @example array('column_name1' => value1);
//	 * @param string $sequence, prive key data, only need in oracle.
//	 */
//	public function doSave($data)
//	{
//		$command = Yii::app()->db->createCommand();
//		$rs = $command->insert($this->_table , $data);
//		if($rs){
//			return Yii::app()->db->getLastInsertID();
//		}
//		return false;
//	}
//
//
//	/**
//	 * \brief update a record
//	 * @param string $whereSql, the where sql that identity the record
//	 * @param array $data, the data that will be updated
//	 */
//	public function doUpdate($data , $whereSql = '')
//	{
//		return $this->updateAll($data , $whereSql);
//	}
//
//
//	/**
//	 * \brief delete a record
//	 * @param string $whereSql, the where sql that identity the record
//	 */
//	public function doDelete($whereSql = '')
//	{
//			return $this->deleteAll($whereSql);
//	}
//
//
//
//	/**
//	 * \brief get one page data
//	 * @param int $pageSize, the count per page
//	 * @param int $pageNum, the number of the page
//	 * @param string $whereSql, the condition where sql
//	 * @param int $secs2cache, the time of cache.
//	 * @param string $Field  字段 默认所有
//	 * 	 */
//	public function getPageData($whereSql=FALSE , $pageNum = 1 , $pageSize =10 , $order_by='',$field='*')
//	{
//		$pageNum = $pageNum>0 ? $pageNum : 1;
//
//		$sql = "select ". $field ." from $this->_table ";
//		if($whereSql){
//			$sql .= " where ".$whereSql;
//		}
//		if($order_by){
//			$sql .= " order by ".$order_by;
//		}
//		$sql .= ' limit :offset, :limit';
//		$offset = ($pageNum-1)*$pageSize;
//		$model = Yii::app()->db->createCommand($sql);
//		$model->bindValue(':offset',$offset);
//		$model->bindValue(':limit',$pageSize);
//
//		//echo $sql;exit;
//		return $model->queryAll();
//	}
	
}

?>