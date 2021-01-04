
@extends('layouts.back')
 
 @section('content')

<?php
use App\Http\Controllers\HomeController ;
 $user = auth()->user();  

$commandes=HomeController::listecommandes($user['client_id'],'');
$modeles=HomeController::listemodeles($user['client_id'],'');
$natures=HomeController::natures( );
//dd($natures );
$Natures=array();
foreach($natures as $nature)
{
	$Natures[$nature->nature_lot]=$nature->libelle;
}

?>
<style>
 .btn-default{ border:1px solid lightgrey!important;}
 .dt-buttons{background-color:#f8f9fc;margin-bottom:10px;}
</style>
						<div class="row">
 <nav aria-label="breadcrumb" style="width:100%">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.Home')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('affinage')}}">Affinage</a></li>
	</ol>
 </nav>
        <!-- Content Column -->
        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Mes modèles d'affinage sauvegardés</h6>
                                </div>
                                <div class="card-body"  style="min-height:400px">
                                      
						<style>	
						.pagination{
						 position: absolute; 
						 right: 5px; margin-bottom:50px;bottom:5px}
						</style>	




<!-- Nav tabs -->
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="modeles-tab" data-toggle="tab" href="#modeles" role="tab" aria-controls="modeles" aria-selected="true">Modèles</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="commandes-tab" data-toggle="tab" href="#commandes" role="tab" aria-controls="commandes" aria-selected="false">Commandes En cours</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="commandes2-tab" data-toggle="tab" href="#commandes2" role="tab" aria-controls="commandes2" aria-selected="false">Commandes Terminées</a>
  </li> 
 <li>
 <a   class="ml-30 btn btn-md btn-success"    href="{{route('modele')}} " ><b><i class="fas fa-plus"></i> Nouveau Modèle</b></a>
 </li>
</ul>

<!-- Tab panes -->
<div class="tab-content pt-20">
  <div class="tab-pane active" id="modeles" role="tabpanel" aria-labelledby="modeles-tab">

        <table id="mytable" class="table table-striped mb-40"  style="width:100%">
            <thead>
            <tr id="headtable">
                <th style="width:12%">Nom</th>
                <th style="width:10%">Nature</th>
                <th style="width:8%">Poids</th>
                <th style="width:25%">Métaux</th>
                <th    style="width:10%;padding-right:10px"><small>Assiste à la fonte</small></th>
                  <th style="width:8%">Actions</th>
              </tr>
            </thead>
            <tbody>
            @foreach($modeles as $modele)
				<tr>
				<td style="font-size:12px"><a href="<?php echo URL("viewmodele/".$modele->id);?>"><?php echo $modele->nom; ?></a></td>
				<td style="font-size:12px"><?php echo $Natures[$modele->nature_lot_ident];?></td>
				<td><?php echo $modele->poids;?> g</td>
				<td>
				<?php $w1=0; if ($modele->or > 0){ $w1=intval($modele->or / 10 ) ;?>
				<span class="ml-10 btn text-center text-white bg-gradient-warning   btn-sm" style="width:<?php echo $w1;?>px;max-width:200px!important" >
                  Or 
                 </span>
				<?php }$w2=0;  if ($modele->argent > 0){ $w2=intval($modele->argent / 10 ) ;   ?>
				<span class="ml-10 btn text-center text-dark bg-gradient-light   btn-sm" style="width:<?php echo $w2;?>px;max-width:200px!important" >
                  Arg 
                 </span>
				<?php }$w3=0;  if ($modele->platine > 0){ $w3=intval($modele->platine / 10 );   ?>				 
				 <span class="ml-10 btn text-center text-white bg-gradient-secondary btn-sm" style="width:<?php echo $w3;?>px;max-width:200px!important" >
                  Plat
                 </span>
				<?php }$w4=0;  if ($modele->palladium > 0){  $w4=intval($modele->palladium  / 10 ) ;  ?>				 				 
				<span class="ml-10 btn text-center text-white bg-gray-500  btn-sm"  style="width:<?php echo $w4;?>px;max-width:200px!important" >
                  Pall
                 </span>
				 <?php }   ?>	
				</td>
				<td></td>
				<td></td>
 				</tr>
			@endforeach
            </tbody>
        </table><br>  
  
  
  </div>
  <div class="tab-pane" id="commandes" role="tabpanel" aria-labelledby="commandes-tab">
 <table id="mytable2" class="table table-striped mb-40"  style="width:100%">
            <thead>
            <tr id="headtable">
                <th style=" ">Commande</th>
                <th style=" ">Date</th>
                <th style=" ">Nature du lot</th>
                <th style=" ">Poids</th>
                 <th style="width:8%">Actions</th>
              </tr>
            </thead>
            <tbody>
			  <?php $i=0;?>    

        @foreach($commandes as $commande)
				<tr>
								
								<?php $i++;
								if ($i <6){    
								if ($commande->etat!='Passée'){   ?>
								<td><b><a href="<?php echo URL("commande/".$commande->cmde_aff);?>"><?php echo   $commande->cmde_aff ;?></a></b></td>
								<td><b><?php echo  date('d/m/Y', strtotime($commande->date ));?></b></td>
 								<td><b><?php echo $commande->poids  ;?> g</b></td>
								<td><b><?php   echo $Natures[$commande->nature_ident];?></b></td>
			   </tr>
								<?php } ?>
								<?php } ?>
								
								@endforeach
			</tbody>
 </table>
  
  </div>
    <div class="tab-pane" id="commandes2" role="tabpanel" aria-labelledby="commandes2-tab">

	  <table id="mytable2" class="table table-striped mb-40"  style="width:100%">
            <thead>
            <tr id="headtable">
                <th style=" ">Commande</th>
                <th style=" ">Date</th>
                 <th style=" ">Poids</th>
                 <th style="width:8%">Actions</th>
              </tr>
            </thead>
            <tbody>
			  <?php $i=0;?>    

        @foreach($commandes as $commande)
				<tr> 
								<?php $i++;
								if ($i <6){    
								if ($commande->etat=='Passée'){   ?>
								<td><b><a href="<?php echo URL("commande/".$commande->cmde_aff);?>"><?php echo   $commande->cmde_aff ;?></a></b></td>
								<td><b><?php echo  date('d/m/Y', strtotime($commande->date ));?></b></td>
 								<td><b><?php echo $commande->poids  ;?> g</b></td>
								<td></td>
 			   </tr>
								<?php } ?>
								<?php } ?>
								
								@endforeach
			</tbody>
 </table>
	
	</div>
 </div>






						

		
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
 	  