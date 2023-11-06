<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>WorkShopShared :: Tu sitio de trabajo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">

    <!-- External CSS libraries -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-submenu.css">

    <link rel="stylesheet" type="text/css" href="css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/leaflet.css" type="text/css">
    <link rel="stylesheet" href="css/map.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" type="text/css" href="fonts/linearicons/style.css">
    <link rel="stylesheet" type="text/css"  href="css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" type="text/css"  href="css/dropzone.css">
    <link rel="stylesheet" type="text/css"  href="css/slick.css">

    <!-- Custom stylesheet -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" id="style_sheet" href="css/skins/red.css">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" >

    <!-- Google fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,300,700">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800%7CPlayfair+Display:400,700%7CRoboto:100,300,400,400i,500,700">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link rel="stylesheet" type="text/css" href="css/ie10-viewport-bug-workaround.css">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script  src="js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script  src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script  src="js/html5shiv.min.js"></script>
    <script  src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div class="page_loader"></div>

<!-- Main header start -->
<header class="main-header header-transparent sticky-header">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand logo" href="index.html">
                <img src="img/logos/black-logo.png" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="index.php" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Inicio
                        </a>
                        <!--<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="index.html">Index 01</a></li>
                            <li><a class="dropdown-item" href="index-2.html">Index 02</a></li>
                            <li><a class="dropdown-item" href="index-3.html">Index 03</a></li>
                            <li><a class="dropdown-item" href="index-4.html">Index 04</a></li>
                            <li><a class="dropdown-item" href="index-5.html">Index 05</a></li>
                            <li><a class="dropdown-item" href="index-6.html">Index 06</a></li>
                            <li><a class="dropdown-item" href="index-7.html">Index 07</a></li>
                        </ul>-->
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Porque WorkSpaceShared
                        </a>
                        <!--<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Property List</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="properties-list-rightside.html">Right Sidebar</a></li>
                                    <li><a class="dropdown-item" href="properties-list-leftsidebar.html">Left Sidebar</a></li>
                                    <li><a class="dropdown-item" href="properties-list-fullwidth.html">Fullwidth</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Property Grid</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="properties-grid-rightside.html">Right Sidebar</a></li>
                                    <li><a class="dropdown-item" href="properties-grid-leftside.html">Left Sidebar</a></li>
                                    <li><a class="dropdown-item" href="properties-grid-fullwidth.html">Fullwidth</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Property Map</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="properties-map-rightside-list.html">Map List 01</a></li>
                                    <li><a class="dropdown-item" href="properties-map-leftside-list.html">Map List 02</a></li>
                                    <li><a class="dropdown-item" href="properties-map-rightside-grid.html">Map Grid 01</a></li>
                                    <li><a class="dropdown-item" href="properties-map-leftside-grid.html">Map Grid 02</a></li>
                                    <li><a class="dropdown-item" href="properties-map-full.html">Map FullWidth</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Property Detail</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="properties-details.html">Property Detail 01</a></li>
                                    <li><a class="dropdown-item" href="properties-details-2.html">Property Detail 02</a></li>
                                    <li><a class="dropdown-item" href="properties-details-3.html">Property Detail 03</a></li>
                                </ul>
                            </li>
                        </ul>-->
                    </li>
                    <!--<li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Agents
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="agent-list.html">Agent List</a></li>
                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Agent Grid</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="agent-grid.html">Agent Grid 01</a></li>
                                    <li><a class="dropdown-item" href="agent-grid-2.html">Agent Grid 02</a></li>
                                    <li><a class="dropdown-item" href="agent-grid-3.html">Agent Grid 03</a></li>
                                </ul>
                            </li>
                            <li><a class="dropdown-item" href="agent-detail.html">Agent Detail</a></li>
                        </ul>
                    </li>-->
                    <li class="nav-item dropdown megamenu-li">
                        <a class="nav-link dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ciudades Donde Estamos</a>
                        <div class="dropdown-menu megamenu" aria-labelledby="dropdown01">
                            <div class="megamenu-area">
                                <div class="row sobuz">
                                    <div class="col-sm-6 col-md-4 col-lg-4">
                                        <div class="megamenu-section">
                                            <h6 class="megamenu-title">Pages</h6>
                                            <a class="dropdown-item" href="about.html">About Us</a>
                                            <a class="dropdown-item" href="services.html">Services</a>
                                            <a class="dropdown-item" href="elements.html">Elements</a>
                                            <a class="dropdown-item" href="properties-list-rightside.html">Properties List</a>
                                            <a class="dropdown-item" href="properties-grid-rightside.html">Properties Grid</a>
                                            <a class="dropdown-item" href="properties-map-leftside-list.html">Properties Map</a>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-4">
                                        <div class="megamenu-section">
                                            <h6 class="megamenu-title">Pages</h6>
                                            <a class="dropdown-item" href="pricing-tables.html">Pricing Tables</a>
                                            <a class="dropdown-item" href="properties-comparison.html">Properties Comparison</a>
                                            <a class="dropdown-item" href="search-brand.html">Properties Brands</a>
                                            <a class="dropdown-item" href="gallery-3column.html">Gallery 3 column</a>
                                            <a class="dropdown-item" href="gallery-4column.html">Gallery 4 column</a>
                                            <a class="dropdown-item" href="typography.html">Typography</a>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-4">
                                        <div class="megamenu-section">
                                            <h6 class="megamenu-title">Pages</h6>
                                            <a class="dropdown-item" href="faq.html">Faq</a>
                                            <a class="dropdown-item" href="icon.html">Icons</a>
                                            <a class="dropdown-item" href="contact.html">Contact Us</a>
                                            <a class="dropdown-item" href="coming-soon.html">Coming Soon</a>
                                            <a class="dropdown-item" href="404.html">Error Page</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Blog de Experiencias
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Blog Columns</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="blog-columns-2col.html">2 Columns</a></li>
                                    <li><a class="dropdown-item" href="blog-columns-3col.html">3 Columns</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Blog Classic</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="blog-classic-sidebar-right.html">Right Sidebar</a></li>
                                    <li><a class="dropdown-item" href="blog-classic-sidebar-left.html">Left Sidebar</a></li>
                                    <li><a class="dropdown-item" href="blog-classic-fullwidth.html">FullWidth</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Blog Details</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="blog-single-sidebar-right.html">Right Sidebar</a></li>
                                    <li><a class="dropdown-item" href="blog-single-sidebar-left.html">Left Sidebar</a></li>
                                    <li><a class="dropdown-item" href="blog-single-fullwidth.html">Fullwidth</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Mi Cuenta
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="login.php.html">Login</a></li>
                            <li><a class="dropdown-item" href="signup.html">Register</a></li>
                            <li><a class="dropdown-item" href="forgot-password.html">Forgot Password</a></li>
                            <li><a class="dropdown-item" href="dashboard.html">Dashboard</a></li>
                            <li><a class="dropdown-item" href="my-profile.html">My Profile</a></li>
                            <li><a class="dropdown-item" href="my-properties.html">My Properties</a></li>
                            <li> <a class="dropdown-item" href="my-invoices.html">My Invoices</a></li>
                            <li><a class="dropdown-item" href="favorited-properties.html">Favorited Properties</a></li>
                            <li><a class="dropdown-item" href="messages.html">Messages</a></li>
                            <li><a class="dropdown-item" href="bookings.html">Bookings</a></li>
                            <li><a class="dropdown-item" href="submit-property.html">Submit Property</a></li>
                        </ul>
                    </li>
                    <!--<li class="nav-item sp">
                        <a href="submit-property.html" class="nav-link link-color"><i class="fa fa-plus"></i> Submit Property</a>
                    </li>-->
                </ul>
            </div>
        </nav>
    </div>
