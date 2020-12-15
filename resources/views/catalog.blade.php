
@extends('layouts.back')
 
 @section('content')

<?php
 
use App\Http\Controllers\HomeController ;

//$referentiels1=  HomeController::referentiel1() ;
 $Fam1 =DB::table('type_famille')->where('fam1_id',$famille1)->where('type_id',$type)->first();
 $libelle=$Fam1->LIBFAM1;
 if($type==101){$Type=  __('msg.Half Products') ;}
 if($type==102){$Type=  __('msg.Galvano') ;}
 if($type==103){$Type=  __('msg.Findings') ;}
 if($type==104){$Type= __('msg.Jewelry') ;}
 
?>
  
					
    <div class="">
	
    <div class="row pt-4">

            <!-- Sidebar -->
            <div class="col-lg-3    ">
				

                <div class="">
                    <!-- Grid row -->
                    <div class="row card pl-30 pt-20">
                      <div class="col-md-6 col-lg-12 mb-5">
				        <h5 class="font-weight-bold  text-primary"> <?php echo $Type;?></strong></h3>
						<hr style="width:150px" class="ml-20">
						<h5 class="font-weight-bold dark-grey-text"><strong>Famille 1 </strong></h3>
						<label><?php echo $libelle .' <small>'.$famille1; ?></small></label>
						<hr style="width:150px" class="ml-20">


				 
                            <h5 class="font-weight-bold dark-grey-text"><strong>Famille 2</strong></h3>
                                <div class="divider"></div>

                                <!--Radio group-->
                                <div class="form-group ">
                                    <input class="form-check-input" name="group100" type="radio" id="radio100">
                                    <label for="radio100" class="form-check-label dark-grey-text">All</label>
                                </div>

                                <div class="form-group">
                                    <input class="form-check-input" name="group100" type="radio" id="radio101" checked>
                                    <label for="radio101" class="form-check-label dark-grey-text">Laptop</label>
                                </div>

                                <div class="form-group">
                                    <input class="form-check-input" name="group100" type="radio" id="radio102">
                                    <label for="radio102" class="form-check-label dark-grey-text">Smartphone</label>
                                </div>

                                <div class="form-group">
                                    <input class="form-check-input" name="group100" type="radio" id="radio103">
                                    <label for="radio103" class="form-check-label dark-grey-text">Tablet</label>
                                </div>

                                <div class="form-group">
                                    <input class="form-check-input" name="group100" type="radio" id="radio104">
                                    <label for="radio104" class="form-check-label dark-grey-text">Headphones</label>
                                </div>
                                <!--Radio group-->
                        </div>

                        <!-- Filter by category-->
                        <div class="col-md-6 col-lg-12 mb-5">
                            <h5 class="font-weight-bold dark-grey-text"><strong>Famille 3</strong></h3>
                                <div class="divider"></div>

                                <!--Radio group-->
                                <div class="form-group ">
                                    <input class="form-check-input" name="group100" type="radio" id="radio100">
                                    <label for="radio100" class="form-check-label dark-grey-text">All</label>
                                </div>

                                <div class="form-group">
                                    <input class="form-check-input" name="group100" type="radio" id="radio101" checked>
                                    <label for="radio101" class="form-check-label dark-grey-text">Laptop</label>
                                </div>

                                <div class="form-group">
                                    <input class="form-check-input" name="group100" type="radio" id="radio102">
                                    <label for="radio102" class="form-check-label dark-grey-text">Smartphone</label>
                                </div>

                                <div class="form-group">
                                    <input class="form-check-input" name="group100" type="radio" id="radio103">
                                    <label for="radio103" class="form-check-label dark-grey-text">Tablet</label>
                                </div>

                                <div class="form-group">
                                    <input class="form-check-input" name="group100" type="radio" id="radio104">
                                    <label for="radio104" class="form-check-label dark-grey-text">Headphones</label>
                                </div>
                                <!--Radio group-->
                        </div>
                        <!-- /Filter by category-->
						
						<div class="col-md-6 col-lg-12 mb-5">
                            <h5 class="font-weight-bold dark-grey-text"><strong>Métal</strong></h3>
                                <div class="divider"></div>

                                <!--Radio group-->
                                <div class="form-group ">
                                    <input class="form-check-input" name="group100" type="radio" id="radio100">
                                    <label for="radio100" class="form-check-label dark-grey-text">OR</label>
                                </div>

                                <div class="form-group">
                                    <input class="form-check-input" name="group100" type="radio" id="radiom1"  >
                                    <label for="radiom1" class="form-check-label dark-grey-text">ARGENT</label>
                                </div>

                                <div class="form-group">
                                    <input class="form-check-input" name="group100" type="radio" id="radiom2">
                                    <label for="radiom2" class="form-check-label dark-grey-text">PLATINE</label>
                                </div>

                                <div class="form-group">
                                    <input class="form-check-input" name="group100" type="radio" id="radiom3">
                                    <label for="radiom3" class="form-check-label dark-grey-text">PALLADIUM</label>
                                </div>

                                <div class="form-group">
                                    <input class="form-check-input" name="group100" type="radio" id="radiom4">
                                    <label for="radiom4" class="form-check-label dark-grey-text">RHODIUM</label>
                                </div>
								
                                <div class="form-group">
                                    <input class="form-check-input" name="group100" type="radio" id="radiom5">
                                    <label for="radiom5" class="form-check-label dark-grey-text">NON PRECIEUX</label>
                                </div>								
                                <!--Radio group-->
                        </div>
                    </div>
                    <!-- /Grid row -->

                    <!-- Grid row -->
                    <div class="row">

                        <!-- Filter by price  -- 
                        <div class="col-md-6 col-lg-12 mb-5">
                            <h5 class="font-weight-bold dark-grey-text"><strong>Price</strong></h3>
                                <div class="divider"></div>

                                <form class="range-field mt-3">
                                    <input id="calculatorSlider" class="no-border" type="range" value="0" min="0" max="30" />
                                </form>

                                <!-- Grid row -- 
                                <div class="row justify-content-center">

                                    <!-- Grid column -- 
                                    <div class="col-md-6 text-left">
                                        <p class="dark-grey-text"><strong id="resellerEarnings">0$</strong></p>
                                    </div>
 
                                     <div class="col-md-6 text-right">
                                        <p class="dark-grey-text"><strong id="clientPrice">319$</strong></p>
                                    </div>
                                    <!-- Grid column -- 
                                </div>
                                <!-- Grid row -- 

                        </div>-->
                        <!-- /Filter by price -->

         
                     </div>
                    <!-- /Grid row -->
                </div>

            </div>
            <!-- /.Sidebar -->

            <!-- Content -->
            <div class="col-lg-9">

                <!-- Filter Area -->
                <div class="row">

                    <div class="col-md-4 mt-3">
                    </div>
                    <div class="col-md-8 text-right">

                    </div>

                </div>
                <!-- /.Filter Area -->

                <!-- Products Grid -->
                <section class="section pt-4">

                    <!-- Grid row -->
                    <div class="row">

                        <!--Grid column-->
                        <div class="col-lg-4 col-md-12 mb-4">

                            <!--Card-->
                            <div class="card card-ecommerce">

                                <!--Card image-->
                                <div class="view overlay">
                                    <center><img style="max-height:200px" src="http://mysaamp.com/myapi/images/grenamo0.gif" class="img-fluid" alt=""></center>
                                    <a>
                                        <div class="mask rgba-white-slight"></div>
                                    </a>
                                </div>
                                <!--Card image-->

                                <!--Card content-->
                                <div class="card-body">
                                    <!--Category & Title-->

                                    <h5 class="card-title mb-1"><strong><a href="" class="dark-grey-text">iPad</a></strong></h5><span class="badge badge-danger mb-2">bestseller</span>
 

                                    <!--Card footer-->
                                    <div class="card-footer pb-0">
                                        <div class="row mb-0">
                                            <span class="float-left"><strong>1439$</strong></span>
                                            <span class="float-right">

                                        <a class="" data-toggle="tooltip" data-placement="top" title="Add to Cart"><i class="fas fa-shopping-cart ml-3"></i></a>
                                        </span>
                                        </div>
                                    </div>

                                </div>
                                <!--Card content-->

                            </div>
                            <!--Card-->

                        </div>
                        <!--Grid column-->

                        <!--Grid column-->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <!--Card-->
                            <div class="card card-ecommerce">

                                <!--Card image-->
                                <div class="view overlay">
                                 <center>  <img style="max-height:200px" src="http://mysaamp.com/myapi/images/GREFONP1.gif" class="img-fluid" alt=""></center>
                                    <a>
                                        <div class="mask rgba-white-slight"></div>
                                    </a>
                                </div>
                                <!--Card image-->

                                <!--Card content-->
                                <div class="card-body">
                                    <!--Category & Title-->

                                    <h5 class="card-title mb-1"><strong><a href="" class="dark-grey-text">Sony T56-v</a></strong></h5><span class="badge badge-info mb-2">new</span>
 

                                    <!--Card footer-->
                                    <div class="card-footer pb-0">
                                        <div class="row mb-0">
                                            <span class="float-left"><strong>1439$</strong></span>
                                            <span class="float-right">

                                                <a class="" data-toggle="tooltip" data-placement="top" title="Add to Cart"><i class="fas fa-shopping-cart ml-3"></i></a>
                                                </span>
                                        </div>
                                    </div>

                                </div>
                                <!--Card content-->

                            </div>
                            <!--Card-->

                        </div>
                        <!--Grid column-->

                        <!--Grid column-->
                        <div class="col-lg-4 col-md-6 mb-4">

                            <!--Card-->
                            <div class="card card-ecommerce">

                                <!--Card image-->
                                <div class="view overlay">
                                    <center><img style="max-height:200px" src="http://mysaamp.com/myapi/images/grenaa0.gif" class="img-fluid" alt=""></center>
                                    <a>
                                        <div class="mask rgba-white-slight"></div>
                                    </a>
                                </div>
                                <!--Card image-->

                                <!--Card content-->
                                <div class="card-body">
                                    <!--Category & Title-->

                                    <h5 class="card-title mb-1"><strong><a href="" class="dark-grey-text">Headphones</a></strong></h5><span class="badge badge-danger mb-2">bestseller</span>
 

                                    <!--Card footer-->
                                    <div class="card-footer pb-0">
                                        <div class="row mb-0">
                                            <span class="float-left"><strong>1439$</strong></span>
                                            <span class="float-right">

                                            <a class="" data-toggle="tooltip" data-placement="top" title="Add to Cart"><i class="fas fa-shopping-cart ml-3"></i></a>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <!--Card content-->

                            </div>
                            <!--Card-->

                        </div>
                        <!--Grid column-->

                    </div>
                    <!--Grid row-->

                    <!-- Grid row -->
                    <div class="row">

                        <!--Grid column-->
                        <div class="col-lg-4 col-md-12 mb-4">

                            <!--Card-->
                            <div class="card card-ecommerce">

                                <!--Card image-->
                                <div class="view overlay">
                                   <center> <img style="max-height:200px" src="http://mysaamp.com/myapi/images/GRENAGD13.gif" class="img-fluid" alt=""></center>
                                    <a>
                                        <div class="mask rgba-white-slight"></div>
                                    </a>
                                </div>
                                <!--Card image-->

                                <!--Card content-->
                                <div class="card-body">
                                    <!--Category & Title-->

                                    <h5 class="card-title mb-1"><strong><a href="" class="dark-grey-text">Samsung CT-567</a></strong></h5><span class="badge grey mb-2">best rated</span>
 

                                    <!--Card footer-->
                                    <div class="card-footer pb-0">
                                        <div class="row mb-0">
                                            <span class="float-left"><strong>1439$</strong></span>
                                            <span class="float-right">
                                            <a class="" data-toggle="tooltip" data-placement="top" title="Add to Cart"><i class="fas fa-shopping-cart ml-3"></i></a>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <!--Card content-->

                            </div>
                            <!--Card-->

                        </div>
                        <!--Grid column-->

                        <!--Grid column-->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <!--Card-->
                            <div class="card card-ecommerce">

                                <!--Card image-->
                                <div class="view overlay">
                                   <center> <img style="max-height:200px" src="http://mysaamp.com/myapi/images/BFDO10CDJ.gif" class="img-fluid" alt=""></center>
                                    <a>
                                        <div class="mask rgba-white-slight"></div>
                                    </a>
                                </div>
                                <!--Card image-->

                                <!--Card content-->
                                <div class="card-body">
                                    <!--Category & Title-->

                                    <h5 class="card-title mb-1"><strong><a href="" class="dark-grey-text">Sony TV-675</a></strong></h5><span class="badge badge-danger mb-2">bestseller</span>
 

                                    <!--Card footer-->
                                    <div class="card-footer pb-0">
                                        <div class="row mb-0">
                                            <span class="float-left"><strong>1439$</strong></span>
                                            <span class="float-right">
                                            <a class="" data-toggle="tooltip" data-placement="top" title="Add to Cart"><i class="fas fa-shopping-cart ml-3"></i></a>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <!--Card content-->

                            </div>
                            <!--Card-->

                        </div>
                        <!--Grid column-->

                        <!--Grid column-->
                        <div class="col-lg-4 col-md-6 mb-4">

                            <!--Card-->
                            <div class="card card-ecommerce">

                                <!--Card image-->
                                <div class="view overlay">
                                    <center><img style="max-height:200px" src="http://mysaamp.com/myapi/images/FIMV05J3.gif" class="img-fluid" alt=""></center>
                                    <a>
                                        <div class="mask rgba-white-slight"></div>
                                    </a>
                                </div>
                                <!--Card image-->

                                <!--Card content-->
                                <div class="card-body">
                                    <!--Category & Title-->

                                    <h5 class="card-title mb-1"><strong><a href="" class="dark-grey-text">Dell V-964i</a></strong></h5><span class="badge badge-info mb-2">new</span>
 

                                    <!--Card footer-->
                                    <div class="card-footer pb-0">
                                        <div class="row mb-0">
                                            <span class="float-left"><strong>1439$</strong></span>
                                            <span class="float-right">

                                            <a class="" data-toggle="tooltip" data-placement="top" title="Add to Cart"><i class="fas fa-shopping-cart ml-3"></i></a>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <!--Card content-->

                            </div>
                            <!--Card-->

                        </div>
                        <!--Grid column-->

                    </div>
                    <!--Grid row-->

                    <!-- Grid row -->
                    <div class="row mb-3">

                        <!--Grid column-->
                        <div class="col-lg-4 col-md-12 mb-4">

                            <!--Card-->
                            <div class="card card-ecommerce">

                                <!--Card image-->
                                <div class="view overlay">
                                    <center><img style="max-height:200px" src="http://mysaamp.com/myapi/images/FIC.gif" class="img-fluid" alt=""></center>
                                    <a>
                                        <div class="mask rgba-white-slight"></div>
                                    </a>
                                </div>
                                <!--Card image-->

                                <!--Card content-->
                                <div class="card-body">
                                    <!--Category & Title-->

                                    <h5 class="card-title mb-1"><strong><a href="" class="dark-grey-text">Samsung V54</a></strong></h5><span class="badge grey mb-2">best rated</span>
 

                                    <!--Card footer-->
                                    <div class="card-footer pb-0">
                                        <div class="row mb-0">
                                            <span class="float-left"><strong>1439$</strong></span>
                                            <span class="float-right">
                                            <a class="" data-toggle="tooltip" data-placement="top" title="Add to Cart"><i class="fas fa-shopping-cart ml-3"></i></a>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <!--Card content-->

                            </div>
                            <!--Card-->

                        </div>
                        <!--Grid column-->

                        <!--Grid column-->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <!--Card-->
                            <div class="card card-ecommerce">

                                <!--Card image-->
                                <div class="view overlay">
                                    <center><img style="max-height:200px" src="http://mysaamp.com/myapi/images/GAJ3.gif" class="img-fluid" alt=""></center>
                                    <a>
                                        <div class="mask rgba-white-slight"></div>
                                    </a>
                                </div>
                                <!--Card image-->

                                <!--Card content-->
                                <div class="card-body">
                                    <!--Category & Title-->

                                    <h5 class="card-title mb-1"><strong><a href="" class="dark-grey-text">Dell 786i</a></strong></h5><span class="badge badge-info mb-2">new</span>
 

                                    <!--Card footer-->
                                    <div class="card-footer pb-0">
                                        <div class="row mb-0">
                                            <span class="float-left"><strong>1439$</strong></span>
                                            <span class="float-right">
                                            <a class="" data-toggle="tooltip" data-placement="top" title="Add to Cart"><i class="fas fa-shopping-cart ml-3"></i></a>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <!--Card content-->

                            </div>
                            <!--Card-->

                        </div>
                        <!--Grid column-->

                        <!--Grid column-->
                        <div class="col-lg-4 col-md-6 mb-4">

                            <!--Card-->
                            <div class="card card-ecommerce">

                                <!--Card image-->
                                <div class="view overlay">
                                    <center><img style="max-height:200px" src="http://mysaamp.com/myapi/images/GUACPM.gif" class="img-fluid" alt=""></center>
                                    <a>
                                        <div class="mask rgba-white-slight"></div>
                                    </a>
                                </div>
                                <!--Card image-->

                                <!--Card content-->
                                <div class="card-body">
                                    <!--Category & Title-->

                                    <h5 class="card-title mb-1"><strong><a href="" class="dark-grey-text">Canon 675-D</a></strong></h5><span class="badge badge-info mb-2">new</span>
 

                                    <!--Card footer-->
                                    <div class="card-footer pb-0">
                                        <div class="row mb-0">
                                            <span class="float-left"><strong>1439$</strong></span>
                                            <span class="float-right">
                                            <a class="" data-toggle="tooltip" data-placement="top" title="Add to Cart"><i class="fas fa-shopping-cart ml-3"></i></a>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <!--Card content-->

                            </div>
                            <!--Card-->

                        </div>
                        <!--Grid column-->

                    </div>
                    <!--Grid row-->

                    <!--Grid row-->
                    <div class="row justify-content-center mb-4">

                     
                    </div>
                    <!--Grid row-->
                </section>
                <!-- /.Products Grid -->

            </div>
            <!-- /.Content -->

        </div>

    </div>
    <!-- /.Main Container -->
					
					
					
					
@endsection
