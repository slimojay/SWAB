<?php
//header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
//header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
//the slimphp class is a basic CRUD application helper, which helps PHP  developers build crud apps 
//seamlessly, as the SlimPHP library helps them complete most of the tasks, in order to reduce time spent on a project
//  
class BaseClass{
	public $con; 
	public $path;
	public $currentPath;
	public $href ;
	public $offset;
	public function __construct(){
		
	}
	
	//this method helps you connect to the database,
	//it takes three args
	//1)the username of the account
	//2)the password of the account
	//3)the database to connect to
	public function connect($user, $pass, $dbname){
		/*if ($flag == true){
			$error = error();
		}
		else{
			$error = 'an error occured';
		}*/
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
   public function openForm($action, $method,  $id, $bool){
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
	   return //"<form action='" . $action . "' method= '" . $method .  "' . id = '" . $id ."' enctype='multipart/form-data'>";
	   "<form action='$action' method='$method' id='$id' enctype='multipart/form-data'>";
   }
   
   
   public function closeForm(){
	   return "</form>";
   }
   
   
   
   public function inputField($type, $name, $id, $placeholder, bool $required){
	    if($required == false){
		   $required = '';
	   }
	   else{
		   $required = 'required';
	   }
	   $arr = array('email', 'text', 'password');
	   if (!in_array($type, $arr)){
		   die('input type not supported, try using the appropriate method');
	   }
	  $str = "<div class='form-group'>
	  <input type='$type' name='$name' id= '$id' placeholder = '$placeholder' class='form-control' $required/></div>";
	  return $str;
	   
   }
   
   
   public function textArea($name, $id, $placeholder, $bool){
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
	   if ($title == ''){
		   $title = 'Please Select';
	   }
	  $str = " <div class='form-group'> <select class='form-control' name='$name' id='$id'><option value=''>$title</option> ";
	 // for ($i = 0; $i < count($options); $i++)
		 $i = 0;
	 while($i < count($options)){
		  $str .= "<option value='$options[$i]'>$options[$i] </option>"; $i++;
	  }
	  $str .= "</select></div>";
	  return $str;
   }
   
   
   public function checkBox($value, $name, $id, $bool){
	   if($bool == true){
		   $checked = 'checked';
	   }
	   else{
		   $checked = '';
	   }
	   $Value = ucwords($value);
	   $str = " <div class='form-check'> $Value &nbsp
    <input type='checkbox' class='form-check-input' $checked value='$value' name='$name' id='$id'>
	</div>
	";
	return $str;
	
   }
   public function radioGroup($name, $id, array $options){
	   //$Value = ucwords($value);
	 $str = " <div class='form-check form-check-inline'>";
	for($i = 0; $i < count($options); $i++){
		$str .= "$options[$i] <input type='radio' class='form-check-input' value='$options[$i]' name='$name' id='$id'> &nbsp &nbsp";
	}
    
	$str .= "</div>";
	return $str;   
   }
   public function _file($name, $id, $purpose, bool $multiple){
	   if($multiple == true){
		   $mul = 'multiple';
	   }else{
		   $mul = '';
	   }
	   if (empty($purpose)){
		   $purpose = 'upload file **';
	   }
	   $purpose = ucwords($purpose);
	   $str = " 
  <div class='form-group'>
    <label for='$name'>$purpose</label><br><br>
    <input type='file' class='form-control-file' id='$id' $mul name='$name'/>
  </div>";
  return $str;
	   
   }
   public function submit($name, $id, $value){
	   $str = "<input type='submit' name='$name' id='$id' value='$value' />";
	   return $str;
   }
   
   
   public function insert($table, array $keys, array $values){
	   $this->errors = array(); $this->output = array();
	   if (count($keys) == count($values)){
	   /*array_push('cols and values do not match in length', $errors);
		print_r($errors);*/
	   
	   $txtkey = ''; $txtval = '';
	   for ($i = 0; $i < count($keys); $i++){
		 $txtkey .= $keys[$i] . ',';
		 
	   }
	   $newkey = rtrim($txtkey, ',');
	   for ($i = 0; $i < count($values); $i++){
		   $txtval .= "'" . $values[$i] . "',";
	   }
	   $newval = rtrim($txtval, ',');
	   $sql = $this->con->query("INSERT INTO $table ($newkey) VALUES ($newval)");
	   if($sql){
		   $msg = 'data inserted';
		   $this->output['outcome'] = $msg;
		   $id = $this->con->insert_id;
		  
		   $this->output['Query_Id'] = $id;
		   
		   $this->con->rollback();
	   }
	   else{
		   $err = mysqli_error($this->con); 
		   $this->output['error1'] = $err;
	   }
	  
	   
	   }
	   else{
		   $msg = 'columns and values do not match in length';
		  $this->output['error2'] = $msg;
	   }
	   return $this->output;
   }
   public function checkMime(string $file){
	   if(empty($file)){
		echo 'file not set';
         die();		
	   }else{
		   $this->output = mime_content_type($file);
		   
		   return $this->output;
	   }
   }
   public function upload(string $file, array $dir, bool $create_dir_if_not_exists,int $size = 0, array $extensions){
	   if(empty($file)){
		   echo 'empty name parameter';
		   exit;
	   }else{
		   echo $file;
	   }
	   $filename = basename($file);
	   //the third parameter 'create_dir_if_not_exists', take either true or false
	   //if true a directory with the directory name passed as a second parameter will be created
	   //$type can either be $file = application/pdf, image/png etc
	   //please be sure to check the right format for your file;
	   //the $type parameter is optional
	   for($i = 0; $i < count($dir); $i++){
		   
	   if(!file_exists($dir[$i]) && $create_dir_if_not_exists == false){
		 echo $dir[$i] . 'is not a recognized folder <br> please create this directory or pass <u>true</u> as a third parameter to this function';   
	   }
	   else if(!file_exists($dir[$i]) && $create_dir_if_not_exists == true){
		   mkdir($dir[$i]);
	   }
	   }
	   
	   //checking if the file is what we expect and if it's an allowed file type
	  $this->checkMime($filename);
	  $ext = explode('/', $this->output);
	  if(!in_array($ext[1], $extensions)){
		  echo '<hr>' . $ext[1] . '____' . $this->output . '<hr>';
		  echo '<br> unrecognized file format';
		  exit;
	  }
	  
	  /*if (!in_array($this->output, $type)){
		  echo '<br> unrecognized file format';
		  exit;
	  }*/
	  if ($size !== 0){
		  if (filesize($file) > $size){
			  echo 'max file size allowed : ' . $size . '<br> file size uploaded : ' . filesize($file);
			  exit;
		  }
		  
	  }
	  $iv = rand(99, 9999);
	  $date = date('l-D-M-Y');
	  $this->newname = $date . $iv . $filename;
	  if (move_uploaded_file($_FILES[$file]['tmp_name'], $this->newname)){
		  $result = array();
		  $result['filename'] = $this->newname;
		  $result['outcome'] = 'file moved';
		  echo '<br>';
		  return $result;
	  }
   }
   
 public function displayPagination($total_num_of_pages, $page_no){ 
	$output = '';
/*if ($using_query_string == true){
	$url = $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'];
    $
$url = 

}
*/
$url = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])){
	//unset($_GET['page_no']);
	$queries = $_SERVER['QUERY_STRING'];}else{
		$queries ='';
	}
	$url .= '?' . $queries . '&page_no';