</header>
<!-- Main header end -->

<!-- Banner start -->
<div class="banner" id="banner">
    <div id="bannerCarousole" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item banner-max-height active item-bg">
                <img class="d-block w-100 h-100" src="img/slider_A.jpg" alt="banner">
                <div class="carousel-caption banner-slider-inner h-100"></div>
            </div>
            <div class="carousel-item banner-max-height item-bg">
                <img class="d-block w-100 h-100" src="img/slider_B.jpg" alt="banner">
                <div class="carousel-caption banner-slider-inner h-100"></div>
            </div>
            <div class="carousel-item banner-max-height item-bg">
                <img class="d-block w-100 h-100" src="img/slider_C.jpg" alt="banner">
                <div class="carousel-caption banner-slider-inner h-100"></div>
            </div>
            <div class="carousel-caption d-flex h-100 banner-slider-inner-2">
                <div class="carousel-content container">
                    <div class="text-center bi-3">
                        <div class="clearfix">
                            <h3 class="text-uppercase">Encuentra tu espacio compartido de trabajo</h3>
                            <p>Ahorra en servicios básicos, optimiza tus recursos</p>
                        </div>
                        <div class="clearfix"></div>
                        <div class="inline-search-area isa-4 clearfix">
                            <div class="row">
                                 <div class="col-xl-2 col-lg-2 col-sm-4 col-6 search-col">
                                    <select class="selectpicker search-fields" name="bathrooms">
                                        <option>Ciudad</option>
                                        <option>Quito</option>
                                        <option>Guayaquil</option>
                                        <option>Cuenca</option>
                                        <option>Manta</option>
                                    </select>
                                </div>
                                <div class="col-xl-2 col-lg-2 col-sm-4 col-6 search-col">
                                    <select class="selectpicker search-fields" name="location">
                                        <option>Sector</option>
                                        <option>Centro</option>
                                        <option>Centro Norte</option>
                                        <option>Norte</option>
                                        <option>Sur</option>
                                        <option>Valle Chillos</option>
                                        <option>Cumbayá</option>

                                    </select>
                                </div>
                                <div class="col-xl-2 col-lg-2 col-sm-4 col-6 search-col">
                                    <select class="selectpicker search-fields" name="any-status">
                                        <option>Tiempo</option>
                                        <option>Por Horas</option>
                                        <option>Por Días</option>
                                        <option>Por Semanas</option>
                                        <option>Por Más Tiempo</option>
                                    </select>
                                </div>
                                <div class="col-xl-2 col-lg-2 col-sm-4 col-6 search-col">
                                    <select class="selectpicker search-fields" name="all-type">
                                        <option>Tipo</option>
                                        <option>Oficina Completa</option>
                                        <option>Sala de Reuniones</option>
                                        <option>Oficina</option>
                                        
                                    </select>
                                </div>
                                <div class="col-xl-2 col-lg-2 col-sm-4 col-6 search-col">
                                    <select class="selectpicker search-fields" name="bedrooms">
                                        <option>Espacios</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>
                                </div>
                               
                                <div class="col-xl-2 col-lg-2 col-sm-4 col-6 search-col">
                                    <button class="btn button-theme btn-search btn-block">
                                        <i class="fa fa-search"></i><strong>Encontrar</strong>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="inline-search-area isa-3 clearfix">
                            <div class="row clearfix">
                                <div class="col-md-6 col-sm-6 col-6">
                                     <select class="selectpicker search-fields" name="bathrooms">
                                        <option>Ciudad</option>
                                        <option>Quito</option>
                                        <option>Guayaquil</option>
                                        <option>Cuenca</option>
                                        <option>Manta</option>
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-6 col-6">
                                    <select class="selectpicker search-fields" name="location">
                                        <option>Sector</option>
                                        <option>Centro</option>
                                        <option>Centro Norte</option>
                                        <option>Norte</option>
                                        <option>Sur</option>
                                        <option>Valle Chillos</option>
                                        <option>Cumbayá</option>

                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-6 col-6">
                                     <select class="selectpicker search-fields" name="any-status">
                                        <option>Tiempo</option>
                                        <option>Por Horas</option>
                                        <option>Por Días</option>
                                        <option>Por Semanas</option>
                                        <option>Por Más Tiempo</option>
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-6 col-6">
                                     <select class="selectpicker search-fields" name="all-type">
                                        <option>Tipo</option>
                                        <option>Oficina Completa</option>
                                        <option>Sala de Reuniones</option>
                                        <option>Oficina</option>
                                        
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-6 col-6">
                                     <select class="selectpicker search-fields" name="bedrooms">
                                        <option>Espacios</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-6 col-6">
                                    <button class="btn button-theme btn-search btn-block mb-0">
                                        <i class="fa fa-search"></i><strong>Encontrar</strong>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#bannerCarousole" role="button" data-slide="prev">
            <span class="slider-mover-left" aria-hidden="true">
                <i class="fa fa-angle-left"></i>
            </span>
        </a>
        <a class="carousel-control-next" href="#bannerCarousole" role="button" data-slide="next">
            <span class="slider-mover-right" aria-hidden="true">
                <i class="fa fa-angle-right"></i>
            </span>
        </a>
    </div>
