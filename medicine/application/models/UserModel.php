<?php
class UserModel extends MY_Model{
	public function __construct($table = false)
	{
		parent::__construct();
	}
	public function tableName()
	{
		return 'medhelper_acount';
	}

}