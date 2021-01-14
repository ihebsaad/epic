
@extends('layouts.back')
 
 @section('content')

<?php
use App\Http\Controllers\HomeController ;

 $user = auth()->user();  

$commandes=HomeController::listecommandeslabo($user['client_id'] );
$modeles=HomeController::listemodeleslabo($user['client_id'] );
$prestations=HomeController::listeprestations($user['client_id'] );
//dd($natures );
$PrestLibs=array();
$PrestTypes=array();
 foreach($prestations as $prest)
{
	$PrestLibs[$prest->id]=$prest->lib;
	$PrestTypes[$prest->type_id]=$prest->type_lib;
 }
//sp_accueil_liste_nature_lot
$natures=HomeController::natures2( );
//dd($natures );
$Natures=array();
foreach($natures as $nature)
{
	$Natures[$nature->nature_lot_ident]=$nature->nature_lot_nom;
}
?>
<style>
 .btn-default{ border:1px solid lightgrey!important;}
 .dt-buttons{background-color:#f8f9fc;margin-bottom:10px;}
</style>
 <nav aria-label="breadcrumb" style="width:100%">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.Home')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('laboratoire')}}">{{__('msg.Laboratory')}}</a></li>
	</ol>
 </nav>
						<div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-9 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('msg.My saved laboratory models')}}</h6>
                                </div>
                                <div class="card-body">
			<div class="row mb-15">
                <div class="col-lg-8"></div>
                <div class="col-lg-4">
                    <a   class="btn btn-md btn-success"    href="{{route('modelelab')}} " ><b><i class="fas fa-plus"></i>  {{__('msg.New Model')}}</b></a>
                </div>
            </div>                                      
						<style>	
						.pagination{
						 position: absolute; 
						 right: 5px; margin-bottom:50px;bottom:5px}
						</style>			 
        <table id="mytable" class="table table-striped mb-40"  style="width:100%">
            <thead>
            <tr id="headtable">
                <th style="width:12%">{{__('msg.Name')}}</th>
                 <th style="width:10%">{{__('msg.Laboratory')}}</th>
                 <th style="width:5%">{{__('msg.Qty')}}</th>
                 <th style="width:15%">{{__('msg.Metals')}}</th>
               </tr>
            </thead>
            <tbody>
            @foreach($modeles as $modele)
				<tr>
				<td><a href="<?php echo URL("viewmodelelab/".$modele->id);?>"><?php echo $modele->nom; ?></a><br><?php echo $Natures[$modele->nature_id];?></td>
 				<td><?php echo $PrestLibs[$modele->type_lab_ident];?></td>
 				<td><?php echo $modele->qte;?></td>
 				<td><?php echo $modele->poids;?> g<br>
				<?php $w1=0; if ($modele->or > 0){ $w1=intval($modele->or / 10 ) ;?>
                <span class="mr-10 btn text-center text-white bg-gradient-warning   btn-sm" style="width:<?php echo $w1;?>px;max-width:100px!important" >
                  Or 
                 </span>
				<?php }$w2=0;  if ($modele->argent > 0){ $w2=intval($modele->argent / 10 ) ;   ?>
                <span class="mr-10 btn text-center text-dark bg-gradient-light   btn-sm" style="width:<?php echo $w2;?>px;max-width:100px!important" >
                  Arg 
                 </span>
                <?php }  
				$w3=0;  if ($modele->platine > 0){ $w3=intval($modele->platine / 10 );   ?>                 
                 <span class="mr-10 btn text-center text-white bg-gradient-secondary btn-sm" style="width:<?php echo $w3;?>px;max-width:100px!important" >
                  Plat
                 </span>
				<?php } $w4=0;  if ($modele->palladium > 0){  $w4=intval($modele->palladium  / 10 ) ;  ?>                                  
                <span class="mr-10 btn text-center text-white bg-gray-500  btn-sm"  style="width:<?php echo $w4;?>px;max-width:100px!important" >
                  Pall
                 </span>
                 <?php }   ?>  
				</td>
  				</tr>
			@endforeach
            </tbody>
        </table><br>
		
                                </div>
                            </div>

                       

                        </div>

                         <!-- Content Column -->
                        <div class="col-lg-3 mb-4">

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
                                 <?php $i=0;?>    
								
                                @foreach($commandes as $commande)
								<?php $i++;
								if ($i <6){    
								if ($commande->etat=='En cours'){   ?>
								<div class="row pb-10">
								
								<div class="col-md-6">
								{{__('msg.Date')}}:<br><b><?php echo  date('d/m/Y', strtotime($commande->cmde_lab_date ));?></b>
								</div>
								<div class="col-md-6">
								{{__('msg.order')}}: <b><a href="<?php echo URL("commandelab/".$commande->cmde_lab_ident);?>"><?php echo   $commande->cmde_lab_ident ;?></a></b><br>															
								</div>								
								
								</div>
								
								<div class="row pb-15" >
								
								<div class="col-md-6">
								{{__('msg.Qty')}}: <b><?php echo  $commande->cmde_lab_qte ; ?></b>
								</div>
								<div class="col-md-6">								
								{{__('msg.Total weight')}}: <b><?php echo $commande->cmde_lab_poids  ;?> g</b>
								</div>								
								
								</div>								
								<hr>
								<?php } ?>
								<?php } ?>
								@endforeach

                                </div>
								
								
                                <div class="  ">
                                    <a href="#div1" class="d-block card-header " data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
										<h6 class="m-0 font-weight-bold text-dark">{{__('msg.Finished')}}</h6>
									</a>
                                </div>
                                <div id="div1" class="card-body">
                                 <?php $i=0;?>    
                                @foreach($commandes as $commande)
								<?php $i++;
								if ($i <6){    
								if ($commande->etat=='Terminée'){   ?>
								<div class="row pb-10">
								
								<div class="col-md-6">
								{{__('msg.Date')}}:<br><b><?php echo  date('d/m/Y', strtotime($commande->cmde_lab_date ));?></b>
								</div>
								<div class="col-md-6">
								{{__('msg.order')}}: <b><a href="<?php echo URL("commandelab/".$commande->cmde_lab_ident);?>"><?php echo   $commande->cmde_lab_ident ;?></a></b><br>															
								</div>								
								
								</div>
								
								<div class="row pb-15" >
								
								<div class="col-md-6">
								{{__('msg.Qty')}}: <b><?php echo  $commande->cmde_lab_qte ; ?></b>
								</div>
								<div class="col-md-6">								
								{{__('msg.Total weight')}}: <b><?php echo $commande->cmde_lab_poids  ;?> g</b>
								</div>								
								
								</div>								
								<hr>
								<?php } ?>
								<?php } ?>
								@endforeach
									 
                                </div>								
                            </div>

                       

                        </div>
                    </div>

