<?php require_once 'php_action/core.php'; ?>

<!DOCTYPE html>
<html>
<head>

<title>Stock Management System</title>

<!-- bootstrap -->
<link rel="stylesheet" href="assests/bootstrap/css/bootstrap.min.css">
<!-- bootstrap theme-->
<link rel="stylesheet" href="assests/bootstrap/css/bootstrap-theme.min.css">
<!-- font awesome -->
<link rel="stylesheet" href="assests/font-awesome/css/font-awesome.min.css">

<!-- custom css -->
<link rel="stylesheet" href="custom/css/custom.css">

<!-- jquery -->
<script src="assests/jquery/jquery.min.js"></script>
<!-- jquery ui -->  
<link rel="stylesheet" href="assests/jquery-ui/jquery-ui.min.css">
<script src="assests/jquery-ui/jquery-ui.min.js"></script>

<!-- DataTables -->
<link rel="stylesheet" href="assests/plugins/datatables/jquery.dataTables.min.css">
<script src="assests/plugins/datatables/jquery.dataTables.min.js"></script>

<!-- file input -->
<link rel="stylesheet" href="assests/plugins/fileinput/css/fileinput.min.css">

<!-- bootstrap js -->
<script src="assests/bootstrap/js/bootstrap.min.js"></script>

</head>
<body>


	<nav class="navbar navbar-default navbar-static-top">
		<div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!-- <a class="navbar-brand" href="#">Brand</a> -->
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">      

      <ul class="nav navbar-nav navbar-right">        
		<li id="navHome"><a href="index.php"><i class="glyphicon glyphicon-home"></i>  Home</a></li>
		
      	<li id="navDashboard"><a href="dashboard.php"><i class="glyphicon glyphicon-list-alt"></i>  Dashboard</a></li>        
        
        <li id="navBrand"><a href="brand.php"><i class="glyphicon glyphicon-tags"></i>  Brand</a></li>        

        <li id="navCategories"><a href="categories.php"> <i class="glyphicon glyphicon-th-list"></i> Category</a></li>        

        <li id="navProduct"><a href="product.php"> <i class="glyphicon glyphicon-gift"></i> Product </a></li>  
		
		<li id="navsku"><a href="sku.php"> <i class="glyphicon glyphicon-barcode"></i> SKU </a></li>  
		
		<li id="navPrice"><a href="pricing.php"> <i class="glyphicon glyphicon glyphicon-usd"></i> Pricing </a></li> 
		
		<li id="navPurchase"><a href="purchase.php"> <i class="glyphicon glyphicon glyphicon-credit-card"></i> Purchase </a></li>  
		
		<li id="navStocks"><a href="stock.php"> <i class="glyphicon glyphicon glyphicon-th-large"></i> Stocks </a></li> 
		
        <li class="dropdown" id="navOrder">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-shopping-cart"></i> Orders <span class="caret"></span></a>
          <ul class="dropdown-menu">            
            <li id="topNavAddOrder"><a href="orders.php?o=add"> <i class="glyphicon glyphicon-plus"></i> Add Orders</a></li>            
            <li id="topNavManageOrder"><a href="orders.php?o=manord"> <i class="glyphicon glyphicon-edit"></i> Manage Orders</a></li>            
          </ul>
        </li> 

        <li id="navReport"><a href="report.php"> <i class="glyphicon glyphicon-stats"></i> Report </a></li>

        <li class="dropdown" id="navSetting">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-user"></i> <span class="caret"></span></a>
          <ul class="dropdown-menu">            
            <li id="topNavSetting"><a href="setting.php"> <i class="glyphicon glyphicon-wrench"></i> Setting</a></li>            
            <li id="topNavLogout"><a href="logout.php"> <i class="glyphicon glyphicon-log-out"></i> Logout</a></li>            
          </ul>
        </li>        
               
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
	</nav>

	<div class="container">