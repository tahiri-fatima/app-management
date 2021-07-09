<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Page d'accuiel</title>
  <meta content="" name="description">
  <meta content="" name="keywords">


<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">

<!-- Vendor CSS Files -->
<link href="assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="assets/css/owl/owl.carousel.min.css" rel="stylesheet">
<link href="assets/css/venobox/venobox.css" rel="stylesheet">
<link href="assets/css/aos.css" rel="stylesheet">

    <!-- Required Fremwork -->
    <!-- waves.css -->
    <!-- themify icon -->
    <!-- font-awesome-n -->
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome-n.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <!-- scrollbar.css -->
  <!-- Template Main CSS File -->
  <link href="assets/css/home.css" rel="stylesheet">
  

  <!-- =======================================================
  * Template Name: Regna - v2.2.1
  * Template URL: https://bootstrapmade.com/regna-bootstrap-onepage-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header-transparent">
    <div class="container">

      <div id="logo" class="pull-left">
        <a href="/home"><img src="assets/images/logo.png" alt="" Style="width: 100px; height:50px;"></a>
        <!-- Uncomment below if you prefer to use a text logo -->
        <!--<h1><a href="#hero">Regna</a></h1>-->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="home">Home</a></li>
          @guest
            @if (Route::has('login'))
                <li class="menu-active"><a href="{{ route('login') }}">Se connecter</a></li>
               
            @endif
    
        
       @endguest
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- End Header -->


  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
      <h1>Welcome </h1>
      <a href="{{ route('login') }}" class="btn-get-started">Se connecter</a>
    </div>
  </section><!-- End Hero Section -->

  <main id="main">


  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">

      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!--
        All the links in the footer should remain intact.
        You can delete the links only if you purchased the pro version.
        Licensing information: https://bootstrapmade.com/license/
        Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Regna
      -->
        Designed by <a href="">La Route Centrale</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/js/jquery/jquery.min.js"></script>
  <script src="assets/js/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/js/php-email-form/validate.js"></script>
  <script src="assets/js/counterup/counterup.min.js"></script>
  <script src="assets/js/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/js/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/js/superfish/superfish.min.js"></script>
  <script src="assets/js/hoverIntent/hoverIntent.js"></script>
  <script src="assets/js/owl.carousel.min.js"></script>
  <script src="assets/js/venobox/venobox.min.js"></script>
  <script src="assets/js/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>