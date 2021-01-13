<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\User ;
use App\Product ;
use App\Order ;
use DB ;
use URL;

class ProductsController extends Controller
{
	
	  public function __construct()
    {
        $this->middleware('auth');
    } 
	 
 

					 function data(Request $request) { 	
					   
					   $type= $request->get('type');
					   $famille1= $request->get('famille1');
					   $famille2= $request->get('famille2');
					  // dd($famille2);
					   $famille3= $request->get('famille3');
					   $metal= $request->get('metal');



						if(($famille2)!=null &&  ($famille3 !=null)){
					 $products = DB::table('type_famille')->where('type_id',$type)->where('fam1_id',$famille1)->where('fam2_id',$famille2)->where('fam3_id',$famille3)->limit(16)->get();
							
						}else{
					 if(  ($famille2!=null) ){
					 $products = DB::table('type_famille')->where('type_id',$type)->where('fam1_id',$famille1)->where('fam2_id',$famille2)->limit(16)->get();
						}else{
					 $products = DB::table('type_famille')->where('type_id',$type)->where('fam1_id',$famille1)->where('fam3_id',$famille3)->limit(16)->get();
							
						}
						}

                         if(   $famille2==null  ){
						    if($famille3==null)
                            {
                                $products = DB::table('type_famille')->where('type_id',$type)->where('fam1_id',$famille1)->limit(16)->get();

                            }else{
                                $products = DB::table('type_famille')->where('type_id',$type)->where('fam1_id',$famille1)->where('fam3_id',$famille3)->limit(16)->get();


                            }
                         }

					 $data='';
					 foreach($products as $prod)
					 { 
					 $titre= $prod->LIBFAM1.' '.$prod->LIBFAM2 .' '.$prod->LIBFAM3;
					 $titre=strtolower($titre);
					 $image=DB::table('photo')->where('photo_id',$prod->photo_id)->first();
					 if(isset($image)){ $img=$image->url;}
					// $img=(substr($img,32,strlen($img)));
					 
						 $data.=
						 '
 <div class="col-lg-4 col-md-12 mb-4">

                            <!--Card-->
                            <div class="card card-ecommerce border-bottom-primary">

                                <!--Card image-->
                                <div class="view overlay" style="min-height:180px">
                                    <center><a title="'.__("msg.View product").'" href="'.route("single",['type'=>$type,'fam1'=>$famille1,'fam2'=>$prod->fam2_id,'fam3'=>$prod->fam3_id]).'"><img style="max-height:180px" src="'.   URL::asset('images/'.$img).'" class="img-fluid" alt=""></a></center>
                                    <a>
                                        <div class="mask rgba-white-slight"></div>
                                    </a>
                                </div>
                                <!--Card image-->

                                <!--Card content-->
                                <div class="card-body">
                                    <!--Category & Title-->

                                    <h5 title="'.__("msg.View product").'" class="card-title mb-1" style="min-height:72px"><strong><a href="'.route("single",['type'=>$type,'fam1'=>$famille1,'fam2'=>$prod->fam2_id,'fam3'=>$prod->fam3_id]).'" class="dark-grey-text">'.$titre.'</a></strong></h5>
									<!--<span class="badge badge-danger mb-2">famille2</span>-->
 
 
 
                                </div>
                                <!--Card content-->

                            </div>
                            <!--Card-->

                        </div>
						 
						 ';
					 }
					 return $data;

				}					 
	
	
	 function addproduct(Request $request) { 
 		 $type =  $request->get('type');
		 $famille1 =  $request->get('famille1');
		 $famille2 =  $request->get('famille2');
		 $famille3 =  $request->get('famille3');
		 $user =  $request->get('user');
		 $libelle =  $request->get('libelle');
		 $qte =  $request->get('qte');
		 $unite =  $request->get('unite');
		 $article =  $request->get('article');
	     $montant = $request->get('montant'); 
	     $montant_compl =  $request->get('montant_compl');
	     $poids =  $request->get('poids');
	     $alliage =  $request->get('alliage');
	     $mesure1 =  $request->get('mesure1');
	     $mesure2 =  $request->get('mesure2');
	     $comp_id =  $request->get('comp_id');
	     $comp_val =  $request->get('comp_val');
 			
	     $or=  $request->get('or');
	     $argent=   $request->get('argent'); 
	     $palladium=  $request->get('palladium'); 
	     $platine=  $request->get('platine');

		 $order = Order::where('user',$user)->where('status','cart')->first();
		 if(isset($order)){
 		 $product = new Product([
             'orderid' =>  $order->id ,
             'libelle' =>  $libelle ,
             'qte' =>  $qte ,
             'unite' =>  $unite ,
             'article' =>  $article ,
             'montant' =>  $montant ,
             'montant_compl' =>  $montant_compl ,
             'poids' =>  $poids ,
             'gold' =>  $or ,
             'silver' =>  $argent ,
             'palladium' =>  $palladium ,
             'platine' =>  $platine ,
             'type' =>  $type ,
             'famille1' =>  $famille1 ,
             'famille2' =>  $famille2 ,
             'famille3' =>  $famille3 ,
             'alliage' =>  $alliage ,
             'mesure1' =>  $mesure1 ,
             'mesure2' =>  $mesure2 ,
             'comp_id' =>  $comp_id ,
             'comp_val' =>  $comp_val 
         
        ]);
	      $product->save();
		// increment order totals
		$amount = $montant  +	$order->amount;
		$weight = $poids  +	$order->weight;
		$comp_amount =	$montant_compl+ $order->comp_amount;
		$gold =	$or + $order->gold;
		$silver =	$argent+ $order->silver;
		$pallad  =	$palladium+ $order->palladium;
		$plat  =	$platine+ $order->platine;
		Order::where('id', $order->id)->update(array(
		'amount' => $amount,
		'weight' => $weight,
		'comp_amount' => $comp_amount,
		'gold' => $gold,
		'silver' => $silver,
		'palladium' => $pallad ,
		'platine' => $plat 
 		
		));

  
 		 }else{
			 
		// add order
 			$Order = new Order([
             'user' =>  $user ,
               'amount' =>  $montant ,
             'comp_amount' =>  $montant_compl ,
             'weight' =>  $poids ,
             'gold' =>  $or ,
             'silver' =>  $argent ,
             'palladium' =>  $palladium ,
             'platine' =>  $platine ,
             'status' =>  'cart' ,
         
        ]);		
		 $Order->save();
		 $orderid=$Order->id;
		// add product
			$product = new Product([
             'orderid' =>  $orderid ,
             'libelle' =>  $libelle ,
             'qte' =>  $qte ,
             'unite' =>  $unite ,
             'article' =>  $article ,
             'montant' =>  $montant ,
             'montant_compl' =>  $montant_compl ,
             'poids' =>  $poids ,
             'gold' =>  $or ,
             'silver' =>  $argent ,
             'palladium' =>  $palladium ,
             'platine' =>  $platine ,
             'type' =>  $type ,
             'famille1' =>  $famille1 ,
             'famille2' =>  $famille2 ,
             'famille3' =>  $famille3 ,
             'alliage' =>  $alliage ,
             'mesure1' =>  $mesure1 ,
             'mesure2' =>  $mesure2 ,
             'comp_id' =>  $comp_id ,
             'comp_val' =>  $comp_val 
        ]);		
		 $product->save();
		 
 		 }
		
      //  return  back();

	         
	 }
	 
	 	
     public function deleteproduct($id)
    {
	// decrement order details
		$product=Product::where('id', $id)->first();

		$montant =  	$product->montant;
		$poids =  	$product->poids;
		$montant_compl =	  $product->montant_compl;
		$gold =	  $product->gold;
		$silver =	  $product->silver;
		$palladium =	  $product->palladium;
		$platine =	  $product->platine;
		
		$orderid =	  $product->orderid;
		$Order=Order::where('id', $orderid)->first();
		
		$amount = $Order->amount - $montant;
		$weight= $Order->weight - $poids;
		$comp_amount = $Order->comp_amount - $montant_compl ;
		$gold = $Order->gold - $gold ;
		$silver = $Order->silver - $silver ;
		$palladium = $Order->palladium - $palladium ;
		$platine = $Order->platine - $platine ;
		
		Order::where('id', $orderid)->update(array(
		'amount' => $amount,
		'weight' => $weight,
		'comp_amount' => $comp_amount,
		'gold' => $gold,
		'silver' => $silver,
		'palladium' => $palladium,
		'platine' => $platine
		
		));
		
		 $product=Product::where('id', $id)->first();

		DB::table('products')->where('id', $id)->delete();
 
		$products=Product::where('orderid', $product->orderid)->get();	
		
		$amount=0; 		$weight=0; 		$comp_amount=0; 
		$gold=0; 		$silver=0; 		$palladium=0; 		$platine=0;
		// parcours produit et calcul totaux
		foreach($products as $prod){
			$amount=$amount+$prod->montant  ;
			$weight=$weight+ floatval($prod->poids    );
			$comp_amount=$comp_amount+ floatval($prod->montant_compl    );
			$gold=$gold+ floatval($prod->gold    );
			$silver=$silver+ floatval($prod->silver    );
			$palladium=$palladium+ floatval($prod->palladium    );
			$platine=$platine+ floatval($prod->platine    );
		}
		// mise à jour de la commande
		Order::where('id',$product->orderid)->update(array(
		'amount' => $amount,
		'weight' => $weight,
		'comp_amount' => $comp_amount,
		'gold' => $gold,
		'silver' => $silver,
		'palladium' => $palladium,
		'platine' => $platine,
 		
		));

		
		
		
		
	return back();

	}
	 
	 
	 
	 
	 function details(Request $request) { 	
			 $user = auth()->user();  
		   
					   $type= $request->get('type');
					   $famille1= $request->get('famille1');
					   $famille2= $request->get('famille2');
 					   $famille3= $request->get('famille3');
					   $mesure1= $request->get('mesure1');
					   $mesure2= $request->get('mesure2');
					   $alliage_id= $request->get('alliage_id');
					   $qte= $request->get('qte');
					   $comp_id= $request->get('comp_id');
					   $comp_val= $request->get('comp_val');
 					   
		$data= app('App\Http\Controllers\HomeController')->detailsproduit($type,$famille1,$famille2,$famille3,$mesure1,$mesure2,$alliage_id,$qte,$comp_id,$comp_val,$user['client_id']);
		return $data;
	 }					   
	
	
	