/*else{
	$url .= '?page_no';
}*/
if ($total_num_of_pages >= 1){
//$page_no;
if($total_num_of_pages <= 10){
   for ($i =1; $i <= $total_num_of_pages; $i++){
	   if($i == $page_no){
		   $output .= "<li class='active page-item'><a href='$url=$page_no' class='page-link'>$i</a></li>";
	   }else{
     $output .= "<li class='page-item'><a href='$url=$i' class='page-link'>$i</a></li>";
	   }
  }
  //$this->pagi = $output;
}
else if($total_num_of_pages > 10){
if ($page_no <= 4){
	for($i = 1; $i < 8; $i++){
		if($i == $page_no){
		$output .= "<li class='active page-item blue'><a href='$url=$page_no' class='blue page-link'>$i</a></li>";	
		}else{
		$output .= "<li class='blue page-item'><a href='$url=$i' class='blue page-link'>$i</a></li>";	
		}
	}
	$output .= '...';
	$penult = $total_num_of_pages - 1;
	$output .= "<li class='blue page-item'><a href='$url=$penult ' class='blue page-link'>$penult</a></li>";
	$output .= "<li class='page-item'><a href='$url=$page_no' class='blue page-link'>$total_num_of_pages</a></li>"; 
}
elseif($page_no > 4 && $page_no < $total_no_of_pages - 4){
	$output .= "<li class='page-item'><a href='$url=1' class='blue page-link'>1</a></li><li class='page-item'><a href='$url=2' class='blue page-link'>2</a></li><li class='page-item'>...</li>";
	for($i = $page_no - $adjacent; $i <= $page_no + $adjacent; $i++){
		if ($i == $page_no){
			$output .= "<li class='active page-item'><a href='$url=$page_no' class='blue page-link'>$i</a></li>";
		}else{
			$output .=  "<li class='page-item'><a href='$url=$i' class='blue page-link'>$i</a></li>";
		}
	}
	$output .= '...';
	$penult = $total_num_of_pages - 1;
	$output .= "<li class='page-item'><a href='$url=$penult' class='blue page-link'>$penult</a></li>";
	$output .= "<li class='page-item'><a href='$url=$page_no' class='blue page-link'>$total_num_of_pages</a></li>"; 
}
else {
	$output .= "<li class='page-item'><a href='$url?=1' class='blue page-link'>1</a></li><li class='page-item'><a href='$url=2' class='blue page-link'>2</a></li><li>...</li>";
	for ($i = $total_no_of_pages - 6; $i <= $total_no_of_pages; $i++) {
     if ($i == $page_no) {
 echo "<li class='active page-item'>$i</li>"; 
 }else{
        echo "<li class='page-item'><a href='$url=$i' class='blue page-link'>$i</a></li>";
 }                   
     }
}


}


}
else{
	$output .= "no data to display";
}
$this->pagi = $output;
return $this->pagi;
}
   
   public function sqlQuery($table, $limit, $offset, $sql, $keynames){
	//$this->keynames = ('name')
	 $sql =  $this->con("SELECT *FROM $table LIMIT $offset, $limit ");
	 $this->sql = $sql;
	 //return $sql;
   }
   public function queryBuilder($sql){
	  // $sql .= " LIMIT $this->offset, $this->items	";
	   $$this->con->query($sql); 
	   
   }
   public function pagination($queryString, $items){
	   if ($items < 2) die('invalid item number');
	   if (isset($_GET['page_no']) && $_GET['page_no']!="") {
       $page_no = $_GET['page_no'];
     } else {
        $page_no = 1;
        }
		//$this->page_url = $page_url;
		$this->page_no = $page_no;
		$offset = ($page_no - 1) * $items;
		$this->offset = $offset;
		$this->items = $items;
        $previous_page = $page_no - 1;
        $next_page = $page_no + 1;
		$adjacents = 2; 
		$result_count = $this->con->query($queryString);// . "  LIMIT " . $offset . "," . $items_per_page);
		$total_records = $result_count->num_rows;
		$this->total_records = $total_records;
		$total_no_of_pages = ceil($total_records / $items);
		$this->total_no_of_pages = $total_no_of_pages;
		$second_last = $total_no_of_pages - 1;
		$this->displayPagination($total_no_of_pages, $page_no);  
   }
   

}
?>
