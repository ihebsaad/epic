 <?php  $user = auth()->user();  
$lg=$user['lg'];$displayfr='';$displayen='';$displaypl='';
if($lg=='fr' ||$lg=='' ) { $langue='Français';$displayfr='display:none';}
if($lg=='en' ){ $langue='English';$displayen='display:none';}
if($lg=='pl' ){ $langue='Polski';$displaypl='display:none';}	 
app()->setLocale($lg); 
	?>
 <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i style="color:#f2ba01" class="fa fa-bars"></i>
          </button>
		 <ul style="margin-top:10px" id="" class="nav  ">
 
		<li class="dropdown menu-item">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
            <img 
			<?php if($lg=='fr'|| $lg=='' ){?>
			src="{{ URL::asset('public/img/fr.png')}}" 
			<?php } ?>
			<?php if($lg=='en' ){?>
			src="{{ URL::asset('public/img/en.png')}}" 
			<?php } ?>			
			<?php if($lg=='pl' ){?>
			src="{{ URL::asset('public/img/pl.png')}}" 
			<?php } ?>			
			style="width:25px;margin-right:5px"   title="<?php echo $langue;?>" >
            <span class="lang"><?php echo $langue;?></span>
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu   dropdown-menu-right shadow animated--grow-in"  style="padding-left:20px;padding-top:10px;">
		<li style="margin-bottom:12px;<?php echo $displayfr;?>">
		   <div id="lg-fr"  style="cursor:pointer;" onclick="setlanguage('fr');">
           <img src="{{ URL::asset('public/img/fr.png')}}" style="width:20px;margin-bottom:5px;" title="Français">   Français
           </div>	
		</li>
		<li style="margin-bottom:12px;<?php echo $displayen;?>">
          <div id="lg-en" style="cursor:pointer" onclick="setlanguage('en');">
          <img src="{{ URL::asset('public/img/en.png')}}" style="width:20px" title="English">   English
          </div>
        </li>
		<li style="margin-bottom:12px;<?php echo $displaypl;?>">
          <div id="lg-pl"  style="cursor:pointer" onclick="setlanguage('pl');">
           <img src="{{ URL::asset('public/img/pl.png')}}" style="width:20px;margin-bottom:5px;" title="polski">   Polski
           </div>
	   
         </li>
          </ul>
			</li>
		 </ul>
 
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

<?php 
$myorder = DB::table('orders')->where('status','cart')->where('user',$user->id)->first();
if ($myorder!=null){
 $Orderid=$myorder->id;
$prods= DB::table('products')->where('orderid',$Orderid)->count();
}else{
	$prods=0;
}
?>
<?php

$E_CmdesAff=DB::table('cmde_aff_e')->where('cl_ident',$user['client_id'])->where('statut','panier')->get();
$E_CmdesLab=DB::table('cmde_lab_e')->where('cl_ident',$user['client_id'])->where('statut','panier')->get();
$E_CmdesRMP=DB::table('cmde_rmp_e')->where('cl_ident',$user['client_id'])->where('statut','panier')->get();

$count_aff =count($E_CmdesAff);
$count_lab =count($E_CmdesLab);
$count_rmp =count($E_CmdesRMP);
$count= $count_aff + $count_lab + $count_rmp;
?>
            <!-- Nav Item - Messages --> 
 
 			<li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="{{route('panier')}}"  >
                <i class="fas fa-shopping-cart fa-fw"></i>
                <!-- Counter - Messages --> 
                <span  data-toggle="tooltip" data-placement="bottom" title="{{__('msg.Products')}}" class="badge badge-danger badge-counter"><?php if($prods>0){echo $prods;}?></span>
              </a>
	   
            </li> 			
 			<li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="{{route('livraisonmod')}}"  >
                <i class="fas fa-shopping-bag fa-fw"></i>
                <!-- Counter - Messages --> 
                <span  data-toggle="tooltip" data-placement="bottom" title="{{__('msg.My templates')}}" class="badge badge-danger badge-counter"><?php if($count>0){echo $count;}?></span>
              </a>
	   
            </li> 
 
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php if(isset($user['name'] )){ echo $user['name'];} if(isset($user['lastname'] )){ echo ' '.$user['lastname'] ;}?></span>
                <img class="img-profile rounded-circle" src="{{ URL::asset('public/img/person.jpg')}}">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{route('profile')}}">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  {{__('msg.My Profile')}} 
                </a>
				<?php if ($user['user_type']=='admin'){?>
               <a class="dropdown-item" href="{{route('users')}}">
                  <i class="fas fa-users fa-sm fa-fw mr-2 text-gray-400"></i>
                  {{__('msg.List of users')}}
                </a>
        <?php }
        if ($user['user_type']=='admin' || $user['user_type']=='adv' ){?>
               <a class="dropdown-item" href="{{route('beneficiairesvalides')}}">
                  <i class="fas fa-user-friends fa-sm fa-fw mr-2 text-gray-400"></i>
                  {{__('msg.List of beneficiaries')}}
                </a>				
				<?php } ?>

               <!-- <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a> -->
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  {{__('msg.Logout')}}
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->
<script>
  
  function setlanguage(lg)               
  {   var _token = $('input[name="_token"]').val();
 	 				
   $.ajax({
      url:"{{ route('setlanguage') }}",
      method:"POST",
      data:{user: <?php echo $user->id;?> ,lg:lg   , _token:_token},
      success:function(data){
		location.reload();
     }
    });
              
  } 
</script>