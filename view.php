<?php 
  ob_start();
  include('include/server.php');
  include('uploads');

    // if user is not logged in, they cannot access this page
  if (empty($_SESSION['username'])) {
    header('location: login.php');
  }
  $id=$_REQUEST['id'];
  $sql = "SELECT * from uploads where id='".$id."'";
  $result = mysqli_query($db, $sql) or die ( mysqli_error());
  $row = mysqli_fetch_assoc($result);
  $dept = $row['dept'];
  if(($_SESSION['role'] == 'User' || $_SESSION['role'] == 'Adminuser') && strtoupper($_SESSION['dept']) != $dept){
    echo "<script>alert('You do not have access to view this file!'); window.close();</script>"; 
  }else{
    $file = $row['fileupload'];
    if(file_exists($file)){
      header("Cache-Control: maxage=1");
      header("Pragma: public");
      header("Content-type: application/pdf");
      header('Content-Transfer-Encoding: binary'); 
      header("Content-Description: PHP Generated Data");
      header('Content-Length:' . filesize($file));
      header('Accept-Ranges: bytes');
      ob_clean();
      //@readfile($file);
      readfile($file);
      //OR
      //echo "<iframe src=\"$file\" width=\"100%\" style=\"height:100%\"></iframe>";
    }else{
      echo "<script>alert('File not found!'); window.close();</script>";
    }
    
  }
  echo "<a href='search.php'>Go Back</a>";
?>