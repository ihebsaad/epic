
@extends('layouts.front')

   
@section('content')
   
    <div class="row">

      <!-- Post Content Column was 8 -->
      <div class="col-lg-12">

        <!-- Title -->
        <h1 class="mt-4"><?php echo $actualite['titre'] ; ?></h1>

        <!-- Author  
        <p class="lead">
          by
          <a href="#">Start Bootstrap</a>
        </p>

        <hr>
--->
		<?php $date=  date('d/m/Y H:i', strtotime($actualite['created_at'] )); ?>
         <!-- Date/Time -->
        <p>Publié le  <b><?php echo $date; ?></b></p>

        <hr>				
        <!-- Preview Image -->
		<?php if($actualite['image'] !=''){?> <img class="img-fluid rounded" src="//<?php echo $_SERVER['HTTP_HOST'];?>/storage/images/<?php echo $actualite['image'];?>" style="max-height:300px"/><?php } ?>

        <hr>

        <!-- Post Content -->
        <?php echo   ($actualite['contenu']);?>
        <hr>
 

</div>
  
@endsection


 
 
