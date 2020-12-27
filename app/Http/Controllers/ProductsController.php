<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\User ;
use App\Product ;
use App\Order ;
use DB ;

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
                                    <center><a title="'.__("msg.View product").'" href="'.route("single",['type'=>$type,'fam1'=>$famille1,'fam2'=>$prod->fam2_id,'fam3'=>$prod->fam3_id]).'"><img style="max-height:180px" src="'.$img.'" class="img-fluid" alt=""></a></center>
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
		 $article =  $request->get('article');
	     $montant = $request->get('montant'); 
	     $montant_compl =  $request->get('montant_compl');
	     $poids =  $request->get('poids');
	     $alliage =  $request->get('alliage');
 			
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
         
        ]);

        $product->save();
		// increment order totals
		
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
             'article' =>  $article ,
             'montant' =>  $montant ,
             'montant_compl' =>  $montant_compl ,
             'poids' =>  $poids ,
             'gold' =>  $or ,
             'silver' =>  $argent ,
             'palladium' =>  $palladium ,
             'platine' =>  $platine ,
         
        ]);		
		 $product->save();
		 
 		 }
		
      //  return  back();

	         
	 }
	 
	 	
     public function deleteproduct($id)
    {
	DB::table('products')->where('id', $id)->delete();
	// decrement order details
	return back();

	}
	 
	 
	 
	 
	 function details(Request $request) { 	
					   
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
 					   
		$data= app('App\Http\Controllers\HomeController')->detailsproduit($type,$famille1,$famille2,$famille3,$mesure1,$mesure2,$alliage_id,$qte,$comp_id,$comp_val,1);
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

}
