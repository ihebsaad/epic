
@extends('layouts.back')
 
 @section('content')

<?php
 $user = auth()->user();  
 use App\Http\Controllers\HomeController ;
 $alliages=HomeController::referentielalliage();			  
  
$order = DB::table('orders')->where('status','cart')->where('user',$user->id)->first();
if ($order!=null){
 $orderid=$order->id;
$amount=$order->amount   ;
$comp_amount=$order->comp_amount   ;
$weight=$order->weight   ;
 $gold=$order->gold   ;
 $silver=$order->silver   ;
$palladium=$order->palladium   ;
$platine=$order->platine   ;
	
 $products= DB::table('products')->where('orderid',$orderid)->orderBy('id','asc')->get();
 
}else{
$orderid=0;
$amount=0;
$comp_amount=0;
$weight=0;
 $gold=0;
$silver=0;
$palladium=0;
$platine =0;
$products=array();
}

?>

						<div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-7 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Panier</h6>
                                </div>
                                <div class="card-body">
 
 <?php foreach($products as $product){ ?>
	  <div class="row pt-20" style="border-bottom:1px solid lightgrey">  
<?php
 $prod=app('App\Http\Controllers\HomeController')->produit($product->type,$product->famille1,$product->famille2,$product->famille3);
  $produit=  DB::table('type_famille')->where('type_id',$product->type)->where('fam1_id',$product->famille1)->where('fam2_id',$product->famille2)->where('fam3_id',$product->famille3)->first();

 $img=''; $image=DB::table('photo')->where('photo_id',$produit->photo_id )->first();
	 if(isset($image)){ $img=$image->url;}
	 if($product->type==101){$Type=  __('msg.Half Products') ; $link=route('products');}
 if($product->type==102){$Type=  __('msg.Galvano') ; $link=route('galvano');}
 if($product->type==103){$Type=  __('msg.Findings') ; $link=route('findings');}
 if($product->type==104){$Type= __('msg.Jewelry') ; $link=route('jewelry');}

 $id_unite= $prod[0]['UNIT_IDENT'];
 $unite=DB::table('unite')->where('UNIT_IDENT',$id_unite)->first();
?>
<div class="col-md-3  pl-10">
 <center><img style="min-height:150px;max-height:180px" src="<?php echo $img; ?>" class="img-fluid " alt=""></center>
</div>
<div class="col-md-5  pl-10">
<h5 ><a class="text-info"  title="<?php echo __("msg.View product");?>" href="<?php echo route("single",['type'=>$product->type,'fam1'=>$product->famille1,'fam2'=>$product->famille2,'fam3'=>$product->famille3]);?>"><?php echo $product->libelle; ?></a></h5>
<a  href="<?php echo route('catalog',['type'=>$product->type,'famille1'=>$product->famille1]);?>" ><?php echo  $produit->LIBFAM1; ?></a><br>
<?php
if($product->alliage >0){
 foreach ($alliages as $alliage)
	{
	 if( $alliage->id == $product->alliage  ) 
	 { echo $alliage->libelle;}
	}
 }
  	?>
	<div class="row pt-15"><input type="number" value="<?php echo $product->qte;?>" class="ml-10 mr-10 form-control" style="width:80px"></input> <span class="pt-10"><?php echo $unite->UNIT_LIB_LONG ; ?></span> </div>

</div>
<div class="col-md-4"  >
  <div class="pb-40  pl-10 pt-15" style="border-left:1px solid lightgrey">
   <b>Poids Total :  <?php echo $product->poids ; ?> g<br>
   Façon : <?php echo $product->montant_compl ; ?>  €</b>
  </div>
</div>

</div><!-- row -->
<?php	 
 }
?>	
 								 
									 
                                </div>
                            </div>

                       

                        </div>

                        <div class="col-lg-5 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Cumul de la commande</h6>
                                </div>
                                <div class="card-body">
 
 
                                </div>
                            </div>

 

                        </div>
                    </div>

@endsection