	  function forfait(Request $request) { 	
			 $user = auth()->user();  
    
					   $nature= $request->get('nature');
					   $estim_or= $request->get('estim_or');
					   $estim_ag= $request->get('estim_ag');
 					   $estim_pt= $request->get('estim_pt');
					   $estim_pd= $request->get('estim_pd');
					   $poids= $request->get('poids');
					     
		$data= app('App\Http\Controllers\HomeController')->tarifforfait($nature,$estim_or,$estim_ag,$estim_pt,$estim_pd,$poids  );
		return $data;
	 }	


	  function tarifcmd(Request $request) { 	
			 $user = auth()->user();  
    
					   $nature= $request->get('nature');
					   $estim_or= $request->get('estim_or');
					   $estim_ag= $request->get('estim_ag');
 					   $estim_pt= $request->get('estim_pt');
					   $estim_pd= $request->get('estim_pd');
					   $poids= $request->get('poids');
					   $poids_cdr = $request->get('poids_cdr');
					     
		$data= app('App\Http\Controllers\HomeController')->tarifdetails($nature,$estim_or,$estim_ag,$estim_pt,$estim_pd,$poids,$poids_cdr  );
		return $data;
	 }	

	 
	 
	  function tariflabo(Request $request) { 	
			 $user = auth()->user();  
			           $client= $request->get('client');
					   $choix= $request->get('choix');
					   $estim_or= $request->get('estim_or');
					   $estim_ag= $request->get('estim_ag');
 					   $estim_pt= $request->get('estim_pt');
					   $estim_pd= $request->get('estim_pd');
  					     
	   DB::select("SET @p0='$client' ;");
   	   DB::select("SET @p1='$choix' ;");
   	   DB::select("SET @p2='$estim_or' ;");
   	   DB::select("SET @p3='$estim_ag' ;");
   	   DB::select("SET @p4='$estim_pt' ;");
   	   DB::select("SET @p5='$estim_pd' ;");
    
 	  $result=  DB::select ("  CALL `sp_labo_tarif`(@p0,@p1,@p2,@p3,@p4,@p5); ");				 
						 
 		return $result;
	 }	




