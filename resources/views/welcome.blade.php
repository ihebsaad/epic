<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    
    <!--====== Title ======-->
    <title>SAAMP</title>
    
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{ URL::asset('public/front/images/favicon.png')}}" type="image/png">
        
    <!--====== Magnific Popup CSS ======-->
    <link rel="stylesheet" href="{{ URL::asset('public/front/css/magnific-popup.css')}}">
        
    <!--====== Slick CSS ======-->
    <link rel="stylesheet" href="{{ URL::asset('public/front/css/slick.css')}}">
        
    <!--====== Line Icons CSS ======-->
    <link rel="stylesheet" href="{{ URL::asset('public/front/css/LineIcons.css')}}">
        
    <!--====== Bootstrap CSS ======-->
    <link rel="stylesheet" href="{{ URL::asset('public/front/css/bootstrap.min.css')}}">
    
    <!--====== Default CSS ======-->
    <link rel="stylesheet" href="{{ URL::asset('public/front/css/default.css')}}">
    
    <!--====== Style CSS ======-->
    <link rel="stylesheet" href="{{ URL::asset('public/front/css/style.css')}}">
    
</head>

<body>
    <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->
   
    <!--====== PRELOADER PART START ======-->

    <div class="preloader">
        <div class="loader">
            <div class="ytp-spinner">
                <div class="ytp-spinner-container">
                    <div class="ytp-spinner-rotator">
                        <div class="ytp-spinner-left">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                        <div class="ytp-spinner-right">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--====== PRELOADER PART ENDS ======-->
    
    <!--====== NAVBAR TWO PART START ======-->

    <section class="navbar-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">
                       
                        <a class="navbar-brand" href="#">
                            <img src="{{ URL::asset('public/front/images/logo.png')}}" alt="Logo">
                        </a>
                        
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTwo" aria-controls="navbarTwo" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarTwo">
                            <ul class="navbar-nav m-auto">
                                <li class="nav-item active"><a class="page-scroll" href="#home">Accueil</a></li>
                                <li class="nav-item"><a class="page-scroll" href="#services">Nos Services</a></li>
                              <!--  <li class="nav-item"><a class="page-scroll" href="#portfolio">Portfolio</a></li>
                                <li class="nav-item"><a class="page-scroll" href="#pricing">Pricing</a></li>
                                <li class="nav-item"><a class="page-scroll" href="#about">About</a></li>
                                <li class="nav-item"><a class="page-scroll" href="#team">Team</a></li>-->
                                <li class="nav-item"><a class="page-scroll" href="#agences">Nos Agences</a></li>
                                <li class="nav-item"><a class="page-scroll" href="#contact">Contact</a></li>
                            </ul>
                        </div>
                        
                        <div class="navbar-btn d-none d-sm-inline-block">
                            <ul>
							@guest
                                <li><a class="solid" href="{{route('register')}}">Inscription</a></li>
                                <li><a class="solid" href="{{route('login')}}">Connexion</a></li>
							@else
                                <li><a class="solid" href="{{route('home')}}">Mon espace</a></li>
                            @endguest
						   </ul>
                        </div>
                    </nav> <!-- navbar -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== NAVBAR TWO PART ENDS ======-->
    
    <!--====== SLIDER PART START ======-->

    <section id="home" class="slider_area">
        <div id="carouselThree" class="carousel slide" data-ride="carousel">
         <!--   <ol class="carousel-indicators">
                <li data-target="#carouselThree" data-slide-to="0" class="active"></li>
                <li data-target="#carouselThree" data-slide-to="1"></li>
                <li data-target="#carouselThree" data-slide-to="2"></li>
            </ol>
			-->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="slider-content">
                                    <h1 class="title">Bienvenue à <b style="">SAAMP Space</b> </h1>
                                    <p class="text">Gérez vos produits en métaux précieux </p>
                                    <ul class="slider-btn rounded-buttons">
                                        @guest
									    <li><a class="main-btn rounded-one" href="{{route('login')}}">Connexion</a></li>
                                        <li><a class="main-btn rounded-two" href="{{route('register')}}">Inscription</a></li>
										@else
                                        <li><a class="main-btn rounded-two" href="{{route('home')}}">Mon espace</a></li>
											
										@endguest
                                    </ul>
                                </div>
                            </div>
                        </div> <!-- row -->
                    </div> <!-- container -->
                    <div class="slider-image-box d-none d-lg-flex align-items-end">
                        <div class="slider-image">
                            <img src="{{ URL::asset('public/front/images/slider/1.png')}}" alt="Hero">
                        </div> <!-- slider-imgae -->
                    </div> <!-- slider-imgae box -->
                </div> <!-- carousel-item -->
				<!--
                <div class="carousel-item">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="slider-content">
                                    <h1 class="title">Crafted for Business</h1>
                                    <p class="text">We blend insights and strategy to create digital products for forward-thinking organisations.</p>
                                    <ul class="slider-btn rounded-buttons">
                                        <li><a class="main-btn rounded-one" href="./espace/regiter">Connexion</a></li>
                                        <li><a class="main-btn rounded-two" href="./espace/login">Inscription</a></li>
                                    </ul>
                                </div> <!-- slider-content -- 
                            </div>
                        </div> <!-- row -- 
                    </div> <!-- container -- 
                    <div class="slider-image-box d-none d-lg-flex align-items-end">
                        <div class="slider-image">
                            <img src="{{ URL::asset('public/front/images/slider/2.png')}}" alt="Hero">
                        </div> <!-- slider-imgae -- 
                    </div> <!-- slider-imgae box -- 
                </div> <!-- carousel-item -->
				<!--
                <div class="carousel-item">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="slider-content">
                                    <h1 class="title">...... </h1>
                                    <p class="text"> ........</p>
                                    <ul class="slider-btn rounded-buttons">
                                        <li><a class="main-btn rounded-one" href="#">Connexion </li>
                                        <li><a class="main-btn rounded-two" href="#">Inscription</a></li>
                                    </ul>
                                </div> <!-- slider-content --
                            </div>
                        </div> <!-- row --
                    </div> <!-- container --
                    <div class="slider-image-box d-none d-lg-flex align-items-end">
                        <div class="slider-image">
                            <img src="{{ URL::asset('public/front/images/slider/3.png')}}" alt="Hero">
                        </div> <!-- slider-imgae --
                    </div> <!-- slider-imgae box --
                </div> <!-- carousel-item -->
            </div>

        <!--    <a class="carousel-control-prev" href="#carouselThree" role="button" data-slide="prev">
                <i class="lni lni-arrow-left"></i>
            </a>
            <a class="carousel-control-next" href="#carouselThree" role="button" data-slide="next">
                <i class="lni lni-arrow-right"></i>
            </a>-->
        </div>
    </section>

    <!--====== SLIDER PART ENDS ======-->
    
    <!--====== FEATRES TWO PART START ======-->

    <section id="services" class="features-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10">
                    <div class="section-title text-center pb-10">
                        <h3 class="title">Nos Services</h3>
                        <p class="text"> Short details for the ones who look for something new. Short details for the ones who look for something new.</p>
                    </div> <!-- row -->
                </div>
            </div> <!-- row -->
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-7 col-sm-9">
                    <div class="single-features mt-40">
                        <div class="features-title-icon d-flex justify-content-between">
                            <h4 class="features-title"><a href="#">Affinage</a></h4>
                            <div class="features-icon">
                                <i class="lni lni-brush"></i>
                             </div>
                        </div>
                        <div class="features-content">
                            <p class="text">collecter, analyser, traiter et valoriser tous vos déchets avec le respect strict des réglementations en vigueurs.</p>
                          <!--  <a class="features-btn" href="#">LEARN MORE</a>-->
                        </div>
                    </div> <!-- single features -->
                </div>
                <div class="col-lg-4 col-md-7 col-sm-9">
                    <div class="single-features mt-40">
                        <div class="features-title-icon d-flex justify-content-between">
                            <h4 class="features-title"><a href="#">Bijouterie</a></h4>
                            <div class="features-icon">
                                <i class="lni lni-diamond"></i>
                             </div>
                        </div>
                        <div class="features-content">
                            <p class="text">élaboration des alliages de hautes qualités métallurgiques et fabrication des demi-produits destinés à des clients prestigieux.</p>
                          <!--  <a class="features-btn" href="#">LEARN MORE</a>-->
                        </div>
                    </div> <!-- single features -->
                </div>
                <div class="col-lg-4 col-md-7 col-sm-9">
                    <div class="single-features mt-40">
                        <div class="features-title-icon d-flex justify-content-between">
                            <h4 class="features-title"><a href="#">Métaux</a></h4>
                            <div class="features-icon">
                                <i class="lni lni-bricks"></i>
                             </div>
                        </div>
                        <div class="features-content">
                            <p class="text">gestion du compte client : la récupération des affinages, l’analyse des échantillons, la production des demi-produits..</p>
                          <!--  <a class="features-btn" href="#">LEARN MORE</a>-->
                        </div>
                    </div> <!-- single features -->
                </div>
				
				
				<div class="col-lg-4 col-md-7 col-sm-9">
                    <div class="single-features mt-40">
                        <div class="features-title-icon d-flex justify-content-between">
                            <h4 class="features-title"><a href="#">Analyse</a></h4>
                            <div class="features-icon">
                                <i class="lni lni-graph"></i>
                             </div>
                        </div>
                        <div class="features-content">
                            <p class="text">homogénéisation , prélèvement d'échantillon, réception de lot, détection de la proportion des métaux préciaux..</p>
                          <!--  <a class="features-btn" href="#">LEARN MORE</a>-->
                        </div>
                    </div> <!-- single features -->
                </div>
				
				 <div class="col-lg-4 col-md-7 col-sm-9">
                    <div class="single-features mt-40">
                        <div class="features-title-icon d-flex justify-content-between">
                            <h4 class="features-title"><a href="#">Traitement</a></h4>
                            <div class="features-icon">
                                <i class="lni lni-construction-hammer"></i>
                             </div>
                        </div>
                        <div class="features-content">
                            <p class="text">traitement de surface des métaux : sels de métaux précieux, anodes, grenailles calibrées..</p>
                          <!--  <a class="features-btn" href="#">LEARN MORE</a>-->
                        </div>
                    </div> <!-- single features -->
                </div>
				
				
				
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
 
    <!--====== CONTACT PART START ======-->

	    <section id="agences" class=" ">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10">
                    <div class="section-title text-center pt-30">
                        <h3 class="title">Nos agences</h3>
                     </div> <!-- section title -->
                </div>
            </div> <!-- row -- 
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact-map mt-30">
                        <iframe id="gmap_canvas" src="https://maps.google.com/maps?q=Mission%20District%2C%20San%20Francisco%2C%20CA%2C%20USA&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                    </div> <!-- row - 
                </div>
            </div> <!-- row -->
			   <div class="contact-info pt-30">
			   
			    <h3 class="title pl-100">Paris</h3>
                <div class="row">
				<div class="col-lg-1 col-md-12" ></div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-contact-info contact-color-1 mt-30 d-flex ">
                            <div class="contact-info-icon">
                                <i class="lni lni-map-marker"></i>
                            </div>
                            <div class="contact-info-content media-body">
                                <p class="text">145 rue de temple 75003 Paris</p>
                            </div>
                        </div> <!-- single contact info -->
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="single-contact-info contact-color-2 mt-30 d-flex ">
                            <div class="contact-info-icon">
                                <i class="lni lni-envelope"></i>
                            </div>
                            <div class="contact-info-content media-body">
                                <p class="text">hello@mail.com</p>
                                <p class="text"> </p>
                            </div>
                        </div> <!-- single contact info -->
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="single-contact-info contact-color-3 mt-30 d-flex ">
                            <div class="contact-info-icon">
                                <i class="lni lni-phone"></i>
                            </div>
                            <div class="contact-info-content media-body">
                                <p class="text">+33(0)1 44 61 80 32</p>
                             </div>
                        </div> <!-- single contact info -->
                    </div>
                </div> <!-- row --><br><br>
				
				
			    <h3 class="title pl-100">Lyon</h3>
                <div class="row">
                    <div class="col-lg-1 col-md-12" ></div>
					<div class="col-lg-4 col-md-6">
                        <div class="single-contact-info contact-color-1 mt-30 d-flex ">
                            <div class="contact-info-icon">
                                <i class="lni lni-map-marker"></i>
                            </div>
                            <div class="contact-info-content media-body">
                                <p class="text"> 25 rue de president E.Herriot 69001 Lyon.</p>
                            </div>
                        </div> <!-- single contact info -->
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="single-contact-info contact-color-2 mt-30 d-flex ">
                            <div class="contact-info-icon">
                                <i class="lni lni-envelope"></i>
                            </div>
                            <div class="contact-info-content media-body">
                                <p class="text">hello@ayroui.com</p>
                             </div>
                        </div> <!-- single contact info -->
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="single-contact-info contact-color-3 mt-30 d-flex ">
                            <div class="contact-info-icon">
                                <i class="lni lni-phone"></i>
                            </div>
                            <div class="contact-info-content media-body">
                                <p class="text">+33(0)4 78 39 49 77</p>
                             </div>
                        </div> <!-- single contact info -->
                    </div>
                </div> <!-- row --><br><br>

				
				
			    <h3 class="title pl-100">Marseille</h3>
                <div class="row">
                    <div class="col-lg-1 col-md-12" ></div>
					<div class="col-lg-4 col-md-6">
                        <div class="single-contact-info contact-color-1 mt-30 d-flex ">
                            <div class="contact-info-icon">
                                <i class="lni lni-map-marker"></i>
                            </div>
                            <div class="contact-info-content media-body">
                                <p class="text"> 6 place de Rome, 13006 Marseille</p>
                            </div>
                        </div> <!-- single contact info -->
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="single-contact-info contact-color-2 mt-30 d-flex ">
                            <div class="contact-info-icon">
                                <i class="lni lni-envelope"></i>
                            </div>
                            <div class="contact-info-content media-body">
                                <p class="text">hello@mail.com</p>
                             </div>
                        </div> <!-- single contact info -->
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="single-contact-info contact-color-3 mt-30 d-flex ">
                            <div class="contact-info-icon">
                                <i class="lni lni-phone"></i>
                            </div>
                            <div class="contact-info-content media-body">
                                <p class="text">+33 (0)4 91 13 06 08</p>
                             </div>
                        </div> <!-- single contact info -->
                    </div>
                </div> <!-- row --><br><br>

				
				
