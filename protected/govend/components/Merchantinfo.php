<?php
class Merchantinfo
{
	private $merchant_id;
	private $merchant_name;
	private $merchant_email;
	private $balance;
	private $commerce_no;
	private $merchant_phone;
	
	public function __get($key){		
		return $this->$key;
	}
	
	public function __set($key, $value){
		$this->$key = $value;
	}
	
	public function init() {
		
	}
	
	public function clear(){
		$merchant_id = NULL;
		$merchant_name = NULL;
		$merchant_email = NULL;
		$balance = NULL;
		$commerce_no = NULL;
		$merchant_phone = NULL;		
	}
	
	public function getid(){
		return $this->merchant_id;
	}
	public function setid($value){
		$this->merchant_id = $value;
	}
	public function getname(){
		return $this->merchant_name;
	}
	public function setname($value){
		$this->merchant_name = $value;
	}
	public function getbalance(){
		return $this->balance;
	}
	public function  setbalance($value){
		$this->balance = $value;
	}
	public function getemail(){
		return $this->merchant_email;
	}
	public function  setemail($value){
		$this->merchant_email = $value;
	}
	public function getcommerce_no(){
		return $this->commerce_no;
	}
	public function  setcommerce_no($value){
		$this->commerce_no = $value;
	}
	public function getphone(){
		return $this->merchant_phone;
	}
	public function  setphone($value){
		$this->merchant_phone = $value;
	}
}