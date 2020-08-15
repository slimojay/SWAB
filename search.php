<?php include('include/server.php');

  // if user is not logged in, they cannot access this page
if (empty($_SESSION['username'])) {
  header('location: login.php');
}

$dept = $_SESSION['dept'];
$role = $_SESSION['role'];
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

    <head>
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

  
        <!-- meta data -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <!--font-family-->
		<link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        
        <!-- title of site -->
        <title>G-index App</title>

        <!-- For favicon png -->
		<link rel="shortcut icon" type="image/icon" href="assets/logo/favicon.png"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
		<style type="text/css">
		.dplink{margin-bottom:10px;}
			.ourDiv{
    			width:100%;
    			height:300px;
    			background:dimgrey;
			}
			@media screen and (min-width: 600px) and (max-width: 2500px){
	   .back{margin-left:70%;}
	   #iconholder{float:right; margin-left:98%; margin-top:-50px;}
	   .lgg{margin-top:-10px; padding-top:-30px; font-family:times new roman; text-transform:uppercase; position:relative; left:600px;}
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
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
 


        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		
        <!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
	
	<body style='font-family:'>
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
					
			                <ul class="nav navbar-nav navbar-riht lgg" data-in="fadeInDown" data-out="fadeOutUp">
							<!--<div class='dropdown right' style='font-family:times new roman; margin-left:200px; margin-top:50px;'><button class='dropdown-toggle btn btn-primary' data-toggle='dropdown'>Add Files/Documents <span class='caret'></span> </button>
							<span class='dropdown-menu'>
							<li>upload new file</li>
							<li>update previous file</li>
							</span></div>-->
							
							
							<?php if (isset($_SESSION["username"])): ?> 
			                    <li  style="padding:1px; margn-top:25px; display:none;" class="btn btn-secondary"><?php echo  '<a href="search.php"  >'. $_SESSION['username'] .'</a>'; ?> </li>
			                <?php endif ?>
							<?php 
								if (isset($_SESSION['admin_role']) && $_SESSION['admin_role'] == 1){

							echo "<li style='list-style-type:none' class=''> <a  href='new_upload.php' id='lg' class='btn btn-alert' style=''>add files/documents</a></li>
						"; }?> 
							
							</ul>
							
						
						
						
						
						
          <span class="nav-item dropdown-right"id='iconholder'>

			            <a class="nav-link dplink pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
             <!-- <img class="avatar avatar-sm rounded-circle" src='./assets/img/placeholder_avatar.gif'>--><i class="fa fa-user" style='color:dimgrey; background-color:white; border:0.4px solid dimgrey; padding:8px; border-radius:10px;'></i>
                </img>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold"><?php //echo $_SESSION['username']?></span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right" style='font-family:times new roman; padding:12px'>
              <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0"><i class='fa fa-check'></i> &nbsp <?php echo "<small style='text-transform:lowercase; font-size:10px;'>signed in as </small><br><span style='color:lightblue;'>" .
			   $_SESSION['username'] . "</span>"; ?>
			  
			  </h6>
            </div><hr>
            <a href='settings.php'#<i class="fa fa-cog"></i>  &nbsp
              <span>Account Settings</span></a>
            </a><hr>
            <div class="dropdown-divider"></div>
            <?php if (isset($_SESSION["username"])): ?>
            <a href="index.php?logout='1'" class="dropdown-item">
              <i class="fa fa-times"></i> &nbsp
              <span>Logout</span>
            </a><?php endif ?>
            </div>
          </li>
						
						
							
							
							
							
							
							<?php if (isset($_SESSION["username"])): ?> 
			                   <!-- <li><a href="index.php?logout='1'">Sign Out</a></li>-->
			                <?php endif ?>
							
							
	
							
							
							
							
			                </ul><!--/.nav -->
			            </div><!-- /.navbar-collapse -->
			        </div><!--/.container-->
			    </nav><!--/nav-->
			    <!-- End Navigation -->
			</div><!--/.header-area-->
		    <div class="clearfix"></div>

		</section><!-- /.top-area-->
		<!-- top-area End -->

		<!--welcome-hero start -->
			<div class="ourDiv">
				<br>
				<form action="search.php" method="post">
				<div class="centre welcome-hero-serch-box">
					<div class="row">
					<div class="col-sm-12">
						<div class="subscription-input-group">
								<input type="text" name="search" class="subscription-input-form" placeholder="Search Eg.: File No, Suit No, Parties or Keywords">
								<button class="appsLand-btn subscribe-btn" name="valueToSearch">
									search <i data-feather="search" height="12"></i>
								</button>
						</div>
					</div>	
				</div>
				</div>
				</form>
				<div class="centre welcome-hero-serch-box"><br>
					<p class="centre"><i style="color: white" class="fa fa-check-square"></i><h3 style="color: white">&nbsp;Search</h3></p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<p class="centre"><i style="color: white" class="fa fa-check-square"></i><h3 style="color: white">&nbsp;View</h3></p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<p class="centre"><i style="color: white" class="fa fa-check-square"></i><h3 style="color: white">&nbsp;Download</h3></p>
				</div>

			</div>


		<!--works start -->
		<section id="works" class="works">
			<div class="container" id="works">
				<div class="works-content">
					<div class="row">
<?php
$msg = '';
if(isset($_POST['valueToSearch']))
{
$valueToSearch =  $_POST['search'];
$msg = 'Showing Search Result for "'.$valueToSearch.'"';
$url = "/searchdcl.php";
$mydept = "DCL";

if (empty($valueToSearch)) {
	echo  '<script>alert("Please enter a file number/keyword. Searchbox is empty")</script>';
	redirect($url);
}

//$db = mysqli_connect('localhost', 'gindex', 'Bawd8T31l0', 'gindex_gindex');

$sql="SELECT * FROM uploads WHERE dept='$dept' AND ((((fileno LIKE '%".$valueToSearch."%')OR suitno LIKE '%".$valueToSearch."%')OR parties LIKE '%".$valueToSearch."%')OR keywords LIKE '%".$valueToSearch."%')";
if($res = mysqli_query($db, $sql)){ 
    if(mysqli_num_rows($res) > 0){ 
		$total_results = $res->num_rows;
echo '<div class="section-header"><p>'.$msg.'</p></div>';
echo '<div class="section-header">';
echo '<p>'. $total_results. ' Related Document(s) Found</p>';
echo '</div>';
echo '<br><br><br>';


                echo '<table id="example1" style="font-family:times new roman"class="table table-bordered table-striped">'; 
				echo "<th style='color:red'>DOC ID</th>";
                echo "<th>File No</th>"; 
                echo "<th>Suit No</th>"; 
                echo "<th>Parties</th>";
              
				echo "<th>Departments</th>";
				echo "<th>View</th>";
				echo "<th>Comments</th>";
				 
            echo "</tr>"; 
        while($row = mysqli_fetch_array($res)){ 
            echo "<tr>"; 
			 echo "<td style='color:red'>" . $row['id'] . "</td>";
                echo "<td>" . $row['fileno'] . "</td>"; 
                echo "<td>" . $row['suitno'] . "</td>"; 
                echo "<td>" . $row['parties'] . "</td>";
               
                echo "<td>" . $row['dept'] . "</td>";
                if($role == 'User'){
                    echo "<td style='color:lightgreen'><a style='color:lightgreen' target='_blank' href='view_regular.php?id=" . $row['id']. "'>View </a></td>";
                }else{
					echo '<td style="color:lightgreen"><a style="color:lightgreen" target="_blank" href="view.php?id=' . $row['id'] . '">View</a></td>';
				}
				echo '<td style="color:red"><a target="_blank" style="font-size:11px; font-family:times new roman" href="comments.php?id=' . $row['id'] . '">view/Add Comments</a></td>';
            echo "</tr>"; 
        } 
        echo "</table>"; 
        mysqli_free_result($res); 
    } else{ 
        echo "<div class='section-header'><p>No Matching Record Found.</p></div>"; 
    } 
} else{ 
    echo "ERROR: Could not able to execute $sql. "  
                                . mysqli_error($db); 
} 
}
  
mysqli_close($db); 
?> 

</form>

						
					</div>
				</div>
			</div><!--/.container-->
		
		</section><!--/.works-->
		<!--works end -->

		<!--footer start-->
		<footer id="footer"  class="footer">
			<div class="container">
				<div class="footer-menu">
		           	<div class="row">
			           	<div class="col-sm-3">
			           		 <div class="navbar-header">
				                <a class="navbar-brand" href="index.php">G-index<span>App</span></a>
				            </div><!--/.navbar-header-->
			           	</div>
		           </div>
				</div>
				<div class="hm-footer-copyright">
					<div class="row">
						<div class="col-sm-5">
							<p>
							 copyright &copy; &nbsp<script>document.write(new Date().getFullYear())</script> <a href="https://www.globaltandt.com.ng/">Global T and T New Solutions Ltd.</a>
							</p><!--/p-->
						</div>
						<div class="col-sm-7">
							<div class="footer-social">
								<span><i class="fa fa-envelope"> info@globaltandt.com.ng</i></span>
								<a href="#"><i class="fa fa-facebook"></i></a>	
								<a href="#"><i class="fa fa-twitter"></i></a>
								<a href="#"><i class="fa fa-linkedin"></i></a>
								<a href="#"><i class="fa fa-google-plus"></i></a>
							</div>
						</div>
					</div>
					
				</div><!--/.hm-footer-copyright-->
			</div><!--/.container-->


		<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Reset Password <?php echo $_SESSION['username'] ; ?></h4>
      </div>
      <div class="modal-body">
        
	  <div class="col">
          <div class="card shadow">
            <div class="card-header bg-transparent">
              <h3 class="mb-0"> Change Password </h3>
            </div>
            <div class="card-body">
              <div class="row icon-examples">                
                <div class="col-lg-8 col-md-8">
                  <form method="post" action="search.php">
                    <?php include('errors.php') ?>
                    <div class="form-group">
                      <input type="password" required class="form-control" placeholder="current password" name="cp" value="<?php echo $file_name; ?>">
                    </div>
                    <div class="form-group">
                      <input type="password" required class="form-control" placeholder="new password" name="np" value="<?php echo $file_name; ?>">
                    </div>
                    <div class="form-group">
                      <input type="password" required class="form-control" placeholder="retype new password" name="retype" value="<?php echo $file_name; ?>">
                    </div>
                    <button type="submit" name="sub" id="submit" class="btn btn-secondary">Submit</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>




			<div id="scroll-Top">
				<div class="return-to-top">
					<i class="fa fa-angle-up " id="scroll-top" data-toggle="tooltip" data-placement="top" title="" data-original-title="Back to Top" aria-hidden="true"></i>
				</div>
				
			</div><!--/.scroll-Top-->
			
        </footer><!--/.footer-->
		<!--footer end-->
		
		<!-- Include all js compiled plugins (below), or include individual files as needed -->

		<script src="assets/js/jquery.js"></script>
        
        <!--modernizr.min.js-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
		
		<!--bootstrap.min.js-->
        <script src="assets/js/bootstrap.min.js"></script>
		
		<!-- bootsnav js -->
		<script src="assets/js/bootsnav.js"></script>

        <!--feather.min.js-->
        <script  src="assets/js/feather.min.js"></script>

        <!-- counter js -->
		<script src="assets/js/jquery.counterup.min.js"></script>
		<script src="assets/js/waypoints.min.js"></script>

        <!--slick.min.js-->
        <script src="assets/js/slick.min.js"></script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
		     
        <!--Custom JS-->
        <script src="assets/js/custom.js"></script>

        <script type="text/javascript">
        	

			
			
        	window.smoothScroll = function(target) {
    var scrollContainer = target;
    do { //find scroll container
        scrollContainer = scrollContainer.parentNode;
        if (!scrollContainer) return;
        scrollContainer.scrollTop += 1;
    } while (scrollContainer.scrollTop == 0);

    var targetY = 0;
    do { //find the top of target relatively to the container
        if (target == scrollContainer) break;
        targetY += target.offsetTop;
    } while (target = target.offsetParent);

    scroll = function(c, a, b, i) {
        i++; if (i > 30) return;
        c.scrollTop = a + (b - a) / 30 * i;
        setTimeout(function(){ scroll(c, a, b, i); }, 20);
    }
    // start scrolling
    scroll(scrollContainer, scrollContainer.scrollTop, targetY, 0);
}
        </script>

        <script type="text/javascript">
        	
        </script>
        
    </body>
	
</html>
<!-- 
	//////////////////////////////////////////////////////

	DESIGNED & DEVELOPED by Afolayan Emmanuel O
		
	Email: 			iammuyiwa@gmail.com
	Twitter: 		http://twitter.com/iam_alphonse

	CO-Developer - 

	//////////////////////////////////////////////////////
-->