<h3 class="title pl-100">Nice</h3>
                <div class="row">
                    <div class="col-lg-1 col-md-12" ></div>
					<div class="col-lg-4 col-md-6">
                        <div class="single-contact-info contact-color-1 mt-30 d-flex ">
                            <div class="contact-info-icon">
                                <i class="lni lni-map-marker"></i>
                            </div>
                            <div class="contact-info-content media-body">
                                <p class="text">29, rue Pastorelli<br>
										(entrée B, 2ème étage, bureau 204) 06000 Nice</p>
                            </div>
                        </div> <!-- single contact info -->
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="single-contact-info contact-color-2 mt-30 d-flex ">
                            <div class="contact-info-icon">
                                <i class="lni lni-envelope"></i>
                            </div>
                            <div class="contact-info-content media-body">
                                <p class="text">hello@mail.com</p>
                             </div>
                        </div> <!-- single contact info -->
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="single-contact-info contact-color-3 mt-30 d-flex ">
                            <div class="contact-info-icon">
                                <i class="lni lni-phone"></i>
                            </div>
                            <div class="contact-info-content media-body">
                                <p class="text">+33 (0)4 83 39 83 74</p>
                             </div>
                        </div> <!-- single contact info -->
                    </div>
                </div> <!-- row --><br><br>



