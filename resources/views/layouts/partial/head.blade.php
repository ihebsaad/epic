<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <link rel="shortcut icon" type="image/png" href="{{  URL::asset('public/site/img/favicon.png') }}">

  <title>Al Manahel Academy </title>
    <?php    setlocale(LC_ALL, "fr_FR.UTF-8");    ?>
  <!-- Bootstrap core CSS -->
  <link  href="{{  URL::asset('public/site/vendor/bootstrap/css/bootstrap.min.css') }}"   rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link   href="{{  URL::asset('public/site/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Maven Pro' rel='stylesheet'>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">

  <!-- Custom styles for this template -->
  <link  href="{{  URL::asset('public/site/css/clean-blog.min.css') }}"   rel="stylesheet">
  <link  href="{{  URL::asset('public/site/css/slicknav.min.css') }}"   rel="stylesheet">
  <link  href="{{  URL::asset('public/site/css/menu.css') }}"   rel="stylesheet">
  <link  href="{{  URL::asset('public/site/css/custom.css') }}"   rel="stylesheet">

<style>
.select2-container--default .select2-selection--single {    
    height: 38px!important;
    padding-top: 5px!important;
}
 li .active  {
 border-bottom:3px solid darkgrey;line-height:23px;color:#8f8f8f!important ;
}
</style>

</head>

<body class="bgpattern">

 <header class="header-area">
<div class="header-top bg-2">
<div class="container">
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-6">
<div class="header-top-left">
<p>LYCÉE Al-MANAHEL MONASTIR</p>
</div>
</div>
<div class="col-md-6 col-sm-6 col-xs-6">
<div class="header-top-right text-right">
<ul>
<li><a href="https://www.facebook.com/almanahel.monastir/" target="blank"><i class="fa fa-facebook"></i></a></li>
<li><a href="https://twitter.com/al_lycee" target="blank"><i class="fa fa-twitter"></i></a></li>
<li><a href="#"><i class="fa fa-youtube"></i></a></li>
</ul>
</div>
</div>
</div>
</div>
</div>
<div class="header-middle bg-1">
<div class="container">
<div class="row">
<div class="col-md-3 d-none d-md-block">
<div class="logo">
<a href="{{ route('home') }}"><img src="{{  URL::asset('public/site/img/logo.png') }}" alt="AlManahel Academy" width="250"></a>
</div>
</div>
<div class="col-md-9 col-xs-12">
<div class="header-middle-right">
<ul>
<?php
$user_type="";
$loggedin=false;
if (Auth::check()) {
$loggedin=true;
$user = auth()->user();
 $user_type=$user->user_type;
 $prenom=$user->name;
 $nom=$user->lastname;
echo '<li>Bienvenue  <B>'.$prenom.' '.$nom.'</B> </li>';

}
?>
<?php if(! $loggedin || $user_type=='eleve'){?>
<li>
<div class="contact-info">
<a href="{{ route('espaceeleves') }}">Espace Élèves</a>
<!--<span>Sunday colsed</span>-->
</div>
</li>
<?php } ?>
<?php if(! $loggedin || $user_type=='prof'){?>
<li>
<!--<div class="contact-icon">
<i class="fa fa-envelope"></i>
</div>-->
<div class="contact-info">
<a href="{{ route('espaceprofs') }}">Espace Enseignants</a>
</div>
</li>
<?php } ?>
<?php if(! $loggedin || $user_type=='parent'){?>
<li>
<!--<div class="contact-icon">
<i class="fa fa-phone"></i>
</div>-->
<div class="contact-info">
<a href="{{ route('espaceparents') }}">Espace Parents</a>
<!--<span> (+1) 1144-1254</span>-->
</div>
</li>
<?php } ?>
<?php if(! $loggedin || (($user_type!='parent')&& ($user_type!='prof') && ($user_type!='eleve')    )  ){?>
<li>
<!--<div class="contact-icon">
<i class="fa fa-phone"></i>
</div>-->
<div class="contact-info">
<a href="{{ route('admin') }}">Espace Administration</a>
<!--<span> (+1) 1144-1254</span>-->
</div>
</li>
<?php } ?>
</ul>
</div>
</div>
</div>
</div>
</div>
<div class="header-bottom" id="sticky-header">
<div class="container">
<div class="row d-flex justify-content-between">
<div class="d-md-none d-lg-none d-xl-none col-sm-8 col-xs-6">
<div class="logo">
<a href="{{ route('home') }}"><img src="{{  URL::asset('public/site/img/logo.png') }}" alt="AlManahel Academy" width="150"></a>
</div>
</div>
<div class="col-md-11 d-none d-md-block">
<div class="mainmenu"  style="padding-left:40px">
<ul id="navigation"><li  class="<?php if($view_name=='home'){echo 'active';} ?>"   >
  <a   <?php if($view_name=='home'){echo 'style="border-bottom:3px solid darkgrey;line-height:23px; ;"';} ?>  href="{{ route('home') }}">Accueil</a>
</li>
<li>
  <a href="{{ route('presentation') }}"  class="<?php if($view_name=='presentation'){echo 'active';} ?>"   >Présentation</a>
</li>
<li>
  <a href="{{ route('inscription') }}" class="<?php if($view_name=='inscription'){echo 'active';} ?>"   >Inscription</a>
</li>
<li>
  <a href="{{ route('scolaire') }}" class="<?php if($view_name=='scolaire'){echo 'active';} ?>"   >Vie Scolaire</a>
</li>
<li>
  <a href="{{ route('formation') }}" class="<?php if($view_name=='formation'){echo 'active';} ?>"   >Formation & Emploi</a>
</li>
<li>
  <a href="{{ route('contact') }}" class="<?php if($view_name=='contact'){echo 'active';} ?>"   >Contact</a>
</li>
</ul>
</div>
</div>

<div id="menumob" class="ml-auto" style="display: none"></div>

</div>
</div>
</div>
</header> 