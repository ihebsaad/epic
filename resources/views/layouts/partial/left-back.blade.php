<?php
$user_type='';
if (Auth::check()) {

$user = auth()->user();
 $iduser=$user->id;
$user_type=$user->user_type;
} 
?>
<style>
#accordionSidebar a:hover{color:black!important;}
</style>
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient sidebar sidebar-dark  accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home')}}">
        <!--<div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>-->
        <div class="sidebar-brand-text mx-3"><img width="100"  src="{{ URL::asset('public/img/logo.png')}}" /></div>
      </a>

      <!-- Divider -->

      <!-- Nav Item - Dashboard -->
    <?php   ?>
<!-- 
  <li class="nav-item">
	  
  <a class="nav-link"  href=" ">
          <i class="fas fa-fw fa-home"></i>
          <span>Accueil</span></a>
      </li>
 <?php     ?>-->
 
 
  
 
<?php    ?>
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        {{__('msg.Craftsmen, Manufacturers, Industrialists')}}
      </div>
      <hr class="sidebar-divider">

      <li class="nav-item   "  <?php if(isset($type)){if($type==101){echo 'style="font-weight:800"'; }}   if($view_name=='products-products' ){echo 'style="font-weight:800"'; } ?>>
        <a class="nav-link" href="{{route('products')}}">
          <!--<i class="fas fa-fw fa-folder-open"></i>-->
          <span>{{__('msg.Half Products')}}</span></a>
      </li>
	  
	  <li class="nav-item   <?php  ?>">
        <a class="nav-link" href="{{route('findings')}}"  <?php if(isset($type)){if($type==103){echo 'style="font-weight:800"'; }}  if($view_name=='products-findings' ){echo 'style="font-weight:800"'; } ?>  >
          <!--<i class="fas fa-fw fa-folder-open"></i>-->
          <span> {{__('msg.Findings')}}</span></a>
      </li>

	  <li class="nav-item   <?php  ?>">
        <a class="nav-link" href="{{route('jewelry')}}"  <?php if(isset($type)){if($type==104){echo 'style="font-weight:800"'; }} if($view_name=='products-jewelry' ){echo 'style="font-weight:800"'; } ?>>
           <span> {{__('msg.Jewelry')}}</span></a>
      </li>
	  <li class="nav-item   <?php  ?>">
        <a class="nav-link" href="{{route('galvano')}}"  <?php if(isset($type)){if($type==102){echo 'style="font-weight:800"'; }} if($view_name=='products-galvano' ){echo 'style="font-weight:800"'; } ?>>
           <span> {{__('msg.Galvano')}}</span></a>
      </li>	
	  
 	  <li class="nav-item   <?php  ?>">
        <a class="nav-link" href="{{route('affinage')}}"  <?php if( strpos($view_name  ,'affinage') !== false )  {echo 'style="font-weight:800"'; } ?> >
           <span> {{__('msg.Industrial refining')}} </span></a>
      </li>
	  
 	  <li class="nav-item   <?php  ?>">
        <a class="nav-link" href="{{route('laboratoire')}}"   <?php if( strpos($view_name  ,'laboratoire') !== false )  {echo 'style="font-weight:800"'; } ?> >
           <span> {{__('msg.Laboratory')}} </span></a>
      </li>	 
	  
 	  <li class="nav-item   <?php  ?>">
        <a class="nav-link" href="{{route('rachat')}}"   <?php if( strpos($view_name  ,'rachat') !== false )  {echo 'style="font-weight:800"'; } ?> >
           <span> {{__('msg.Buyback')}} </span></a>
      </li>	 	  
      <!-- Divider -->
      <hr class="sidebar-divider">
       <!-- Heading -->
	   
      <div class="sidebar-heading">
         {{__('msg.Collectors, Investors')}}
      </div>
	  <hr class="sidebar-divider">

	  <li class="nav-item   <?php  ?>">
        <a class="nav-link" href="">
           <span> {{__('msg.Metal transfer')}}</span></a>
      </li>	
	  
	  <li class="nav-item   <?php  ?>">
        <a class="nav-link" href="">
           <span> {{__('msg.Trading')}}</span></a>
      </li>		  
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->