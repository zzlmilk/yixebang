<?php

class global_helper
{
	var $CI;
	function global_helper(){
		$this->CI = & get_instance();
		//变量可以在这里定义，或者来自配置文件，也可以去数据库中查
		$variable = array('$sendCode'=>'asdfasdf');
		$this->CI->load->global_helper($variable);
	}
}