@endsection


@section('footer_scripts')

    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/jquery.dataTables.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/dataTables.bootstrap.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/dataTables.rowReorder.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/dataTables.scroller.js') }}" ></script>

    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/dataTables.buttons.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/dataTables.responsive.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/buttons.colVis.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/buttons.html5.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/buttons.print.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/buttons.bootstrap.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/buttons.print.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/pdfmake.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('resources/assets/datatables/js/vfs_fonts.js') }}" ></script>
 

    <script type="text/javascript">
	
	    function toggle(className, displayState){
            var elements = document.getElementsByClassName(className);
            for (var i = 0; i < elements.length; i++){
                elements[i].style.display = displayState;
				var index=elements[i].title;
             }
			 return   parseInt(elements[0].title) ;
        }
		
        $(document).ready(function() {


            $('#mytable thead tr:eq(1) th').each( function () {
                var title = $('#mytable thead tr:eq(0) th').eq( $(this).index() ).text();
                $(this).html( '<input class="searchfield" type="text"   />' );
            } );

            var table = $('#mytable').DataTable({
                orderCellsTop: true,
                dom : '<fl<"clear">>rt<"bottom"ip<"clear">>',
  				//dom : 'lrtip',
				
				//  dom: 'Blfrtip',
				
                responsive:true,
				 aaSorting : [],               
            
                "columnDefs": [ {
                    "targets": 'no-sort',
                    "orderable": false,
                } ]
                ,
                "language":
                    {
                        "decimal":        "",
                        "emptyTable":     "Pas de données",
                        "info":           "Affichage de  _START_ à _END_ de _TOTAL_ entrées",
                        "infoEmpty":      "Affichage 0 à 0 de 0 entrées",
                        "infoFiltered":   "(Filtrer de _MAX_ total d`entrées)",
                        "infoPostFix":    "",
                        "thousands":      ",",
                        "lengthMenu":     "Affichage de _MENU_ entrées",
                        "loadingRecords": "chargement...",
                        "processing":     "chargement ...",
                        "search":         "Recherche:",
                        "zeroRecords":    "Pas de résultats",
                        "paginate": {
                            "first":      "Premier",
                            "last":       "Dernier",
                            "next":       "Suivant",
                            "previous":   "Précédent"
                        },
                        "aria": {
                            "sortAscending":  ": activer pour un tri ascendant",
                            "sortDescending": ": activer pour un tri descendant"
                        }
                    }

            });

            // Restore state
       /*     var state = table.state.loaded();
            if ( state ) {
                table.columns().eq( 0 ).each( function ( colIdx ) {
                    var colSearch = state.columns[colIdx].search;

                    if ( colSearch.search ) {
                        $( '#mytable thead tr:eq(1) th:eq(' + index + ') input', table.column( colIdx ).footer() ).val( colSearch.search );

                    }
                } );

                table.draw();
            }

*/

            function delay(callback, ms) {
                var timer = 0;
                return function() {
                    var context = this, args = arguments;
                    clearTimeout(timer);
                    timer = setTimeout(function () {
                        callback.apply(context, args);
                    }, ms || 0);
                };
            }
// Apply the search
            table.columns().every(function (index) {
                $('#mytable thead tr:eq(1) th:eq(' + index + ') input').on('keyup change', function () {
                    table.column($(this).parent().index() + ':visible')
                        .search(this.value)
                        .draw();


                });

                $('#mytable thead tr:eq(1) th:eq(' + index + ') input').keyup(delay(function (e) {
                    console.log('Time elapsed!', this.value);
                    $(this).blur();

                }, 2000));
            });


 
        });

    </script>
@stop
 	  