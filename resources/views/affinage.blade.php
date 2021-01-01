
@extends('layouts.back')
 
 @section('content')

<?php
use App\Http\Controllers\HomeController ;
 $user = auth()->user();  

$commandes=HomeController::listecommandes($user['client_id'],'');
$modeles=HomeController::listemodeles($user['client_id'],'');
//dd($modeles);

?>
<style>
 .btn-default{ border:1px solid lightgrey!important;}
 .dt-buttons{background-color:#f8f9fc;margin-bottom:10px;}
</style>
						<div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-8 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Mes modèles d'affinage sauvegardés</h6>
                                </div>
                                <div class="card-body">
			<div class="row mb-15">
                <div class="col-lg-8"></div>
                <div class="col-lg-4">
                    <a   class="btn btn-md btn-success"    href=" " ><b><i class="fas fa-plus"></i> Nouveau Modèle</b></a>
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
                <th style="width:25%">Nom</th>
                <th style="width:10%">Lot</th>
                <th style="width:10%">Poids</th>
                <th style="width:25%">Métaux</th>
                 <th style="width:10%">Actions</th>
              </tr>
            </thead>
            <tbody>
            @foreach($modeles as $modele)
				<tr>
				<td><?php echo $modele->nom; ?></td>
				<td><?php echo $modele->nature_lot_ident;?></td>
				<td><?php echo $modele->poids;?></td>
				<td>
				<?php if ($modele->or > 0){  ?>
				<span class="btn text-center text-white bg-gradient-warning btn-circle btn-sm">
                  Or
                 </span>
				<?php }  if ($modele->argent > 0){    ?>
				<span class="btn text-center text-dark bg-gradient-light btn-circle btn-sm">
                  Arg 
                 </span>
				<?php }  if ($modele->platine > 0){    ?>				 
				 <span class="btn text-center text-dark bg-gradient-secondary btn-circle btn-sm">
                  Plat 
                 </span>
				<?php }  if ($modele->palladium > 0){    ?>				 				 
				<span class="btn text-center text-dark btn-gray-500 btn-circle btn-sm">
                  Pall 
                 </span>
				 <?php }   ?>	
				</td>
				<td></td>
 				</tr>
			@endforeach
            </tbody>
        </table><br>
		
                                </div>
                            </div>

                       

                        </div>

                         <!-- Content Column -->
                        <div class="col-lg-4 mb-4">

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
								if ($commande->etat!='Passée'){   ?>
								<div class="row pb-10">
								
								<div class="col-md-6">
								Date :<br><b><?php echo  date('d/m/Y', strtotime($commande->date ));?></b>
								</div>
								<div class="col-md-6">
								Poids Total : <b><?php echo $commande->poids  ;?> g</b>
								</div>								
								
								</div>
								
								<div class="row pb-15" >
								
								<div class="col-md-6">
								Commande : <b><a href="#"><?php echo   $commande->cmde_aff ;?></a></b><br>																
								</div>
								<div class="col-md-6">
								
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
								if ($commande->etat=='Passée'){   ?>
								<div class="row pb-10 ">
								
								<div class="col-md-6">
								Date :<br><b><?php echo  date('d/m/Y', strtotime($commande->date ));?></b>
								</div>
								<div class="col-md-6">
								Poids Total : <b><?php echo $commande->poids  ;?> g</b>
								</div>								
								
								</div>
								
								<div class="row pb-15">
								
								<div class="col-md-6">
								Commande : <b><a href="#"><?php echo   $commande->cmde_aff ;?></a></b><br>																
								</div>
								<div class="col-md-6">
								
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
        $(document).ready(function() {


            $('#mytable thead tr:eq(1) th').each( function () {
                var title = $('#mytable thead tr:eq(0) th').eq( $(this).index() ).text();
                $(this).html( '<input class="searchfield" type="text"   />' );
            } );

            var table = $('#mytable').DataTable({
                orderCellsTop: true,
                dom : '<Bfl<"clear">>rt<"bottom"ip<"clear">>',
  				//dom : 'lrtip',
				
				//  dom: 'Blfrtip',
				
                responsive:true,
				 aaSorting : [],               
                buttons: [						 
                    {
                    extend: 'print',
                    text:    '  Imprimer' ,
                     exportOptions: {
                    columns: [ 0,1,2  ]
				}
                    },
                    {
                    extend: 'csv',
                    text: '  Csv',
                     exportOptions: {
                    columns: [ 0,1,2  ]
                	}
                    },
				 {
                    extend: 'excel',
                    text: '  Excel',
                     exportOptions: {
                    columns: [ 0,1,2  ]
               	}
                    },				
				{
                    extend: 'pdf',
                    text: '  Pdf',
                     exportOptions: {
                    columns: [ 0,1,2 ]
                	}
                    },
                ],
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
 	  