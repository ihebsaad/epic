@extends('layouts.back')
 
 @section('content')
  <?php
use App\Http\Controllers\HomeController ;

$cl_ident=$user->client_id;
$client=DB::table('client')->where('cl_ident',$cl_ident)->first();
  $metals=DB::select('CALL `sp_referentiel_metal_defaut`();') ;
  //dd($metals);
  $agences=DB::table('agence')->get();
  $type_clients=DB::table('type_client')->get();
  $adresses=HomeController::adresse($cl_ident);
   /*
cl_ident
siret
num_tva
ape
type_client_ident
 raison_sociale  
type_societe
enseigne
adresse1
adresse2
zip
ville
pays_code
defaut_contact_ident
agence_ident
metal_defaut_id

*/
  ?>
	<div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

						 <div class="card shadow mb-4">
                                <div class="  ">
                                    <a href="#div1" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">								
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('msg.My Profile')}}</h6>
									</a>
                                </div>
                                <div id="div1" class="card-body">

                                    <form class="user"   method="post" action="{{ route('updateuser') }}"    >
                                        <input type="hidden" value="{{$id}}" id="iduser" name="user">
                                        {{ csrf_field() }}
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
											<label><?php echo __('msg.Name');?></label>
                                                <input type="text" class="form-control form-control-user" id="name" name="name"  value="{{ $user->name }}"   
                                                       placeholder="<?php echo __('msg.Name');?>">

                                            </div>
                                            <div class="col-sm-6">
											<label><?php echo __('msg.Last name');?></label>											
                                                <input type="text" class="form-control form-control-user" id="lastname" name="lastname"  value="{{ $user->lastname }}"   
                                                       placeholder="<?php echo __('msg.Last name');?>">
                                            </div>

                                        </div>
                                        <style>
                                            #activity:placeholder-shown{
                                                color: darkgrey;
                                            }								 
                                        </style>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
											<label><?php echo __('msg.Activity');?></label>											
                                                <select class="form-control  " id="activity" name="activity"  placeholder="Sélectionnez votre activité"   
                                                        style="font-size: 0.8rem;border-radius: 10rem;padding-left:15px;padding-top:10px;height:50px;font-family:Nunito">
                                                     <option value="artisan" <?php if($user->activity=='artisan'){echo 'selected="selected"';}  ?> ><?php echo __('msg.Artisan');?></option>
                                                    <option value="fabricant" <?php if($user->activity=='fabricant'){echo 'selected="selected"';}  ?> ><?php echo __('msg.Manufacturer');?></option>
                                                    <option value="industriel" <?php if($user->activity=='industriel'){echo 'selected="selected"';}  ?> ><?php echo __('msg.Industrial');?></option>
                                                    <option value="laboratoire" <?php if($user->activity=='laboratoire'){echo 'selected="selected"';}  ?> ><?php echo __('msg.Laboratory');?></option>
                                                    <option value="recuperateur" <?php if($user->activity=='recuperateur'){echo 'selected="selected"';}  ?> ><?php echo __('msg.Gold Scraps Buyer');?></option>
                                                    <option value="investisseur" <?php if($user->activity=='investisseur'){echo 'selected="selected"';}  ?> ><?php echo __('msg.Investor');?></option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6 mb-3 mb-sm-0">
											<!--<label><?php echo __('msg.Username');?></label>											
                                                <input type="text" class="form-control form-control-user" id="username"   readonly value="{{ $user->username }}"
                                                       placeholder="<?php echo __('msg.Username');?>*">
											-->
												<label><?php echo __('msg.Email address');?></label>											
                                                <input type="email" class="form-control form-control-user" id="email" name="email"  readonly value="{{ $user->email }}"
                                                       placeholder="<?php echo __('msg.Email address');?>">
                                         											
                                             </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
											<label><?php echo __('msg.Cell phone');?></label>											
                                                <input type="text" class="form-control form-control-user" id="mobile" name="mobile" pattern=".{10,10}" value="{{ $user->mobile }}"   
                                                       placeholder="<?php echo __('msg.Cell phone');?>">
                                            </div>
                                            <div class="col-sm-6 mb-3 mb-sm-0">
											<label><?php echo __('msg.Phone');?></label>											
                                                <input type="text" class="form-control form-control-user" id="phone" name="phone"  pattern=".{0,10}" value="{{ $user->phone }}"   
                                                       placeholder="<?php echo __('msg.Phone');?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                         
                                       <div class="col-sm-6 mb-3 mb-sm-0">
											<label><?php echo __('msg.Password');?></label>											
                                                <input type="password" class="form-control form-control-user" name="password"   pattern=".{6,30}"    style="width:100%"  autocomplete="off"
                                                       id="password" placeholder="<?php echo __('msg.Password');?>">
 										 </div>
										<div class="col-sm-6 mb-3 mb-sm-0">
										<label><?php echo __('msg.Confirmation');?></label>											
                                                <input type="password" class="form-control form-control-user" name="confirmation"   pattern=".{6,30}"    style="width:100%"  autocomplete="off"
                                                       id="confirmation" placeholder="<?php echo __('msg.Confirmation');?>">
										 
                                        </div>
                                        </div>
							<h5  class="mt-20" style="cursor:pointer;color:black" onclick="showing()"><i class="fas fa-chevron-down"></i> Mes adresses de livraison</h5>	
							<div id="lesadresses"  style="display:none">
							<?php  
							if (is_array($adresses) || is_object($adresses)){  
							foreach($adresses as $adresse)
							 { ?>
							 
							 <div class="pl-10 pr-10 pt-10 pt-10 mb-10 adresses"   id="adresse-<?php echo $adresse->id;?>" >
 							 <b style="color:black">{{__('msg.Sales office')}} :</b>  <span  ><?php echo $adresse->nom; ?></span><br>
							 <b style="color:black">{{__('msg.Address')}} :</b> <span  ><?php echo $adresse->adresse1; ?> <?php echo $adresse->adresse2; ?></span><br>
							  <span  ><?php echo $adresse->zip; ?></span> <span id="ville"><?php echo $adresse->ville; ?></span><br>
							 <b style="color:black">{{__('msg.Country')}} :</b> <span  >
							 <?php 
							 if($adresse->pays_code=='FR'){echo 'France';}   
							 if($adresse->pays_code=='PL'){echo 'Pologne';}   
							 if($adresse->pays_code=='GF'){echo 'Guyane française';}   
							 
							 ?>
							 </span>
							 </div>
							 
							 <hr>
							 <?php }?>
							 <?php } ?>
							 <p><i style="color:#0054f3" class="fas fa-exclamation-circle"></i> Contactez notre support pour modifier ou ajouter une nouvelle adresse</p>
							 
							 </div>
							 
							 

                                        <div class="form-group row">

								<button value="update"  name="update"   type="submit"  class="pull-right btn btn-success btn-icon-split  ml-20   mt-50 mb-30">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-save"></i>
                                        </span>
                                        <span class="text" style="width:120px" >{{__('msg.Update')}}</span>
                                    </button>
                                        </div>

                                    </form>


                                </div>
                            </div>
 

                       

                        </div>

                        <div class="col-lg-6 mb-4">

                             <div class="card shadow mb-4">
                                <div class="  ">
                                    <a href="#div2" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">								
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('msg.Company')}}</h6>
									</a>
                                </div>
                                <div id="div2" class="card-body">

                                    <form class="user"  method="post" action="{{ route('updatecomp') }}"    >
							        {{ csrf_field() }}

                                        <input type="hidden" value="{{$cl_ident}}" id="cl_ident" name="cl_ident">

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
											<label><?php echo __('msg.Agency');?></label>											
 													   
												<select  class="form-control"  id="agence_ident" name="agence_ident"  >
												<option></option>												
												<?php 
												if (is_array($agences) || is_object($agences))
												{  

												foreach($agences as $agence)
												{
												if (isset($agence))
												{
													if($agence->agence_ident==$client->agence_ident){$selected="selected='selected'";}else{$selected="";}	
													echo '<option '.$selected.' value="'.$agence['agence_ident'].'">'.$agence['agence_lib'].' ('.$agence['adresse1'].')</option>';
												}
												}
												
												
												}
												?>
												</select>

                                            </div>
                                            <div class="col-sm-6">
											<label><?php echo __('msg.Default metal');?></label>											
                                                  
									<select class="form-control "   name="metal_defaut_id" id="metal_defaut_id"    >
									<option value="" ></option> 
									<?php
									if (is_array($metals) || is_object($metals))
									{
									foreach($metals as $metal)
									{  
										if($client->metal_defaut_id==$metal->id){$selected="selected='selected'";}else{$selected="";}
									echo '<option   '.$selected.' value="'.$metal->id.'" >'.$metal->libelle.'</option>';    
										 
										}
									}
				
										?>

										</select>													   
                                            </div>

                                        </div>	
										
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
											<label><?php echo __('msg.Social reason');?></label>
                                                <input type="text" class="form-control form-control-user" id="raison_sociale" name="raison_sociale"  value="{{ $client->raison_sociale }}"  readonly  
                                                       placeholder="<?php echo __('msg.Social reason');?>">

                                            </div>
                                            <div class="col-sm-6">
											<label><?php echo __('msg.Company type');?></label>
											
                                                <input type="text" class="form-control form-control-user" id="type_societe" name="type_societe"  value="{{ $client->type_societe }}"   readonly
                                                       placeholder="<?php echo __('msg.Company type');?>">
                                            </div>

                                        </div>								
								
                                        <div class="form-group row">
										
                                            <div class="col-sm-4 mb-3 mb-sm-0">
											<label>SIRET</label>											
                                                <input type="text" class="form-control form-control-user" id="siret" name="siret"  value="{{ $client->siret }}"   readonly
                                                       placeholder="SIRET">

                                            </div>
                                            <div class="col-sm-4">
											<label><?php echo __('msg.VAT number');?></label>
											
                                                <input type="text" class="form-control form-control-user" id="num_tva" name="num_tva"  value="{{ $client->num_tva }}"  readonly 
                                                       placeholder="<?php echo __('msg.VAT number');?>">
                                            </div>
											
                                            <div class="col-sm-4">
											 <label><?php echo __('msg.Company sign');?></label>											
                                             <input type="text" class="form-control form-control-user" id="enseigne" name="enseigne"  value="{{ $client->enseigne }}" readonly  
                                                       placeholder="<?php echo __('msg.Company sign');?>">
                                            </div>

                                        </div>

                                      <!--  <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">

                                            </div>
                                            <div class="col-sm-6">
											<label><?php /* echo __('msg.Activity');?></label>											
  													   
												<select class="form-control" id="type_client_ident" name="type_client_ident"  >	
												<option></option>
												<?php foreach ($type_clients as $typec)
												{
										if($client->type_client_ident==$typec->type_client_ident){$selected="selected='selected'";}else{$selected="";}
											echo '<option '.$selected.' value="'.$typec->type_client_ident.'"  >'.$typec->type_client_lib.'</option>';	
													
												}
											*/	?>
												</select>	  
                                            </div>

                                        </div>-->

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
											<label><?php echo __('msg.Address');?> 1</label>											
                                                <input type="text" class="form-control form-control-user" id="adresse1" name="adresse1"  value="{{ $client->adresse1 }}"   readonly
                                                       placeholder="<?php echo __('msg.Address');?> 1">

                                            </div>
                                            <div class="col-sm-6">
											<label><?php echo __('msg.Address');?> 2</label>											
                                                <input type="text" class="form-control form-control-user" id="adresse2" name="adresse2"  value="{{ $client->adresse2 }}"   readonly
                                                       placeholder="<?php echo __('msg.Address');?> 2">
                                            </div>

                                        </div>

                                        <div class="form-group row">
										
                                            <div class="col-sm-3 mb-3 mb-sm-0">
											<label>ZIP</label>											
                                                <input type="text" class="form-control form-control-user" id="zip" name="zip"  value="{{ $client->zip }}"   readonly
                                                       placeholder="ZIP">

                                            </div>
                                            <div class="col-sm-6">
											<label><?php echo __('msg.City');?></label>											
                                                <input type="text" class="form-control form-control-user" id="ville" name="ville"  value="{{ $client->ville }}"   readonly
                                                       placeholder="<?php echo __('msg.City');?>">
                                            </div>
                                            <div class="col-sm-3">
											<label><?php echo __('msg.Country code');?></label>																						
											
                                                <input type="text" class="form-control form-control-user" id="pays_code" name="pays_code"  value="{{ $client->pays_code }}"  readonly 
                                                       placeholder="<?php echo __('msg.Country code');?>">
                                            </div>
                                        </div>										

									
								
					            <div class="form-group row">

								<button value="update"  name="update"   type="submit"  class="pull-right btn btn-success btn-icon-split  ml-20   mt-50 mb-30">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-save"></i>
                                        </span>
                                        <span class="text" style="width:120px" >{{__('msg.Update')}}</span>
                                    </button>
                                        </div>			
					</form>
                               

							   </div>
                            </div>

           

                        </div>
						
 
 				
   </div>


    <script>

 function showing(elm) {
  var div  = document.getElementById('lesadresses');
 
  if ( div.style.display == 'none'){
	  $('#lesadresses').fadeIn('slow');
 }else{ 
 	  $('#lesadresses').fadeOut('slow');

 }

 }
 
 
    /*    function changing(elm) {
            var champ = elm.id;

            var val = document.getElementById(champ).value;

            var user = $('#iduser').val();
            //if ( (val != '')) {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('users.updating') }}",
                method: "POST",
                data: {user: user, champ: champ, val: val, _token: _token},
                success: function (data) {
                    $('#' + champ).animate({
                        opacity: '0.1',
                    });
                    $('#' + champ).animate({
                        opacity: '1',
                    });

                    $.notify({
                        message: 'Modifié avec succès',
                        icon: 'glyphicon glyphicon-check'
                    },{
                        type: 'success',
                        delay: 3000,
                        timer: 1000,
                        placement: {
                            from: "bottom",
                            align: "right"
                        },
                    });

                }
            });

        }
		*/

    </script>
@endsection
