<?php
class Userinfo
{
	private $user_id;
	private $user_name;
	private $ali_balance;
	private $ali_freeze;
	private $ali_email;
	private $user_lastlogin;
	
	public function __get($key){		
		return $this->$key;
	}
	
	public function __set($key, $value){	
		$this->$key = $value;
	}
	
	public function init() {
		
	}
	
	public function clear(){
		$user_id = NUll;
		$user_name = NULL;
		$ali_balance = NULL;
		$ali_freeze = NULL;
		$ali_email = NULL;
		$user_lastlogin =NULL;
	}
	
	public function getid(){
		return $this->user_id;
	}
	public function setid($value){
		$this->user_id = $value;
	}
	public function getname(){
		return $this->user_name;
	}
	public function setname($value){
		$this->user_name = $value;
	}
	public function getbalance(){
		return $this->ali_balance;
	}
	public function  setbalance($value){
		$this->ali_balance = $value;
	}
	public function getfreeze(){
		return $this->ali_freeze;
	}
	public function  setfreeze($value){
		$this->ali_freeze = $value;
	}
	public function getemail(){
		return $this->ali_email;
	}
	public function  setemail($value){
		$this->ali_email = $value;
	}
	public function getlastlogin(){
		return $this->user_lastlogin;
	}
	public function  setlastlogin($value){
		$this->user_lastlogin = $value;
	}
}