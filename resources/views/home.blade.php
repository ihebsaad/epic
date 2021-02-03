
@extends('layouts.back')
 
 @section('content')

<?php
/*
$user_type='';
if (Auth::check()) {

$user = auth()->user();
 $iduser=$user->id;
$user_type=$user->user_type;
} 
 
*/ 
  
   ?>
<b>{{__('msg.welcome to your saamp page')}}</b><br>

<br>

	<div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
 
								 
								<div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('msg.My Orders')}}</h6>
                                </div>
  

								
                                <div class="  ">
                                    <a href="#div0" class="d-block card-header " data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
										<h6 class="m-0 font-weight-bold text-dark">{{__('msg.In Progress')}}</h6>
									</a>
                                </div>
                                <div id="div0" class="card-body">
                                     
                                </div>
								
								
                                <div class="  ">
                                    <a href="#div1" class="d-block card-header " data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
										<h6 class="m-0 font-weight-bold text-dark">{{__('msg.Finished')}}</h6>
									</a>
                                </div>
                                <div id="div1" class="card-body">
                                     
                                </div>								
                            </div>

                       

                        </div>

                        <div class="col-lg-6 mb-4">

                             <div class="card shadow mb-4">
                                <div class="  ">
                                    <a href="#div2" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">								
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('msg.My templates')}}</h6>
									</a>
                                </div>
                                <div id="div2" class="card-body">
 
 
                                </div>
                            </div>

                             <div class="card shadow mb-4">
                                <div class=" ">
                                    <a href="#div3" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
										<h6 class="m-0 font-weight-bold text-primary">{{__('msg.My Euros Account')}}</h6>
									</a>
                                </div>
                                <div id="div3" class="card-body">

								
                                </div>
                            </div>

                        </div>
						
                       <div class="col-lg-6 mb-4">

        

                             <div class="card shadow mb-4">
                                <div class=" ">
                                    <a href="#div4" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
										<h6 class="m-0 font-weight-bold text-primary">{{__('msg.My Metal Account')}}</h6>
									</a>
                                </div>
								<style>
								.metal{height:50px;padding-top:15px;margin-bottom:10px;color:white;}
								</style>
                                <div id="div4" class="card-body">
									<div style="width:150px;" class="metal text-center bg-gradient-warning"> OR </div>
									<div style="width:125px; " class="metal text-center bg-gradient-light"> ARGENT </div>
									<div style="width:80px;" class="metal text-center bg-gradient-secondary"> PLATINE </div>
									<div style="width:100px;" class="metal text-center bg-gray-500"> PALLADIUM </div>
								
                                </div>
                            </div>

                        </div>						
   </div>

@endsection
