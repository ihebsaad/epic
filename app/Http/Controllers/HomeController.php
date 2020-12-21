<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB ;
use App\User ;
		use Illuminate\Support\Facades\App;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   public function __construct()
    {
         $this->middleware('auth');
    }
 
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

	 
	
	    public function setlanguage(Request $request)
    {
        $user= $request->get('user');
        $lg=  $request->get('lg') ;
        
        User::where('id', $user)->update(array('lg' => $lg));
		 app()->setLocale($lg);
    }
	
	    public function updating(Request $request)
    {
        $id= $request->get('user');
        $champ= strval($request->get('champ'));
        if($champ=='password'){
            $val= bcrypt(trim($request->get('val')));

        }else{
            $val= $request->get('val');

        }
         
        User::where('id', $id)->update(array($champ => $val));

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
                            <div class="card card-ecommerce">

                                <!--Card image-->
                                <div class="view overlay" style="min-height:180px">
                                    <center><img style="max-height:180px" src="'.$img.'" class="img-fluid" alt=""></center>
                                    <a>
                                        <div class="mask rgba-white-slight"></div>
                                    </a>
                                </div>
                                <!--Card image-->

                                <!--Card content-->
                                <div class="card-body">
                                    <!--Category & Title-->

                                    <h5 class="card-title mb-1" style="min-height:72px"><strong><a href="" class="dark-grey-text">'.$titre.'</a></strong></h5>
									<!--<span class="badge badge-danger mb-2">famille2</span>-->
 

                                    <!--Card footer-->
                                    <div class="card-footer pb-4 bg-primary mt-20 mb-10" style="color:white;height:40px;padding-bottom:4px">
                                        <div class="row mb-0">
                                          <!--  <span class="float-left"><strong>1439$</strong></span>-->
                                            <span class="float-right">

                                        <center><a style="color:white" href="'.route("single",['type'=>$type,'fam1'=>$famille1,'fam2'=>$prod->fam2_id,'fam3'=>$prod->fam3_id]).'" class="pb-5" data-toggle="tooltip" data-placement="top" title="'.__("msg.View product").'"><i class="fas fa-eye ml-3"></i> '.__("msg.View product").'</a></center>
                                        </span>
                                        </div>
                                    </div>
 
                                </div>
                                <!--Card content-->

                            </div>
                            <!--Card-->

                        </div>
						 
						 ';
					 }
					 return $data;

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
 					   
		$data=$this->detailsproduit($type,$famille1,$famille2,$famille3,$mesure1,$mesure2,$alliage_id,$qte,$comp_id,$comp_val,1);
		return $data;
	 }					   
	
	
	
	
	public function single($type,$famille1,$famille2,$famille3)
    {
        $produit=  DB::table('type_famille')->where('type_id',$type)->where('fam1_id',$famille1)->where('fam2_id',$famille2)->where('fam3_id',$famille3)->first();


        $product=app('App\Http\Controllers\HomeController')->produit($type,$famille1,$famille2,$famille3);

        return view('products.single',['product'=>$product,'produit'=>$produit,'type'=>$type,'famille1'=>$famille1,'famille2'=>$famille2,'famille3'=>$famille3]);
    }
	
	  public function filtres($code)
    { 
	   DB::select("SET @p0='$code'  ;");
	  $result=  DB::select (" CALL `sp_filtre_produit`(@p0);");
 
     if ($result!= null){
	 return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
      } else{

	  
           } 
 
    }
	
	
	
	 public function filtres2($code)
    { 
 	$result= response()->json( DB::table('type_famille')->where('CODEPRO',$code)->get(),200,array(),JSON_PRETTY_PRINT);
		if ($result!= null){
	 return $result;
		} else{
	 	 return 'Error';

			} 
 
    }
	 
	
     public function catalogue($code)
    { 
	
		$code= trim(  strtoupper($code)); 	   
	   $result=null;
	   
	   if(  $code =='S' || $code =='B' || $code =='G'  )
	   { DB::select("SET @p0='$code'  ;");
		$result=  DB::select (" CALL `sp_catalogue_produit`(@p0);");
		}
	   if(  $code =='D'    )
	   { $result=  DB::select (" CALL `sp_catalogue_demi_produit`();  ") ;}
		
 
     if ($result!= null){
	 return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
      } else{
	 	 return 'Error';

           } 
    }
		
		
	 public function metal_demi_produit($type,$fam)
    { 
 	   DB::select("SET @p0='$type' ;");
	   DB::select("SET @p1='$fam'  ;");

 	  $result=  DB::select ("  CALL `sp_metal_demi_produit`(@p0, @p1); ");
 
  if ($result!= null){
	 return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
 } else{
	 	 return 'Error';

 } 
 
    }	
		
	
	  public function tarif_article()
    { 
 
 	  $result=  DB::select (" CALL `sp_tarif_article(); ");
 
  if ($result!= null){
	 return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
 } else{
	 	 return 'Error';

 } 
 
    }
		 
	 	
		
	  public static function  alliage1($code,$fam1 )
    {   DB::select("SET @p0='$code' ;");
	   DB::select("SET @p1='$fam1'  ;");
	 	$result=  DB::select('call `sp_referentiel1_alliage`(@p0,@p1 ); ');
		return $result;
 
	} 
	
	
	   public function catalogue2($code,$fam1,$fam2,$fam3)
    {
	 	$result=  DB::select('call sp_filtre_produit(?)',array('B') ) ;
		return $result;
 
	}
	
	 
	 /**
     * @OA\Get(
     *   path="/referentiels/{lg}",
     *   summary="Liste des référentiels",
     *   operationId="referentiels",
	 *   tags={"Référentiels"},
     *   @OA\Response(response=200, description="opération exécutée avec succès"),
     *   @OA\Response(response=404, description="non trouvé"),
     *   @OA\Response(response=500, description="Erreur interne"),
	 *		@OA\Parameter(
     *          name="lg",
	 *          description="Langue",	 
     *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),		 
     *   security={
     *      {
     *           "passwords": { }
     *       }
     *    },	 
     * )
     *
     */
	 
	 	  public function referentiels ()
    { 
	// try {
		$referentiel=$this->referentiel();
	//	$referentiel1=$this->referentiel1();
		$referentiel1=$this->requete2();
		//$referentiel2=$this->referentiel2();
		$referentiel2=$this->req_referentiel2();
		$referentiel3=$this->referentiel3();
		$referentielmetal=$this->referentielmetal();
		$referentielalliage=$this->referentielalliage();
	    $referentieletat=$this->referentieletat();
		$referentielcomplement=$this->referentielcomplement();
		$referentielmodefacturation=$this->referentielmodefacturation();
		$referentielphoto=$this->referentielphoto();
		$referentielunite=$this->referentielunite();

		$result['type']=$referentiel;
		$result['famille1']=$referentiel1;
		$result['famille2']=$referentiel2;
		$result['famille3']=$referentiel3;
		$result['metal']=$referentielmetal;
		$result['alliage']=$referentielalliage;
		$result['etat']=$referentieletat;
		$result['complement']=$referentielcomplement;
		$result['modefacturation']=$referentielmodefacturation;
		$result['photo']=$referentielphoto;
		$result['unite']=$referentielunite;
 		
 //$result=array_merge($referentiel,$referentiel1,$referentiel2,$referentiel3,$referentielmetal,$referentielalliage,$referentieletat,$referentielcomplement,$referentielmodefacturation,$referentielphoto,$referentielunite);
 
 
   if ($result!= null){
	 return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
 } else{

 	  $error = array(
    "status" => "error",
    "error_code" => 404,
    "error_message" => "Aucun résultat trouvé",
);
		return response()->json(  $error ,404,array(),JSON_PRETTY_PRINT);
		
		
 } 
 
 /* }catch (\Exception $e){
	
 		  $error = array(
    "status" => "error",
    "error_code" => 500,
    "error_message" => "erreur interne",
);
		return response()->json(  $error ,500,array(),JSON_PRETTY_PRINT);
		
 }
 */
 
    }
	 
	 
	 
	 
	 
	 
	  public function referentiel ()
    { 
 
 	  $result=  DB::select ("CALL `sp_referentiel0`();");
 
  if ($result!= null){
	// return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	 return   $result  ;
 } else{
	 	 return 'Error';

 } 
 
    }
 
	 

	  public static function referentiel1 ()
    { 
 
 	  $result=  DB::select ("CALL `sp_referentiel1`(); ");
 
  if ($result!= null){
	// return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	return  $result  ;
 } else{
	 	 return 'Error';

 } 
 
    }

	 
	 
	  public function referentiel2 ()
    { 
 
 	  $result=  DB::select ("CALL `sp_referentiel2`();");
 
  if ($result!= null){
	// return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	 return    $result  ;
 } else{
	 	 return 'Error';

 } 
 
    }
	
  public static function req_referentiel2 ()
    { 
 
   $data=  DB::select ("CALL `sp_referentiel2`(); ");

  if ($data!= null){

$result=array();
$i=-1;
  foreach($data as $d)
  { $i++;
  $famille=$d->id;
  $libelle=$d->libelle;
  $parents=array();
  
  // 	   DB::select("SET @p0='$famille' ;");

  //   $data2=  DB::select ("CALL `sp_referentiel2_parent`(@p0)");
	  $data2=  DB::table("type_famille")->where('fam2_id',$famille)->distinct('fam1_id')->pluck('fam1_id');
	  
 
  $parents = $data2 ;
  
  $result[$i]['famille2']=$famille;
  $result[$i]['libelle']=$libelle;
  $result[$i]['parents']=$parents;
  
  }
 
    }
	return $result ;
   }
	
	
	
		  public static function referentiel3 ()
    { 
 
 	  $result=  DB::select ("CALL `sp_referentiel3`();");
 
  if ($result!= null){
	// return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	 return   $result  ;
 } else{
	 	 return 'Error';

 } 
 
    }
	
    
	  public function referentielmetal ()
    { 
 
 	  $result=  DB::select ("CALL `sp_referentiel_metal`();");
 
  if ($result!= null){
	 // return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	 return $result  ;
 } else{
	 	 return 'Error';

 } 
 
    }

 
	  public function referentielphoto ()
    { 
 
 	  $result=  DB::select ("CALL `sp_referentiel_photo`();");
 
  if ($result!= null){
	 return  $result  ;
 } else{
	 	 return 'Error';

 } 
 
    }
	 
		  public function referentielunite ()
    { 
 
 	  $result=  DB::select ("CALL `sp_referentiel_unite`();");
 
  if ($result!= null){
	 // return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	 return  $result  ;
 } else{
	 	 return 'Error';

 } 
 
    }
	
	 
	
		  public static function referentieletat ()
    { 
 
 	  $result=  DB::select ("CALL `sp_referentiel_etat`();");
 
  if ($result!= null){
	// return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	 return   $result  ;
 } else{
	 	 return 'Error';

 } 
 
    }	
	
	 	
	
	  public function referentielcomplement ()
    { 
 
 	  $result=  DB::select ("CALL `sp_referentiel_complement`();");
 
  if ($result!= null){
	// return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	 return  $result ;
 } else{
	 	 return 'Error';

 } 
 
    }
	
  	
	
	  public function referentielmodefacturation ()
    { 
 
 	  $result=  DB::select ("CALL `sp_referentiel_mode_facturation`();");
 
  if ($result!= null){
	// return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	 return  $result  ;
 } else{
	 	 return 'Error';

 } 
 
    }

	
	
	
	
	  public function referentieltitre ()
    { 
 
 	  $result=  DB::select ("CALL `sp_referentiel_titre`();");
 
  if ($result!= null){
	 return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
 } else{
	 	 return 'Error';

 } 
 
    }

	  public function referentielcouleur ()
    { 
 
 	  $result=  DB::select ("CALL `sp_referentiel_couleur`();");
 
  if ($result!= null){
	 return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
 } else{
	 	 return 'Error';

 } 
 
    }

 
   public function requete1 ($id)
   {
	 $article=  DB::table('demi_produit')->where('DP_IDENT',$id)->first();
	// $typefamille=  DB::table('type_famille')->where('type_id',$type_id)->orderBy('page_cat', 'ordre')->first();
	// $typefamille =  $typefamille->unique();
	 
	// if($article!=null)
	 {$typefamille=  DB::table('type_famille')->where('type_id',$article->typeid)->first();}
 
	 
	 $results=array();
	 $results['art_ident']=$article->DP_IDENT;
	 $results['codepro']=$article->CODEPRO;
	 $results['libpro']=$typefamille->LIBPRO;
	 $results['Codefam1']=$article->CODEFAM1;
	 $results['Codefam2']=$article->CODEFAM2;
	 $results['Codefam3']=$article->CODEFAM3;
	 $results['nat_mesure1']=$article->NAT_MESURE1;
	 $results['mesure1']=$article->MESURE1;
	 $results['nat_mesure2']=$article->NAT_MESURE2;
	 $results['photo_ident']=$typefamille->photo_id;
	// $results['metal_ident']=$article->metal_ident;
	 
	   
	 if($typefamille!= null){
		// return $result;
		 return response()->json(  $results ,200,array(),JSON_PRETTY_PRINT);
	 }else{
	  return 'Error';

	 }
	 
   }
 
    
 
    public static function referentielalliage ()
    { 
 
 	  $result=  DB::select ("CALL `Sp_referentiel_alliage`(); ");
 
  if ($result!= null){
	// return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	 return   $result  ;
 } else{
	 	 return 'Error';

 } 
 
    }
	
	
	    public function requete2 ()
    { 
 
 	  $data=  DB::select ("CALL `Sp_referentiel1`(); ");

  if ($data!= null){

$result=array();
$i=-1;
  foreach($data as $d)
  { $i++;
  $famille=$d->id;
  $type_id=$d->type_id; 

 $data2=\App\Lien_alliage_produit::where(function ($query) use($type_id )   {
                      $query->where('type_id', $type_id );
                        
                  })->where(function ($query) use($famille)  {
                      $query->where('fam1_id' , $famille)
                          ->orWhere('fam1_id', 0);
   
                  })->pluck('ALLIAGE_IDENT');

 
  $result[$i]['id']=$famille;
  $result[$i]['libelle']=$d->libelle;
  $result[$i]['type_id']=$type_id;
 
 $result[$i]['alliage']=$data2;
  }
	// return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	 return   $result ;

  } else{
	 	 return 'Error';

 } 
 
    }
   
   
   
   
   
   /*************  Produits   *************/
    
      /**
     * @OA\Get(
     *   path="/produit/{type_id}/{fam1}/{fam2}/{fam3}/{id_cl}/{lg}",
     *   summary="Fiche du produit",
     *   description="<b>En entrée</b> : identifiant type, famille 1, 2, 3 <br><b>En sortie</b> :  libellé, nature de mesure1, nature de mesure 2, unité, choix ou non de l’état",
     *   operationId="fiche_produit",
     *   tags={"Produits"},
     *   @OA\Response(response=200, description="opération exécutée avec succès"),
     *   @OA\Response(response=404, description="non trouvé"),
     *   @OA\Response(response=500, description="Erreur interne"),
	 *		@OA\Parameter(
     *          name="type_id",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )     
	 *      ),
	 *		@OA\Parameter(
     *          name="fam1",
	 *          description="Famille 1",	 
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="fam2",
	 *          description="Famille 2",	 	 
     *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="fam3",
	 *          description="Famille 3",	 	 
     *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="string",
     *              default="0"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="id_cl",
	 *          description="ID du client",	 
     *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="lg",
	 *          description="Langue",	 
     *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	 	 
     *   security={
     *      {
     *           "passwords": { }
     *       }
     *    },	 
     * )
     *
     */
	 
 
      	 public   function produit($typeid,$fam1,$fam2,$fam3)
    { 
//	try {
 	   DB::select("SET @p0='$typeid' ;");
	   DB::select("SET @p1='$fam1'  ;");
	   DB::select("SET @p2='$fam2'  ;");
	   DB::select("SET @p3='$fam3'  ;");

 	  $data=  DB::select ("  CALL `sp_fiche_produit`(@p0,@p1,@p2,@p3); ");
 
 $result=array();
$i=-1;
  foreach($data as $d)
  { $i++;
  $libelle=$d->libelle;
  $NAT_MESURE1=$d->NAT_MESURE1;
  $NAT_MESURE2=$d->NAT_MESURE2;
   $UNIT_IDENT=$d->UNIT_IDENT;
  // $choix_etat=$d->etatid;
 // $choix_etat=$d->choix_etat;
 
 
   $result[$i]['libelle']=$libelle;
   $result[$i]['NAT_MESURE1']=$NAT_MESURE1;
   $result[$i]['NAT_MESURE2']=$NAT_MESURE2;
    $result[$i]['UNIT_IDENT']=$UNIT_IDENT;
  // $result[$i]['choix_etat']=$choix_etat;
   
   $produitmesure1 =$this->produitmesure1($typeid,$fam1,$fam2,$fam3);
    $result[$i]['mesures']=$produitmesure1 ;
 
   $result[$i]['complements']=$this->produitcomplement($typeid,$fam1,$fam2,$fam3);
   
  }

if ($data!= null){
	// return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	  return $result  ;
	  }
	  else{
		  /*
  $error = array(
    "status" => "error",
    "error_code" => 404,
    "error_message" => "Aucun résultat trouvé",
);
		return response()->json(  $error ,404,array(),JSON_PRETTY_PRINT);
*/
		  return 'error' ;
		}
	
/*	 }catch (\Exception $e){
	
 		  $error = array(
    "status" => "error",
    "error_code" => 500,
    "error_message" => "erreur interne",
);
		return response()->json(  $error ,500,array(),JSON_PRETTY_PRINT);
		
 }
 */
 
}
      
   
   	 public function produitcomplement($typeid,$fam1,$fam2,$fam3)
    { 
 	   DB::select("SET @p0='$typeid' ;");
	   DB::select("SET @p1='$fam1'  ;");
	   DB::select("SET @p2='$fam2'  ;");
	   DB::select("SET @p3='$fam3'  ;");

 	  $result=  DB::select ("  CALL `sp_fiche_produit_complement`(@p0,@p1,@p2,@p3); ");
 
  if ($result!= null){
	// return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	 return  $result  ;
			} else{
	 	 return 'Error';

			} 
 
    }   
   
     
   
   	 public function produitmesure1($typeid,$fam1,$fam2,$fam3)
    { 
 	   DB::select("SET @p0='$typeid' ;");
	   DB::select("SET @p1='$fam1'  ;");
	   DB::select("SET @p2='$fam2'  ;");
	   DB::select("SET @p3='$fam3'  ;");

 	  $result=  DB::select ("  CALL `sp_fiche_produit_val_mesure1`(@p0,@p1,@p2,@p3); ");
 $c=0;
  foreach ($result as $r)
  {  
//  dd($r->NAT_MESURE2);
  $mesure2= $this->produitmesure2($typeid,$fam1,$fam2,$fam3,$r->MESURE1 );
 // dd($mesure2["0"]) ;
 	$r->MESURE2= $mesure2;
   }
 
  if ($result!= null){
	// return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	 return   $result  ;
			} else{
	 	 return 'Error';

			} 
 
    }

	 
   	 public function produitmesure2($typeid,$fam1,$fam2,$fam3,$mes1)
    { 
		$mes1=floatval($mes1);
 	   DB::select("SET @p0='$typeid' ;");
	   DB::select("SET @p1='$fam1'  ;");
	   DB::select("SET @p2='$fam2'  ;");
	   DB::select("SET @p3='$fam3'  ;");
	   DB::select("SET @p4='$mes1'  ;");

 	  $result=  DB::select ("  CALL `sp_fiche_produit_val_mesure2`(@p0,@p1,@p2,@p3,@p4); ");
		
  if ($result!= null){
	// return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	 return   $result  ;
			} else{
	 	 return 'Error';

			} 
 
    }       
   
   
     /**
     * @OA\Get(
     *   path="/detailsproduit/{type_id}/{fam1}/{fam2}/{fam3}/{mes1}/{mes2}/{alliage}/{qte}/{id_comp}/{val_comp}/{id_cl}/{lg}",
     *   summary="détails du poids, prix et tarif du produit",
     *   description="<b>En entrée</b> : identifiant type, famille 1, 2, 3, valeur mesure1 et mesure2, identifiant alliage...",
     *   operationId="detproduit",
     *   tags={"Produits"},
     *   @OA\Response(response=200, description="opération exécutée avec succès"),
     *   @OA\Response(response=404, description="non trouvé"),
     *   @OA\Response(response=500, description="Erreur interne"),
	 *		@OA\Parameter(
     *          name="type_id",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="fam1",
     *          description="Famille 1",	 
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="fam2",
     *          description="Famille 2",	 
     *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="fam3",
     *          description="Famille 3",
     *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="mes1",
     *          description="Mesure 1",	 
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ), 
	 *		@OA\Parameter(
     *          name="mes2",
     *          description="Mesure 2",
     *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),	 
	 *		@OA\Parameter(
     *          name="alliage",
     *          description=" ID de l'alliage",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),	
	 *		@OA\Parameter(
     *          name="qte",
     *          description="Quantité",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),	 
	 *		@OA\Parameter(
     *          name="id_comp",
	 *          description="ID du complément",
     *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="val_comp",
	 *          description="Valeur du complément",	 
     *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="id_cl",
	 *          description="ID du client",	 
     *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="lg",
	 *          description="Langue",	 
     *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	 
     *   security={
     *      {
     *           "passwords": { }
     *       }
     *    },	 
	 * )
     *
     */
   
   	 public function detailsproduit($typeid,$fam1,$fam2,$fam3,$mes1,$mes2,$all,$qte,$id_comp,$val_comp,$id_cl)
    {
	//	try {
		$results=array();
		$produit=$this->produitpoids($typeid,$fam1,$fam2,$fam3,$mes1,$mes2,$all);
		//dd($produit[0]->produit );
		$poidsu=0; $articleid=0;
		
		
 		if (($produit!='Error')){
		 $poidsu=$produit[0]->poids_u;
 		$articleid=$produit[0]->produit ;

		}else{
			 return 'Error';
		}
		
 		$results['poids_u']=$poidsu;
		$qte=intval($qte);
		$poids=  ($poidsu)* ($qte);
		$results['produit']=$articleid;
 		$results['prix']=$this->prix($typeid,$articleid,$all,$qte,$poidsu,$id_cl );
 		//dd($typeid,$articleid,$all,$qte,$poidsu,$id_cl );
		 $results['tarif']=$this->tarif($id_comp,$val_comp,$id_cl,$qte,$poidsu) ;
		
		  if ($results['prix']!= null){
	// return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	// return response()->json(  $results ,200,array(),JSON_PRETTY_PRINT);
	 return    $results  ;

	 } else{

	   $error = array(
    "status" => "error",
    "error_code" => 404,
    "error_message" => "Aucun résultat trouvé",
);
		return response()->json(  $error ,404,array(),JSON_PRETTY_PRINT);
		
			} 
	
	
/*	 }catch (\Exception $e){
	
 		  $error = array(
    "status" => "error",
    "error_code" => 500,
    "error_message" => "erreur interne",
);
		return response()->json(  $error ,500,array(),JSON_PRETTY_PRINT);
		
 }*/
 
 
	}
   
   
   
    
    
   	 public function produitpoids($typeid,$fam1,$fam2,$fam3,$mes1,$mes2,$all)
    { 
 	   DB::select("SET @p0='$typeid' ;");
	   DB::select("SET @p1='$fam1'  ;");
	   DB::select("SET @p2='$fam2'  ;");
	   DB::select("SET @p3='$fam3'  ;");
	   DB::select("SET @p4='$mes1'  ;");
	   DB::select("SET @p5='$mes2'  ;");
	   DB::select("SET @p6='$all'  ;");

 	  $result=  DB::select ("  CALL `sp_fiche_produit_poids_id`(@p0,@p1,@p2,@p3,@p4,@p5,@p6); ");
 
  if ($result!= null){
	// return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	 return $result;
			} else{
	 	 return 'Error';

			} 
 
    }       
   
 
   	 public function tarif($id_comp,$val_comp,$id_cl,$qte,$poids)
    { 
 	   DB::select("SET @p0='$id_comp' ;");
	   DB::select("SET @p1='$val_comp'  ;");
	   DB::select("SET @p2='$id_cl'  ;");
	   DB::select("SET @p3='$qte'  ;");
	   DB::select("SET @p4='$poids'  ;");
 
 	  $result=  DB::select ("  CALL `sp_fiche_produit_compl_tarif`(@p0,@p1,@p2,@p3,@p4); ");
 
  if ($result!= null){
	 return  $result;
			} else{
	 	 return 'Error';

			} 
 
    }   
   

      
     /**
     *  
     *   path="/compprix",
     *   summary="Complément du prix de la fiche du produit",
     *   description="<b>En entrée</b> : identifiant du complément, quantité, poids, id client, valeur du complément <br><b>En sortie</b> : montant",
     *   operationId="compprix",
     *   tags={"Produits"},
     *   @OA\Response(response=200, description="opération exécutée avec succès"),
     *   @OA\Response(response=404, description="non trouvé"),
     *   @OA\Response(response=500, description="Erreur interne"),
	 *		@OA\Parameter(
     *          name="id_comp",
     *          in="path",
     *          description="ID du complément",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="qte",
     *          description="Quantité",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="poids",
	 *          description="Poids",	 
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="id_cl",
     *          description="ID du client",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="val_comp",
     *          description="Valeur du complément",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="lg",
	 *          description="Langue",	 
     *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	 	 
     *   security={
     *      {
     *           "passwords": { }
     *       }
     *    },	 
     * )
     *
     */
   
   	 public function compprix($id_comp,$qte,$poids,$id_cl,$val_comp )
    { 
//	try {
 	   DB::select("SET @p0='$id_comp' ;");
 	   DB::select("SET @p1='$qte' ;");
 	   DB::select("SET @p2='$poids' ;");
	   DB::select("SET @p3='$id_cl'  ;");
	   DB::select("SET @p4='$val_comp'  ;");
 
 	  $result=  DB::select ("  CALL `sp_fiche_produit_compl_prix`(@p0,@p1,@p2,@p3,@p4); ");
 
  if ($result!= null){
	 return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
			} else{
	 	 return 'Error';

			} 
 
 
 /* }catch (\Exception $e){
	
 		  $error = array(
    "status" => "error",
    "error_code" => 500,
    "error_message" => "erreur interne",
);
		return response()->json(  $error ,500,array(),JSON_PRETTY_PRINT);
		
 }*/
 
 
 
    }

 
 
    
     /**
     * @OA\Get(
     *   path="/prix/{type_id}/{article_id}/{alliage_id}/{qte}/{poids}/{id_cl}/{lg}",
     *   summary="détails du prix du produit",
     *   description="<b>En entrée</b> : identifiant type, famille 1, 2, 3, valeur mesure1 et mesure2, identifiant alliage...",
     *   operationId="prix_produit",
     *   tags={"Produits"},
     *   @OA\Response(response=200, description="opération exécutée avec succès"),
     *   @OA\Response(response=404, description="non trouvé"),
     *   @OA\Response(response=500, description="Erreur interne"),
	 *		@OA\Parameter(
     *          name="type_id",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="article_id",
     *          description="ID du produit",	 
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="alliage_id",
     *          description=" ID de l'alliage",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	
	 *		@OA\Parameter(
     *          name="qte",
     *          description="Quantité",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	 
	 *		@OA\Parameter(
     *          name="poids",
	 *          description="Poids (Qté * poid unitaire)",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="id_cl",
	 *          description="ID du client",	 
     *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="lg",
	 *          description="Langue",	 
     *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	 
	 
     *   security={
     *      {
     *           "passwords": { }
     *       }
     *    },	 
	 * )
     *
     */
   
   	 public function prix($typeid,$articleid,$alliageid,$qte,$poids,$id_cl )
    {
 //   try {		
 	   DB::select("SET @p0='$typeid' ;");
 	   DB::select("SET @p1='$articleid' ;");
 	   DB::select("SET @p2='$alliageid' ;");
	   DB::select("SET @p3='$qte'  ;");
	   DB::select("SET @p4='$poids'  ;");
	   DB::select("SET @p5='$id_cl'  ;");
 
 	  $result=  DB::select ("  CALL `sp_fiche_produit_prix`(@p0,@p1,@p2,@p3,@p4,@p5); ");
 
  if ($result!= null){
	 return   $result  ;
			} else{
  $error = array(
    "status" => "error",
    "error_code" => 404,
    "error_message" => "Aucun résultat trouvé",
);
		return response()->json(  $error ,404,array(),JSON_PRETTY_PRINT);
			} 
 
 
 /* }catch (\Exception $e){
	
 		  $error = array(
    "status" => "error",
    "error_code" => 500,
    "error_message" => "erreur interne",
);
		return response()->json(  $error ,500,array(),JSON_PRETTY_PRINT);
		
 }*/
 
 
    }	
	

	
 
	 public function clients( )
    { 
  
 	  $data=  DB::select ("  CALL `sp_liste_contact`(); ");
 
 $result=array();
$i=-1;
  foreach($data as $d)
  { $i++;
  $contactid=$d->contactid;
  $nom=$d->nom;
  $email=$d->email;
  $cl_ident=$d->cl_ident;
 
 
   $result[$i]['contactid']=$contactid;
   $result[$i]['nom']=$nom;
   $result[$i]['email']=$email;
   $result[$i]['client_id']=$cl_ident;
 	$data3=  $this->adresse2($cl_ident);
     $result[$i]['adresse_livraison']=$data3;

	} // data
	
     
	  if ($result!= null){
	 return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	  }
	  else{
		  
  $error = array(
    "status" => "error",
    "error_code" => 404,
    "error_message" => "Aucun résultat trouvé",
);
	 return response()->json(  $error ,404,array(),JSON_PRETTY_PRINT);

		}
	
	
	}	
	
	
	
	 /**
     * @OA\Get(
     *   path="/checkclient/{siren}/{lg}",
     *   summary="Vérifier le client par numéro siren (8 chiffres)",
     *   operationId="contacts",
     *   tags={"Clients"},
     *   @OA\Response(response=200, description="opération exécutée avec succès"),
     *   @OA\Response(response=404, description="non trouvé"),
     *   @OA\Response(response=500, description="Erreur interne"),
	 *		@OA\Parameter(
     *          name="siren",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="lg",
	 *          description="Langue",	 
     *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	 
     *   security={
     *      {
     *           "passwords": { }
     *       }
     *    },	 
     * )
     *
     */
	
		 public function checkclient($siren )
    { 
  //	try {
   	   DB::select("SET @p0='$siren' ;");

 	  $result=  DB::select ("  CALL `sp_check_client`(@p0); ");
 
	  if ($result!= null){
	 return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	  }
	  else{
		  
  $error = array(
    "status" => "error",
    "error_code" => 404,
    "error_message" => "Aucun résultat trouvé",
);
		return response()->json(  $error ,404,array(),JSON_PRETTY_PRINT);

		}
	
/*	 }catch (\Exception $e){
	
 		  $error = array(
    "status" => "error",
    "error_code" => 500,
    "error_message" => "erreur interne",
);
		return response()->json(  $error ,500,array(),JSON_PRETTY_PRINT);
		
 }*/
 
 
	}	
	
	
	 /**
     * @OA\Get(
     *   path="/agences/{code_pays}/{id_cl}/{lg}",
     *   summary="Liste des agences par pays",
     *   operationId="agence",
     *   tags={"Clients"},
     *   @OA\Response(response=200, description="opération exécutée avec succès"),
     *   @OA\Response(response=404, description="non trouvé"),
     *   @OA\Response(response=500, description="Erreur interne"),
 	 *		@OA\Parameter(
     *          name="code_pays",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="id_cl",
	 *          description="ID du client",	 
     *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="lg",
	 *          description="Langue",	 
     *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	 	 
     *   security={
     *      {
     *           "passwords": { }
     *       }
     *    },	 
     * )
     *
     */		


		 public function agences( $code_pays)
    { 
//	try {
     	   DB::select("SET @p0='$code_pays' ;");

 	  $result=  DB::select ("  CALL `sp_liste_agence`(@p0); ");
 
	  if ($result!= null){
	 return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	  }
	  else{
		  
  $error = array(
    "status" => "error",
    "error_code" => 404,
    "error_message" => "Aucun résultat trouvé",
);
		return response()->json(  $error ,404,array(),JSON_PRETTY_PRINT);

		}
	
	/* }catch (\Exception $e){
	
 		  $error = array(
    "status" => "error",
    "error_code" => 500,
    "error_message" => "erreur interne",
);
		return response()->json(  $error ,500,array(),JSON_PRETTY_PRINT);
		
 }*/
 
 
	}	


 
	

	  public function listeclients($contact_id  )
    { 
   	   DB::select("SET @p0='$contact_id' ;");

 	  $result=  DB::select ("  CALL `sp_liste_client`(@p0); ");
 
	  if ($result!= null){
	 return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	  }
	  else{
		  
		return 'Error';  
	  }
	
	
	}	
	
	
	   public function listeclients2($contact_id  )
    { 
   	   DB::select("SET @p0='$contact_id' ;");

 	  $result=  DB::select ("  CALL `sp_liste_client`(@p0); ");
 
	  if ($result!= null){
	 return $result;
	  }
	  else{
		  
		return 'Error';  
	  }
	
	
	}	


	
 
	


	  public function adresse($client_id  )
    { 
   	   DB::select("SET @p0='$client_id' ;");

 	  $result=  DB::select ("  CALL `sp_liste_adresse_livraison`(@p0); ");
 
	  if ($result!= null){
	 return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	  }
	  else{
		  
		return 'Error';  
	  }
	
	
	}		
	
	
	
	
	
	  public function adresse2($client_id  )
    { 
   	   DB::select("SET @p0='$client_id' ;");

 	   $result=  DB::select ("  CALL `sp_liste_adresse_livraison`(@p0); ");
  
	  if ($result!= null){
	 return $result;
	  }
	  else{
		  
		return 'Error';  
	  }
	
	
	}
	
	
	
	  public function  liste_contact($client_id  )
    { 
   	   DB::select("SET @p0='$client_id' ;");

 	//  $result=  DB::select ("  CALL `sp_liste_adresse_livraison`(@p0); ");
 	  $result=  DB::select ("  CALL `sp_liste_contact`(@p0); ");
 
	  if ($result!= null){
	 return $result;
	  }
	  else{
		  
		return 'Error';  
	  }
	
	
	}
	
	
	
	
	 /**
     * @OA\Get(
     *   path="/detailsclient/{id_cl}/{lg}",
     *   summary="Détails du clinet",
     *   operationId="detailcl",
     *   tags={"Clients"},
     *   @OA\Response(response=200, description="opération exécutée avec succès"),
     *   @OA\Response(response=404, description="non trouvé"),
     *   @OA\Response(response=500, description="Erreur interne"),
 	 *		@OA\Parameter(
     *          name="id_cl",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ) ,
	 *		@OA\Parameter(
     *          name="lg",
	 *          description="Langue",	 
     *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	 	 
     *   security={
     *      {
     *           "passwords": { }
     *       }
     *    },	 
     * )
     *
     */		

		
	
	  public function detailsclient($client_id  )
    { 
	// try {
	$liste=$this->listeclients2($client_id);
	$adresses=$this->adresse2($client_id);
	$contact=$this->liste_contact($client_id);
	$result=array();
    $result['client']=$liste;
    $result['adresses']=$adresses;
    $result['contact']=$contact;
	
	  if ($result!= null){
	 return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	  }
	  else{
		  
  $error = array(
    "status" => "error",
    "error_code" => 404,
    "error_message" => "Aucun résultat trouvé",
);
		return response()->json(  $error ,404,array(),JSON_PRETTY_PRINT);

		}
	
	/* }catch (\Exception $e){
	
 		  $error = array(
    "status" => "error",
    "error_code" => 500,
    "error_message" => "erreur interne",
);
	 return response()->json(  $error ,500,array(),JSON_PRETTY_PRINT);
		
 }*/
 
	
	}
	
