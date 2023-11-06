<!DOCTYPE html>
<html lang="html">
<head>
    <title></title>
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
    <link rel="stylesheet" type="text/css"  href="css/extra.css">
    <link rel="stylesheet" type="text/css"  href="css/custom.css">
    <link rel="stylesheet" type="text/css"  href="js/ohSnap/css/style.css">
    <!-- Custom stylesheet -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" id="style_sheet" href="css/skins/default.css">
   <!-- <link rel="stylesheet" href="js/chosen/chosen.css">-->

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" >

    <!-- Google fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,300,700">

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

<!-- Contact section start -->
<div class="contact-section">
    <div class="container">
        <div class="row login-box">
            <div class="col-lg-6 align-self-center pad-0">
                <div class="form-section align-self-center">
                    <h3 class="c-font-label">Consulta de Padrón Electoral</h3>
                    
                    <div class="clearfix"></div>
                    <form action="#" method="GET">
                       <div class="form-group form-box">
                            <input type="text" name="txtcedula" id="txtCedula" class="input-text solonumero" placeholder="Cédula de Identidad">
                        </div>
                        <div id="divZonaCaptcha">
                        <div class="form-group form-box">
                            <input type="text" name="txtcaptcha" id="txtcaptcha" class="input-text solonumero" placeholder="Ingrese la suma de la imagen">
                        </div>
                       <div class="row">    
                        <div class="col-md-12">
                        <canvas id="myCanvas" width="200" height="70"
                            style="border:1px solid #d3d3d3; padding:10px 80px; background-color: #fec839;">
                            Your browser does not support the canvas element.
                            </canvas>
                        </div>
                       </div>
                        </div>
                        <div class="form-group clearfix mb-0 m-t-30">
                            <button type="button" id="btnConsultar" class="btn-md bg float-right f-bold">Consultar</button>
                            <!--<a href="forgot-password.html" class="forgot-password">Recuperar Contraseña</a>-->
                        </div>

                        <div id="divConsultaPadron" class="row d-none m-t-30">
                            <div class="col-md-12">
                                <p class="c-font-label">Estimado(a) <span id="lblNombre" class="f-bold">xx</span></p>
                                <p class="c-font-label text-justify">Usted está empadronado para el proceso de Elección de <span id="lblEmpresa" class="f-bold"></span> que   
                                 se llevará a cabo <span id="lblFecha" class="f-bold"></span> a partir de las <span id="lblHoraInicio" class="f-bold"></span> hasta las <span id="lblHoraFin" class="f-bold"></span>. Deberá 
                                 acercarse portando su cédula de identidad a la Agencia <span id="lblRecinto" class="f-bold"></span>.</p>
                            </div>
                        </div>
                       <div id="divConsultaNegativo" class="row d-none m-t-30">
                            <div class="col-md-12">
                                <p class="c-font-label">Estimado(a) </p>
                                <p class="c-font-label">Usted no se encuentra habilitado para el proceso de elecciones.</p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 bg-color-15 align-self-center pad-0 none-992 heightlogin">
                <div class="info clearfix">
                    <div class="">
                        <a href="index.html">
                            <img id="logo" src="" alt="logo">
                        </a>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact section end -->

<!-- Full Page Search -->
<div id="full-page-search">
    <button type="button" class="close">×</button>
    <form action="index.html#">
        <input type="search" value="" placeholder="type keyword(s) here" />
        <button type="submit" class="btn btn-sm button-theme">Search</button>
    </form>
</div>
<div id="ohsnap"></div>
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
<script  src="js/app.js?rand=<?php echo uniqid();?>"></script>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script  src="js/ie10-viewport-bug-workaround.js"></script>
<!-- Custom javascript -->
<script  src="js/ie10-viewport-bug-workaround.js"></script>

 <script type="text/javascript" src="js/noty/js/noty/jquery.noty.js"></script>
    <script type="text/javascript" src="js/noty/js/noty/layouts/topRight.js"></script>
    <script type="text/javascript" src="js/noty/js/noty/layouts/bottom.js"></script>
    <script type="text/javascript" src="js/noty/js/noty/layouts/center.js"></script>
    <script type="text/javascript" src="js/noty/js/noty/themes/default.js"></script>

    <script type="text/javascript" src="js/noty/js/noty/packaged/jquery.noty.packaged.js"></script>

<!--<script src="js/chosen/chosen.jquery.js" type="text/javascript"></script>   -->
<script  src="js/fnJSCore.js?rand=<?php echo uniqid();?>"></script>
<script  src="js/jsPadron.js?rand=<?php echo uniqid();?>"></script>
</body>
</html>