  function tarifrmp(Request $request) { 	
			 $user = auth()->user();  
    
					   $nature= $request->get('nature');
					   $estim_or= $request->get('estim_or');
					   $estim_ag= $request->get('estim_ag');
 					   $estim_pt= $request->get('estim_pt');
					   $estim_pd= $request->get('estim_pd');
					   $poids= $request->get('poids');
 					     
		$data= app('App\Http\Controllers\HomeController')->tarifrmp($nature,$estim_or,$estim_ag,$estim_pt,$estim_pd,$poids   );
		return $data;
	 }	

	 
	 
	 
	 
	 
	public function single($type,$famille1,$famille2,$famille3)
    {
        $produit=  DB::table('type_famille')->where('type_id',$type)->where('fam1_id',$famille1)->where('fam2_id',$famille2)->where('fam3_id',$famille3)->first();


        $product=app('App\Http\Controllers\HomeController')->produit($type,$famille1,$famille2,$famille3);

        return view('products.single',['product'=>$product,'produit'=>$produit,'type'=>$type,'famille1'=>$famille1,'famille2'=>$famille2,'famille3'=>$famille3]);
    }
	    
    public function modelabel (Request $request)
    {
       $id= $request->get('id');
	 $article=  DB::table('mode_facturation')->where('MODE_FACT_IDENT',$id)->first();
	 return $article->MODE_FACT_LIBC ;
   }

   
       public function updatecart(Request $request)
    {
        $id= $request->get('idprod');
        $poids= floatval($request->get('poids')) ;
        $montant= $request->get('montant') ;
         $qte= $request->get('qte') ;
        
        Product::where('id', $id)->update(array(
		'poids' => $poids,
		'montant' => $montant,
		'qte' => $qte
		
		));
		
		$product=Product::where('id', $id)->first();
		$products=Product::where('orderid', $product->orderid)->get();		
		$amount=0; 		$weight=0; 		$comp_amount=0; 
		$gold=0; 		$silver=0; 		$palladium=0; 		$platine=0;
		// parcours produit et calcul totaux
		foreach($products as $prod){
			$amount=$amount+$prod->montant  ;
			$weight=$weight+ floatval($prod->poids    );
			$comp_amount=$comp_amount+ floatval($prod->montant_compl    );
			$gold=$gold+ floatval($prod->gold    );
			$silver=$silver+ floatval($prod->silver    );
			$palladium=$palladium+ floatval($prod->palladium    );
			$platine=$platine+ floatval($prod->platine    );
		}
		// mise à jour de la commande
		Order::where('id',$product->orderid)->update(array(
		'amount' => $amount,
		'weight' => $weight,
		'comp_amount' => $comp_amount,
		'gold' => $gold,
		'silver' => $silver,
		'palladium' => $palladium,
		'platine' => $platine,
 		
		));

		
		
    }
	
	
	
 public function updating(Request $request)
    {
        $id= $request->get('order');
        $champ= strval($request->get('champ'));
        $val= $request->get('val');

        
         Order::where('id', $id)->update(array($champ => $val));

    }	
	
	
	
	
   
}
