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
          <!-- Topbar Search  
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>
--->
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS)  
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages - 
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>-->


		 

    <!-- Nav Item - Messages  
           <li class="nav-item   no-arrow mx-1">
              <a class="nav-link  " href=" " >
                <i class="fas fa-sms fa-fw"></i>
                <!-- Counter - Messages 
				 
                <span class="badge badge-danger badge-counter"> </span>
              </a>
			</li>
 -->
            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas  fa-user-cog  fa-fw"></i>  <small style="color:darkgrey">{{__('msg.My Operations')}}</small>
                <!-- Counter - Alerts --> 
                <span class="badge badge-danger badge-counter"></span>
              </a>
              <!-- Dropdown - Alerts --> 
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  {{__('msg.My Operations')}}
                </h6>
 
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                   <!-- <div class="small text-gray-500">December 12, 2019</div>-->
                    <span class="font-weight-bold">{{__('msg.My Orders')}}</span>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-success">
                      <i class="fas fa-donate text-white"></i>
                    </div>
                  </div>
                  <div>
                  <!--  <div class="small text-gray-500">December 7, 2019</div>-->
                    <span class="font-weight-bold">{{__('msg.My Euros Account')}}</span>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class=" fas fa-bullseye  text-white"></i>
                    </div>
                  </div>
                  <div>
                   <!-- <div class="small text-gray-500">December 2, 2019</div>-->
                  <span class="font-weight-bold">{{__('msg.My Models')}}</span>
                  </div>
                </a>
				<a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-danger">
                      <i class="fas fa-balance-scale-left text-white"></i>
                    </div>
                  </div>
                  <div>
                   <!-- <div class="small text-gray-500">December 2, 2019</div>-->                   
                  <span class="font-weight-bold">{{__('msg.My Weight Account')}}</span>
					
                  </div>
                </a>
              <!--  <a class="dropdown-item text-center small text-gray-500" href="#">Show All </a>-->
              </div>
            </li>
<?php 
$myorder = DB::table('orders')->where('status','cart')->where('user',$user->id)->first();
if ($myorder!=null){
 $Orderid=$myorder->id;
$prods= DB::table('products')->where('orderid',$Orderid)->count();
}else{
	$prods=0;
}
?>
            <!-- Nav Item - Messages --> 
 			<li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="{{route('panier')}}"  >
                <i class="fas fa-shopping-cart fa-fw"></i>
                <!-- Counter - Messages --> 
                <span class="badge badge-danger badge-counter"><?php if($prods>0){echo $prods;}?></span>
              </a>
              <!-- Dropdown - Messages  
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Message Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div class="font-weight-bold">
                    <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                    <div class="status-indicator"></div>
                  </div>
                  <div>
                    <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                    <div class="small text-gray-500">Jae Chun · 1d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
                    <div class="status-indicator bg-warning"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                    <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                    <div class="small text-gray-500">Chicken the Dog · 2w</div>
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
              </div>---->
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
             <!--   <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
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