<?php 
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
$file = $row['fileupload'];
$dept = $row['dept'];
$file = explode("/", $file)[2];
$url = 'http://179.61.137.11/~gindex/uploads/'.$file;
?>
<html>
<head>
<link rel = "stylesheet" 
href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
  <title>View Document</title>
</head>
<body>
<?php 
  if(($_SESSION['role'] == 'User' || $_SESSION['role'] == 'Adminuser') && strtoupper($_SESSION['dept']) != $dept){
    echo "<script>alert('You do not have access to view this file!'); location.href='search.php'</script>";
  }else{
    if(!file_exists($row['fileupload'])){
      echo "<script>alert('File not found!'); location.href='search.php'</script>";
    }else{
?>
<script>document.getElementsByTagName('body')[0].oncontextmenu = function(e){e.preventDefault();}</script>
<script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>

<center><h1 style='color:lightgrey'>___________</h1>

<div>
  <button id="prev"><i class="fa fa-angle-left"></i></button>
  <button id="next"><i class="fa fa-angle-right"></i></button><br><br>
  &nbsp; &nbsp;
  <span>Page: <span id="page_num"></span> / <span id="page_count"></span></span>
</div></center>

<canvas id="the-canvas" height="673" width="500"></canvas>
<script>
  // If absolute URL from the remote server is provided, configure the CORS
// header on that server.
var url = "<?php echo $url;?>";

// Loaded via <script> tag, create shortcut to access PDF.js exports.
var pdfjsLib = window['pdfjs-dist/build/pdf'];

// The workerSrc property shall be specified.
pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';

var pdfDoc = null,
    pageNum = 1,
    pageRendering = false,
    pageNumPending = null,
    scale = 1.3,
    canvas = document.getElementById('the-canvas'),
    ctx = canvas.getContext('2d');

/**
 * Get page info from document, resize canvas accordingly, and render page.
 * @param num Page number.
 */
function renderPage(num) {
  pageRendering = true;
  // Using promise to fetch the page
  pdfDoc.getPage(num).then(function(page) {
    var viewport = page.getViewport({scale: scale});
    canvas.height = viewport.height;
    canvas.width = viewport.width;

    // Render PDF page into canvas context
    var renderContext = {
      canvasContext: ctx,
      viewport: viewport
    };
    var renderTask = page.render(renderContext);

    // Wait for rendering to finish
    renderTask.promise.then(function() {
      pageRendering = false;
      if (pageNumPending !== null) {
        // New page rendering is pending
        renderPage(pageNumPending);
        pageNumPending = null;
      }
    });
  });

  // Update page counters
  document.getElementById('page_num').textContent = num;
}

/**
 * If another page rendering in progress, waits until the rendering is
 * finised. Otherwise, executes rendering immediately.
 */
function queueRenderPage(num) {
  if (pageRendering) {
    pageNumPending = num;
  } else {
    renderPage(num);
  }
}

/**
 * Displays previous page.
 */
function onPrevPage() {
  if (pageNum <= 1) {
    return;
  }
  pageNum--;
  queueRenderPage(pageNum);
}
document.getElementById('prev').addEventListener('click', onPrevPage);

/**
 * Displays next page.
 */
function onNextPage() {
  if (pageNum >= pdfDoc.numPages) {
    return;
  }
  pageNum++;
  queueRenderPage(pageNum);
}
document.getElementById('next').addEventListener('click', onNextPage);

/**
 * Asynchronously downloads PDF.
 */
pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
  pdfDoc = pdfDoc_;
  document.getElementById('page_count').textContent = pdfDoc.numPages;

  // Initial/first page rendering
  renderPage(pageNum);
});
</script>
<style>
  #the-canvas {
    border: 1px solid black;
    direction: ltr;
    width:80%; padding:10px; margin-left:10%;
  }
  #prev{background-color:white; color:lightblue; padding:10px;}
  #next{background-color:white; color:lightblue; padding:10px;}

  @media screen and (min-width:0px) and (max-width:600px) {
  body {
   
  }
   #the-canvas {
    border: 1px solid black;
    direction: ltr;
	width:100%; padding:1px; margin-top:30px;
	
  }
}
</style>
<?php } }?>
</body>
<html>