<?php
//测试git
//pjl-test-word

class BaseCommon{
	//数据库连接句柄
	const updatelog="updatelog\\";
}



class MysqlCommon
{	
	protected $link;
	public $localhost="127.0.0.1";
	public $mysqli_user="root";
	public $mysqli_password="root";
	public $database="test";
	//数据库连接方法(构造函数)
	function __construct(){
		$this->link=mysqli_connect($this->localhost,$this->mysqli_user,$this->mysqli_password,$this->database);
		
	}

	//数据库查询多行数据
	public function getDatas($field,$table,$where){
		$i=0;
		$a=array();
		if($where==NULL){
			$query="select ".$field." from ".$table;
		}else{
			$query="select ".$field." from ".$table." where ".$where;
		}
		$re = mysqli_query($this->link,$query);
		while($row = mysqli_fetch_assoc($re)){
			$a[$i]=$row;
			$i++;
		}
		
		return $a;
	}

	//分页显示查询
	public function break_getDatas($page,$table,$length){
		$i=0;
		$a1=array();
		$h=($page-1)*$length;
		$p=$length;
		$query="select * from ".$table." limit ".$h.",".$p;
		$re = mysqli_query($this->link,$query);
		while($row = mysqli_fetch_assoc($re)){
			$a1[$i]=$row;
			$i++;
		}
		return $a1;
	}


	//数据库查询多行数据右连接
	public function getDatas_right($field,$table1,$table2,$idname){
		$i=0;
		$a1=array();
		$query="select ".$field." from ".$table1." right join  ".$table2." on ".$table1.".".$idname." = ".$table2.".".$idname;
		$re = mysqli_query($this->link,$query);
		while($row = mysqli_fetch_assoc($re)){
		$a1[$i]=$row;
		$i++;
		}
		return $a1;
	}

	//数据库更新方法
	public function updateDatas($arr,$table,$where){
		if($arr==NULL || $where==NULL || $table==NULL){
			print_r('请输入参数');
		}
		foreach($arr as $k=>$v){
			$q=$k."="."'".$v."'";
			$query="update ".$table." set ".$q." where ".$where;
			$result=mysqli_query($this->link,$query);
		}
		return $result;
	}

	//数据库插入方法
	public function insertData($a,$table){
		$u=array_keys($a);
		$j=implode(',',$u);
		$q=" ";
		foreach($a as $vv){
			if($a['ordersn']==NULL || $a['sku']==NULL || $a['count']==NULL || $a['orderTime']==NULL || $a['arriveCount']==NULL || $a['user']==NULL){
				print_r("输入字段缺失");
				exit;
			}
			$q .="'".$vv."',";
			$qa=trim($q,',');
		}
		$query="insert into ".$table." (".$j.") values "."(".$qa.")";
		$rr=mysqli_query($this->link,$query);
		return $rr;
	}

	public function deleteData($table,$where){
		if($table==NULL || $where==NULL){
			print_r('请输入参数');
		}
		$query="delete from ".$table." where ".$where;
		$result=mysqli_query($this->link,$query);
		return $result;
	}
	
	public function insert($a,$table){
		$u=array_keys($a);
		$j=implode(',',$u);
		$q=" ";
		foreach($a as $kk=>$vv){
			if($a['username']==NULL || $a['sex']==NULL){
				print_r("输入字段缺失");
				exit;
			}
			$q .="'".$vv."',";
			$qa=trim($q,',');
		}
		$query="insert into ".$table." (".$j.") values "."(".$qa.")";
		$rr=mysqli_query($this->link,$query);
		return $rr;
	}

	public function insertall($a,$table){
		$u=array_keys($a);
		$j=implode(',',$u);
		$q=" ";
		foreach($a as $vv){
			$q .="'".$vv."',";
			$qa=trim($q,',');
		}
		$query="insert into ".$table." (".$j.") values "."(".$qa.")";
		$rr=mysqli_query($this->link,$query);
		return $rr;
	}
	
	public function inserta($a,$table){
		$q = " ";
		foreach($a as $vv){
			$j="ordersn,sku,count,isLack,orderTime,arriveTime,user,order_type";
			$q .="'".$vv."',";
			$qa=trim($q,',');
		}
		$query="insert into ".$table." (".$j.") values "."(".$qa.")";
		$rr=mysqli_query($this->link,$query);
		return $rr;
	}

	public function insert_single($j,$q,$table){
		$query="insert into ".$table." (".$j.") values "."(".$q.")";
		$rr=mysqli_query($this->link,$query);
		return $rr;
	}

	public function insert_log($a,$table){
		$q = " ";
		foreach($a as $vv){
			$j="type,content,oid,time";
			$q .="'".$vv."',";
			$qa=trim($q,',');
		}
		$query="insert into ".$table." (".$j.") values "."(".$qa.")";
		$rr=mysqli_query($this->link,$query);
		return $rr;
	}
}

