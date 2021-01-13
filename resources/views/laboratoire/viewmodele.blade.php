
@extends('layouts.back')
 
 @section('content')

<?php
use App\Http\Controllers\HomeController ;
 $user = auth()->user();  
 
$prestations=HomeController::listeprestations($user['client_id'] );
$PrestLibs=array();
$PrestTypes=array();
$PrestTypes2=array();
 
 foreach($prestations as $prest)
{
	$PrestLibs[$prest->id]=$prest->lib;
	$PrestTypes2[$prest->id]=$prest->type_lib;
	$PrestTypes[$prest->type_id]=$prest->type_lib;
 }
// dd($PrestLibs);
  $natures=HomeController::natures2( );
 $Natures=array();
foreach($natures as $nature)
{
	if($nature->metier_CODE=='LAB'){
	$Natures[$nature->nature_lot_ident]=$nature->nature_lot_nom;
	}
}

$modele=DB::table('modele_lab')->where('modele_lab_ident',$id)->first();
 ?>
 

 <div class="row">
 <nav aria-label="breadcrumb" style="width:100%">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.Home')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('laboratoire')}}">{{__('msg.Laboratory')}}</a></li>
    <li class="breadcrumb-item"><a href="#">{{__('msg.Model')}} <?php echo $modele->modele_nom; ?></a></li>
	</ol>
 </nav>
                        <!-- Content Column -->
                        <div class="col-lg-9 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('msg.Model details')}}</h6>
                                </div>
                                <div class="card-body">
								   <form method="post" action="{{ route('updatemodelelab') }}"    >
										{{ csrf_field() }}
									  <input  class="form-control"  id="cl_ident"  type="hidden"  name="cl_ident" value="<?php echo $user['client_id']; ?>" />
									  <input  class="form-control"  id="id"  type="hidden"  name="id" value="<?php echo $id; ?>" />

                                     <div class="row pl-20 pr-20 mb-10">
										<div class="col-lg-12">
											<label>{{__('msg.Model name')}}: </label>
										</div>
									    <div class="col-lg-9  " style="display:inline!important">
											 <input  class="form-control"  id="modele_nom"  name="modele_nom"  type="text"   value="<?php echo $modele->modele_nom; ?>"  />
											  
									   </div>
									   
									 </div>	
 
                                   <div class="row pl-20 pr-20 mb-10">
										<div class="col-lg-9">
											<label>{{__('msg.Type of service')}}: </label>
										</div>
									    <div class="col-lg-9">
											<select id="choix_lab_ident"  name="choix_lab_ident" class="form-control" data-toggle="tooltip" data-placement="bottom" onchange="types()" >
											<option></option>
												<?php $i=0; foreach($PrestTypes as $key => $val)
												{ $i++; 
										if( $modele->choix_lab_ident== $key ){$selected='selected="selected"';}else{$selected=''; }											 
												echo '<option   '.$selected.'      value="'.($key).'"   >'.$val.'</option>';
									 
												}  ?>
											</select>
									   </div>
									  
								    </div>
									
                                     <div class="row pl-20 pr-20 mb-10">
										<div class="col-lg-9">
											<label>{{__('msg.Nature of work')}}: </label>
										</div>
									    <div class="col-lg-9">
											<select id="type_lab_ident"  name="type_lab_ident" class="form-control" data-toggle="tooltip" data-placement="bottom" >
											<option></option>
												<?php $i=0; foreach($PrestLibs   as $key => $val)
												{ $i++; 
										if( $modele->type_lab_ident== $key ){$selected='selected="selected"';}else{$selected=''; }
												echo '<option   '.$selected.'   value="'.($key).'" class="types type-'.$PrestTypes2[$i].'" >'.$val.'</option>';
									 
												}  ?>
											</select>
									   </div>
									  
								    </div>	
									
                                     <div class="row pl-20 pr-20 mb-10">
										<div class="col-lg-9">
											<label>{{__('msg.Nature of products')}}: </label>
										</div>
									    <div class="col-lg-9">
											<select id="nature_lot_ident"  name="nature_lot_ident" class="form-control" data-toggle="tooltip" data-placement="bottom" >
											<option></option>
												<?php foreach($Natures as $key => $val)
												{  
										 	if(  intval($modele->nature_lot_ident)== intval($key) ){$selected='selected="selected"';}else{$selected=''; }
												echo '<option '.$selected.' value="'.$key.'"   >'.$val.'</option>';
									 
												}  ?>
											</select>
									   </div>
									  
									 </div>								 
									
                                      <div class="row pl-20 pr-20 mb-10">
										<div class="col-lg-4">
											<label>{{__('msg.Quantity')}}: </label>
 											 <input  class="form-control"   id="qte" name="qte"  type="number" step="1" min="1" style="width:130px" value="1"  required  value="<?php echo $modele->qte;?>" />
										 </div>
  
										<div class="col-lg-4">
											<label>{{__('msg.Weight')}} <small>{{__('msg.in grams')}}:</small> </label>
									        <input  class="form-control"   id="poids" name="poids"  type="number" step="0.01" min="0" style="width:130px"  required  value="<?php echo $modele->poids;?>"   />

										</div>
									  <div class="col-lg-4">
											<label>{{__('msg.Value')}}: </label>
										     <input  class="form-control"   id="valeur" name="valeur"  type="number" step="0.01" min="0" style="width:130px"  value="<?php echo $modele->valeur;?>"     />

									   </div>
											  
 									   
									 </div>	
									 
									 
                                     <div class="row pl-20 pr-20 mb-10">
										<div class="col-lg-12">
											<label>{{__('msg.Metals to be analyzed')}}: </label>
										</div>
									    <div class="col-lg-3"  >
											 <label for="titrage_au" ><input class="form-control"     id="titrage_au" name="titrage_au"  type="checkbox"  style="width:25px" value="1" <?php if($modele->titrage_au==1){?> checked <?php } ?>  /> <span class="  mt-10 btn text-center text-white bg-gradient-warning btn-circle btn-sm">Or</span></label>
									    </div>
									    <div class="col-lg-3"  >
											 <label for="titrage_ag" ><input class="form-control"      id="titrage_ag" name="titrage_ag" type="checkbox" style="width:25px" value="1" <?php if($modele->titrage_ag==1){?> checked <?php } ?> /> <span class="  mt-10 btn text-center text-dark bg-gradient-light btn-circle btn-sm">Arg</span></label>
									    </div>
									    <div class="col-lg-3"  >
											 <label for="titrage_pt" ><input class="form-control"    id="titrage_pt" name="titrage_pt" type="checkbox"  style="width:25px"  value="1" <?php if($modele->titrage_pt==1){?> checked <?php } ?> /> <span class="  mt-10 btn text-center text-white bg-gradient-secondary btn-circle btn-sm">Plat</span></label>
									    </div>
									    <div class="col-lg-3"  >
											 <label for="titrage_pd" ><input class="form-control"    id="titrage_pd" name="titrage_pd" type="checkbox"  style="width:25px" value="1" <?php if($modele->titrage_pd==1){?> checked <?php } ?> /> <span class="  mt-10 btn text-center text-white bg-gray-500 btn-circle btn-sm">Pall</span></label>
									    </div>										
									      
									 </div>	
									 

									 
		 
				 	      <div class="row " style=" ">
				 	      <div class="col-xs-12 col-sm-6 " style=" ">
								<button     type="submit"  class="pull-right btn btn-primary btn-icon-split   ml-50 mt-10 mb-20">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-save"></i>
                                        </span>
                                        <span class="text" >{{__('msg.Update Model')}}</span>
                                    </button>
                                </div>	


				 	          <div class="col-xs-12 col-sm-6" style=" " >
								<button   disabled  type="submit"   class="pull-right btn btn-primary btn-icon-split   ml-50 mt-10 mb-20">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-save"></i>
                                        </span>
                                        <span class="text" >{{__('msg.Save as an order')}}</span>
                                    </button>
                                </div>									
									 
</form>									 
									 
						 </div>
									
									
									</div>
                              </div>

                       

                        </div>

                     <!--   <div class="col-lg-5 mb-4">

                             <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">  </h6>
                                </div>
                                <div class="card-body">
 
 
                                </div>
                            </div>

               

                        </div>-->
                    </div>

					
<script>

	   function toggle(className, displayState){
            var elements = document.getElementsByClassName(className);
            for (var i = 0; i < elements.length; i++){
                elements[i].style.display = displayState;
              }
			  
        }
 
 function types(){
 	var type= $( "#choix_lab_ident option:selected" ).text();
 	  toggle('types','none');
	 toggle('type-'+type,'block');
 }
</script>					
					
@endsection