<h3 class="title pl-100">Cayenne</h3>
                <div class="row">
                    <div class="col-lg-1 col-md-12" ></div>
					<div class="col-lg-4 col-md-6">
                        <div class="single-contact-info contact-color-1 mt-30 d-flex ">
                            <div class="contact-info-icon">
                                <i class="lni lni-map-marker"></i>
                            </div>
                            <div class="contact-info-content media-body">
                                <p class="text">  6 impasse Paoline  Za Galmot, 97300 Cayenne-Guyane</p>
                            </div>
                        </div> <!-- single contact info -->
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="single-contact-info contact-color-2 mt-30 d-flex ">
                            <div class="contact-info-icon">
                                <i class="lni lni-envelope"></i>
                            </div>
                            <div class="contact-info-content media-body">
                                <p class="text">hello@mail.com</p>
                             </div>
                        </div> <!-- single contact info -->
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="single-contact-info contact-color-3 mt-30 d-flex ">
                            <div class="contact-info-icon">
                                <i class="lni lni-phone"></i>
                            </div>
                            <div class="contact-info-content media-body">
                                <p class="text">05 94 38 12 74</p>
                             </div>
                        </div> <!-- single contact info -->
                    </div>
                </div> <!-- row --><br><br>
				
            </div> <!--   -->
		</div>
		</section>
	
	 
	
    <section id="contact" class="contact-area">
        <div class="container">
    

            <div class="row">
                <div class="col-lg-12">
                    <div class="contact-wrapper form-style-two ">
                        <h4 class="contact-title pb-10"><i class="lni lni-envelope"></i> <span>Laissez</span> un message.</h4>
                        
                        <form id="contact-form" action=" " method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-input mt-25">
                                        <label>Nom complet</label>
                                        <div class="input-items default">
                                            <input name="name" type="text" placeholder="Nom">
                                            <i class="lni lni-user"></i>
                                        </div>
                                    </div> <!-- form input -->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-input mt-25">
                                        <label>Email</label>
                                        <div class="input-items default">
                                            <input type="email" name="email" placeholder="Email">
                                            <i class="lni lni-envelope"></i>
                                        </div>
                                    </div> <!-- form input -->
                                </div>
                                <div class="col-md-12">
                                    <div class="form-input mt-25">
                                        <label>Message</label>
                                        <div class="input-items default">
                                            <textarea name="message" placeholder="Message"></textarea>
                                            <i class="lni lni-pencil-alt"></i>
                                        </div>
                                    </div> <!-- form input -->
                                </div>
                                <p class="form-message"></p>
                                <div class="col-md-12">
                                    <div class="form-input light-rounded-buttons mt-30">
                                        <button class="main-btn light-rounded-two">Envoyer</button>
                                    </div> <!-- form input -->
                                </div>
                            </div> <!-- row -->
                        </form>
                    </div> <!-- contact wrapper form -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== CONTACT PART ENDS ======-->
    
    <!--====== FOOTER PART START ======-->

    <section class="footer-area footer-dark pt-40 pb-40" style="">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="footer-logo text-center">
                        <a class="mt-10" href="#"><img src="{{ URL::asset('public/front/images/logo.png')}}" alt="Logo"></a>
                    </div> <!-- footer logo -->
                    <ul class="social text-center mt-60">
                        <li><a href="#"><i class="lni lni-facebook-filled"></i></a></li>
                        <li><a href="#"><i class="lni lni-twitter-original"></i></a></li>
                        <li><a href="#"><i class="lni lni-instagram-original"></i></a></li>
                        <li><a href="#"><i class="lni lni-linkedin-original"></i></a></li>
                    </ul> <!-- social -->
                <!--    <div class="footer-support text-center">
                        <span class="number">+545555555550</span>
                        <span class="mail">contact@saamp.com</span>
                    </div>--->
                    <div class="copyright text-center mt-5">
                        <p class="text">SAAMP 2021 &copy par <a href="#" rel="nofollow"> </a>    </p>
                    </div> <!--  copyright -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== FOOTER PART ENDS ======-->
    
    <!--====== BACK TOP TOP PART START ======-->

    <a href="#" class="back-to-top"><i class="lni lni-chevron-up"></i></a>

    <!--====== BACK TOP TOP PART ENDS ======-->    

    <!--====== PART START ======-->