</div>
<!-- Banner end -->

<!-- Search Section start -->
<div class="search-section search-area pb-hediin-12 bg-grea animated fadeInDown" id="search-style-1">
    <div class="container">
        <div class="search-section-area">
            <div class="search-area-inner">
                <div class="search-contents">
                    <form method="GET">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-6 col-6">
                                <div class="form-group">
                                    <select class="selectpicker search-fields" name="any-status">
                                        <option>Any Status</option>
                                        <option>For Rent</option>
                                        <option>For Sale</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-6">
                                <div class="form-group">
                                    <select class="selectpicker search-fields" name="all-type">
                                        <option>All Type</option>
                                        <option>Apartments</option>
                                        <option>Shop</option>
                                        <option>Restaurant</option>
                                        <option>Villa</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-6">
                                <div class="form-group">
                                    <select class="selectpicker search-fields" name="bedrooms">
                                        <option>Bedrooms</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-6">
                                <div class="form-group">
                                    <select class="selectpicker search-fields" name="bathrooms">
                                        <option>Bathrooms</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-6">
                                <div class="form-group">
                                    <select class="selectpicker search-fields" name="location">
                                        <option>location</option>
                                        <option>United States</option>
                                        <option>American Samoa</option>
                                        <option>Belgium</option>
                                        <option>Canada</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-6">
                                <div class="form-group">
                                    <button class="search-button">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Search Section end -->

