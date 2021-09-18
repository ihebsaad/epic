<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Client ;
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

class ModelesController extends Controller
{
	 
	public static function detailscommande($id_cmd    )
    {
   	  DB::select("SET @p0='$id_cmd' ;");

 	  $result=  DB::select ("  CALL `sp_affinage_cmde_detail`(@p0); ");
 
	  if ($result!= null){
	 return  $result  ;
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
	
 	
	public static function listecommandes($cli_id,$lg )
    { 
    DB::select("SET @p0='$cli_id' ;");

 	  $result=  DB::select ("  CALL `sp_affinage_cmde_liste`(@p0); ");
 
	  if ($result!= null){ 	 return  $result  ;	  }
	  else{	 return  null;	  }
 
	}	
 
	public static function listemodeles($cli_id,$lg )
    { 
     DB::select("SET @p0='$cli_id' ;");

 	  $result=  DB::select ("  CALL `sp_affinage_modele_liste`(@p0); ");
 
	  if ($result!= null){ 	 return  $result  ;	  }
	  else{	 return  null;	  }
 
	}		
	
	 
	public static function listeprestations($cli_id  )
    { 
  	  $result=  DB::select ("  CALL `sp_labo_choix`(); ");
 
	  if ($result!= null){
 	 return   $result  ;
	  }
	  else{
		  
  $error = array(  "status" => "error",  "error_code" => 404, "error_message" => "Aucun résultat trouvé",);
		return response()->json(  $error ,404,array(),JSON_PRETTY_PRINT);	
		  }
	 
	}	


	public static function natures()
    { 
 	  $result=  DB::select (" CALL `sp_affinage_nature_lot`(); ");
 
	  if ($result!= null){ 	 return  $result  ;	  }
	  else{	 return  'Error';	  } 
    }
	
	public static function natures2()
    { 
 
 	  $result=  DB::select (" CALL `sp_accueil_liste_nature_lot`(); ");
	  if ($result!= null){ 	 return  $result  ;	  }
	  else{	 return  'Error';	  }
 
    }
	
	   public static function natures3()
    { 
      $result=  DB::select (" CALL `sp_rmp_nature_lot`(); ");
 
	  if ($result!= null){ 	 return  $result  ;	  }
	  else{	 return  'Error';	  }
    }

 public function addmodele(Request $request)
{
 // try{
$cl_ident  = intval($request->get('cl_ident'));	
$modele_nom   = $request->get('modele_nom');	
$nature_lot_ident = intval($request->get('nature_lot_ident'));	
$pds_lot  = floatval($request->get('pds_lot'));	
$estim_titre_au  = floatval($request->get('estim_titre_au'));	
$estim_titre_ag  = floatval($request->get('estim_titre_ag'));	
$estim_titre_pt  = floatval($request->get('estim_titre_pt'));	
$estim_titre_pd  = floatval($request->get('estim_titre_pd'));	
$assiste   =  $request->get('assiste') ;	
 
 		if($assiste=="on" || $assiste==1 ){
			$assiste=1;
		}else{
			$assiste=0;			
		}
   	 
        $affinage  = new Modele_affinage([
              'cl_ident' => $cl_ident,
             'modele_nom' => $modele_nom ,
             'nature_lot_ident' => $nature_lot_ident ,
             'pds_lot' => $pds_lot ,
             'estim_titre_au' => $estim_titre_au ,
             'estim_titre_ag' => $estim_titre_ag ,
             'estim_titre_pt' => $estim_titre_pt ,
             'estim_titre_pd' => $estim_titre_pd ,
             'assiste' => $assiste  
              
        ]);

        if($affinage->save()){
		  $id=$affinage->modele_affinage_ident;
		  return redirect('/viewmodele/'.$id)->with('success', ' ajouté avec succès');
		
		}
		
 
 }

 
  public function addmodelelab(Request $request)
{
 // try{
$cl_ident  = intval($request->get('cl_ident'));	
$modele_nom   = $request->get('modele_nom');	
$nature_lot_ident = intval($request->get('nature_lot_ident'));	
$poids  = floatval($request->get('poids'));	
$titrage_au  = floatval($request->get('titrage_au'));	
$titrage_ag  = floatval($request->get('titrage_ag'));	
$titrage_pt  = floatval($request->get('titrage_pt'));	
$titrage_pd  = floatval($request->get('titrage_pd'));	
$qte   =  $request->get('qte') ;	
$valeur   =  $request->get('valeur') ;	
$type_lab_ident   =  $request->get('type_lab_ident') ;	
$choix_lab_ident   =  $request->get('choix_lab_ident') ;	
 
 
   	 
        $modele  = new Modele_lab([
              'cl_ident' => $cl_ident,
             'modele_nom' => $modele_nom ,
             'poids' => $poids ,
             'titrage_au' => $titrage_au ,
             'titrage_ag' => $titrage_ag ,
             'titrage_pt' => $titrage_pt ,
             'titrage_pd' => $titrage_pd ,
             'nature_lot_ident' => $nature_lot_ident ,			 
             'type_lab_ident' => $type_lab_ident ,
             'choix_lab_ident' => $choix_lab_ident ,
             'qte' => $qte ,
             'valeur' => $valeur ,
              
        ]);

        if($modele->save()){
		  $id=$modele->modele_lab_ident;
		  return redirect('/viewmodelelab/'.$id)->with('success', ' ajouté avec succès');
		
		}
		
 }
 
 public function addmodelermp(Request $request)
{
 // try{
$cl_ident  = intval($request->get('cl_ident'));	
$modele_nom   = $request->get('modele_nom');	
$nature_lot_ident = intval($request->get('nature_lot_ident'));	
$pds_lot  = floatval($request->get('pds_lot'));	
$estim_titre_au  = floatval($request->get('estim_titre_au'));	
$estim_titre_ag  = floatval($request->get('estim_titre_ag'));	
$estim_titre_pt  = floatval($request->get('estim_titre_pt'));	
$estim_titre_pd  = floatval($request->get('estim_titre_pd'));	
$assiste   =  $request->get('assiste') ;	
$demande_acompte   =  $request->get('acompte') ;	
$choix_couv_ident   =  $request->get('choix_couv_ident') ;	
 
 		if($assiste=="on" || $assiste==1 ){
			$assiste=1;
		}else{
			$assiste=0;			
		}
		
 		if($demande_acompte=="on" || $demande_acompte==1 ){
			$demande_acompte=1;
		}else{
			$demande_acompte=0;			
		} 
		
        $rachat  = new Modele_rmp([
              'cl_ident' => $cl_ident,
             'modele_nom' => $modele_nom ,
             'nature_lot_ident' => $nature_lot_ident ,
             'pds_lot' => $pds_lot ,
             'estim_titre_au' => $estim_titre_au ,
             'estim_titre_ag' => $estim_titre_ag ,
             'estim_titre_pt' => $estim_titre_pt ,
             'estim_titre_pd' => $estim_titre_pd ,
             'assiste' => $assiste ,
             'demande_acompte' => $demande_acompte , 
             'choix_couv_ident' => $choix_couv_ident  
              
        ]);

        if($rachat->save()){
		  $id=$rachat->modele_rmp_ident;
		  return redirect('/viewmodelermp/'.$id)->with('success', ' ajouté avec succès');
		
		}
		
 }

  public function updatemodele(Request $request)
{
$id  = intval($request->get('id'));	
$cl_ident  = intval($request->get('cl_ident'));	
$modele_nom   = $request->get('modele_nom');	
$nature_lot_ident = intval($request->get('nature_lot_ident'));	
$pds_lot  = floatval($request->get('pds_lot'));	
$pds_cdr  = floatval($request->get('pds_cdr'));	
$estim_titre_au  = floatval($request->get('estim_titre_au'));	
$estim_titre_ag  = floatval($request->get('estim_titre_ag'));	
$estim_titre_pt  = floatval($request->get('estim_titre_pt'));	
$estim_titre_pd  = floatval($request->get('estim_titre_pd'));	
$assiste   =  $request->get('assiste') ;	
$update   =  $request->get('update') ;	
 $estimation_prix   =  $request->get('estimation_prix') ;	

 		if($assiste=="on" || $assiste==1 ){
			$assiste=1;
		}else{
			$assiste=0;			
		}
 
   if ($update !=null){
	   
  	 
    
	    Modele_affinage::where('modele_affinage_ident',$id)->update(
		array(
              'cl_ident' => $cl_ident,
             'modele_nom' => $modele_nom ,
             'nature_lot_ident' => $nature_lot_ident ,
             'pds_lot' => $pds_lot ,
             'estim_titre_au' => $estim_titre_au ,
             'estim_titre_ag' => $estim_titre_ag ,
             'estim_titre_pt' => $estim_titre_pt ,
             'estim_titre_pd' => $estim_titre_pd ,
             'assiste' => $assiste  
              
			)
		);
 
 		  return redirect('/affinage/')->with('success', ' Modèle modifié avec succès');

		}else{
			
 
 
			$Cmde_aff_e  = new Cmde_aff_e([
              'cl_ident' => $cl_ident,
              'cmde_aff_date' => date('Y-m-d H:i:s'),
              'cmde_aff_canal' => 0, // doit être WEB pourquoi dans la base int ?
              'cmde_aff_poids_brut' => $pds_cdr,
              'cmde_aff_poids_lot' => $pds_lot,
			  'statut' => 'panier', 			 

			  ]);
			if($Cmde_aff_e->save()){
				$id=$Cmde_aff_e->cmde_aff_ident;
				
			$Cmde_aff_l  = new Cmde_aff_l([
               'cmde_aff_e_ident' => $id,
               'nature_ident' => $nature_lot_ident,
               'cmde_aff_poids_lot' => $pds_lot,
               'cmde_estim_titre_au' => $estim_titre_au,
               'cmde_estim_titre_ag' => $estim_titre_ag,
               'cmde_estim_titre_pt' => $estim_titre_pt,
               'cmde_estim_titre_pd' => $estim_titre_pd,
               'assiste' => $assiste,
			   'statut' => 'panier', 			 
               'nom_modele' => $modele_nom,
               'estimation_prix' => $estimation_prix,

			     
			  ]);	
				$Cmde_aff_l->save();
			}
			
		  return back()->with('success', 'Modèle ajouté au panier');
			
		}			
		 
 }
 
 
  public function updatemodelermp(Request $request)
{
 // try{
$id  = intval($request->get('id'));	
$cl_ident  = intval($request->get('cl_ident'));	
$modele_nom   = $request->get('modele_nom');	
$nature_lot_ident = intval($request->get('nature_lot_ident'));	
$pds_lot  = floatval($request->get('pds_lot'));	
$pds_cdr  = floatval($request->get('pds_cdr'));	
$estim_titre_au  = floatval($request->get('estim_titre_au'));	
$estim_titre_ag  = floatval($request->get('estim_titre_ag'));	
$estim_titre_pt  = floatval($request->get('estim_titre_pt'));	
$estim_titre_pd  = floatval($request->get('estim_titre_pd'));	
$assiste   =  $request->get('assiste') ;	
$choix_couv_ident   =  $request->get('choix_couv_ident') ;	
$demande_acompte   =  $request->get('acompte') ;	
$update   =  $request->input('update') ;	
 $estimation_prix   =   ($request->get('estimation_prix')) ;	
  
 		if($assiste=="on" || $assiste==1 ){
			$assiste=1;
		}else{
			$assiste=0;			
		}
		
 		if($demande_acompte=="on" || $demande_acompte==1 ){
			$demande_acompte=1;
		}else{
			$demande_acompte=0;			
		}		
 
   	 
    if ($update !=null){  
	    Modele_rmp::where('modele_rmp_ident',$id)->update(
		array(
			'cl_ident' => $cl_ident,
             'modele_nom' => $modele_nom ,
             'nature_lot_ident' => $nature_lot_ident ,
             'pds_lot' => $pds_lot ,
             'estim_titre_au' => $estim_titre_au ,
             'estim_titre_ag' => $estim_titre_ag ,
             'estim_titre_pt' => $estim_titre_pt ,
             'estim_titre_pd' => $estim_titre_pd ,
             'assiste' => $assiste , 
             'demande_acompte' => $demande_acompte , 
             'choix_couv_ident' => $choix_couv_ident 			 
              
			)
		);
 
		  return redirect('/rachat/')->with('success', ' Modèle modifié avec succès');
		 
		 
		}else{
			
  
			$Cmde_rmp_e  = new Cmde_rmp_e([
              'cl_ident' => $cl_ident,
              'cmde_rmp_date' => date('Y-m-d H:i:s'),
              'cmde_rmp_canal' => 0, // doit être WEB pourquoi dans la base int ?
              'cmde_rmp_poids_brut' => $pds_cdr,
              'cmde_rmp_poids_lot' => $pds_lot,
              'estim_au' => $estim_titre_au,
              'estim_ag' => $estim_titre_ag,
              'estim_pt' => $estim_titre_pt,
              'estim_pd' => $estim_titre_pd,
              'assiste' => $estim_titre_pd,
              'demande_acompte' => $demande_acompte,
              'choix_couv_ident' => $choix_couv_ident,
 			  'statut' => 'panier', 			 
        
			  
			  ]);
			if($Cmde_rmp_e->save()){
				$id=$Cmde_rmp_e->cmde_rmp_ident;
 
			$Cmde_rmp_l  = new Cmde_rmp_l([
               'cmde_rmp_e_ident' => $id,
               'nature_ident' => $nature_lot_ident,
               'cmde_rmp_poids' => $pds_lot,
               'cmde_estim_titre_au' => $estim_titre_au,
               'cmde_estim_titre_ag' => $estim_titre_ag,
               'cmde_estim_titre_pt' => $estim_titre_pt,
               'cmde_estim_titre_pd' => $estim_titre_pd,
               'assiste' => $assiste,
			   'statut' => 'panier', 			 
               'nom_modele' => $modele_nom,
               'estimation_prix' => $estimation_prix,
			  
			     
			  ]);	
				$Cmde_rmp_l->save();
			}
			
		  return back()->with('success', 'Modèle ajouté au panier');
			
		}			 

 }
 
 public function updatemodelelab(Request $request)
{
 // try{
$id  = intval($request->get('id'));	
$cl_ident  = intval($request->get('cl_ident'));	
$modele_nom   = $request->get('modele_nom');	
$nature_lot_ident = intval($request->get('nature_lot_ident'));	
$poids  = floatval($request->get('poids'));	
$titrage_au  = floatval($request->get('titrage_au'));	
$titrage_ag  = floatval($request->get('titrage_ag'));	
$titrage_pt  = floatval($request->get('titrage_pt'));	
$titrage_pd  = floatval($request->get('titrage_pd'));	
$qte   =  $request->get('qte') ;	
$valeur   =  $request->get('valeur') ;	
$type_lab_ident   =  $request->get('type_lab_ident') ;	
$choix_lab_ident   =  $request->get('choix_lab_ident') ;	
$update   =  $request->input('update') ;	
$estimation_prix   =  $request->get('estimation_prix') ;	
 
     if ($update !=null){  
	    Modele_lab::where('modele_lab_ident',$id)->update(
		array(
               'cl_ident' => $cl_ident,
             'modele_nom' => $modele_nom ,
             'poids' => $poids ,
             'titrage_au' => $titrage_au ,
             'titrage_ag' => $titrage_ag ,
             'titrage_pt' => $titrage_pt ,
             'titrage_pd' => $titrage_pd ,
             'nature_lot_ident' => $nature_lot_ident ,			 
             'type_lab_ident' => $type_lab_ident ,
             'choix_lab_ident' => $choix_lab_ident ,
             'qte' => $qte ,
             'valeur' => $valeur ,
              
			)
		);
 
		  return redirect('/laboratoire/')->with('success', ' Modèle modifié avec succès');
		 
	}else{
  
			$Cmde_lab_e  = new Cmde_lab_e([
              'cl_ident' => $cl_ident,
              'cmde_lab_date' => date('Y-m-d H:i:s'),
              'cmde_lab_canal' => 0, // doit être WEB pourquoi dans la base int ?
              'cmde_lab_qte' => $qte,
              'cmde_lab_poids' => $poids,
			  'statut' => 'panier', 			 
             
			  
			  ]);
			if($Cmde_lab_e->save()){
				$id=$Cmde_lab_e->cmde_lab_ident;
 
  
			$Cmde_lab_l  = new Cmde_lab_l([
               'cmde_lab_e_ident' => $id,
               'type_lab_ident' => $type_lab_ident,
               'nature_ident' => $nature_lot_ident,
               'choix_lab_ident' => $choix_lab_ident,
               'qte' => $qte,
               'poids' => $poids,
               'titrage_au' => $titrage_au,
               'titrage_ag' => $titrage_ag,
               'titrage_pt' => $titrage_pt,
               'titrage_pd' => $titrage_pd,
			   'statut' => 'panier', 			 
                'nom_modele' => $modele_nom,
               'estimation_prix' => $estimation_prix,
			  
			     
			  ]);	
				$Cmde_lab_l->save();
			}
			
		  return back()->with('success', 'Modèle ajouté au panier');
			
		}			 
		 	 
 }

  public function validatemodels(Request $request)
{
 $user = auth()->user();  
 $adresse   = $request->get('adresse');	
 $agence   = $request->get('agence');	

$E_CmdesAff=DB::table('cmde_aff_e')->where('cl_ident',$user['client_id'])->where('statut','panier')->get();
 foreach ($E_CmdesAff as $cmd)
 {								
  $cmdid=$cmd->cmde_aff_ident;
  $lignes=DB::table('cmde_aff_l')->where('cmde_aff_e_ident',$cmdid)->where('statut','panier')->update( array( 'statut'=>'valide' )  );
 }
 DB::table('cmde_aff_e')->where('cl_ident',$user['client_id'])->where('statut','panier')->update( array( 'statut'=>'valide','adresse_id'=>$adresse ,'agence_id'=>$agence )  );

 $E_CmdesLab=DB::table('cmde_lab_e')->where('cl_ident',$user['client_id'])->where('statut','panier')->get();
  foreach ($E_CmdesLab as $cmd)
 {								
  $cmdid=$cmd->cmde_lab_ident;
  $lignes=DB::table('cmde_lab_l')->where('cmde_lab_e_ident',$cmdid)->where('statut','panier')->update( array( 'statut'=>'valide' )  );
 }
  DB::table('cmde_lab_e')->where('cl_ident',$user['client_id'])->where('statut','panier')->update( array( 'statut'=>'valide','adresse_id'=>$adresse ,'agence_id'=>$agence )  );

 $E_CmdesRMP=DB::table('cmde_rmp_e')->where('cl_ident',$user['client_id'])->where('statut','panier')->get();
  foreach ($E_CmdesRMP as $cmd)
 {								
  $cmdid=$cmd->cmde_rmp_ident;
  $lignes=DB::table('cmde_rmp_l')->where('cmde_rmp_e_ident',$cmdid)->where('statut','panier')->update( array( 'statut'=>'valide' )  );
 }	
  DB::table('cmde_rmp_e')->where('cl_ident',$user['client_id'])->where('statut','panier')->update( array( 'statut'=>'valide','adresse_id'=>$adresse ,'agence_id'=>$agence )  );

  
 
 return redirect('/home')->with('success', ' Commande passée avec succès');
	
}	

  public function validatemodelsliv(Request $request)
{
 $user = auth()->user();  
 $adresse   = $request->get('adresse');	
 $agence   = $request->get('agence');	

  $client_id=$user['client_id'];
   DB::select("SET @p0='$client_id' ;");
  $adresses=  DB::select (" CALL `sp_liste_adresse_livraison`(@p0);");
 	foreach($adresses as $address)
	{
		if($adresse==$address->id)
		{
			 $nomagence= $address->nom;
			$adresse1= $address->adresse1;
			$ville= $address->ville;
			$codep= $address->zip;
		}
	}

 $phone   = $request->get('phone');	
 $email   = $request->get('email');	
 $poids   = $request->get('poids');	
 $longeur   = $request->get('longeur');	
 $largeur   = $request->get('largeur');	
 $hauteur   = $request->get('hauteur');	

  $result = DHLController::shipment(true,'saampFR','A@0eV^1zW!3x','220136396',$nomagence,$adresse1,$ville,$codep, $phone,$email,$poids,$longeur,$largeur,$hauteur) ;
	 if($result['truck_number']!=0){
  
 
$E_CmdesAff=DB::table('cmde_aff_e')->where('cl_ident',$user['client_id'])->where('statut','panier')->get();
 foreach ($E_CmdesAff as $cmd)
 {								
  $cmdid=$cmd->cmde_aff_ident;
  $lignes=DB::table('cmde_aff_l')->where('cmde_aff_e_ident',$cmdid)->where('statut','panier')->update( array( 'statut'=>'valide' )  );
 }
 DB::table('cmde_aff_e')->where('cl_ident',$user['client_id'])->where('statut','panier')->update( array( 'statut'=>'valide','adresse_id'=>$adresse ,'agence_id'=>$agence ,'truck_number'=> $result['truck_number']  )  );

 $E_CmdesLab=DB::table('cmde_lab_e')->where('cl_ident',$user['client_id'])->where('statut','panier')->get();
  foreach ($E_CmdesLab as $cmd)
 {								
  $cmdid=$cmd->cmde_lab_ident;
  $lignes=DB::table('cmde_lab_l')->where('cmde_lab_e_ident',$cmdid)->where('statut','panier')->update( array( 'statut'=>'valide' )  );
 }
  DB::table('cmde_lab_e')->where('cl_ident',$user['client_id'])->where('statut','panier')->update( array( 'statut'=>'valide','adresse_id'=>$adresse ,'agence_id'=>$agence,'truck_number'=> $result['truck_number']  )  );

 $E_CmdesRMP=DB::table('cmde_rmp_e')->where('cl_ident',$user['client_id'])->where('statut','panier')->get();
  foreach ($E_CmdesRMP as $cmd)
 {								
  $cmdid=$cmd->cmde_rmp_ident;
  $lignes=DB::table('cmde_rmp_l')->where('cmde_rmp_e_ident',$cmdid)->where('statut','panier')->update( array( 'statut'=>'valide' )  );
 }	
  DB::table('cmde_rmp_e')->where('cl_ident',$user['client_id'])->where('statut','panier')->update( array( 'statut'=>'valide','adresse_id'=>$adresse ,'agence_id'=>$agence  ,'truck_number'=> $result['truck_number']  )  );

 } 
  
  return json_encode($result);
 
}		
	
 
 public function validateproducts(Request $request)
{
 $user = auth()->user();  
 $adresse   = $request->get('adresse');	
 $agence   = $request->get('agence');
 $gross_weight   = $request->get('gross');
 $mode   = $request->get('mode');
 $client_id=$user['client_id'];
 $langue=$user['lg'];
 
 $Order=DB::table('orders')->where('user',$user->id)->where('status','cart')->first( );
 $produits=DB::table('products')->where('orderid',$Order->id)->get();

$quantite= count($produits); // nombre de produits ???
$poids=$Order->weight;
$or=$Order->gold;
$argent=$Order->silver;
$platine=$Order->platine;
$palladium=$Order->palladium;
if($Order->adresse_id!=null)
{$adresse=$Order->adresse_id;}else{$adresse=0;}
if($Order->agence_id!=null)
{$agence=$Order->agence_id;}else{$agence=0;}

$facon=$Order->comp_amount;    // montant du complément ???
  
 DB::select("SET @p0='$client_id' ;");
 DB::select("SET @p1='$langue' ;");
 DB::select("SET @p2='$quantite' ;");
 DB::select("SET @p3='$poids' ;");
 DB::select("SET @p4='$or' ;");
 DB::select("SET @p5='$argent' ;");
 DB::select("SET @p6='$platine' ;");
 DB::select("SET @p7='$palladium' ;");
 DB::select("SET @p8='$facon' ;");
 DB::select("SET @p9='$adresse' ;");
 DB::select("SET @p10='$agence' ;");
 

   DB::select ("  CALL `SP_cmde_e_insert`(@p0,@p1,@p2,@p3,@p4,@p5,@p6,@p7,@p8,@p9,@p10,@p11 ); ");
   DB::select("SELECT @p11 AS `cmde_id`  ;");

 	 $cmde_id = null;
$selectResult = DB::select(DB::raw("SELECT @p11 AS `cmde_id`  ;"));

if (!empty($selectResult) && isset($selectResult[0]->cmde_id)) {
    // we have a result
    $cmde_id = $selectResult[0]->cmde_id;
	
 // update order table  
  DB::table('orders')->where('user',$user->id)->where('status','cart')->update( array( 'status'=>'valide','gross_weight'=>$gross_weight,'mode'=>$mode )  );
	
}  
	  
	  if (intval($cmde_id) > 0) {
 	  $i=0;
 	  foreach ($produits as $produit)
	  {
  $i++;
$produit_id  = intval($produit->article);	
$type_id   = intval($produit->type );
$alliage_id   = intval($produit->alliage );
$etat_id   = intval($produit->etat_id); 
$comp_id   = intval($produit->comp_id );
$comp_val   = floatval($produit->comp_val );
$quantite = floatval($produit->qte );
$poids  = floatval($produit->poids );
$tarif   = floatval($produit->tarif );	 
$mode_facturation    = intval($produit->fact_id );   
  

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
	  
} //foreach


DB::table('products')->where('orderid',$Order->id)->update( array( 'status'=>'valide' ));
} //cmd_id>0

  
 
}


	public static function listecommandesrmp($cli_id  )
    { 
   	   DB::select("SET @p0='$cli_id' ;");
 	  $result=  DB::select ("  CALL `sp_rmp_cmde_liste`(@p0); ");
 
	  if ($result!= null){ 	 return  $result  ;	  }
	  else{	 return  null;	  }

	}		
	

	public static function listemodelesrmp($cli_id  )
    { 
   	   DB::select("SET @p0='$cli_id' ;");
 	  $result=  DB::select ("  CALL `sp_rmp_modele_liste`(@p0); ");
 
	  if ($result!= null){ 	 return  $result  ;	  }
	  else{	 return  null;	  }
 
	}		
	
	public static function detailscommandermp($id_cmd    )
    { 
   	   DB::select("SET @p0='$id_cmd' ;");
 	  $result=  DB::select ("  CALL `sp_rmp_cmde_detail`(@p0); ");
 
	  if ($result!= null){
	  return   $result  ;
	  }
	  else{
		  
  $error = array(  "status" => "error",  "error_code" => 404, "error_message" => "Aucun résultat trouvé",);
		return response()->json(  $error ,404,array(),JSON_PRETTY_PRINT);

		}
	
	}

 	public static function listecommandeslabo($cli_id  )
    { 
      DB::select("SET @p0='$cli_id' ;");
 	  $result=  DB::select ("  CALL `sp_labo_cmde_liste`(@p0); ");
	  if ($result!= null){ 	 return  $result  ;	  }
	  else{	 return  null;	  }
	}		
		
	public static function listemodeleslabo($cli_id  )
    { 
   	   DB::select("SET @p0='$cli_id' ;");
 	  $result=  DB::select ("  CALL `sp_labo_modele_liste`(@p0); ");
 
	  if ($result!= null){ 	 return  $result  ;	  }
	  else{	 return  null;	  }
	}		
			
	public static function detailscommandelabo($id_cmd    )
    { 
   	DB::select("SET @p0='$id_cmd' ;");

 	  $result=  DB::select ("  CALL `sp_labo_cmde_detail`(@p0); ");
 
	  if ($result!= null){
	 return   $result   ;
	  }
	  else{
		  
  $error = array(  "status" => "error",  "error_code" => 404, "error_message" => "Aucun résultat trouvé",);
		return response()->json(  $error ,404,array(),JSON_PRETTY_PRINT);

		}
	}		
		
	  public static function tariflabo($cl_id,$choix_id,$titre_or,$titre_argent,$titre_platine,$titre_palladium  )
    { 
   	   DB::select("SET @p0='$cl_id' ;");
   	   DB::select("SET @p1='$choix_id' ;");
   	   DB::select("SET @p2='$titre_or' ;");
   	   DB::select("SET @p3='$titre_argent' ;");
   	   DB::select("SET @p4='$titre_platine' ;");
   	   DB::select("SET @p5='$titre_palladium' ;");
    
		$result=  DB::select ("  CALL `sp_labo_tarif`(@p0,@p1,@p2,@p3,@p4,@p5); ");
		return $result;
	}		
			
	
	public static function tarifrmp($nature_id,$titre_or,$titre_argent,$titre_platine,$titre_palladium,$poids )
    { 
   	   DB::select("SET @p0='$nature_id' ;");
       DB::select("SET @p1='$titre_or' ;");
   	   DB::select("SET @p2='$titre_argent' ;");
   	   DB::select("SET @p3='$titre_platine' ;");
   	   DB::select("SET @p4='$titre_palladium' ;");
   	   DB::select("SET @p5='$poids' ;");
    
 	  $result=  DB::select ("  CALL `sp_rmp_tarif`(@p0,@p1,@p2,@p3,@p4,@p5); ");
		return $result;
	}		
 
 	public static function detailscommandeprod($id_cmd    )
    {
      DB::select("SET @p0='$id_cmd' ;");
 	  $result=  DB::select ("  CALL `sp_produit_cmde_detail`(@p0); ");
	  if ($result!= null){
	 return  $result  ;
 	  }
	  
	}
	

  public function entetecommande(Request $request)
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
	return $cmde_id;
	}  
	 
 }
	  
	public function lignecommande(Request $request)
	{
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
	 
	}
	
	
}
