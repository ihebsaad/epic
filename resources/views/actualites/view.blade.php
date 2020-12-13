
@extends('layouts.back')


<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Modifier l'article
        </div>
        <div class="card-body">
          
            <form method="post" action="{{ route('actualites.edit') }}"  enctype="multipart/form-data">
			  {{ csrf_field() }}
			   <input id="actualite" type="hidden" class="form-control" name="id"  value="<?php  echo $actualite['id'];?>"/>

			  <div class="row">
                <div class="form-group col-md-6">
                    <label for="titre">Image:</label>
                    <input id="image" type="file" class="form-control" name="image"  accept="image/*"/>
                </div>
				 <div class="  col-md-6">

				<?php if($actualite['image'] !=''){?><img class="pull-right" src="//<?php echo $_SERVER['HTTP_HOST'];?>/storage/images/<?php echo $actualite['image'];?>" style="max-width:150px"/><?php } ?>
                </div>
				
                </div>
                <div class="form-group">
                    <label for="titre">Titre:</label>
                    <input id="titre" type="text" class="form-control" name="titre"  value="<?php  echo $actualite['titre'];?>"/>
                </div>	
			    <div class="form-group">
                    <label for="extrait">Extrait:</label>
                    <textarea id="extrait" type="text" class="form-control" name="extrait" ><?php  echo $actualite['extrait'];?></textarea>
                </div>		
				<div class="form-group ">
                    <label for="contenu">Contenu:</label>
                    <div class="editor" >
                        <textarea style="min-height: 380px;"  id="home" type="text"  class="textarea tex-com" placeholder="Contenu ici" name="contenu" required  ><?php echo $actualite['contenu'];?></textarea>
                    </div>
				</div>
			 
          <div class="form-group ">
      <button  type="submit"  class="btn btn-primary">Enregistrer</button>
  			 </div>

             <!--   <button id="add"  class="btn btn-primary">Ajax Add</button>-->
            </form>
        </div>
    </div>
@endsection


 

<script>
    $(document).ready(function(){

        $('#add').click(function(){
            var nom = $('#nom').val();
            var typepres = $('#typepres').val();
             if ((titre != '') )
            {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{ route('actualites.saving') }}",
                    method:"POST",
                    data:{nom:nom,type:type, _token:_token},
                    success:function(data){
                        alert('ajouté !');

                    }
                });
            }else{
                alert('ERROR');
            }
        });




    });
</script>