/*************************************************** Commandes ***************************************************************/

	
	
				
	
 /**
     * @OA\Post(
     *   path="/commande",
     *   summary="Ajouter une commande",
     *   operationId="commande",
     *   tags={"Commandes"},
     *   @OA\Response(response=200, description="opération exécutée avec succès"),
     *   @OA\Response(response=404, description="non trouvé"),
     *   @OA\Response(response=500, description="Erreur interne"),
 *     @OA\RequestBody(
 *        required = true,
 *        description = "Data packet for Test",
 *        @OA\JsonContent(
 *             type="object",
 *      @OA\Property(property="client_id", type="number",example="10099"),
 *      @OA\Property(property="langue", type="string",example="fr_FR"),
 *      @OA\Property(property="quantite", type="number",example="10"),
 *      @OA\Property(property="poids", type="number",example="20"),
 *      @OA\Property(property="or", type="number",example="15"),
 *      @OA\Property(property="argent", type="number",example="2.5"),
 *      @OA\Property(property="platine", type="number",example="0"),
 *      @OA\Property(property="palladium", type="number",example="0"),
 *      @OA\Property(property="facon", type="number",example="35"),
 *      @OA\Property(property="adresse", type="number",example="0"),
 *      @OA\Property(property="agence", type="number",example="1"),
 *             @OA\Property(
 *                property="produits",
 *                type="array",
 *                example={{
 *                  "produit_id": "1",
 *                  "type_id": "1",
 *                  "alliage_id": "1",
 *                  "etat_id": "1",
 *                  "complement_id": "1",
 *                  "complement_val": "1",
 *                  "quantite": "1",
 *                  "poids": "1",
 *                  "tarif": "1",
 *                  "mode_facturation": "1",
 *                }},
 *                @OA\Items(
 *                      @OA\Property(
 *                         property="produit_id",
 *                         type="number",
 *                         example=""
 *                      ),
 *                      @OA\Property(
 *                         property="type_id",
 *                         type="number",
 *                         example=""
 *                      ),
 *                      @OA\Property(
 *                         property="alliage_id",
 *                         type="number",
 *                         example=""
 *                      ),
 *                      @OA\Property(
 *                         property="etat_id",
 *                         type="number",
 *                         example=""
 *                      ),
 *                      @OA\Property(
 *                         property="complement_id",
 *                         type="number",
 *                         example=""
 *                      ),
 *                      @OA\Property(
 *                         property="complement_val",
 *                         type="number",
 *                         example=""
 *                      ),
 *                      @OA\Property(
 *                         property="quantite",
 *                         type="number",
 *                         example=""
 *                      ),
 *                      @OA\Property(
 *                         property="poids",
 *                         type="number",
 *                         example=""
 *                      ),
 *                      @OA\Property(
 *                         property="tarif",
 *                         type="number",
 *                         example=""
 *                      ), 
 *                      @OA\Property(
 *                         property="mode_facturation",
 *                         type="number",
 *                         example=""
 *                      ),
 *                ),
 *             ),
 
 
 *        ),
 *     ),
     *   security={
     *      {
     *           "passwords": { }
     *       }
     *    },	 
     * )
     *
     */			
	
	  public function commande(Request $request)
{
 // try{
$client_id  = intval($request->get('client_id'));	
$langue   = $request->get('langue');	
$quantite = intval($request->get('quantite'));	
$poids  = floatval($request->get('poids'));	
$or  = floatval($request->get('or'));	
$argent  = floatval($request->get('argent'));	
$platine  = floatval($request->get('platine'));	
$palladium  = floatval($request->get('palladium'));	
$facon   = floatval($request->get('facon'));	
$adresse    = intval($request->get('adresse'));	 
$agence    = intval($request->get('agence'));	 
$produits = $request->get('produits') ;
 
 DB::select("SET @p0='$client_id' ;");
 DB::select("SET @p1='$langue' ;");
 DB::select("SET @p2='$quantite' ;");
 DB::select("SET @p3='$poids' ;");
 DB::select("SET @p4='$or' ;");
 DB::select("SET @p5='$argent' ;");
 DB::select("SET @p6='$platine' ;");
 DB::select("SET @p7='$palladium' ;");
 DB::select("SET @p8='$facon' ;");
 DB::select("SET @p10='$adresse' ;");
 DB::select("SET @p11='$agence' ;");

   DB::select ("  CALL `SP_cmde_e_insert`(@p0,@p1,@p2,@p3,@p4,@p5,@p6,@p7,@p8,@p9,@p10,@p11 ); ");
//	$result=   DB::select("SELECT @p9 AS `cmde_id`  ;");
 
 	 $cmde_id = null;
$selectResult = DB::select(DB::raw("SELECT @p9 AS `cmde_id`  ;"));

if (!empty($selectResult) && isset($selectResult[0]->cmde_id)) {
    // we have a result
    $cmde_id = $selectResult[0]->cmde_id;
	
}  
	  
	  if (intval($cmde_id) > 0) {
 	  $i=0;
 	  foreach ($produits as $produit)
	  {
  $i++;
$produit_id  = intval($produit['produit_id']);	
$type_id   = intval($produit['type_id']);
$alliage_id   = intval($produit['alliage_id']);
$etat_id   = intval($produit['etat_id']);
$comp_id   = intval($produit['complement_id']);
$comp_val   = floatval($produit['complement_val']);
$quantite = floatval($produit['quantite']);
$poids  = floatval($produit['poids']);
$tarif   = floatval($produit['tarif']);	
$mode_facturation    = intval($produit['mode_facturation']); 
  

 DB::select("SET @p0='$produit_id' ;");
 DB::select("SET @p1='$type_id' ;");
 DB::select("SET @p2='$alliage_id' ;");
 DB::select("SET @p3='$etat_id' ;");
 DB::select("SET @p4='$comp_id' ;");
 DB::select("SET @p5='$comp_val' ;");
 DB::select("SET @p6='$quantite' ;");
 DB::select("SET @p7='$poids' ;");
 DB::select("SET @p8='$tarif' ;");
 DB::select("SET @p9='$mode_facturation' ;");
 DB::select("SET @p10='$cmde_id' ;");

  $result=  DB::select ("  CALL `SP_cmde_l_insert`(@p0,@p1,@p2,@p3,@p4,@p5,@p6,@p7,@p8,@p9,@p10 ); ");
	  
}

$result ='commande ajoutée, numéro : '.$cmde_id.' (avec '.$i.' produits)';
return $result ;

	  }
	  else{
 		  $error = array(
    "status" => "error",
    "error_code" => 500,
    "error_message" => "erreur interne",
);
		return response()->json(  $error ,500,array(),JSON_PRETTY_PRINT);
	  }
	  
/* }catch (\Exception $e){
	
 		  $error = array(
    "status" => "error",
    "error_code" => 500,
    "error_message" => "votre commande ne peut pas aboutir",
);
		return response()->json(  $error ,500,array(),JSON_PRETTY_PRINT);
		
 }*/
	  
	  
	  
	  
	  
	}
	
	
	
	 
	
	
	
	
	
	
	
	
	
	 /**
     * @OA\Post(
     *   path="/entetecommande",
     *   summary="Ajouter l'entête de commande",
     *   operationId="entetecommande",
     *   tags={"Commandes"},
     *   @OA\Response(response=200, description="opération exécutée avec succès"),
     *   @OA\Response(response=404, description="non trouvé"),
     *   @OA\Response(response=500, description="Erreur interne"),
 	 *		@OA\Parameter(
     *          name="client_id",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ) ,
	 *		@OA\Parameter(
     *          name="langue",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="quantite",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),	 
	 *		@OA\Parameter(
     *          name="poids",
      *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),	
	 *		@OA\Parameter(
     *          name="or",
      *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),	
	 *		@OA\Parameter(
     *          name="argent",
      *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),	 
	 *		@OA\Parameter(
     *          name="platine",
      *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="palladium",
      *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="façon",
      *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="adresse",
      *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),	
	 *		@OA\Parameter(
     *          name="agence",
      *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),	 
     *   security={
     *      {
     *           "passwords": { }
     *       }
     *    },	 
     * )
     *
     */		

		
  public function entetecommande(Request $request)
{
 // try {
$client_id  = intval($request->get('client_id'));	
$langue   = $request->get('langue');	
$quantite = intval($request->get('quantite'));	
$poids  = floatval($request->get('poids'));	
$or  = floatval($request->get('or'));	
$argent  = floatval($request->get('argent'));	
$platine  = floatval($request->get('platine'));	
$palladium  = floatval($request->get('palladium'));	
$facon   = floatval($request->get('facon'));	
$adresse    = intval($request->get('adresse'));	 
$agence    = intval($request->get('agence'));	 

 DB::select("SET @p0='$client_id' ;");
 DB::select("SET @p1='$langue' ;");
 DB::select("SET @p2='$quantite' ;");
 DB::select("SET @p3='$poids' ;");
 DB::select("SET @p4='$or' ;");
 DB::select("SET @p5='$argent' ;");
 DB::select("SET @p6='$platine' ;");
 DB::select("SET @p7='$palladium' ;");
 DB::select("SET @p8='$facon' ;");
 DB::select("SET @p10='$adresse' ;");
 DB::select("SET @p11='$agence' ;");

   DB::select ("  CALL `SP_cmde_e_insert`(@p0,@p1,@p2,@p3,@p4,@p5,@p6,@p7,@p8,@p9,@p10,@p11 ); ");
	$result=   DB::select(DB::raw("SELECT @p9 AS `cmde_id`  ;"));
 
	   
	   
	 $cmde_id = null;
$selectResult = DB::select(DB::raw("SELECT @p9 AS `cmde_id`  ;"));

if (!empty($selectResult) && isset($selectResult[0]->cmde_id)) {
    // we have a result
    $cmde_id = $selectResult[0]->cmde_id;
	return $cmde_id;
}  
	    
	/*	 }catch (\Exception $e){
	
 		  $error = array(
    "status" => "error",
    "error_code" => 500,
    "error_message" => "votre commande ne peut pas aboutir",
);
		return response()->json(  $error ,500,array(),JSON_PRETTY_PRINT);
		
	}*/
 
 }
	 
	
	

	
	 /**
     * @OA\Post(
     *   path="/lignecommande",
     *   summary="Ajouter une ligne de commande",
     *   operationId="lignecommande",
     *   tags={"Commandes"},
     *   @OA\Response(response=200, description="opération exécutée avec succès"),
     *   @OA\Response(response=404, description="non trouvé"),
     *   @OA\Response(response=500, description="Erreur interne"),
 	 *		@OA\Parameter(
     *          name="produit_id",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ) ,
	 *		@OA\Parameter(
     *          name="type_id",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="alliage_id",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="etat_id",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="complement_id",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="complement_val",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),	
	 *		@OA\Parameter(
     *          name="quantite",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),	
	 *		@OA\Parameter(
     *          name="poids",
      *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),	
	 *		@OA\Parameter(
     *          name="mode_facturation",
      *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),	
	 *		@OA\Parameter(
     *          name="commande_id",
      *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="number"
     *          )
     *      ),	 
     *   security={
     *      {
     *           "passwords": { }
     *       }
     *    },	 
     * )
     *
     */		

		
  public function lignecommande(Request $request)
{
 // try {
$produit_id  = intval($request->get('produit_id'));	
$type_id   = intval($request->get('type_id'));
$alliage_id   = intval($request->get('alliage_id'));
$etat_id   = intval($request->get('etat_id'));
$comp_id   = intval($request->get('comp_id'));
$comp_val   = floatval($request->get('comp_val'));
$quantite = floatval($request->get('quantite'));
$poids  = floatval($request->get('poids'));
$tarif   = floatval($request->get('tarif'));	
$mode_facturation    = intval($request->get('mode_facturation')); 
$cmd_id    = intval($request->get('cmd_id'));

 DB::select("SET @p0='$produit_id' ;");
 DB::select("SET @p1='$type_id' ;");
 DB::select("SET @p2='$alliage_id' ;");
 DB::select("SET @p3='$etat_id' ;");
 DB::select("SET @p4='$comp_id' ;");
 DB::select("SET @p5='$comp_val' ;");
 DB::select("SET @p6='$quantite' ;");
 DB::select("SET @p7='$poids' ;");
 DB::select("SET @p8='$tarif' ;");
 DB::select("SET @p9='$mode_facturation' ;");
 DB::select("SET @p10='$cmd_id' ;");

  $result=  DB::select ("  CALL `SP_cmde_l_insert`(@p0,@p1,@p2,@p3,@p4,@p5,@p6,@p7,@p8,@p9,@p10 ); ");
	  
	  
	  if ($result!= null){
	 return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	  }
	  else{
		  
		return 'requête exécutée, retour vide';  
	  }
	 
	/*	}catch (\Exception $e){
	
 		  $error = array(
    "status" => "error",
    "error_code" => 500,
    "error_message" => "erreur interne",
);
		return response()->json(  $error ,500,array(),JSON_PRETTY_PRINT);
		
 }*/
	 
	}



	
	

	 /**
     * @OA\Get(
     *   path="/listecommandes/{id_cl}/{lg}",
     *   summary="Afficher la liste des commandes pour un client",
     *   operationId="listecommandes",
     *   tags={"Commandes"},
     *   @OA\Response(response=200, description="opération exécutée avec succès"),
     *   @OA\Response(response=404, description="non trouvé"),
     *   @OA\Response(response=500, description="Erreur interne"),
	 *		@OA\Parameter(
     *          name="id_cl",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="lg",
      *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	 
     *   security={
     *      {
     *           "passwords": { }
     *       }
     *    },	 
     * )
     *
     */
	
		 public function listecommandes($cli_id,$lg )
    { 
 // try {
  DB::select("SET @p0='$cli_id' ;");

 	  $result=  DB::select ("  CALL `sp_affinage_cmde_liste`(@p0); ");
 
	  if ($result!= null){
	 return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	  }
	  else{
		  
  $error = array(
    "status" => "error",
    "error_code" => 404,
    "error_message" => "Aucun résultat trouvé",
);
	 return response()->json(  $error ,404,array(),JSON_PRETTY_PRINT);
		

		  }
	
	/* }catch (\Exception $e){
	
 		  $error = array(
    "status" => "error",
    "error_code" => 500,
    "error_message" => "erreur interne",
);
		return response()->json(  $error ,500,array(),JSON_PRETTY_PRINT);
		
 }*/
 
 
	}		
	
	

	 /**
     * @OA\Get(
     *   path="/listemodeles/{id_cl}/{lg}",
     *   summary="Afficher la liste des modèles pour un client",
     *   operationId="listemodeles",
     *   tags={"Commandes"},
     *   @OA\Response(response=200, description="opération exécutée avec succès"),
     *   @OA\Response(response=404, description="non trouvé"),
     *   @OA\Response(response=500, description="Erreur interne"),
	 *		@OA\Parameter(
     *          name="id_cl",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="lg",
      *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	 
     *   security={
     *      {
     *           "passwords": { }
     *       }
     *    },	 
     * )
     *
     */
	
		 public function listemodeles($cli_id,$lg )
    { 
//	try {
   	   DB::select("SET @p0='$cli_id' ;");

 	  $result=  DB::select ("  CALL `sp_affinage_modele_liste`(@p0); ");
 
	  if ($result!= null){
	 return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	  }
	  else{
		  
  $error = array(
    "status" => "error",
    "error_code" => 404,
    "error_message" => "Aucun résultat trouvé",
);
		return response()->json(  $error ,404,array(),JSON_PRETTY_PRINT);

		}
	
/*	 }catch (\Exception $e){
	
 		  $error = array(
    "status" => "error",
    "error_code" => 500,
    "error_message" => "erreur interne",
);
		return response()->json(  $error ,500,array(),JSON_PRETTY_PRINT);
		
 }*/
 
 
	}		
	

	 /**
     * @OA\Get(
     *   path="/detailscommande/{id_cmd}/{id_cl}/{lg}",
     *   summary="Afficher les détails d'une commande",
     *   operationId="detailscommande",
     *   tags={"Commandes"},
     *   @OA\Response(response=200, description="opération exécutée avec succès"),
     *   @OA\Response(response=404, description="non trouvé"),
     *   @OA\Response(response=500, description="Erreur interne"),
	 *		@OA\Parameter(
     *          name="id_cmd",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="id_cl",
     *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	 
	 *		@OA\Parameter(
     *          name="lg",
      *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	 
     *   security={
     *      {
     *           "passwords": { }
     *       }
     *    },	 
     * )
     *
     */
	
		 public function detailscommande($id_cmd ,$id_cl ,$lg  )
    {
	//	try {		
   	   DB::select("SET @p0='$id_cmd' ;");

 	  $result=  DB::select ("  CALL `sp_affinage_cmde_detail`(@p0); ");
 
	  if ($result!= null){
	 return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	  }
	  else{
		  

	  $error = array(
    "status" => "error",
    "error_code" => 404,
    "error_message" => "Aucun résultat trouvé",
);
		return response()->json(  $error ,404,array(),JSON_PRETTY_PRINT);	  
		  
	  }
	
/*	 }catch (\Exception $e){
	
 		  $error = array(
    "status" => "error",
    "error_code" => 500,
    "error_message" => "erreur interne",
);
		return response()->json(  $error ,500,array(),JSON_PRETTY_PRINT);
		
 }*/
 
	}		
	
		
	

	 /**
     * @OA\Get(
     *   path="/tarifdetails/{nature_id}/{titre_or}/{titre_argent}/{titre_platine}/{titre_palladium}/{poids}/{poids_cendres}/{id_cl}/{lg}",
     *   summary="Afficher le tarif en détails",
     *   operationId="tarifdetails",
     *   tags={"Commandes"},
     *   @OA\Response(response=200, description="opération exécutée avec succès"),
     *   @OA\Response(response=404, description="non trouvé"),
     *   @OA\Response(response=500, description="Erreur interne"),
	 *		@OA\Parameter(
     *          name="nature_id",
      *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	
	 *		@OA\Parameter(
     *          name="titre_or",
      *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	
	 *		@OA\Parameter(
     *          name="titre_argent",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	
	 *		@OA\Parameter(
     *          name="titre_platine",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	
	 *		@OA\Parameter(
     *          name="titre_palladium",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	
	 *		@OA\Parameter(
     *          name="poids",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	
	 *		@OA\Parameter(
     *          name="poids_cendres",
     *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	
	 *		@OA\Parameter(
     *          name="id_cl",
     *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="lg",
     *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	 
     *   security={
     *      {
     *           "passwords": { }
     *       }
     *    },	 
     * )
     *
     */
	
		 public function tarifdetails($nature_id,$titre_or,$titre_argent,$titre_platine,$titre_palladium,$poids,$poids_cendres,$cli_id,$lg )
    { 
	// try {
   	   DB::select("SET @p0='$nature_id' ;");
   	   DB::select("SET @p1='$titre_or' ;");
   	   DB::select("SET @p2='$titre_argent' ;");
   	   DB::select("SET @p3='$titre_platine' ;");
   	   DB::select("SET @p4='$titre_palladium' ;");
   	   DB::select("SET @p5='$poids' ;");
   	   DB::select("SET @p6='$poids_cendres' ;");
  
 	  $result=  DB::select ("  CALL `sp_affinage_prix_detail`(@p0,@p1,@p2,@p3,@p4,@p5,@p6); ");
 
	  if ($result!= null){
	 return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	  }
	  else{
		  
	  $error = array(
    "status" => "error",
    "error_code" => 404,
    "error_message" => "Aucun résultat trouvé",
);
		return response()->json(  $error ,404,array(),JSON_PRETTY_PRINT);
		
		
	  }
	
/*	 }catch (\Exception $e){
	
 		  $error = array(
    "status" => "error",
    "error_code" => 500,
    "error_message" => "erreur interne",
);
		return response()->json(  $error ,500,array(),JSON_PRETTY_PRINT);
		
 }*/
 
	
	}		
			
	

	 /**
     * @OA\Get(
     *   path="/tarifforfait/{nature_id}/{titre_or}/{titre_argent}/{titre_platine}/{titre_palladium}/{poids}/{id_cl}/{lg}",
     *   summary="Afficher le tarif en forfait",
     *   operationId="tarifforfait",
     *   tags={"Commandes"},
     *   @OA\Response(response=200, description="opération exécutée avec succès"),
     *   @OA\Response(response=404, description="non trouvé"),
     *   @OA\Response(response=500, description="Erreur interne"),
	 *		@OA\Parameter(
     *          name="nature_id",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	
	 *		@OA\Parameter(
     *          name="titre_or",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	
	 *		@OA\Parameter(
     *          name="titre_argent",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	
	 *		@OA\Parameter(
     *          name="titre_platine",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	
	 *		@OA\Parameter(
     *          name="titre_palladium",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	
	 *		@OA\Parameter(
     *          name="poids",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),		
	 *		@OA\Parameter(
     *          name="id_cl",
     *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="lg",
     *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	 
     *   security={
     *      {
     *           "passwords": { }
     *       }
     *    },	 
     * )
     *
     */
	
  public function tarifforfait($nature_id,$titre_or,$titre_argent,$titre_platine,$titre_palladium,$poids,$cli_id,$lg )
    { 
	//try { 
   	   DB::select("SET @p0='$nature_id' ;");
   	   DB::select("SET @p1='$titre_or' ;");
   	   DB::select("SET @p2='$titre_argent' ;");
   	   DB::select("SET @p3='$titre_platine' ;");
   	   DB::select("SET @p4='$titre_palladium' ;");
   	   DB::select("SET @p5='$poids' ;");
   
 	  $result=  DB::select ("  CALL `sp_affinage_prix_forfait`(@p0,@p1,@p2,@p3,@p4,@p5); ");
 
	  if ($result!= null){
	 return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	  }
	  else{
		  
  $error = array(
    "status" => "error",
    "error_code" => 404,
    "error_message" => "Aucun résultat trouvé",
);
		return response()->json(  $error ,404,array(),JSON_PRETTY_PRINT);

		}
	
	/* }catch (\Exception $e){
	
 		  $error = array(
    "status" => "error",
    "error_code" => 500,
    "error_message" => "erreur interne",
);
		return response()->json(  $error ,500,array(),JSON_PRETTY_PRINT);
		
 }
 */
 
	}		
			
	
	
	
	
	
	 /**
     * @OA\Get(
     *   path="/listeprestations/{id_cl}/{lg}",
     *   summary="Afficher la liste des prestations",
     *   operationId="listeprestations",
     *   tags={"Commandes"},
     *   @OA\Response(response=200, description="opération exécutée avec succès"),
     *   @OA\Response(response=404, description="non trouvé"),
     *   @OA\Response(response=500, description="Erreur interne"),
	 *		@OA\Parameter(
     *          name="id_cl",
     *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="lg",
     *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	 
     *   security={
     *      {
     *           "passwords": { }
     *       }
     *    },	 
     * )
     *
     */
	
		 public function listeprestations($cli_id,$lg )
    { 
//	try {
 	  $result=  DB::select ("  CALL `sp_labo_choix`(); ");
 
	  if ($result!= null){
	 return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	  }
	  else{
		  
  $error = array(
    "status" => "error",
    "error_code" => 404,
    "error_message" => "Aucun résultat trouvé",
);
		return response()->json(  $error ,404,array(),JSON_PRETTY_PRINT);
		
		
		  }
	
/*	 }catch (\Exception $e){
	
 		  $error = array(
    "status" => "error",
    "error_code" => 500,
    "error_message" => "erreur interne",
);
		return response()->json(  $error ,500,array(),JSON_PRETTY_PRINT);
		
 }*/
 
	}		
	
	


	 /**
     * @OA\Get(
     *   path="/listecommandeslabo/{id_cl}/{lg}",
     *   summary="Afficher la liste des commandes du laboratoire pour un client",
     *   operationId="listecommandeslabo",
     *   tags={"Commandes"},
     *   @OA\Response(response=200, description="opération exécutée avec succès"),
     *   @OA\Response(response=404, description="non trouvé"),
     *   @OA\Response(response=500, description="Erreur interne"),
	 *		@OA\Parameter(
     *          name="id_cl",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="lg",
     *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	 
     *   security={
     *      {
     *           "passwords": { }
     *       }
     *    },	 
     * )
     *
     */
	
		 public function listecommandeslabo($cli_id,$lg )
    { 
//	try { 
   	   DB::select("SET @p0='$cli_id' ;");

 	  $result=  DB::select ("  CALL `sp_labo_cmde_liste`(@p0); ");
 
	  if ($result!= null){
	 return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	  }
	  else{
		  
  $error = array(
    "status" => "error",
    "error_code" => 404,
    "error_message" => "Aucun résultat trouvé",
);
		return response()->json(  $error ,404,array(),JSON_PRETTY_PRINT);

		}
	
	/* }catch (\Exception $e){
	
 		  $error = array(
    "status" => "error",
    "error_code" => 500,
    "error_message" => "erreur interne",
);
		return response()->json(  $error ,500,array(),JSON_PRETTY_PRINT);
		
 }
 */
 
	}		
		
	


	 /**
     * @OA\Get(
     *   path="/listemodeleslabo/{id_cl}/{lg}",
     *   summary="Afficher la liste des modèles du laboratoire pour un client",
     *   operationId="listemodeleslabo",
     *   tags={"Commandes"},
     *   @OA\Response(response=200, description="opération exécutée avec succès"),
     *   @OA\Response(response=404, description="non trouvé"),
     *   @OA\Response(response=500, description="Erreur interne"),
	 *		@OA\Parameter(
     *          name="id_cl",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="lg",
     *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	 
     *   security={
     *      {
     *           "passwords": { }
     *       }
     *    },	 
     * )
     *
     */
	
		 public function listemodeleslabo($cli_id,$lg )
    { 
	//try {
   	   DB::select("SET @p0='$cli_id' ;");

 	  $result=  DB::select ("  CALL `sp_labo_modele_liste`(@p0); ");
 
	  if ($result!= null){
	 return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	  }
	  else{
		  
  $error = array(
    "status" => "error",
    "error_code" => 404,
    "error_message" => "Aucun résultat trouvé",
);
		return response()->json(  $error ,404,array(),JSON_PRETTY_PRINT);

		}
	
	/* }catch (\Exception $e){
	
 		  $error = array(
    "status" => "error",
    "error_code" => 500,
    "error_message" => "erreur interne",
);
		return response()->json(  $error ,500,array(),JSON_PRETTY_PRINT);
		
 }*/
 
	}		
			
	
	

	 /**
     * @OA\Get(
     *   path="/detailscommandelabo/{id_cmd}/{id_cl}/{lg}",
     *   summary="Afficher les détails d'une commande du laboratoire",
     *   operationId="detailscommandelabo",
     *   tags={"Commandes"},
     *   @OA\Response(response=200, description="opération exécutée avec succès"),
     *   @OA\Response(response=404, description="non trouvé"),
     *   @OA\Response(response=500, description="Erreur interne"),
	 *		@OA\Parameter(
     *          name="id_cmd",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="id_cl",
     *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	 
	 *		@OA\Parameter(
     *          name="lg",
     *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	 
     *   security={
     *      {
     *           "passwords": { }
     *       }
     *    },	 
     * )
     *
     */
	
		 public function detailscommandelabo($id_cmd ,$id_cl ,$lg  )
    { 
	// try {
   	   DB::select("SET @p0='$id_cmd' ;");

 	  $result=  DB::select ("  CALL `sp_labo_cmde_detail`(@p0); ");
 
	  if ($result!= null){
	 return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	  }
	  else{
		  
  $error = array(
    "status" => "error",
    "error_code" => 404,
    "error_message" => "Aucun résultat trouvé",
);
		return response()->json(  $error ,404,array(),JSON_PRETTY_PRINT);

		}
	
/*	 }catch (\Exception $e){
	
 		  $error = array(
    "status" => "error",
    "error_code" => 500,
    "error_message" => "erreur interne",
);
		return response()->json(  $error ,500,array(),JSON_PRETTY_PRINT);
		
 }*/
 
	}		
		
	
	

	 /**
     * @OA\Get(
     *   path="/tariflabo/{id_cl}/{choix_id}/{titre_or}/{titre_argent}/{titre_platine}/{titre_palladium}/{lg}",
     *   summary="Afficher le tarif du laboratoire",
     *   operationId="tariflabo",
     *   tags={"Commandes"},
     *   @OA\Response(response=200, description="opération exécutée avec succès"),
     *   @OA\Response(response=404, description="non trouvé"),
     *   @OA\Response(response=500, description="Erreur interne"),
	 *		@OA\Parameter(
     *          name="id_cl",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	
	 *		@OA\Parameter(
     *          name="choix_id",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	
	 *		@OA\Parameter(
     *          name="titre_or",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="titre_argent",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	 
	 *		@OA\Parameter(
     *          name="titre_platine",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	
	 *		@OA\Parameter(
     *          name="titre_palladium",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	
	 *		@OA\Parameter(
     *          name="lg",
     *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	 
     *   security={
     *      {
     *           "passwords": { }
     *       }
     *    },	 
     * )
     *
     */
	
	  public function tariflabo($cl_id,$choix_id,$titre_or,$titre_argent,$titre_platine,$titre_palladium,$lg )
    { 
	//try { 
   	   DB::select("SET @p0='$cl_id' ;");
   	   DB::select("SET @p1='$choix_id' ;");
   	   DB::select("SET @p2='$titre_or' ;");
   	   DB::select("SET @p3='$titre_argent' ;");
   	   DB::select("SET @p4='$titre_platine' ;");
   	   DB::select("SET @p5='$titre_palladium' ;");
    
 	  $result=  DB::select ("  CALL `sp_labo_tarif`(@p0,@p1,@p2,@p3,@p4,@p5); ");
 
	  if ($result!= null){
	 return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	  }
	  else{
		  
  $error = array(
    "status" => "error",
    "error_code" => 404,
    "error_message" => "Aucun résultat trouvé",
);
		return response()->json(  $error ,404,array(),JSON_PRETTY_PRINT);

		}
	
	/* }catch (\Exception $e){
	
 		  $error = array(
    "status" => "error",
    "error_code" => 500,
    "error_message" => "erreur interne",
);
		return response()->json(  $error ,500,array(),JSON_PRETTY_PRINT);
		
 }*/
 
	}		
			
		
	


	 /**
     * @OA\Get(
     *   path="/listecommandesrmp/{id_cl}/{lg}",
     *   summary="Afficher la liste des commandes RMP pour un client",
     *   operationId="listecommandesrmp",
     *   tags={"Commandes"},
     *   @OA\Response(response=200, description="opération exécutée avec succès"),
     *   @OA\Response(response=404, description="non trouvé"),
     *   @OA\Response(response=500, description="Erreur interne"),
	 *		@OA\Parameter(
     *          name="id_cl",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="lg",
     *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	 
     *   security={
     *      {
     *           "passwords": { }
     *       }
     *    },	 
     * )
     *
     */
	
		 public function listecommandesrmp($cli_id,$lg )
    { 
	//try { 
   	   DB::select("SET @p0='$cli_id' ;");

 	  $result=  DB::select ("  CALL `sp_rmp_cmde_liste`(@p0); ");
 
	  if ($result!= null){
	 return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	  }
	  else{
		  
  $error = array(
    "status" => "error",
    "error_code" => 404,
    "error_message" => "Aucun résultat trouvé",
);
		return response()->json(  $error ,404,array(),JSON_PRETTY_PRINT);

		}
	
	/* }catch (\Exception $e){
	
 		  $error = array(
    "status" => "error",
    "error_code" => 500,
    "error_message" => "erreur interne",
);
		return response()->json(  $error ,500,array(),JSON_PRETTY_PRINT);
		
 }*/
 
 
	}		
	
	

	 /**
     * @OA\Get(
     *   path="/listemodelesrmp/{id_cl}/{lg}",
     *   summary="Afficher la liste des modèles RMP pour un client",
     *   operationId="listemodelesrmp",
     *   tags={"Commandes"},
     *   @OA\Response(response=200, description="opération exécutée avec succès"),
     *   @OA\Response(response=404, description="non trouvé"),
     *   @OA\Response(response=500, description="Erreur interne"),
	 *		@OA\Parameter(
     *          name="id_cl",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="lg",
     *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	 
     *   security={
     *      {
     *           "passwords": { }
     *       }
     *    },	 
     * )
     *
     */
	
		 public function listemodelesrmp($cli_id,$lg )
    { 
	// try {
   	   DB::select("SET @p0='$cli_id' ;");

 	  $result=  DB::select ("  CALL `sp_rmp_modele_liste`(@p0); ");
 
	  if ($result!= null){
	 return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	  }
	  else{
		  
  $error = array(
    "status" => "error",
    "error_code" => 404,
    "error_message" => "Aucun résultat trouvé",
);
		return response()->json(  $error ,404,array(),JSON_PRETTY_PRINT);

		}
	
	/* }catch (\Exception $e){
	
 		  $error = array(
    "status" => "error",
    "error_code" => 500,
    "error_message" => "erreur interne",
);
		return response()->json(  $error ,500,array(),JSON_PRETTY_PRINT);
		
 }*/
 
 
	}		
	

	 /**
     * @OA\Get(
     *   path="/detailscommandermp/{id_cmd}/{id_cl}/{lg}",
     *   summary="Afficher les détails d'une commande RMP",
     *   operationId="detailscommandermp",
     *   tags={"Commandes"},
     *   @OA\Response(response=200, description="opération exécutée avec succès"),
     *   @OA\Response(response=404, description="non trouvé"),
     *   @OA\Response(response=500, description="Erreur interne"),
	 *		@OA\Parameter(
     *          name="id_cmd",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="id_cl",
     *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	 
	 *		@OA\Parameter(
     *          name="lg",
     *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	 
     *   security={
     *      {
     *           "passwords": { }
     *       }
     *    },	 
     * )
     *
     */
	
		 public function detailscommandermp($id_cmd ,$id_cl ,$lg  )
    { 
	// try {
   	   DB::select("SET @p0='$id_cmd' ;");

 	  $result=  DB::select ("  CALL `sp_rmp_cmde_detail`(@p0); ");
 
	  if ($result!= null){
	 return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	  }
	  else{
		  
  $error = array(
    "status" => "error",
    "error_code" => 404,
    "error_message" => "Aucun résultat trouvé",
);
		return response()->json(  $error ,404,array(),JSON_PRETTY_PRINT);

		}
	
/*	 }catch (\Exception $e){
	
 		  $error = array(
    "status" => "error",
    "error_code" => 500,
    "error_message" => "erreur interne",
);
		return response()->json(  $error ,500,array(),JSON_PRETTY_PRINT);
		
 }*/
 
	
	}		
		
	
	

	 /**
     * @OA\Get(
     *   path="/tarifrmp/{nature_id}/{titre_or}/{titre_argent}/{titre_platine}/{titre_palladium}/{poids}/{id_cl}/{lg}",
     *   summary="Afficher le tarif RMP",
     *   operationId="tarifrmp",
     *   tags={"Commandes"},
     *   @OA\Response(response=200, description="opération exécutée avec succès"),
     *   @OA\Response(response=404, description="non trouvé"),
     *   @OA\Response(response=500, description="Erreur interne"),

	 *		@OA\Parameter(
     *          name="nature_id",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	
	 *		@OA\Parameter(
     *          name="titre_or",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
	 *		@OA\Parameter(
     *          name="titre_argent",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	 
	 *		@OA\Parameter(
     *          name="titre_platine",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	
	 *		@OA\Parameter(
     *          name="titre_palladium",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	
	 *		@OA\Parameter(
     *          name="poids",
     *          in="path",
     *          required=true, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	
	 *		@OA\Parameter(
     *          name="id_cl",
     *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	 
	 *		@OA\Parameter(
     *          name="lg",
     *          in="path",
     *          required=false, 
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),	 
     *   security={
     *      {
     *           "passwords": { }
     *       }
     *    },	 
     * )
     *
     */
	
		 public function tarifrmp($nature_id,$titre_or,$titre_argent,$titre_platine,$titre_palladium,$poids )
    { 
//	try {
   	   DB::select("SET @p0='$nature_id' ;");
       DB::select("SET @p1='$titre_or' ;");
   	   DB::select("SET @p2='$titre_argent' ;");
   	   DB::select("SET @p3='$titre_platine' ;");
   	   DB::select("SET @p4='$titre_palladium' ;");
   	   DB::select("SET @p5='$poids' ;");
    
 	  $result=  DB::select ("  CALL `sp_rmp_tarif`(@p0,@p1,@p2,@p3,@p4,@p5); ");
 
	  if ($result!= null){
	 return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	  }
	  else{
		  
  $error = array(
    "status" => "error",
    "error_code" => 404,
    "error_message" => "Aucun résultat trouvé",
);
		return response()->json(  $error ,404,array(),JSON_PRETTY_PRINT);

		}
	
	/* }catch (\Exception $e){
	
 		  $error = array(
    "status" => "error",
    "error_code" => 500,
    "error_message" => "erreur interne",
);
		return response()->json(  $error ,500,array(),JSON_PRETTY_PRINT);
		
 }*/
 
 
	}		

	
	

	
} // end class