<!-- Featured Properties start -->
<div class="featured-properties content-area-12">
    <div class="container">
        <!-- Main title -->
        <div class="main-title">
            <h1>Oficinas Libres</h1>
            <p>Estas son las oficinas que fueron recientemente utilizadas y que están libres para ti.</p>
        </div>
        <!-- Slick slider area start -->
        <div class="slick-slider-area">
            <div class="row slick-carousel" data-slick='{"slidesToShow": 3, "responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": 2}}, {"breakpoint": 768,"settings":{"slidesToShow": 1}}]}'>
                <div class="slick-slide-item">
                    <div class="property-box">
                        <div class="property-thumbnail">
                            <a href="properties-details.html" class="property-img">
                                <div class="listing-badges">
                                    <span class="featured">Norte</span>
                                </div>
                                <div class="price-box bg-black"><span>$30.00</span> Hora</div>
                                <img class="d-block w-100" src="img/oficinas/officea.jpg" alt="properties">
                            </a>
                        </div>
                        <div class="detail">
                            <h1 class="title">
                                <a href="properties-details.html">Modern Family Home</a>
                            </h1>

                            <div class="location">
                                <a href="properties-details.html">
                                    <i class="flaticon-pin"></i>123 Kathal St. Tampa City,
                                </a>
                            </div>
                        </div>
                        <ul class="facilities-list clearfix">
                            <li>
                                <span>Area</span>3600 Sqft
                            </li>
                            <li>
                                <span>Beds</span> 3
                            </li>
                            <li>
                                <span>Baths</span> 2
                            </li>
                            <li>
                                <span>Garage</span> 1
                            </li>
                        </ul>
                        <div class="footer">
                            <a href="#">
                                <i class="flaticon-male"></i>Jhon Doe
                            </a>
                            <span>
                                <i class="flaticon-calendar"></i>5 Days ago
                            </span>
                        </div>
                    </div>
                </div>
                <div class="slick-slide-item">
                    <div class="property-box">
                        <div class="property-thumbnail">
                            <a href="properties-details.html" class="property-img">
                                <div class="tag">For Sale</div>
                                <div class="price-box"><span>$850.00</span> Per month</div>
                                <img class="d-block w-100" src="http://placehold.it/350x233" alt="properties">
                            </a>
                        </div>
                        <div class="detail">
                            <h1 class="title">
                                <a href="properties-details.html">Two storey modern flat</a>
                            </h1>

                            <div class="location">
                                <a href="properties-details.html">
                                    <i class="flaticon-pin"></i>123 Kathal St. Tampa City,
                                </a>
                            </div>
                        </div>
                        <ul class="facilities-list clearfix">
                            <li>
                                <span>Area</span>3600 Sqft
                            </li>
                            <li>
                                <span>Beds</span> 3
                            </li>
                            <li>
                                <span>Baths</span> 2
                            </li>
                            <li>
                                <span>Garage</span> 1
                            </li>
                        </ul>
                        <div class="footer">
                            <a href="#">
                                <i class="flaticon-male"></i>Jhon Doe
                            </a>
                            <span>
                                <i class="flaticon-calendar"></i>5 Days ago
                            </span>
                        </div>
                    </div>
                </div>
                <div class="slick-slide-item">
                    <div class="property-box">
                        <div class="property-thumbnail">
                            <a href="properties-details.html" class="property-img">
                                <div class="listing-badges">
                                    <span class="featured">Norte</span>
                                </div>
                                <div class="price-box"><span>$850.00</span> Per month</div>
                                <img class="d-block w-100" src="http://placehold.it/350x233" alt="properties">
                            </a>
                        </div>
                        <div class="detail">
                            <h1 class="title">
                                <a href="properties-details.html">Luxury Villa</a>
                            </h1>

                            <div class="location">
                                <a href="properties-details.html">
                                    <i class="flaticon-pin"></i>123 Kathal St. Tampa City,
                                </a>
                            </div>
                        </div>
                        <ul class="facilities-list clearfix">
                            <li>
                                <span>Area</span>3600 Sqft
                            </li>
                            <li>
                                <span>Beds</span> 3
                            </li>
                            <li>
                                <span>Baths</span> 2
                            </li>
                            <li>
                                <span>Garage</span> 1
                            </li>
                        </ul>
                        <div class="footer">
                            <a href="#">
                                <i class="flaticon-male"></i>Jhon Doe
                            </a>
                            <span>
                                <i class="flaticon-calendar"></i>5 Days ago
                            </span>
                        </div>
                    </div>
                </div>
                <div class="slick-slide-item">
                    <div class="property-box">
                        <div class="property-thumbnail">
                            <a href="properties-details.html" class="property-img">
                                <div class="tag">For Rent</div>
                                <div class="price-box"><span>$850.00</span> Per month</div>
                                <img class="d-block w-100" src="http://placehold.it/350x233" alt="properties">
                            </a>
                        </div>
                        <div class="detail">
                            <h1 class="title">
                                <a href="properties-details.html">Modern Family Home</a>
                            </h1>

                            <div class="location">
                                <a href="properties-details.html">
                                    <i class="flaticon-pin"></i>123 Kathal St. Tampa City,
                                </a>
                            </div>
                        </div>
                        <ul class="facilities-list clearfix">
                            <li>
                                <span>Area</span>3600 Sqft
                            </li>
                            <li>
                                <span>Beds</span> 3
                            </li>
                            <li>
                                <span>Baths</span> 2
                            </li>
                            <li>
                                <span>Garage</span> 1
                            </li>
                        </ul>
                        <div class="footer">
                            <a href="#">
                                <i class="flaticon-male"></i>Jhon Doe
                            </a>
                            <span>
                                <i class="flaticon-calendar"></i>5 Days ago
                            </span>
                        </div>
                    </div>
                </div>
                <div class="slick-slide-item">
                    <div class="property-box">
                        <div class="property-thumbnail">
                            <a href="properties-details.html" class="property-img">
                                <div class="listing-badges">
                                    <span class="featured">Featured</span>
                                </div>
                                <div class="price-box"><span>$850.00</span> Per month</div>
                                <img class="d-block w-100" src="http://placehold.it/350x233" alt="properties">
                            </a>
                        </div>
                        <div class="detail">
                            <h1 class="title">
                                <a href="properties-details.html">Relaxing Apartment</a>
                            </h1>

                            <div class="location">
                                <a href="properties-details.html">
                                    <i class="flaticon-pin"></i>123 Kathal St. Tampa City,
                                </a>
                            </div>
                        </div>
                        <ul class="facilities-list clearfix">
                            <li>
                                <span>Area</span>3600 Sqft
                            </li>
                            <li>
                                <span>Beds</span> 3
                            </li>
                            <li>
                                <span>Baths</span> 2
                            </li>
                            <li>
                                <span>Garage</span> 1
                            </li>
                        </ul>
                        <div class="footer">
                            <a href="#">
                                <i class="flaticon-male"></i>Jhon Doe
                            </a>
                            <span>
                                <i class="flaticon-calendar"></i>5 Days ago
                            </span>
                        </div>
                    </div>
                </div>
                <div class="slick-slide-item">
                    <div class="property-box">
                        <div class="property-thumbnail">
                            <a href="properties-details.html" class="property-img">
                                <div class="tag">For Rent</div>
                                <div class="price-box"><span>$850.00</span> Per month</div>
                                <img class="d-block w-100" src="http://placehold.it/350x233" alt="properties">
                            </a>
                        </div>
                        <div class="detail">
                            <h1 class="title">
                                <a href="properties-details.html">Real Luxury Villa</a>
                            </h1>

                            <div class="location">
                                <a href="properties-details.html">
                                    <i class="flaticon-pin"></i>123 Kathal St. Tampa City,
                                </a>
                            </div>
                        </div>
                        <ul class="facilities-list clearfix">
                            <li>
                                <span>Area</span>3600 Sqft
                            </li>
                            <li>
                                <span>Beds</span> 3
                            </li>
                            <li>
                                <span>Baths</span> 2
                            </li>
                            <li>
                                <span>Garage</span> 1
                            </li>
                        </ul>
                        <div class="footer">
                            <a href="#">
                                <i class="flaticon-male"></i>Jhon Doe
                            </a>
                            <span>
                                <i class="flaticon-calendar"></i>5 Days ago
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slick-btn">
                <div class="slick-prev slick-arrow-buton-2 sab-4">
                    <i class="fa fa-angle-left"></i>
                </div>
                <div class="slick-next slick-arrow-buton-2 sab-3">
                    <i class="fa fa-angle-right"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Featured Properties end -->

