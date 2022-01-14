<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB ;
use App\User ;
use App\Order ;
use App\Product ;
use App\Modele_affinage ;
use App\Modele_lab ;
use App\Modele_rmp ;
use App\Cmde_aff_e ;
use App\Cmde_aff_l ;
use App\Cmde_lab_e ;
use App\Cmde_lab_l ;
use App\Cmde_rmp_e ;
use App\Cmde_rmp_l ;
use App\Http\Controllers\DHLController ;
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
         $this->middleware('auth', ['except' => ['checkexiste' ]]);
    }
 
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

	     public function checkexiste(Request $request)
	 {
 
		$val= trim($request->get('val'));
        $type= $request->get('type');
		
		if(trim($type)=='email'){
		$contact=DB::table('contact')->where('email', $val)->first();
		if($contact!= null)	{
			return $contact->cl_ident ;
		}else{ 	return 0;}
		}
		
		if(trim($type)=='siret'){
		$client=DB::table('client')->where('siret', $val)->first();
		if($client!= null)	{
			return $client->cl_ident ;
		}else{	return 0;}	
		}
 
	 } 
	
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
	
	 public function agence (Request $request)
   {
     $id= $request->get('id');
	 $agence=  DB::table('agence')->where('agence_ident',$id)->first();
	 return json_encode($agence) ;
   }
	
	  public function filtres($code)
    { 
	   DB::select("SET @p0='$code'  ;");
	  $result=  DB::select (" CALL `sp_filtre_produit`(@p0);");
 
     if ($result!= null){
	 return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
      } else{  return 'Error';          } 
 
    }
	
	 public function filtres2($code)
    { 
 	$result= response()->json( DB::table('type_famille')->where('CODEPRO',$code)->get(),200,array(),JSON_PRETTY_PRINT);
	  if ($result!= null){ 	 return  $result  ;	  }
	  else{	 return  'Error';	  }
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
	 	 return 'Error'; } 
    }
		
	 public function metal_demi_produit($type,$fam)
    { 
 	   DB::select("SET @p0='$type' ;");
	   DB::select("SET @p1='$fam'  ;");

 	  $result=  DB::select ("  CALL `sp_metal_demi_produit`(@p0, @p1); ");
 
     if ($result!= null){
	 return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	} else{  return 'Error'; } 
 
    }	
	
	public static function modeles_ac($cl)
    { 
  	   DB::select("SET @p0='$cl' ;");

 	  $result=  DB::select (" CALL `sp_accueil_liste_modele`(@p0); ");
 
	  if ($result!= null){ 	 return  $result  ;	  }
	  else{	 return  'Error';	  } 
 
    }
	
	
	  public static function commandes_ac($cl)
    { 
  	   DB::select("SET @p0='$cl' ;");
 	  $result=  DB::select (" CALL `sp_accueil_liste_commandes`(@p0); ");
	  if ($result!= null){ 	 return  $result  ;	  }
	  else{	 return  'Error';	  }
 
    }

	public static function solde_euro($cl)
    { 
  	   DB::select("SET @p0='$cl' ;");
 	  $result=  DB::select (" CALL `sp_accueil_solde_compta`(@p0); ");
 
	  if ($result!= null){ 	 return  $result  ;	  }
	  else{	 return  'Error';	  }
 
    }
 
	  public static function compte_euro($cl)
    { 
  	   DB::select("SET @p0='$cl' ;");
 	  $result=  DB::select (" CALL `sp_accueil_compta`(@p0); ");
	  if ($result!= null){ 	 return  $result  ;	  }
	  else{	 return  'Error';	  }
 
    }
	

	  public static function compte_poids($cl)
    { 
  	   DB::select("SET @p0='$cl' ;");
 	  $result=  DB::select (" CALL `sp_accueil_CP_solde`(@p0); ");

	  if ($result!= null){ 	 return  $result  ;	  }
	  else{	 return  'Error';	  }
 
    }
 
	  public function tarif_article()
    { 
 	  $result=  DB::select (" CALL `sp_tarif_article(); ");
 
	  if ($result!= null){ 	 return  $result  ;	  }
	  else{	 return  'Error';	  } 
 
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

	  public function referentiels ()
    { 
		$referentiel=$this->referentiel();
		$referentiel1=$this->requete2();
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
 		 
   if ($result!= null){
	 return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
 } else{

 	  $error = array(  "status" => "error",  "error_code" => 404, "error_message" => "Aucun résultat trouvé",);
		return response()->json(  $error ,404,array(),JSON_PRETTY_PRINT);
			
 } 
 
    }
	 
	 
	  public function referentiel ()
    { 
 	  $result=  DB::select ("CALL `sp_referentiel0`();");
	  
	  if ($result!= null){ 	 return  $result  ;	  }
	  else{	 return  'Error';	  }
 
    }
  

	  public static function referentiel1 ()
    { 
 	  $result=  DB::select ("CALL `sp_referentiel1`(); ");
 
	  if ($result!= null){ 	 return  $result  ;	  }
	  else{	 return  'Error';	  }
 
    }
	 
	 
	  public function referentiel2 ()
    { 
 	  $result=  DB::select ("CALL `sp_referentiel2`();");
 
	  if ($result!= null){ 	 return  $result  ;	  }
	  else{	 return  'Error';	  }
 
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
  
  $data2=  DB::table("type_famille")->where('fam2_id',$famille)->distinct('fam1_id')->pluck('fam1_id');  $parents = $data2 ;
  
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
	  if ($result!= null){ 	 return  $result  ;	  }
	  else{	 return  'Error';	  }
 
    }
    
	 public function referentielmetal ()
    { 
 	  $result=  DB::select ("CALL `sp_referentiel_metal`();");
 
	  if ($result!= null){ 	 return  $result  ;	  }
	  else{	 return  'Error';	  }
 
    }

 
	public function referentielphoto ()
    { 
 	  $result=  DB::select ("CALL `sp_referentiel_photo`();");
 
	  if ($result!= null){ 	 return  $result  ;	  }
	  else{	 return  'Error';	  }
 
    }
	 
	public function referentielunite ()
    { 
 	$result=  DB::select ("CALL `sp_referentiel_unite`();");
 
	  if ($result!= null){ 	 return  $result  ;	  }
	  else{	 return  'Error';	  }
 
    }
	
    public static function referentieletat ()
    { 
 	  $result=  DB::select ("CALL `sp_referentiel_etat`();");
 
	  if ($result!= null){ 	 return  $result  ;	  }
	  else{	 return  'Error';	  }
 
    }	
	  
	 public function referentielcomplement ()
    { 
 	  $result=  DB::select ("CALL `sp_referentiel_complement`();");
 
	  if ($result!= null){ 	 return  $result  ;	  }
	  else{	 return  'Error';	  } 
 
    }
  	 
	public function referentielmodefacturation ()
    { 
 	  $result=  DB::select ("CALL `sp_referentiel_mode_facturation`();");
 
	  if ($result!= null){ 	 return  $result  ;	  }
	  else{	 return  'Error';	  }
 
    }

	  public function referentieltitre ()
    { 
 	  $result=  DB::select ("CALL `sp_referentiel_titre`();");
 
  if ($result!= null){
	 return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
 } else{  return 'Error'; } 
 
    }

	  public function referentielcouleur ()
    { 
 
 	  $result=  DB::select ("CALL `sp_referentiel_couleur`();");
 
	  if ($result!= null){
	  return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
		} else{  return 'Error'; } 
    }

   
   public function requete1 ($id)
   {
	 $article=  DB::table('demi_produit')->where('DP_IDENT',$id)->first();
 	 
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
	   
	 if($typefamille!= null){
		 return response()->json(  $results ,200,array(),JSON_PRETTY_PRINT);
	 }else{   return 'Error';	 }
	 
   }
 
       public static function alliage_defaut ($type,$fam1)
    { 
	 $user = auth()->user();  
	 $client_id=$user['client_id'];
 	   DB::select("SET @p0='$type'  ;");
	   DB::select("SET @p1='$fam1'  ;");
	   DB::select("SET @p2='$client_id'  ;");
 	  $result=  DB::select ("CALL `sp_referentiel1_alliage_defaut`(@p0, @p1, @p2); ");
 
	  if ($result!= null){ 	 return  $result  ;	  }
	  else{	 return  'Error';	  }
 
    }
	
 
    public static function referentielalliage ()
    { 
    $result=  DB::select ("CALL `Sp_referentiel_alliage`(); ");
 
	  if ($result!= null){ 	 return  $result  ;	  }
	  else{	 return  'Error';	  }
 
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
 	 return   $result ;

  } else{
	 	 return 'Error';

 } 
 
    }
   
   /*************  Produits   *************/    
     public   function produit($typeid,$fam1,$fam2,$fam3)
    { 
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
   if(isset($d->unite1)){$mesure1=$d->unite1;}else{$mesure1=''; }
   if(isset($d->unite2)){$mesure2=$d->unite2;}else{$mesure2=''; }
   
    $valeur_defaut=$d->valeur_defaut;

   $result[$i]['libelle']=$libelle;
   $result[$i]['NAT_MESURE1']=$NAT_MESURE1;
   $result[$i]['NAT_MESURE2']=$NAT_MESURE2;
    $result[$i]['UNIT_IDENT']=$UNIT_IDENT;
    $result[$i]['unite1']=$mesure1;
    $result[$i]['unite2']=$mesure2;
   $result[$i]['valeur_defaut']=$valeur_defaut;
   
   $produitmesure1 =$this->produitmesure1($typeid,$fam1,$fam2,$fam3);
    $result[$i]['mesures']=$produitmesure1 ;
 
   $result[$i]['complements']=$this->produitcomplement($typeid,$fam1,$fam2,$fam3);
   
  }

