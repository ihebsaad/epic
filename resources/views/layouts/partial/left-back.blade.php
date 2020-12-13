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
    <ul class="navbar-nav bg-gradient sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href=" ">
        <!--<div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>-->
        <div class="sidebar-brand-text mx-3"><img src="{{ URL::asset('public/img/logo.png')}}" /></div>
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

      <li class="nav-item   <?php  ?>">
        <a class="nav-link" href="">
          <!--<i class="fas fa-fw fa-folder-open"></i>-->
          <span>{{__('msg.Half Products')}}</span></a>
      </li>
	  
	  <li class="nav-item   <?php  ?>">
        <a class="nav-link" href="">
          <!--<i class="fas fa-fw fa-folder-open"></i>-->
          <span> {{__('msg.Findings')}}</span></a>
      </li>

	  <li class="nav-item   <?php  ?>">
        <a class="nav-link" href="">
           <span> {{__('msg.Jewelry')}}</span></a>
      </li>
	  <li class="nav-item   <?php  ?>">
        <a class="nav-link" href="">
           <span> {{__('msg.Galvano')}}</span></a>
      </li>	
	  
 	  <li class="nav-item   <?php  ?>">
        <a class="nav-link" href="">
           <span> {{__('msg.Industrial refining')}} </span></a>
      </li>
	  
 	  <li class="nav-item   <?php  ?>">
        <a class="nav-link" href="">
           <span> {{__('msg.Laboratory')}} </span></a>
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