<?php
	session_start();
	if (empty($_SESSION['username'])) {
		header('location: login.php');
	}
	if(isset($_GET['id']) || isset($_POST['document_id'])){
		$document_id = isset($_GET['id']) ? $_GET['id'] : $_POST['document_id'];
	}else{
		header('location: index.php');
	}
   //$con = mysqli_connect('localhost', 'gindex_gindex', 'D%kuP(+@Ie;x', 'gindex_gindex') or die(mysqli_error());
	$conn = new mysqli('localhost', 'gindex_gindex', 'D%kuP(+@Ie;x', 'gindex_gindex');
	if($conn->connect_error){
		die("Couldn't connect to the database ".$conn->connect_error);
	}

	$msg = '';

	$query = "SELECT * FROM uploads WHERE id = ?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("i", $document_id);
	$stmt->execute();
	$result = $stmt->get_result();
    $document = $result->fetch_assoc();
    
	$query = "SELECT * FROM comments WHERE document_id = ? ORDER BY date DESC";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("i", $document_id);
	$stmt->execute();
	$comments = $stmt->get_result();
    $num_of_comments = $comments->num_rows;
    if ($num_of_comments > 0){
        if (isset($_GET['page_no']) && $_GET['page_no']!="") {
            $page_no = $_GET['page_no'];
            } 
            else {
                $page_no = 1;
                }
        
        $total_records_per_page = 4;
        $offset = ($page_no-1) * $total_records_per_page;
        $previous_page = $page_no - 1;
        $next_page = $page_no + 1;
        $adjacents = "2";
        
        $total_records = $num_of_comments;
        $total_no_of_pages = ceil($total_records / $total_records_per_page);
        $second_last = $total_no_of_pages - 1;

        $query = "SELECT * FROM comments WHERE document_id = ?  ORDER BY date ASC LIMIT $offset, $total_records_per_page";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $document_id);
        $stmt->execute();
        $comments = $stmt->get_result();
    }

    
	if (isset($_POST['sub'])){
		$comment = mysqli_real_escape_string($conn, $_POST['comment']);
		$comment_by = $_SESSION['username'];
		$query = "INSERT INTO comments (document_id, comment, comment_by) VALUES (?, ?, ?)";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("iss", $document_id, $comment, $comment_by);
		$stmt->execute();
		if($stmt->affected_rows > 0){
			echo "<script>alert('Comment has been added!'); location.href='comments.php?id=".$document_id."'</script>";
		}else{
			$msg = "Unable to add comment!";
		}
    }
    
?>


<!DOCTYPE html>
<html class="no-js" lang="en">

    <head>
        <!-- meta data -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <!--font-family-->
		<link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
   		<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
        <!-- title of site -->
        <title>G-index App</title>

        <!-- For favicon png -->
		<link rel="shortcut icon" type="image/icon" href="assets/logo/favicon.png"/>

		<style type="text/css">
			.ourDiv{
    			width:100%;
    			height:300px;
    			background:dimgrey;
			}
		</style>
       
        <!--font-awesome.min.css-->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">

        <!--linear icon css-->
		<link rel="stylesheet" href="assets/css/linearicons.css">

		<!--animate.css-->
        <link rel="stylesheet" href="assets/css/animate.css">

		<!--flaticon.css-->
        <link rel="stylesheet" href="assets/css/flaticon.css">

		<!--slick.css-->
        <link rel="stylesheet" href="assets/css/slick.css">
		<link rel="stylesheet" href="assets/css/slick-theme.css">
		
        <!--bootstrap.min.css-->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- bootsnav -->
		<link rel="stylesheet" href="assets/css/bootsnav.css" >	
        
        <!--style.css-->
        <link rel="stylesheet" href="assets/css/style.css">
        
        <!--responsive.css-->
        <link rel="stylesheet" href="assets/css/responsive.css">
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		
        <!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<style type='text/css'>
#daa{background-color:lightgrey; color:black; padding:5px; margin-top:28px; border:0.5px solid black; margin-right:10px; margin-bottom:5px;}
#daa2{background-color:lightgrey; color:black; padding:5px; margin-top:28px; border:0.5px solid black; margin-right:10px;}
#daa:hover{color:black; background-color:grey;}
#daa2:hover{color:black; background-color:grey;}
 #txtdiv p{padding-top:10px; font-size:18px !important; font-weight:700; opcaity:1; color:white; font-family:times new roman;}
	 #commentsection{width:80%; margin-left:10%; position:absolute; top:170px; background-color:white; border:1px solid lightgrey; border-radius:10px; padding:30px;}
     #fetchcomments{position:absolute; top:480px; margin-top:50px; width:80%; font-family:times new roman; left:10%;}
	 #fetchcomments div{border:1px solid lightgrey; padding:10px; margin-left:10px; margin-bottom:20px;}
	 #name{font-size:12px;color:green;}