if ($data!= null){
	  return $result  ;
	  }   else{   return 'error' ;	}
 
}
      
   	 public function produitcomplement($typeid,$fam1,$fam2,$fam3)
    { 
 	   DB::select("SET @p0='$typeid' ;");
	   DB::select("SET @p1='$fam1'  ;");
	   DB::select("SET @p2='$fam2'  ;");
	   DB::select("SET @p3='$fam3'  ;");

 	  $result=  DB::select ("  CALL `sp_fiche_produit_complement`(@p0,@p1,@p2,@p3); ");
 
	  if ($result!= null){ 	 return  $result  ;	  }
	  else{	 return  'Error';	  }
 
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
  $mesure2= $this->produitmesure2($typeid,$fam1,$fam2,$fam3,$r->MESURE1 );
 	$r->MESURE2= $mesure2;
   }
 
	  if ($result!= null){ 	 return  $result  ;	  }
	  else{	 return  'Error';	  }
 
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
		
	  if ($result!= null){ 	 return  $result  ;	  }
	  else{	 return  'Error';	  } 
 
    }       
   
  
   	 public function detailsproduit($typeid,$fam1,$fam2,$fam3,$mes1,$mes2,$all,$qte,$id_comp,$val_comp,$id_cl)
    {
 		$results=array();
		$produit=$this->produitpoids($typeid,$fam1,$fam2,$fam3,$mes1,$mes2,$all,$id_comp,$val_comp);
 		$poidsu=0; $articleid=0;
		
 		if (($produit!='Error')){
		 $poidsu=$produit[0]->poids_u;
 		$articleid=$produit[0]->produit ;

		}else{  return 'Error'; }
		
 		$results['poids_u']=$poidsu;
		$qte=floatval($qte);
		$poids=  ($poidsu)* ($qte);
		$results['produit']=intval($articleid);
		 
 		$results['prix']=$this->prix($typeid,$articleid,$all,$qte,$poids,$id_cl );
		 $results['tarif']=$this->tarif($id_comp,$val_comp,$id_cl,$qte,$poids) ;
		 $results['tarif_prod']=$this->tarif_prod($typeid,$articleid,$all,$id_cl) ;
		
	if ($results['prix']!= null){
	 return    $results  ;

	 } else{
	 $error = array(  "status" => "error",  "error_code" => 404, "error_message" => "Aucun résultat trouvé",);
		return response()->json(  $error ,404,array(),JSON_PRETTY_PRINT);
		
			} 
 
	}
   
    
   	 public function produitpoids($typeid,$fam1,$fam2,$fam3,$mes1,$mes2,$all,$id_comp,$val_comp)
    { 
 	   DB::select("SET @p0='$typeid' ;");
	   DB::select("SET @p1='$fam1'  ;");
	   DB::select("SET @p2='$fam2'  ;");
	   DB::select("SET @p3='$fam3'  ;");
	   DB::select("SET @p4='$mes1'  ;");
	   DB::select("SET @p5='$mes2'  ;");
	   DB::select("SET @p6='$all'  ;");
	   DB::select("SET @p7='$id_comp'  ;");
	   DB::select("SET @p8='$val_comp'  ;");

 	  $result=  DB::select ("  CALL `sp_fiche_produit_poids_id`(@p0,@p1,@p2,@p3,@p4,@p5,@p6,@p7,@p8); ");
 
	  if ($result!= null){ 	 return  $result  ;	  }
	  else{	 return  'Error';	  }
 
    }       
   
 
   	 public function tarif($id_comp,$val_comp,$id_cl,$qte,$poids)
    { 
 	   DB::select("SET @p0='$id_comp' ;");
	   DB::select("SET @p1='$val_comp'  ;");
	   DB::select("SET @p2='$id_cl'  ;");
	   DB::select("SET @p3='$qte'  ;");
	   DB::select("SET @p4='$poids'  ;");
 
 	  $result=  DB::select ("  CALL `sp_fiche_produit_compl_tarif`(@p0,@p1,@p2,@p3,@p4); ");
 
	  if ($result!= null){ 	 return  $result  ;	  }
	  else{	 return  'Error';	  }
 
    }   
   
 
   	 public function compprix($id_comp,$qte,$poids,$id_cl,$val_comp )
    { 
  	   DB::select("SET @p0='$id_comp' ;");
 	   DB::select("SET @p1='$qte' ;");
 	   DB::select("SET @p2='$poids' ;");
	   DB::select("SET @p3='$id_cl'  ;");
	   DB::select("SET @p4='$val_comp'  ;");
 
 	  $result=  DB::select ("  CALL `sp_fiche_produit_compl_prix`(@p0,@p1,@p2,@p3,@p4); ");
 
  if ($result!= null){
	 return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
			} else{  return 'Error';} 
 
    }
 
   	 public function prix($typeid,$articleid,$alliageid,$qte,$poids,$id_cl )
    {
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
  $error = array(  "status" => "error",  "error_code" => 404, "error_message" => "Aucun résultat trouvé",);
		return response()->json(  $error ,404,array(),JSON_PRETTY_PRINT);
			} 
 
    }	
	

	   	 public function tarif_prod($typeid,$articleid,$all,$id_cl)
    {
 	   DB::select("SET @p0='$typeid' ;");
 	   DB::select("SET @p1='$articleid' ;");
 	   DB::select("SET @p2='$all' ;");
	   DB::select("SET @p3='$id_cl'  ;");
  
 	  $result=  DB::select ("  CALL `sp_fiche_produit_tarif`(@p0,@p1,@p2,@p3); ");
 
  if ($result!= null){
	 return   $result  ;
			} else{
  $error = array(  "status" => "error",  "error_code" => 404, "error_message" => "Aucun résultat trouvé",);
 		return  $result;
 } 
 
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
		  
  $error = array(  "status" => "error",  "error_code" => 404, "error_message" => "Aucun résultat trouvé",);
	 return response()->json(  $error ,404,array(),JSON_PRETTY_PRINT);

		}
	
	}	
	
	 
	public function checkclient($siren )
    { 
    DB::select("SET @p0='$siren' ;");

 	  $result=  DB::select ("  CALL `sp_check_client`(@p0); ");
 
	  if ($result!= null){
	 return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	  }
	  else{
		  
  $error = array(  "status" => "error",  "error_code" => 404, "error_message" => "Aucun résultat trouvé",);
		return response()->json(  $error ,404,array(),JSON_PRETTY_PRINT);

		}
	
	}	
	
	public function agences( $code_pays)
    { 
	DB::select("SET @p0='$code_pays' ;");
 	$result=  DB::select ("  CALL `sp_liste_agence`(@p0); ");
 
	  if ($result!= null){
	 return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	  }
	  else{
  $error = array(  "status" => "error",  "error_code" => 404, "error_message" => "Aucun résultat trouvé",);
		return response()->json(  $error ,404,array(),JSON_PRETTY_PRINT);
		}
 
	}	

	 public function listeclients($contact_id  )
    { 
   	   DB::select("SET @p0='$contact_id' ;");

 	  $result=  DB::select ("  CALL `sp_liste_client`(@p0); ");
 
	  if ($result!= null){
	 return response()->json(  $result ,200,array(),JSON_PRETTY_PRINT);
	  }
	  else{ return 'Error';   }
	
	}	
	
	public static function listeclients2($contact_id  )
    { 
   	   DB::select("SET @p0='$contact_id' ;");
 	  $result=  DB::select ("  CALL `sp_liste_client`(@p0); ");
 
	  if ($result!= null){ 	 return  $result  ;	  }
	  else{	 return  'Error';	  }	
	
	}	
 
	 public static function adresse($client_id  )
    { 
   	   DB::select("SET @p0='$client_id' ;");
 	  $result=  DB::select ("  CALL `sp_liste_adresse_livraison`(@p0); ");
 
	  if ($result!= null){ 	 return  $result  ;	  }
	  else{	 return  'Error';	  }	
	
	}		
	 
	  public static function adresse2($client_id  )
    { 
   	   DB::select("SET @p0='$client_id' ;");

 	   $result=  DB::select ("  CALL `sp_liste_adresse_livraison`(@p0); ");
  
	  if ($result!= null){ 	 return  $result  ;	  }
	  else{	 return  'Error';	  }
	
	}
	
	
	  public static function  liste_contact($client_id  )
    { 
   	   DB::select("SET @p0='$client_id' ;");

 	  $result=  DB::select ("  CALL `sp_liste_contact`(@p0); ");
 
	  if ($result!= null){ 	 return  $result  ;	  }
	  else{	 return  'Error';	  }
	
	}
	
	  public static function detailsclient($client_id  )
    { 
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
		  
  $error = array(  "status" => "error",  "error_code" => 404, "error_message" => "Aucun résultat trouvé",);
		return response()->json(  $error ,404,array(),JSON_PRETTY_PRINT);

		}
	
	}
	
