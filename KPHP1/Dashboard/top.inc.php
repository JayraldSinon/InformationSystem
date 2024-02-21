<?php
require('connection.inc.php');
require('functions.inc.php');
if(isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN']!=''){

}else{
   header('location:login.php');
   die();
}
$id='0';
?>
<!doctype html>
<html class="no-js" lang="">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
       <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>ADMIN DASHBOARD PAGE</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="assets/css/normalize.css">
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="assets/css/font-awesome.min.css">
      <link rel="stylesheet" href="assets/css/themify-icons.css">
      <link rel="stylesheet" href="assets/css/pe-icon-7-filled.css">
      <link rel="stylesheet" href="assets/css/flag-icon.min.css">
      <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
      <link rel="stylesheet" href="assets/css/style.css">
      <link rel="stylesheet" href="asset/css/bootstrap.css">
      <link rel="stylesheet" href="asset/css/dataTables.bootstrap4.min.css">
      <link rel="stylesheet" href="asset/css/responsive.bootstrap4.min.css">
      <link rel="stylesheet" href="asset/css/bootstrap.css">
      <link rel="stylesheet" href="asset/css/dataTables.bootstrap4.min.css">
      <link rel="stylesheet" href="asset/css/responsive.bootstrap4.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="asset/css/bootstrap.min.css">
      <script src="asset/js/jquery.min.js"></script>
      <script src="asset/js/bootstrap341.min.js"></script>
      <script src="asset/js/351jquery.min.js"></script>
      <script src="asset/js/popper.min.js"></script>
      <script src="asset/js/bootstrap.min.js"></script>
      <link href='asset/css/fonts.css' rel='stylesheet' type='text/css'>
      <script type="text/javascript" src="asset/js/charts/loader.js"></script>
<style>
   .fixed-dashboard-links {
   height: 50px;
   font-size: 18px;
   position: fixed;
   right: 250px;
   margin-right: -10px;
   background-color: #fff; /* Background color for the fixed section */
   padding: 10px;
   z-index: 1000; /* Adjust the z-index as needed to make it appear above other elements */
}

.fixed-dashboard-links a {
      display: block;
      text-decoration: none;
      color: #333; /* Link color */
   }

   .fixed-dashboard-links a:hover {
      color: #ff7f00; /* Link color on hover */
      text-decoration: none
   }
.admin-profile-image{
   width: 30px; 
   height: 30px;
   margin-left: 12px;
}
.user-area.dropdown a:hover {
      text-decoration: none; /* Remove underline on hover */
      color: #ff7f00; /* Change text color on hover */
      font-size: 18px;
   }
   .user-area.dropdown .welcome-text {
      font-size: 18px;
      color: #333; /* Default text color */
      transition: color 0.3s; /* Smooth transition effect */
   }

   .user-area.dropdown .welcome-text:hover {
      color: #ff7f00; /* Text color on hover */
   }
</style>
   </head>
   <body style="background-color: #C8C6C6">
      <aside id="left-panel" class="left-panel" >
         <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
               <ul class="nav navbar-nav">
                  <li class="menu-title">MENU</li>
                  <?php if($_SESSION['ADMIN_ROLE']<=1){?>
				      <li class="menu-item-has-children dropdown">
                     <a href="Admin.php" > ACCOUNTS </a>
               </li>
				  
				  <li class="menu-item-has-children dropdown">
                     <a href="dashboard.php" > MASTERLIST </a>
               </li>
           
               <li class="menu-item-has-children dropdown">
                     <a href="records.php" > PENDING PAYMENTS </a>
               </li>
               <li class="menu-item-has-children dropdown">
                     <a href="approved.php" > STATISTICS </a>
               </li>
			   
			    <li class="menu-item-has-children dropdown">
                     <a href="vacant.php" > INACTIVE UNIT </a>
               </li>
			   
			  			   
			   <li class="menu-item-has-children dropdown">
                     <a href="history.php" > HISTORY </a>
               </li>
			    <li class="menu-item-has-children dropdown">
                     <a href="archiveowner.php" > ARCHIVE OWNERS </a>
               </li>

			   <li class="menu-item-has-children dropdown">
                     <a href="backres.php" > BACK UP AND RESTORE </a>
               </li>
               <?php }?>
			   
			   <?php if($_SESSION['ADMIN_ROLE']==2){?>
				      
               <li class="menu-item-has-children dropdown">
                     <a href="records.php" > PENDING PAYMENTS </a>
               </li>
               <li class="menu-item-has-children dropdown">
                     <a href="approved.php" > STATISTICS </a>
               </li>
			   
			    <li class="menu-item-has-children dropdown">
                     <a href="vacant.php" > INACTIVE UNIT </a>
               </li>
			   
			  			   
			   <li class="menu-item-has-children dropdown">
                     <a href="history.php" > HISTORY </a>
               <?php }?>
			   
			   
			  <?php if($_SESSION['ADMIN_ROLE']==3){?>
				      <li class="menu-item-has-children dropdown">
                     <a href="Admin1.php" > ACCOUNTS </a>
               </li>
				  
				  <li class="menu-item-has-children dropdown">
                     <a href="dashboard.php" > MASTERLIST </a>
               </li>
           
               <li class="menu-item-has-children dropdown">
                     <a href="records.php" > PENDING PAYMENTS </a>
               </li>
               <li class="menu-item-has-children dropdown">
                     <a href="approved.php" > STATISTICS </a>
               </li>
			   
			    <li class="menu-item-has-children dropdown">
                     <a href="vacant.php" > INACTIVE UNIT </a>
               </li>
			   
			  			   
			   <li class="menu-item-has-children dropdown">
                     <a href="history.php" > HISTORY </a>
               </li>
			    <li class="menu-item-has-children dropdown">
                     <a href="archiveowner.php" > ARCHIVE OWNERS </a>
               </li>

			   <li class="menu-item-has-children dropdown">
                     <a href="backres.php" > BACK UP AND RESTORE </a>
               </li>
               <?php }?>
			   
               </ul>
            </div>
         </nav>
      </aside>
      <div id="right-panel" class="right-panel">
         <header id="header" class="header">
            <div class="top-left">
               <div class="navbar-header">
                  <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
               </div>
            </div>
            <div class="fixed-dashboard-links">
            <a href="index.php"><img src="images/logo12.png" style="width: 60px; height: 50px; margin-bottom: -12px;">Karlaville Parkhomes</a>
            </div>
            <div class="top-right">
               <div class="header-menu">
                  <div class="user-area dropdown float-right">
                     <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="welcome-text">Welcome, <?php echo $_SESSION['ADMIN_USERNAME']?></span><img src="images/profile-user.png" alt="Admin Profile Image" class="admin-profile-image"></a>
                     <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="logout.php"><i class="fa fa-power-off"></i>LOGOUT</a>
                     </div>
                  </div>
               </div>
            </div>
         </header>