
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
            Ajouter
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            <form method="post" action="{{ route('actualites.store') }}"  enctype="multipart/form-data">
			  {{ csrf_field() }}
                <div class="form-group">
                    <label for="titre">Image:</label>
                    <input id="image" type="file" class="form-control" name="image"  accept="image/*"/>
                </div>
                <div class="form-group">
                    <label for="titre">Titre:</label>
                    <input id="titre" type="text" class="form-control" name="titre"/>
                </div>		
			    <div class="form-group">
                    <label for="extrait">Extrait:</label>
                    <textarea id="extrait" type="text" class="form-control" name="extrait" ></textarea>
                </div>					
				<div class="form-group ">
                    <label for="contenu">Contenu:</label>
                    <div class="editor" >
                        <textarea style="min-height: 380px;"  id="home" type="text"  class="textarea tex-com" placeholder="Contenu ici" name="contenu" required  ></textarea>
                    </div>
				</div>
				
				<!--
				<div class="form-group ">

             <label class="check "> <input type="checkbox" name="visible"  value="1" checked/> Visible</label>
					</div>
-->
          <div class="form-group ">
      <button  type="submit"  class="btn btn-primary">Ajouter</button>
  			 </div>

             <!--   <button id="add"  class="btn btn-primary">Ajax Add</button>-->
            </form>
        </div>
    </div>
@endsection

 
