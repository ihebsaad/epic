@extends('layouts.back')
 
 @section('content')
 
 
	<div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-7 mb-4">

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
                                                <input type="text" class="form-control form-control-user" id="name" name="name"  value="{{ $user->name }}"  onchange="changing(this)"
                                                       placeholder="<?php echo __('msg.Name');?>*">

                                            </div>
                                            <div class="col-sm-6">
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
                                                <select class="form-control  " id="activity" name="activity"  placeholder="Sélectionnez votre activité*"    onchange="changing(this)"
                                                        style="font-size: 0.8rem;border-radius: 10rem;padding-left:15px;padding-top:10px;height:50px;font-family:Nunito">
                                                     <option value="artisan" <?php if($user->activity=='artisan'){echo 'selected="selected"';}  ?> ><?php echo __('msg.Artisan');?></option>
                                                    <option value="fabricant" <?php if($user->activity=='fabricant'){echo 'selected="selected"';}  ?> ><?php echo __('msg.Manufacturer');?></option>
                                                    <option value="industriel" <?php if($user->activity=='industriel'){echo 'selected="selected"';}  ?> ><?php echo __('msg.Industrial');?></option>
                                                    <option value="laboratoire" <?php if($user->activity=='laboratoire'){echo 'selected="selected"';}  ?> ><?php echo __('msg.laboratory');?></option>
                                                    <option value="recuperateur" <?php if($user->activity=='recuperateur'){echo 'selected="selected"';}  ?> ><?php echo __('msg.Scraps buyer');?></option>
                                                    <option value="investisseur" <?php if($user->activity=='investisseur'){echo 'selected="selected"';}  ?> ><?php echo __('msg.Investor');?></option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" class="form-control form-control-user" id="siret" name="siret"  value="{{ $user->siret }}"  onchange="changing(this)"  pattern=".{14,14}"
                                                       placeholder="SIRET* (ex : 7362 521 879 00034)">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" class="form-control form-control-user" id="mobile" name="mobile" pattern=".{10,10}" value="{{ $user->mobile }}"  onchange="changing(this)"
                                                       placeholder="<?php echo __('msg.Cell phone');?>*">
                                            </div>
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" class="form-control form-control-user" id="phone" name="phone"  pattern=".{0,10}" value="{{ $user->phone }}"  onchange="changing(this)"
                                                       placeholder="<?php echo __('msg.Phone');?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" class="form-control form-control-user" id="username" name="username" readonly value="{{ $user->username }}"
                                                       placeholder="<?php echo __('msg.Username');?>*">
                                            </div>
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="email" class="form-control form-control-user" id="email" name="email"  readonly value="{{ $user->email }}"
                                                       placeholder="<?php echo __('msg.Email address');?>*">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="password" class="form-control form-control-user" name="password"   pattern=".{6,30}"    onchange="changing(this)"
                                                       id="password" placeholder="<?php echo __('msg.Password');?>*">
                                            </div>

                                        </div>

                                    </form>


                                </div>
                            </div>
 

                       

                        </div>

                        <div class="col-lg-5 mb-4">

                             <div class="card shadow mb-4">
                                <div class="  ">
                                    <a href="#div2" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">								
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('msg.My Documents')}}</h6>
									</a>
                                </div>
                                <div id="div2" class="card-body">
 
 
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
