<!DOCTYPE html>
<html lang="en">
<head>

<!-- Meta Tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<meta name="description" content="Shield - One Page Corporate Multipurpose Template" />
<meta name="keywords" content="bootstrap,portfolio,corporate,design" />
<meta name="author" content="ThemeMascot" />

<!-- Page Title -->
<title> Hotel Hillock</title>

<!-- Favicon and Touch Icons -->
<link href="images/favicon.ico" rel="shortcut icon" type="image/png">
 

<!-- CSS | main style file -->
<link href="css/style.css" rel="stylesheet" type="text/css">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
<![endif]-->

	 <link rel="stylesheet" href="lobibox-master/font-awesome/css/font-awesome.min.css"/>
        <link rel="stylesheet" href="lobibox-master/demo/demo.css"/>
        
        <link rel="stylesheet" href="lobibox-master/dist/css/Lobibox.min.css"/>

<script src="js/jquery-2.1.1.min.js"></script>

<script>

$(document).ready(function (e) {
$("#userForm").on('submit',(function(e) {
e.preventDefault();
$('#response').show();

$.ajax({
url: "login-exec.php", // Url to which the request is send
type: "POST",             // Type of request to be send, called as method
data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
contentType: false,       // The content type used when sending data to the server.
cache: false,             // To unable request pages to be cached
processData:false,        // To send DOMDocument or non processed data file it is set to false
success: function(data)   // A function to be called if request succeeds
{
//$('#loading').hide();
//$('#userForm')[0].reset();
$("#response").html(data);
}
});

}));
});


</script>

<script src="lobibox-master/js/Lobibox.js"></script>
<script src="lobibox-master/demo/demo.js"></script>

<style>
body{width:100%;margin:auto;min-width:600px;max-width:2000px}
</style>	
	
<body>
<div id="wrapper"> 
  <!-- preloader --> 
  <div id="preloader">
    <div id="spinner"></div>
  </div>
  
  <?php include("header.php"); ?>
  
  <!-- start main-content -->
  <div class="main-content" style="background:#4B3D37;"> 
    <!-- Section: Home -->
  
    <section class="find-location wow fadeInDown" data-wow-delay=".6s" data-wow-duration=".8s">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="row">
             
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="divider bg2 parallax fixed small-padding curve">
      <div class="layer-overlay">
        <div class="container">
          <div class="row"> 
            <!-- Section Content -->
            <div class="section-content" style='margin-top: 20px;'>
              <div class="col-md-12 text-center">
                <form id="userForm" class="reservation-form">
                  <div class='form-row'>
                  <div class='col-xs-12 form-group'>
                    <label class='control-label'>Username</label>
                    <input type="text" name="email" size="4" placeholder="Enter Username" class="form-control" style="margin:0 auto;width:35%">
                  </div>
                </div>
				<div class='form-row'>
                  <div class='col-xs-12 form-group'>
                    <label class='control-label'>Password</label>
                    <input type="password" name="password" size="4" placeholder="Enter Password" class="form-control" style="margin:0 auto;width:35%">
                  </div>
                </div>
				
                  
                 
                  <div class='form-row'>
                    <div class='col-xs-12 form-group'>
                      <button data-loading-text="Please wait..." class="btn btn-default margin-right-15" type="submit">Login</button>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                </form>
				<span id="response"> </span>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </section>
    
  </div>
  <!-- end main-content -->
  
  
  <?php include("footer.php"); ?>
  
  </div>
<!-- end wrapper --> 
<a href="#" class="back-to-top" data-wow-duration="1.0s" data-wow-delay="1.0s"><i class="fa fa-angle-up"></i></a>  

<!-- jQuery scripts --> 
<!-- JS | jquery library  -->

<!-- Bootstrap --> 
<script src="js/bootstrap.min.js"></script> 
<!-- Owl Carousel --> 
<script src="js/owl-carousel/owl.carousel.js"></script> 
<!-- lightbox --> 
<script src="js/lightbox/lightbox.js"></script>
<!-- theme plugins --> 
 <script src="js/theme-plugins.js"></script>
<!-- Revolution Slider -->
<script src="js/rs-plugin/js/revolution.min.js"></script> 
<!-- Countdown  --> 
<script type="text/javascript" src="js/countdown/jquery.downCount.js"></script>
<!-- isotope  -->
<script type="text/javascript" src="js/isotope/isotope.min.js"></script>
<!-- Custom | common script for all pages --> 
<script src="js/custom.js"></script>
</body>
</html>