<!-- Services start -->
<div class="services content-area bg-grea-3">
    <div class="container">
        <!-- Main title -->
        <div class="main-title text-center">
            <h1>Working with the Neer</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-12">

                <div class="media service-info-3">
                    <div class="icon">
                        <i class="flaticon-user"></i>
                        <h4>01</h4>
                    </div>
                    <div class="media-body align-self-center">
                        <h2>Personalized Service Possible</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt</p>
                        <a class="rm-btn" href="services.html">Read more...</a>
                        <h4>01</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="media service-info-3">
                    <div class="icon">
                        <i class="flaticon-empire-state-building"></i>
                    </div>
                    <div class="media-body align-self-center">
                        <h2>Luxury Real Estate Experts</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt</p>
                        <a class="rm-btn" href="services.html">Read more...</a>
                        <h4>02</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="media service-info-3">
                    <div class="icon">
                        <i class="flaticon-discount"></i>
                    </div>
                    <div class="media-body align-self-center">
                        <h2>Modern Building For Rent $ Sell</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt</p>
                        <a class="rm-btn" href="services.html">Read more...</a>
                        <h4>03</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Services end -->

<!-- Categories strat -->
<div class="categories content-area-7">
    <div class="container">
        <!-- Main title -->
        <div class="main-title text-center">
            <h1>Most Popular Places</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
        <div class="row">
            <div class="col-lg-5 col-md-12 col-sm-12 col-pad">
                <div class="category">
                    <div class="category_bg_box category_long_bg cat-4-bg">
                        <div class="category-overlay">
                            <div class="category-content">
                                <h3 class="category-title">
                                    <a href="#">Tokyo</a>
                                </h3>
                                <h4 class="category-subtitle">12 Properties</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-12 col-sm-12">
                <div class="row">
                    <div class="col-sm-6 col-pad">
                        <div class="category">
                            <div class="category_bg_box cat-1-bg">
                                <div class="category-overlay">
                                    <div class="category-content">
                                        <h3 class="category-title">
                                            <a href="properties-list-rightside.html">Rome</a>
                                        </h3>
                                        <h4 class="category-subtitle">27 Properties</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-pad">
                        <div class="category">
                            <div class="category_bg_box cat-5-bg">
                                <div class="category-overlay">
                                    <div class="category-content">
                                        <h3 class="category-title">
                                            <a href="#">Rome</a>
                                        </h3>
                                        <h4 class="category-subtitle">98 Properties</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-pad">
                        <div class="category">
                            <div class="category_bg_box cat-3-bg">
                                <div class="category-overlay">
                                    <div class="category-content">
                                        <h3 class="category-title">
                                            <a href="#">United States</a>
                                        </h3>
                                        <h4 class="category-subtitle">98 Properties</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-pad">
                        <div class="category">
                            <div class="category_bg_box cat-2-bg">
                                <div class="category-overlay">
                                    <div class="category-content">
                                        <h3 class="category-title">
                                            <a href="#">London</a>
                                        </h3>
                                        <h4 class="category-subtitle">98 Properties</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Categories end -->