/*************************************************** Commandes ***************************************************************/
/*
public function commande(Request $request)
{
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
	  }  else{
 		  $error = array(
    "status" => "error",
    "error_code" => 500,
    "error_message" => "erreur interne",
);
		return response()->json(  $error ,500,array(),JSON_PRETTY_PRINT);
	  }
 
	}*/
	 
	public function tarifdetails($nature_id,$titre_or,$titre_argent,$titre_platine,$titre_palladium,$poids,$poids_cendres  )
    { 
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
	  $error = array(  "status" => "error",  "error_code" => 404, "error_message" => "Aucun résultat trouvé",);
		return response()->json(  $error ,404,array(),JSON_PRETTY_PRINT);
		
	  }
	}		
			
  public function tarifforfait($nature_id,$titre_or,$titre_argent,$titre_platine,$titre_palladium,$poids  )
    { 
   	   DB::select("SET @p0='$nature_id' ;");
   	   DB::select("SET @p1='$titre_or' ;");
   	   DB::select("SET @p2='$titre_argent' ;");
   	   DB::select("SET @p3='$titre_platine' ;");
   	   DB::select("SET @p4='$titre_palladium' ;");
   	   DB::select("SET @p5='$poids' ;");
   
 	  $result=  DB::select ("  CALL `sp_affinage_prix_forfait`(@p0,@p1,@p2,@p3,@p4,@p5); ");
	 return   $result  ;
 
	}		
	

  public static function virements($client,$lang,$metal,$debut,$fin  )
    { 
	   DB::select("SET @p0='$client' ;");
       DB::select("SET @p1='$lang' ;");
   	   DB::select("SET @p2='$metal' ;");
   	   DB::select("SET @p3='$debut' ;");
   	   DB::select("SET @p4='$fin' ;");
     
 	    $result=  DB::select ("  CALL `sp_vir_cp_date`(@p0,@p1,@p2,@p3,@p4); ");
		return $result;
	}	
	
  public static function beneficiaires($client,$lang  )
    { 
   	   DB::select("SET @p0='$client' ;");
       DB::select("SET @p1='$lang' ;");
 	  $result=  DB::select ("  CALL `sp_vir_liste_beneficiaire`(@p0,@p1); ");
		return $result;
	}	
	
	
} // end class