<!--
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-">
                    
                </div>
            </div>
        </div>
    </section>
-->

    <!--====== PART ENDS ======-->




    <!--====== Jquery js ======-->
    <script src="{{ URL::asset('public/front/js/vendor/jquery-1.12.4.min.js')}}"></script>
    <script src="{{ URL::asset('public/front/js/vendor/modernizr-3.7.1.min.js')}}"></script>
    
    <!--====== Bootstrap js ======-->
    <script src="{{ URL::asset('public/front/js/popper.min.js')}}"></script>
    <script src="{{ URL::asset('public/front/js/bootstrap.min.js')}}"></script>
    
    <!--====== Slick js ======-->
    <script src="{{ URL::asset('public/front/js/slick.min.js')}}"></script>
    
    <!--====== Magnific Popup js ======-->
    <script src="{{ URL::asset('public/front/js/jquery.magnific-popup.min.js')}}"></script>
    
    <!--====== Ajax Contact js ======-->
    <script src="{{ URL::asset('public/front/js/ajax-contact.js')}}"></script>
    
    <!--====== Isotope js ======-->
    <script src="{{ URL::asset('public/front/js/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{ URL::asset('public/front/js/isotope.pkgd.min.js')}}"></script>
    
    <!--====== Scrolling Nav js ======-->
    <script src="{{ URL::asset('public/front/js/jquery.easing.min.js')}}"></script>
    <script src="{{ URL::asset('public/front/js/scrolling-nav.js')}}"></script>
    
    <!--====== Main js ======-->
    <script src="{{ URL::asset('public/front/js/main.js')}}"></script>
    
</body>

</html>