<!-- Counters 2 strat -->
<div class="counters-2 overview-bgi">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="media counter-box">
                    <div class="icon">
                        <i class="flaticon-sale"></i>
                    </div>
                    <div class="media-body align-self-center">
                        <h2 class="counter Starting">967</h2>
                        <p>Listings For Sale</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="media counter-box">
                    <div class="icon">
                        <i class="flaticon-rent"></i>
                    </div>
                    <div class="media-body align-self-center">
                        <h2 class="counter Starting">967</h2>
                        <p>Listings For Rent</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="media counter-box">
                    <div class="icon">
                        <i class="flaticon-user"></i>
                    </div>
                    <div class="media-body align-self-center">
                        <h2 class="counter Starting">967</h2>
                        <p>Agents</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="media counter-box">
                    <div class="icon">
                        <i class="flaticon-broker"></i>
                    </div>
                    <div class="media-body align-self-center">
                        <h2 class="counter Starting">967</h2>
                        <p>Brokers</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Counters 2 end -->

<!-- Our team start -->
<div class="our-team content-area">
    <div class="container">
        <!-- Main title -->
        <div class="main-title">
            <h1>Our Agent</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
        <!-- Slick slider area start -->
        <div class="slick-slider-area">
            <div class="row slick-carousel" data-slick='{"slidesToShow": 4, "responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": 2}}, {"breakpoint": 768,"settings":{"slidesToShow": 1}}]}'>
                <div class="slick-slide-item">
                    <div class="team-1">
                        <div class="team-photo">
                            <a href="#">
                                <img src="http://placehold.it/255x255" alt="agent-2" class="img-fluid">
                            </a>
                            <ul class="social-list clearfix">
                                <li><a href="#" class="facebook-bg"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#" class="twitter-bg"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#" class="google-bg"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                        <div class="team-details">
                            <h5><a href="agent-detail.html">Martin Smith</a></h5>
                            <h6>Web Developer</h6>
                            <h4><a href="tel:+1-204-777-0187">+1 204 777 0187</a></h4>
                        </div>
                    </div>
                </div>
                <div class="slick-slide-item">
                    <div class="team-1">
                        <div class="team-photo">
                            <a href="#">
                                <img src="http://placehold.it/255x255" alt="agent-2" class="img-fluid">
                            </a>
                            <ul class="social-list clearfix">
                                <li><a href="#" class="facebook-bg"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#" class="twitter-bg"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#" class="google-bg"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                        <div class="team-details">
                            <h5><a href="agent-detail.html">John Pitarshon</a></h5>
                            <h6>Creative Director</h6>
                            <h4><a href="tel:+1-204-777-0187">+1 204 777 0199</a></h4>
                        </div>
                    </div>
                </div>
                <div class="slick-slide-item">
                    <div class="team-1">
                        <div class="team-photo">
                            <a href="#">
                                <img src="http://placehold.it/255x255" alt="agent-2" class="img-fluid">
                            </a>
                            <ul class="social-list clearfix">
                                <li><a href="#" class="facebook-bg"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#" class="twitter-bg"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#" class="google-bg"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                        <div class="team-details">
                            <h5><a href="agent-detail.html">Karen Paran</a></h5>
                            <h6>Support Manager</h6>
                            <h4><a href="tel:+1-204-777-0187">+1 204 777 0166</a></h4>
                        </div>
                    </div>
                </div>
                <div class="slick-slide-item">
                    <div class="team-1">
                        <div class="team-photo">
                            <a href="#">
                                <img src="http://placehold.it/255x255" alt="agent-2" class="img-fluid">
                            </a>
                            <ul class="social-list clearfix">
                                <li><a href="#" class="facebook-bg"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#" class="twitter-bg"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#" class="google-bg"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                        <div class="team-details">
                            <h5><a href="agent-detail.html">Maria Blank</a></h5>
                            <h6>Office Manager</h6>
                            <h4><a href="tel:+1-204-777-0187">+1 204 777 0100</a></h4>
                        </div>
                    </div>
                </div>
                <div class="slick-slide-item">
                    <div class="team-1">
                        <div class="team-photo">
                            <a href="#">
                                <img src="http://placehold.it/255x255" alt="agent-2" class="img-fluid">
                            </a>
                            <ul class="social-list clearfix">
                                <li><a href="#" class="facebook-bg"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#" class="twitter-bg"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#" class="google-bg"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                        <div class="team-details">
                            <h5><a href="agent-detail.html">Karen Paran</a></h5>
                            <h6>Support Manager</h6>
                            <h4><a href="tel:+1-204-777-0187">+1 204 777 0166</a></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Our team end -->

