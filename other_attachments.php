<?php
include('../include/server.php');
include('BaseClass.php');
include('header.php');
$app = new  BaseClass();
$app->connect('root', '', 'gindex_gindex');
if (!isset($_GET['id'])){
	echo 'unrecognized gateway';
	exit;
}
else{
	$id = $_GET['id'];
}
$ql = $app->con->query("SELECT * FROM uploads WHERE id = '$id' ");
//$ql->
?>


<head>
<style type='text/css'>
.col:hover{
	transform:scaleY(1.101);
}

</style>

</head>
<body>


<!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8" style='border-radius:10px;'>
      <div class="container-fluid">
        <div class="header-body">

        </div>
      </div>
    </div>
	<div class='row' style='padding:20px 10px 35px 10px; margin-top:50px; margin-left:30px; text-align:center; border:0.7px solid lightgrey; border-radius:15px; font-family:times new roman'>
	<?php
	while($row = $ql->fetch_assoc()){
	   if (empty($row['more_attachments'])){
		   echo 'empty';
		   exit;
	   }
       else{
		  // echo $row['more_attachments'];
		   $exp = explode(" ", $row['more_attachments']);
		   for ($i = 0; $i < count($exp); $i++){
			   $str = $exp[$i];
			   if ($str !== ''){
			   echo "<div class='col ' style='background-color:black; color:grey; padding:10px 0px 15px 0px; margin-top:30px; margin-left:5px;  border:0.4px solid lightgrey; border-radius:15px; backgroundcolor:white; font-size:11px; text-align:center'>
			   <p> $str </p>
			   <p><a href='$str' download> <i class='fa fa-download medium'></i></a> &nbsp &nbsp
			   <a href='view_attachment.php?doc=$str'><i class='fa fa-eye'></i></a></p>
			   
			   </div>";
			   }
			   
			   
		   }
		   
	   }


	   
	}
	
	
	
	?>
	</div><br>
	
	<?php include('footer.php'); ?>