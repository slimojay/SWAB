<?php
include('../include/server.php');
include('BaseClass.php');
$concern = $_SESSION['concern'];
$concern = "adeniji kazeem";
$app = new BaseClass();
//$app->connect('root', '', 'gindex_gindex');
$app->connect('gindex_gindex', 'D%kuP(+@Ie;x', 'gindex_gindex');
$sel = $app->con->query("SELECT msgno FROM imap_mail_log WHERE concern = '$concern' ORDER BY id DESC LIMIT 1"); 
while($r = $sel->fetch_assoc()){
	if (!empty($r['msgno'])){
	$lastLog = $r['msgno'];
	}else {
		$lastLog = 0;
	}
}
//echo $sel->num_rows;
$username = 'Ojiodujoachim@outlook.com'; $password = '____'; $hostname = '{imap.outlook.com:993/imap/ssl}INBOX'; //outlook.office365.com
$connection = imap_open($hostname,$username,$password) or die('Cannot connect: ' . imap_last_error());
$mailcheck = imap_check($connection);
//var_dump($mailcheck);
//echo '<br> INBOX ' . $mailcheck->Nmsgs;//->msgnum;
//echo '<br> RECENT ' . $mailcheck->Recent;
$data = imap_search($connection, 'ALL');
$mc = imap_check($connection);
$offset2 = $lastLog + 1; //where the logging should start from;
$res = imap_fetch_overview($connection, "$offset2:{$mc->Nmsgs}", 0);
 if (count($res) !== 0){
	 foreach($res as $out){
			$keys = array('msgno', 'subject', 'from_who', 'to_who', 'date', 'concern');
			$vals = array($out->msgno, $out->subject, $out->from, $out->to, $out->date, $concern);
			$app->insert('imap_mail_log', $keys, $vals);
			
			$sel2 = $app->con->query("SELECT msgno FROM imap_mail_log WHERE concern = '$concern' ORDER BY id DESC LIMIT 1"); 
while($r2 = $sel2->fetch_assoc()){
	$newlastLog = $r2['msgno'];
	$offset2 = $offset2 - 1;
	$totalLogs = $newlastLog - $offset2;
	$msgLogged = "<br><center>" . $totalLogs . " mails were  logged</center>";
}
			
			}
 }else{
	 $msgLogged = "<br><center>no mails to log</center>";
 }

include('header.php');
    if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
	$sql = "SELECT * FROM imap_mail_log WHERE concern = '$concern' ";
	$concern= $_SESSION['concern'];
	$concern = 'adeniji kazeem';
	$app->pagination($sql, 10);
	$getLogged = $app->con->query("SELECT * FROM imap_mail_log WHERE concern = '$concern' ORDER BY id DESC LIMIT $app->offset, $app->items");
	$numlg = '';
	}
else if (isset($_POST['go'])){
	$src = $app->con->real_escape_string($_POST['search']);
	$sql = "SELECT * FROM imap_mail_log WHERE concern = '$concern' AND (((msgno LIKE '%$src%') OR subject LIKE '%$src%') OR from_who LIKE '%$src%' ) ";
	$app->pagination($sql, 10);
	$getLogged = $app->con->query("SELECT * FROM imap_mail_log WHERE concern = '$concern' AND msgno LIKE '%$src%' OR subject LIKE '%$src%' OR from_who LIKE '%$src%' ORDER BY id DESC LIMIT $app->offset, $app->items");
	$numlg = $getLogged->num_rows . ' search results';
}
?>



<!DOCTYPE html>
<html>
</head>
</head>
<body>
 <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">

        </div>
      </div>
    </div>
	<div class='col-lg-8' style='margin-left:60px; margin-top:50px'>    
      <form name="" method="post" action="imapp.php" style='width:100%'>
      <div class="form-group">
      <p><input size="55" type="text" placeholder="search for mails logged (message no, subject, sender) " name="search" class="form-control" /><p class="text-center align-items-center" ><input type="submit" name="go" class="btn btn-secondary" value="Search"> &nbsp <input type="reset" class="btn btn-secondary" value="Reset" onclick="window.location='imapp.php'"></p></p>
      </div>
	<center><?php echo $numlg; ?> </center>
<table cellpadding="10" class='table table-striped col-lg-8' cellspacing="1" border="1.5" style='font-family:times new roman; margin-top:50px; margin-left:30px'>
          <thead>
        <tr>
                <th><strong>MsgNo</strong></th>   
                <th><strong>Mail Subject</strong></th>
<th><strong>Mail From</strong></th>				
<th><strong>Date Sent</strong></th>				
                
          
          
          <th><strong>Read</strong></th>
          <!--<th><strong>Comments</strong></th>-->
          
        </tr>
      </thead>
        <tbody>
		<?php 
		while ($rl = $getLogged->fetch_assoc()){
			$msgnoo = $rl['msgno'];
			echo "<tr><td>" . $rl['msgno'] . "</td><td>" .
            $rl['subject'] . "</td><td>" . $rl['from_who'] . "</td><td>" .
            $rl['date'] . "</td><td><a href='readimail.php?msgno=". $msgnoo . "&subject=" . $rl['subject'] . "&from=" . $rl['from_who'] . "&date=". $rl['date'] . " ' target='_blank'>view </a></td></tr>";
            			
		}
		
		?>
		
		</tbody>
		</table>
		<br><br>
		
	<center><ul class='pagination' style='margin-left:50px; text-align:center' >
	
	<?php 

	echo "<center class='blue'>" . $app->pagi . "</center>";
	
	?>
	
	
	
	</ul></center>
		
		
		
		<?php echo $msgLogged; ?>