.coverdiv{width:100%; height:100%; z-index:6; color:whit; background-color:black; opacity:0.8}
 @media screen and (min-width: 600px) and (max-width: 2500px){
	 #txtdiv p{padding-top:10px; font-size:23px !important; font-weight:700; opcaity:1; color:white; font-family:times new roman;}
	 #commentsection{width:80%; margin-left:10%; position:absolute; top:240px; background-color:white; border:1px solid lightgrey; border-radius:10px; padding:30px;}
     #fetchcomments{position:absolute; top:550px; margin-top:50px; width:80%; font-family:times new roman; left:10%;}
	 #fetchcomments div{border:1px solid lightgrey; padding:10px; margin-left:10px; margin-bottom:20px;}
	 #name{font-size:12px;color:green;}
	 }
</style>
    </head>
	
	<body>
		<!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->
		
		<!--header-top start -->
		<header id="header-top" class="header-top">
			
					
		</header><!--/.header-top-->
		<!--header-top end -->

		<!-- top-area Start -->
		<section class="top-area">
			<div class="header-area">
				<!-- Start Navigation -->
			    <nav class="navbar navbar-default bootsnav  navbar-sticky navbar-scrollspy"  data-minus-value-desktop="70" data-minus-value-mobile="55" data-speed="1000">

			        <div class="container">

			            <!-- Start Header Navigation -->
			            <div class="navbar-header">
			                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
			                    <i class="fa fa-bars"></i>
			                </button>
			                <a class="navbar-brand" href="index.php">G-index<span> App</span></a>

			            </div><!--/.navbar-header-->
			            <!-- End Header Navigation -->

			            <!-- Collect the nav links, forms, and other content for toggling -->
			            <div class="collapse navbar-collapse menu-ui-design" id="navbar-menu">
			                <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
			                <li><a href="new_upload.php" style='display:none;'>Add Files/Documents</a></li>
							<?php if (isset($_SESSION["username"])): ?> 
			                    <li><?php $back = 'GO BACK'; echo  '<a href="search.php"><i class="fa fa-arrow-left"></i>  '. $back . '</a>'; ?> </li>
			                <?php endif ?>
							<?php if (isset($_SESSION["username"])): ?> 
			                    <li><a href="index.php?logout='1'">Sign Out</a></li>
			                <?php endif ?>
			                </ul><!--/.nav -->
							
							
							</section>
							
							
							
							<div style="background-image:url('files.jpg'); background-position:center; background-size:cover; height:400px; width:100%;">
							<div class='coverdiv'>
							 <center id='txtdiv'><p><?php
							 if($document){
								echo "File number : ".$document['fileno']."<br> Suit number: ".$document['suitno']."<br> Parties: ".$document['parties'];
							 }?> </center> 
							</div>
							</div>
							<div id='commentsection'>
						<fieldset>
						<legend>Add Comment</legend>
<form class="form-horizontal" action="comments.php" method='post'>
  <div class="form-group">
  <?php echo "<center><h3>".$msg."</h3></center>";?>
  <label class="control-label col-sm-2" for="pwd">Required(*):</label>
    <div class="col-sm-10">
	<input type='hidden' value='<?php echo $document_id;?>' name='document_id'>
    <textarea cols='33' rows='6' required maxlength='500' placeholder='Enter your comment here (Maximum of 500 characters)' name='comment'></textarea>
  </div></div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name='sub' class="btn btn-default">Submit</button>
    </div>
  </div>
</form>
</fieldset>
</div>

<div id='fetchcomments' class='row'>
<?php
	if($num_of_comments < 1){
        echo "<center><div>
		<center> <h1>No comment on this file yet</h1</center>
		</div></center>";
	}else{
		while($row = $comments->fetch_assoc()){
			$name = $row['comment_by'];
			$comment = str_replace("\\r\\n", " ", $row['comment']);
			$date = $row['date'];
			echo "
			<div class='col-lg-5'>
			$comment <br>
			<center id='name'>Comment by $name on $date</center>
			</div>";
		}
	}
?>
<div style="margin-top:50px; position:relative; top:50px; border:0px solid grey">
<?php if($num_of_comments > 0) {?>
<center><ul class="pagination">
	       <li class="disabled"><a href="#!"><i class="fa fa-chevron-left"></i></a></li>
	      <?php if($page_no > 1){
echo "<li class='waves-effect'><a href='comments.php?id=".$document_id."&page_no=1' class='btn btn-default'>First Page</a></li>";
} ?>
	      
	<li <?php if($page_no <= 1){ echo "class='disabled waves-effect'"; } ?> >
<a <?php if($page_no > 1){
echo "href='comments.php?id=".$document_id."&page_no=$previous_page'";
} ?> class='btn btn-default'>Previous</a>
</li>
	
	<li <?php if($page_no >= $total_no_of_pages){
echo "class='disabled waves-effect'";
} ?>>
<a <?php if($page_no < $total_no_of_pages) {
echo "href='comments.php?id=".$document_id."&page_no=$next_page'";
} ?> class='btn btn-default'>Next</a>
</li>
	<?php if($page_no < $total_no_of_pages){
echo "<li class='waves-effect'><a href='comments.php?id=".$document_id."&page_no=$total_no_of_pages'class='btn btn-default'>Last &rsaquo;&rsaquo;</a></li>";

} ?>

    <li class="waves-effect"><a href="#!"><i class="fa fa-chevron-right"></i></a></li>

</ul>
</div>
<?php }?>