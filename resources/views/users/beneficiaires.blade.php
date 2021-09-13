@extends('layouts.back')
 
<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datatables/css/dataTables.bootstrap.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datatables/css/buttons.bootstrap.css') }}" />

<link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/datatables/css/scroller.bootstrap.css') }}" />
 
 
@section('content')


    <style>
        .uper {
            margin-top: 10px;
        }
        .no-sort input{display:none;}
    </style>
 
       
	<div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-12 col-sd-12 mb-4">

						 <div class="card shadow mb-4">
                                <div class="  ">
                                    <a href="#div1" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">								
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('msg.List of beneficiaries')}} non validés</h6>
									</a>
                                </div>
                                <div   class="card-body">

    <div class="row"> 
	<div class="col-lg-8 col-sm-6"> </div>
	<div class="col-lg-4 col-sm-6">
				 <a  style="float:right;margin-bottom:10px"   href="{{route('beneficiairesvalides')}}"    class="btn btn-md btn-success"  role="button" data-toggle="tooltip" data-tooltip="tooltip" data-placement="bottom" data-original-title="" >
                            <span class="fas fa-user-check"></span> Bénéficiaires validés
                 </a> 
	</div>
 						
	</div>							
  <?php
  
   $etablissements=DB::table('etablissement')->get();
 	$et=array(); 
  foreach( $etablissements as $e)
{	 
	$et[$e->etablissement_ident]=$e->etablissement_nom.'('.$e->etablissement_pays.')' ;
} 
  
  
  ?>
		  <table id="mytable" class="table table-striped mb-40"  style="width:100%">
            <thead>
            <tr id="headtable">
                <th style="text-align:center;width:6%;"  >ID</th>
                <th style="text-align:center;width:12%;">{{__('msg.Name')}}</th>
                <th style="text-align:center;width:10%;">{{__('msg.City')}}</th>				
                <th style="text-align:center;width:12%"  >{{__('msg.In')}}</th>
                 <th style="text-align:center;width:14%;"  >{{__('msg.Account num')}}</th>
            <!--    <th style="text-align:center;width:18%;" class="hidemobile">{{__('msg.Comment')}}</th>	-->			 
                <th style="text-align:center;width:10%;">{{__('msg.State')}}</th>
                <th style="text-align:center;width:10%;">{{__('msg.Validate')}}</th>
               </tr>
            </thead>
            <tbody>
			<?php  if (is_array($beneficiaires) || is_object($beneficiaires)){ 	?>
            @foreach($beneficiaires as $ben)
				<?php if(trim($ben->etat)!='validé'){?>			
 				<tr>
				<?php if(trim($ben->etat)=='validé'){$style="color:#54ba1d";}else{$style='';} ?>
				<td style=" text-align:center "  ><?php echo  $ben->bene_ident   ;?></td>	
				<td style=" text-align:center "><a href="<?php echo URL("beneficiaire/".$ben->bene_ident);?>"><?php echo $ben->Nom  ;?></a></td>						
				<td style=" text-align:center "><?php echo $ben->Ville  ;?></td>				
				<td style=" text-align:center " ><?php   if (isset($et[$ben->etablissement_ident])){ echo $et[$ben->etablissement_ident];  }  ;?></td>						
				<td style=" text-align:center "  ><?php echo $ben->compte  ;?></td>						
			<!--	<td class="hidemobile"><?php // echo $ben->commentaire  ;?></td>	-->
				<td style=" text-align:center;<?php echo $style;?> "><?php echo $ben->etat  ;?></td>						
				<td style=" text-align:center;<?php echo $style;?> "><?php if ($ben->etat!='validé'){ ?>
				 <a    href="{{action('UsersController@validatebenef', $ben->bene_ident )}}"  class="btn btn-md btn-success"  role="button" data-toggle="tooltip" data-tooltip="tooltip" data-placement="bottom" data-original-title="{{__('msg.Validate')}}" >
                            <span class="fas fa-user-check"></span> {{__('msg.Validate')}}
                        </a>  
				<?php }   ?></td>						
				

				</tr>	
				<?php } ?>
				
			@endforeach
			<?php } ?>
            </tbody>
			</table>  
  


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

    <style>.searchfield{width:100px;}
		 #mytable{width:100%!important;margin-top:10px !important;}

	</style>


    <script type="text/javascript">
	
        $(document).ready(function() {


            $('#mytable thead tr:eq(1) th').each( function () {
                var title = $('#mytable thead tr:eq(0) th').eq( $(this).index() ).text();
                $(this).html( '<input class="searchfield" type="text"   />' );
            } );

            var table = $('#mytable').DataTable({
                orderCellsTop: true,
                dom : '<"top"flp<"clear">>rt<"bottom"ip<"clear">>',
                responsive:true,
				 aaSorting : [],               
                buttons: [

                    'csv', 'excel', 'pdf', 'print'
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
                        "info":           "affichage de  _START_ à _END_ de _TOTAL_ entrées",
                        "infoEmpty":      "affichage 0 à 0 de 0 entrées",
                        "infoFiltered":   "(Filtrer de _MAX_ total d`entrées)",
                        "infoPostFix":    "",
                        "thousands":      ",",
                        "lengthMenu":     "affichage de _MENU_ entrées",
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
 	  