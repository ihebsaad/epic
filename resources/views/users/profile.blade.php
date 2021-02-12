@extends('layouts.back')
 
 @section('content')
  <?php

$cl_ident=$user->client_id;
$client=DB::table('client')->where('cl_ident',$cl_ident)->first();
  $metals=DB::table('METAL')->get();
  $type_clients=DB::table('type_client')->get();

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

                                    <form class="user"    >
                                        <input type="hidden" value="{{$id}}" id="iduser">
                                        {{ csrf_field() }}
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
											<label><?php echo __('msg.Name');?></label>
                                                <input type="text" class="form-control form-control-user" id="name" name="name"  value="{{ $user->name }}"  onchange="changing(this)"
                                                       placeholder="<?php echo __('msg.Name');?>*">

                                            </div>
                                            <div class="col-sm-6">
											<label><?php echo __('msg.Last name');?></label>											
                                                <input type="text" class="form-control form-control-user" id="lastname" name="lastname"  value="{{ $user->lastname }}"  onchange="changing(this)"
                                                       placeholder="<?php echo __('msg.Last name');?>*">
                                            </div>

                                        </div>
                                        <style>
                                            #activity:placeholder-shown{
                                                color: darkgrey;
                                            }								}
                                        </style>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
											<label><?php echo __('msg.Activity');?></label>											
                                                <select class="form-control  " id="activity" name="activity"  placeholder="Sélectionnez votre activité*"    onchange="changing(this)"
                                                        style="font-size: 0.8rem;border-radius: 10rem;padding-left:15px;padding-top:10px;height:50px;font-family:Nunito">
                                                     <option value="artisan" <?php if($user->activity=='artisan'){echo 'selected="selected"';}  ?> ><?php echo __('msg.Artisan');?></option>
                                                    <option value="fabricant" <?php if($user->activity=='fabricant'){echo 'selected="selected"';}  ?> ><?php echo __('msg.Manufacturer');?></option>
                                                    <option value="industriel" <?php if($user->activity=='industriel'){echo 'selected="selected"';}  ?> ><?php echo __('msg.Industrial');?></option>
                                                    <option value="laboratoire" <?php if($user->activity=='laboratoire'){echo 'selected="selected"';}  ?> ><?php echo __('msg.laboratory');?></option>
                                                    <option value="recuperateur" <?php if($user->activity=='recuperateur'){echo 'selected="selected"';}  ?> ><?php echo __('msg.Gold Scraps Buyer');?></option>
                                                    <option value="investisseur" <?php if($user->activity=='investisseur'){echo 'selected="selected"';}  ?> ><?php echo __('msg.Investor');?></option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6 mb-3 mb-sm-0">
											<label><?php echo __('msg.Username');?></label>											
                                                <input type="text" class="form-control form-control-user" id="username" name="username" readonly value="{{ $user->username }}"
                                                       placeholder="<?php echo __('msg.Username');?>*">
											
                                             </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
											<label><?php echo __('msg.Cell phone');?></label>											
                                                <input type="text" class="form-control form-control-user" id="mobile" name="mobile" pattern=".{10,10}" value="{{ $user->mobile }}"  onchange="changing(this)"
                                                       placeholder="<?php echo __('msg.Cell phone');?>*">
                                            </div>
                                            <div class="col-sm-6 mb-3 mb-sm-0">
											<label><?php echo __('msg.Phone');?></label>											
                                                <input type="text" class="form-control form-control-user" id="phone" name="phone"  pattern=".{0,10}" value="{{ $user->phone }}"  onchange="changing(this)"
                                                       placeholder="<?php echo __('msg.Phone');?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
											  <label><?php echo __('msg.Email address');?></label>											
                                                <input type="email" class="form-control form-control-user" id="email" name="email"  readonly value="{{ $user->email }}"
                                                       placeholder="<?php echo __('msg.Email address');?>*">
                                         
										</div>
                                       <div class="col-sm-6 mb-3 mb-sm-0">
											<label><?php echo __('msg.Password');?></label>											
                                                <input type="password" class="form-control form-control-user" name="password"   pattern=".{6,30}"    onchange="changing(this)" style="width:100%"
                                                       id="password" placeholder="<?php echo __('msg.Password');?>*">
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

                        <div class="col-lg-6 mb-4">

                             <div class="card shadow mb-4">
                                <div class="  ">
                                    <a href="#div2" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">								
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('msg.Company')}}</h6>
									</a>
                                </div>
                                <div id="div2" class="card-body">

                                    <form class="user"    >
								
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
											<label><?php echo __('msg.Social reason');?></label>
                                                <input type="text" class="form-control form-control-user" id="raison_sociale" name="raison_sociale"  value="{{ $client->raison_sociale }}"  onchange="updating(this)"
                                                       placeholder="<?php echo __('msg.Social reason');?>">

                                            </div>
                                            <div class="col-sm-6">
											<label><?php echo __('msg.Company type');?></label>
											
                                                <input type="text" class="form-control form-control-user" id="type_societe" name="type_societe"  value="{{ $client->type_societe }}"  onchange="updating(this)"
                                                       placeholder="<?php echo __('msg.Company type');?>">
                                            </div>

                                        </div>								
								
                                        <div class="form-group row">
										
                                            <div class="col-sm-6 mb-3 mb-sm-0">
											<label>SIRET</label>											
                                                <input type="text" class="form-control form-control-user" id="siret" name="siret"  value="{{ $client->siret }}"  onchange="updating(this)"
                                                       placeholder="SIRET">

                                            </div>
                                            <div class="col-sm-6">
											<label><?php echo __('msg.VAT number');?></label>
											
                                                <input type="text" class="form-control form-control-user" id="num_tva" name="num_tva"  value="{{ $client->num_tva }}"  onchange="updating(this)"
                                                       placeholder="<?php echo __('msg.VAT number');?>">
                                            </div>

                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
											<label><?php echo __('msg.Company sign');?></label>											
                                                <input type="text" class="form-control form-control-user" id="enseigne" name="enseigne"  value="{{ $client->enseigne }}"  onchange="updating(this)"
                                                       placeholder="<?php echo __('msg.Company sign');?>">

                                            </div>
                                            <div class="col-sm-6">
											<label><?php echo __('msg.Activity');?></label>											
  													   
												<select class="form-control" id="type_client_ident" name="type_client_ident"  >	
												<option></option>
												<?php foreach ($type_clients as $typec)
												{
										if($client->type_client_ident==$typec->type_client_ident){$selected="selected='selected'";}else{$selected="";}
											echo '<option '.$selected.' value="'.$typec->type_client_ident.'"  >'.$typec->type_client_lib.'</option>';	
													
												}
												?>
												</select>	   
                                            </div>

                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
											<label><?php echo __('msg.Address');?> 1</label>											
                                                <input type="text" class="form-control form-control-user" id="adresse1" name="adresse1"  value="{{ $client->adresse1 }}"  onchange="updating(this)"
                                                       placeholder="<?php echo __('msg.Address');?> 1">

                                            </div>
                                            <div class="col-sm-6">
											<label><?php echo __('msg.Address');?> 2</label>											
                                                <input type="text" class="form-control form-control-user" id="adresse2" name="adresse2"  value="{{ $client->adresse2 }}"  onchange="updating(this)"
                                                       placeholder="<?php echo __('msg.Address');?> 2">
                                            </div>

                                        </div>

                                        <div class="form-group row">
										
                                            <div class="col-sm-3 mb-3 mb-sm-0">
											<label>ZIP</label>											
                                                <input type="text" class="form-control form-control-user" id="zip" name="zip"  value="{{ $client->zip }}"  onchange="updating(this)"
                                                       placeholder="ZIP">

                                            </div>
                                            <div class="col-sm-6">
											<label><?php echo __('msg.City');?></label>											
                                                <input type="text" class="form-control form-control-user" id="ville" name="ville"  value="{{ $client->ville }}"  onchange="updating(this)"
                                                       placeholder="<?php echo __('msg.City');?>">
                                            </div>
                                            <div class="col-sm-3">
											<label><?php echo __('msg.Country code');?></label>																						
											
                                                <input type="text" class="form-control form-control-user" id="pays_code" name="pays_code"  value="{{ $client->pays_code }}"  onchange="updating(this)"
                                                       placeholder="<?php echo __('msg.Country code');?>">
                                            </div>
                                        </div>										

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
											<label><?php echo __('msg.Agency');?></label>											
                                                <input type="text" class="form-control form-control-user" id="name" name="name"  value="{{ $client->agence_ident }}"  onchange="updating(this)"
                                                       placeholder="<?php echo __('msg.Agency');?>">

                                            </div>
                                            <div class="col-sm-6">
											<label><?php echo __('msg.Default metal');?></label>											
                                                  
									<select class="form-control "   name="metal_defaut_id" id="metal_defaut_id"    >
									<option value="" ></option> 
									<?php foreach($metals as $metal)
									{ if($metal->metal_ident<9){
										if($client->metal_defaut_id==$metal->metal_ident){$selected="selected='selected'";}else{$selected="";}
									echo '<option   '.$selected.' value="'.$metal->metal_ident.'" >'.$metal->metal_lib.'</option>';    
										}
										}
				
										?>

										</select>													   
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



        function changing(elm) {
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

    </script>
@endsection
