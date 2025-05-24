<?php 
//session_start();
// Include database connection
include("code/con1.php");

// Ensure the username is properly sanitized
$username=$_SESSION['username']; 
    $query = "SELECT * FROM `users` WHERE username = '$username'";
    $result = mysqli_query($con, $query);
        $use = mysqli_fetch_assoc($result); 
?>
<div class="container-scroller">
      <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0">
          <div class="card-body card-body-padding px-3 d-flex align-items-center justify-content-between">
            <div>
              
            </div>
            
          </div>
        </div>
      </div>
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
    <a class="navbar-brand brand-logo me-5" href="#"><img src="assets/images/logooo.jpg" alt="logo" /><img src="assets/images/logoo.jpg" class="me-2" alt="logo" /></a>
    <a class="navbar-brand brand-logo-mini" href="#"><img src="assets/images/logooo.jpg" alt="logo" /></a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="icon-menu"></span>
    </button>
    <ul class="navbar-nav mr-lg-2">
      <li class="nav-item nav-search d-none d-lg-block">
        <div class="input-group">
          <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
            <h2>Lost/Found Retrieval System</h2>
          </div>
        </div>
      </li>
    </ul>
    <ul class="navbar-nav navbar-nav-right">
      
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
          <img src="<?php echo htmlspecialchars($use['profile']); ?>" alt="profile" />
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
          <a href="profile1.php" class="dropdown-item">
            <i class="ti-settings text-primary"></i> Settings </a>
          <a href="code/logout.php" class="dropdown-item">
            <i class="ti-power-off text-primary"></i> Logout </a>
        </div>
      </li>
      <li class="nav-item nav-settings d-none d-lg-flex">
        <a class="nav-link" href="#">
          <i class="icon-ellipsis"></i>
        </a>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="icon-menu"></span>
    </button>
  </div>
</nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="home.php">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">DASHBOARD</span>
      </a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
        <i class="icon-head menu-icon"></i>
        <span class="menu-title">USER PAGE</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="auth">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="profile1.php"> Profile </a></li>
          <li class="nav-item"> <a class="nav-link" href="register_other.php"> Register </a></li>
        </ul>
      </div>
    </li>
    
   
    <li class="nav-item">
      <a class="nav-link" href="found.php">
        <i class="mdi mdi-account-convert menu-icon"></i>
        <span class="menu-title">FOUND PROPERTY</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="lost.php">
        <i class="mdi mdi-account-search menu-icon"></i>
        <span class="menu-title">LOST PROPERTY</span>
      </a>
    </li>
  </ul>
</nav>