<!-- Testimonial start -->
<div class="testimonial content-area-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 align-self-center">
                <!-- Main title -->
                <div class="main-title main-title-3">
                    <h1>Our Testimonial</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,</p>
                    <a href="#" class="btn important-btn btn-theme btn-md">Contact us</a>
                </div>
            </div>
            <div class="col-lg-7 offset-lg-1">
                <!-- Slick slider area start -->
                <div class="slick-slider-area">
                    <div class="row slick-carousel" data-slick='{"slidesToShow": 2, "responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": 2}}, {"breakpoint": 768,"settings":{"slidesToShow": 1}}]}'>
                        <div class="slick-slide-item">
                            <div class="testimonial-info-box">
                                <div class="profile-user">
                                    <div class="avatar">
                                        <img src="http://placehold.it/100x100" alt="testimonial-2">
                                    </div>
                                </div>
                                <h5>
                                    <a href="#">Maikel Alisa</a>
                                </h5>
                                <h6>Web Designer, Uk</h6>
                                <p><i class="fa fa-quote-left"></i> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown <i class="fa fa-quote-right"></i></p>
                            </div>
                        </div>
                        <div class="slick-slide-item">
                            <div class="testimonial-info-box">
                                <div class="profile-user">
                                    <div class="avatar">
                                        <img src="http://placehold.it/100x100" alt="testimonial-2">
                                    </div>
                                </div>
                                <h5>
                                    <a href="#">Carolyn Stone</a>
                                </h5>
                                <h6>Creative Director, india</h6>
                                <p><i class="fa fa-quote-left"></i> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown <i class="fa fa-quote-right"></i></p>
                            </div>
                        </div>
                        <div class="slick-slide-item">
                            <div class="testimonial-info-box">
                                <div class="profile-user">
                                    <div class="avatar">
                                        <img src="http://placehold.it/100x100" alt="testimonial-2">
                                    </div>
                                </div>
                                <h5>
                                    <a href="#">Auro Navanth</a>
                                </h5>
                                <h6>Office Manager, New York</h6>
                                <p><i class="fa fa-quote-left"></i> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown <i class="fa fa-quote-right"></i></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Testimonial end -->

<!-- Blog start -->
<div class="blog content-area">
    <div class="container">
        <!-- Main title -->
        <div class="main-title">
            <h1>Our Blog</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
        <!-- Slick slider area start -->
        <div class="slick-slider-area">
            <div class="row slick-carousel" data-slick='{"slidesToShow": 3, "responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": 2}}, {"breakpoint": 768,"settings":{"slidesToShow": 1}}]}'>
                <div class="slick-slide-item">
                    <div class="blog-2">
                        <div class="blog-photo">
                            <img src="http://placehold.it/350x220" alt="blog" class="img-fluid bp">
                            <div class="date-box">
                                <span>21</span>Feb
                            </div>
                            <div class="profile-user">
                                <img src="http://placehold.it/45x45" alt="user">
                            </div>
                        </div>
                        <div class="detail">
                            <div class="post-meta clearfix">
                                <ul>
                                    <li>
                                        <strong><a href="#">Maria Blank</a></strong>
                                    </li>
                                    <li class="float-right mr-0"><a href="#"><i class="flaticon-comment"></i></a>17K</li>
                                    <li class="float-right"><a href="#"><i class="flaticon-calendar"></i></a>73k</li>
                                </ul>
                            </div>
                            <h4>
                                <a href="blog-single-sidebar-right.html">Selling Your Real House</a>
                            </h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the</p>
                        </div>
                    </div>
                </div>
                <div class="slick-slide-item">
                    <div class="blog-2">
                        <div class="blog-photo">
                            <img src="http://placehold.it/350x220" alt="blog" class="img-fluid bp">
                            <div class="date-box">
                                <span>21</span>Feb
                            </div>
                            <div class="profile-user">
                                <img src="http://placehold.it/45x45" alt="user">
                            </div>
                        </div>
                        <div class="detail">
                            <div class="post-meta clearfix">
                                <ul>
                                    <li>
                                        <strong><a href="#">Karen Paran</a></strong>
                                    </li>
                                    <li class="float-right mr-0"><a href="#"><i class="flaticon-comment"></i></a>17K</li>
                                    <li class="float-right"><a href="#"><i class="flaticon-calendar"></i></a>73k</li>
                                </ul>
                            </div>
                            <h4>
                                <a href="blog-single-sidebar-right.html">Buying a Best House</a>
                            </h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the</p>
                        </div>
                    </div>
                </div>
                <div class="slick-slide-item">
                    <div class="blog-2">
                        <div class="blog-photo">
                            <img src="http://placehold.it/350x220" alt="blog" class="img-fluid bp">
                            <div class="date-box">
                                <span>21</span>Feb
                            </div>
                            <div class="profile-user">
                                <img src="http://placehold.it/45x45" alt="user">
                            </div>
                        </div>
                        <div class="detail">
                            <div class="post-meta clearfix">
                                <ul>
                                    <li>
                                        <strong><a href="#">Brandon Miller</a></strong>
                                    </li>
                                    <li class="float-right mr-0"><a href="#"><i class="flaticon-comment"></i></a>17K</li>
                                    <li class="float-right"><a href="#"><i class="flaticon-calendar"></i></a>73k</li>
                                </ul>
                            </div>
                            <h4>
                                <a href="blog-single-sidebar-right.html">Selling Your Real House</a>
                            </h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the</p>
                        </div>
                    </div>
                </div>
                <div class="slick-slide-item">
                    <div class="blog-2">
                        <div class="blog-photo">
                            <img src="http://placehold.it/350x220" alt="blog" class="img-fluid bp">
                            <div class="date-box">
                                <span>21</span>Feb
                            </div>
                            <div class="profile-user">
                                <img src="http://placehold.it/45x45" alt="user">
                            </div>
                        </div>
                        <div class="detail">
                            <div class="post-meta clearfix">
                                <ul>
                                    <li>
                                        <strong><a href="#">Brandon Miller</a></strong>
                                    </li>
                                    <li class="float-right mr-0"><a href="#"><i class="flaticon-comment"></i></a>17K</li>
                                    <li class="float-right"><a href="#"><i class="flaticon-calendar"></i></a>73k</li>
                                </ul>
                            </div>
                            <h4>
                                <a href="blog-single-sidebar-right.html">Find Your Best Real Estate</a>
                            </h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blog end -->

