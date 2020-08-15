<?php
//the slimphp class is a basic CRUD application helper, which helps PHP  developers build crud apps 
//seamlessly, as the SlimPHP library helps them complete most of the tasks, in order to reduce time spent on a project
//  
class BaseClass{
	public $con; 
	public $path;
	public $currentPath;
	public function __construct(){
		
	}
	
	//this method helps you connect to the database,
	//it takes three args
	//1)the username of the account
	//2)the password of the account
	//3)the database to connect to
	public function connect($user, $pass, $dbname, $flag){
		if ($flag == true){
			$error = mysqli_error();
		}
		else{
			$error = 'an error occured';
		}
		$this->con = new mysqli("localhost", $user, $pass, $dbname) or die("failed to connect to db" .$error);
		return $this->con;
		
	}
	//returns the full path of the current url
	
   public function fullPath(){
	   $this->path = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	return $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
   }
   public function currentPath(){
	  $this->currentPath = $_SERVER['PHP_SELF'];
return 	$_SERVER['PHP_SELF'];  
	   
   }
   public function openForm($action, $method, $name, $id, $bool){
	   if($bool == false){
		   $bool = '';
	   }
	   else{
		   $bool = 'required';
	   }
	   
	   if ($action == 'self'){
		   $action = '';
		
	   }
	   if ($method == ''){
		   $method = 'post';
	   }
	   return "<form action='" . $action . "' method= '" . $method . "' name = '" . $name . "' id= '" . $id . "'>";
   }
   
   
   public function closeForm(){
	   return "</form>";
   }
   
   
   
   public function inputField($type, $name, $id, $placeholder, $bool){
	    if($bool == false){
		   $bool = '';
	   }
	   else{
		   $bool = 'required';
	   }
	   $arr = array('email', 'text', 'password');
	   if (!in_array($type, $arr)){
		   die('input type not supported, try using the appropriate method');
	   }
	  $str = "<div class='form-group'>
	  <input type='" . $type . "' name='" . $name .  "' id= '" . $id . "' placeholder = '" . $placeholder . "' class='form-control'" . $bool . "/></div>";
	  return $str;
	   
   }
   
   
   public function textArea($name, $id, $placeholder, $flag){
	    if($bool == false){
		   $bool = '';
	   }
	   else{
		   $bool = 'required';
	   }
	   
	   $str = " <div class='form-group'><textarea class='form-control' id='$id' name='$name' rows='3' placeholder='$placeholder' $bool></textarea></div>";
	   return $str;
   }
   
   
   
   public function select($title, $name, $id, array $options){
	  $str = " <div class='form-group'> <select class='form-control' name='$name' id='$id'><option value=''>$title (none..)</option> ";
	  for ($i = 0; $i < count($options); $i++){
		  $str .= "<options value='$options[$i]'>$options[$i] </option>";
	  }
	  $str .= "</select></div>";
	  return $str;
   }
   
   
   public function checkBox($value, $name, $id){
	   $Value = ucwords($value);
	   $str = " <div class='form-check'> $Value &nbsp
    <input type='checkbox' class='form-check-input' value='$value' name='$name' id='$id'>
	</div>
	";
	return $str;
	
   }
   public function radioGroup($name, $id, array $options){
	   //$Value = ucwords($value);
	 $str = " <div class='form-check form-check-inline'>";
	for($i = 0; $i < count($options); $i++){
		$str .= "$options[$i] <input type='radio' class='form-check-input' value='$options[$i]' name='$name' id='$id'>";
	}
    
	$str .= "</div>";
	return $str;   
   }
   public function file($name, $id){
	   
   }

}


?>
