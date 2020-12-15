

@extends('layouts.back')
 
 @section('content')
<?php 
use App\Http\Controllers\HomeController ;

$referentiels=  HomeController::referentiel1() ;
  ?>
 
<h2> {{__('msg.Galvano')}}</h2> 

<div class="card shadow mb-4 pt-10 pl-10 pr-10 pb-20">
 {{__('Select a category')}}<br><br>

	<div class="row">
	<?php $i=0;
 	foreach($referentiels as $famille1) 
{ 
// 102 = galvano
 	if($famille1->type_id==102){
		
$i++; 
if($i==1 ||$i==6 || $i== 11 ){$color='primary';}
if($i==2 ||$i==7 || $i== 12 ){$color='info';}
if($i==3 ||$i==8 || $i== 13 ){$color='success';}
if($i==4 ||$i==9 || $i== 14 ){$color='warning';}
if($i==5 ||$i==10 || $i== 15 ){$color='danger';}		
 		echo
		'<div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-'.$color.' shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="h5 font-weight-bold text-gray-800 text-uppercase mb-0">
                                              ';?>
                                              <a href="<?php echo route('catalog',['type'=>102,'famille1'=>$famille1->id]);?>"><?php echo $famille1->libelle; ?></a></div>
 									<?php   echo ' </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
		
	}
}?>
                         
 
 				
						
	</div>
 
 
 </div>
					
@endsection					