<!-- Partners strat -->
<div class="partners">
    <div class="container">
        <div class="slick-slider-area">
            <div class="row slick-carousel" data-slick='{"slidesToShow": 5, "responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": 3}}, {"breakpoint": 768,"settings":{"slidesToShow": 2}}]}'>
                <div class="slick-slide-item"><img src="http://placehold.it/160x60" alt="brand" class="img-fluid"></div>
                <div class="slick-slide-item"><img src="http://placehold.it/160x60" alt="brand" class="img-fluid"></div>
                <div class="slick-slide-item"><img src="http://placehold.it/160x60" alt="brand" class="img-fluid"></div>
                <div class="slick-slide-item"><img src="http://placehold.it/160x60" alt="brand" class="img-fluid"></div>
                <div class="slick-slide-item"><img src="http://placehold.it/160x60" alt="brand" class="img-fluid"></div>
                <div class="slick-slide-item"><img src="http://placehold.it/160x60" alt="brand" class="img-fluid"></div>
                <div class="slick-slide-item"><img src="http://placehold.it/160x60" alt="brand" class="img-fluid"></div>
                <div class="slick-slide-item"><img src="http://placehold.it/160x60" alt="brand" class="img-fluid"></div>
            </div>
        </div>
    </div>
</div>
<!-- Partners end -->

<!-- Footer start -->
<footer class="footer">
    <div class="container footer-inner">
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="footer-item clearfix">
                    <img src="img/logos/logo.png" alt="logo" class="f-logo">
                    <div class="text">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla. Nulla posuere sapien vitae posuere sapien vitae posuere.</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="footer-item">
                    <h4>Contact Us</h4>
                    <ul class="contact-info">
                        <li>
                            <i class="flaticon-pin"></i>20/F Green Road, Dhanmondi, Dhaka
                        </li>
                        <li>
                            <i class="flaticon-mail"></i><a href="mailto:sales@hotelempire.com">info@themevessel.com</a>
                        </li>
                        <li>
                            <i class="flaticon-phone"></i><a href="tel:+55-417-634-7071">+0477 85X6 552</a>
                        </li>
                        <li>
                            <i class="flaticon-fax"></i>+0477 85X6 552
                        </li>
                        <li>
                            <i class="flaticon-internet"></i><a href="mailto:info@green.com">info@green.com</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6">
                <div class="footer-item">
                    <h4>
                        Useful Links
                    </h4>
                    <ul class="links">
                        <li>
                            <a href="#">Home</a>
                        </li>
                        <li>
                            <a href="about.html">About Us</a>
                        </li>
                        <li>
                            <a href="services.html">Services</a>
                        </li>
                        <li>
                            <a href="contact.html">Contact Us</a>
                        </li>
                        <li>
                            <a href="dashboard.html">Dashboard</a>
                        </li>
                        <li>
                            <a href="properties-details.html">Properties Details</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="footer-item clearfix">
                    <h4>Subscribe</h4>
                    <div class="Subscribe-box">
                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit.</p>
                        <form class="form-inline" action="#" method="GET">
                            <input type="text" class="form-control mb-sm-0" id="inlineFormInputName3" placeholder="Email Address">
                            <button type="submit" class="btn"><i class="fa fa-paper-plane"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sub-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <p class="copy">© 2018 <a href="#">Theme Vessel.</a> Trademarks and brands are the property of their respective owners.</p>
                </div>
                <div class="col-lg-4 col-md-12">
                    <ul class="social-list clearfix">
                        <li><a href="#" class="facebook-bg"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#" class="twitter-bg"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#" class="google-bg"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#" class="linkedin-bg"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer end -->

<!-- Full Page Search -->
<div id="full-page-search">
    <button type="button" class="close">×</button>
    <form action="index.html#">
        <input type="search" value="" placeholder="type keyword(s) here" />
        <button type="submit" class="btn btn-sm button-theme">Search</button>
    </form>
</div>

<script src="js/jquery-2.2.0.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script  src="js/bootstrap-submenu.js"></script>
<script  src="js/rangeslider.js"></script>
<script  src="js/jquery.mb.YTPlayer.js"></script>
<script  src="js/bootstrap-select.min.js"></script>
<script  src="js/jquery.easing.1.3.js"></script>
<script  src="js/jquery.scrollUp.js"></script>
<script  src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script  src="js/leaflet.js"></script>
<script  src="js/leaflet-providers.js"></script>
<script  src="js/leaflet.markercluster.js"></script>
<script  src="js/dropzone.js"></script>
<script  src="js/slick.min.js"></script>
<script  src="js/jquery.filterizr.js"></script>
<script  src="js/jquery.magnific-popup.min.js"></script>
<script  src="js/jquery.countdown.js"></script>
<script  src="js/maps.js"></script>
<script  src="js/app.js"></script>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script  src="js/ie10-viewport-bug-workaround.js"></script>
<!-- Custom javascript -->
<script  src="js/ie10-viewport-bug-workaround.js"></script>
<script  src="js/main.js?aleat=<?php echo rand();?>"></script>
</body>
</html>