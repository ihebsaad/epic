<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\User ;
use DB ;

class UsersController extends Controller
{
	
	  public function __construct()
    {
        $this->middleware('auth', ['except' => ['registration' ]]);
    } 
	 
	 public function index()
	{
		 $users= User::orderBy('name','asc')->get();
        return view('users.index',[ 'users'=>$users]);
 	}
	
		public function view($id  )
	{
        $user= User::where('id',$id)->first();
        return view('users.view',['id'=>$id,'user'=>$user]);
 	}
	
	public function profile(  )
	{
        $user = auth()->user();

        $user= User::where('id',$user->id)->first();
        return view('users.profile',['id'=>$user->id,'user'=>$user]);
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

    public static function  ChampById($champ,$id)
    {
        $user = User::find($id);
        if (isset($user[$champ])) {
            return $user[$champ] ;
        }else{return '';}

    }
	
	    public static function  adduser()
    {
		   return view('users.add');

	}
	
	    public function updateuser(Request $request)
    {
        $id= $request->get('user');
        $name= $request->get('name');
        $lastname= $request->get('lastname');
        $activity= $request->get('activity');
        $mobile= $request->get('mobile');
        $phone= $request->get('phone');
        $password= $request->get('password');
        $confirmation= $request->get('confirmation');
         if($password !=''  && (strlen($password )>5) ){
		
		if($password == $confirmation )
		{  $password= bcrypt(trim($request->get('password')));

					
		DB::table('users')->where('id', $id)->update(array(
 		'name' => $name,
		'lastname' => $lastname,
		'activity' => $activity,
		'mobile' => $mobile,
		'phone' => $phone,
		'password' => $password,
		
		));
		 }
        }else{

		 DB::table('users')->where('id', $id)->update(array(
 		'name' => $name,
		'lastname' => $lastname,
		'activity' => $activity,
		'mobile' => $mobile,
		'phone' => $phone,
 		
		));
		
        }
		
	  return redirect('/profile')->with('success', ' modifié avec succès');

 
    }

	
	 public function adding(Request $request)
    {
         $siret= $request->get('siret');
         $email= $request->get('email');
         $name= $request->get('name');
        $lastname= $request->get('lastname');
        $activity= $request->get('activity');
        $mobile= $request->get('mobile');
        $phone= $request->get('phone');
        $password= $request->get('password');
        $confirmation= $request->get('confirmation');
        $client_id= $request->get('client_id');
         if($password !=''  && (strlen($password )>5) ){
		
		if($password == $confirmation )
		{  $password= bcrypt(trim($request->get('password')));

					
	 $user = new User([
 		'username' => $email,
 		'email' => $email,
 		'siret' => $siret,
 		'name' => $name,
		'lastname' => $lastname,
		'activity' => $activity,
		'mobile' => $mobile,
		'phone' => $phone,
		'password' => $password,
		'client_id' => $client_id,
		]
		);
		
		if($user->save()) {
	    return redirect('/users')->with('success', ' ajouté avec succès');
		
		}else{
			return back();
		}
		
		 }
		 }
	 }

	 
	 	 public function registration(Request $request)
    {
         $siret= $request->get('siret');
         $email= $request->get('email');
         $name= $request->get('name');
        $lastname= $request->get('lastname');
        $activity= $request->get('activity');
        $mobile= $request->get('mobile');
        $phone= $request->get('phone');
        $password= $request->get('password');
        $confirmation= $request->get('confirmation');
        $client_id= intval($request->get('client_id'));
        $client_id2= intval($request->get('client_id2'));
         if($password !=''  && (strlen($password )>7) ){
		
		if( $client_id >0 && ($client_id==$client_id2) && $password== $confirmation )
		{  $password= bcrypt(trim($request->get('password')));

		 		
	 $user = new User([
 		'username' => $email,
 		'email' => $email,
 		'siret' => $siret,
 		'name' => $name,
		'lastname' => $lastname,
		'activity' => $activity,
		'mobile' => $mobile,
		'phone' => $phone,
		'password' => $password,
		'client_id' => $client_id,
		]
		);
		 
		if($user->save()) {
	    return redirect('/login')->with('success', ' Inscrit avec succès');
		
		}else{
			return redirect('/register') ;
		}
		 
		 }else{
	 //   return redirect('/register')->with('error', "Problème lors de l'inscription, contactez nous pour le résoudre");
		return redirect('/register')->withErrors([ "Problème lors de l'inscription, contactez nous à l'adresse : contact@saamp.com."]);

	 
		 }
		 }
	 }

	 
	 
		 public function updatinguser(Request $request)
    {
 
        $user= $request->get('user');
        $activity= $request->get('activity');
        $mobile= $request->get('mobile');
        $phone= $request->get('phone');
        $password= $request->get('password');
        $confirmation= $request->get('confirmation');
          if($password !=''  && (strlen($password )>5) ){
		
		if($password == $confirmation )
		{  $password= bcrypt(trim($request->get('password')));

					
 DB::table('users')->where('id', $user)->update(array( 	
		 
		'activity' => $activity,
		'mobile' => $mobile,
		'phone' => $phone,
		'password' => $password,
 		)
		);
		
 	    return redirect('/users')->with('success', ' modifié avec succès');
		
		 
		
		 }
		 }else{
			 
					
 DB::table('users')->where('id', $user)->update(array( 	
		 
		'activity' => $activity,
		'mobile' => $mobile,
		'phone' => $phone,
  		)
		);
		
 	    return redirect('/users')->with('success', ' modifié avec succès');
		
	 	 
			 
			 
		 }
	 }
		    public function updatecomp(Request $request)
    {
        $id= $request->get('cl_ident');
        $raison_sociale= $request->get('raison_sociale');
        $type_societe= $request->get('type_societe');
        $siret= $request->get('siret');
        $num_tva= $request->get('num_tva');
        $enseigne= $request->get('enseigne');
        $type_client_ident= $request->get('type_client_ident');
        $adresse1= $request->get('adresse1');
        $adresse2= $request->get('adresse2');
        $zip= $request->get('zip');
        $ville= $request->get('ville');
        $pays_code= $request->get('pays_code');
        $agence_ident= $request->get('agence_ident');
        $metal_defaut_id= $request->get('metal_defaut_id');
      

		 DB::table('client')->where('cl_ident', $id)->update(array(
 		'raison_sociale' => $raison_sociale,
		'type_societe' => $type_societe,
		'siret' => $siret,
		'num_tva' => $num_tva,
		'enseigne' => $enseigne,
		'type_client_ident' => $type_client_ident,
		'adresse1' => $adresse1,
		'adresse2' => $adresse2,
		'zip' => $zip,
		'ville' => $ville,
		'pays_code' => $pays_code,
		'agence_ident' => $agence_ident,
		'metal_defaut_id' => $metal_defaut_id,
 		
		));
		
 		
	  return redirect('/profile')->with('success', ' modifié avec succès');

 
    }
	
	
	
	    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('/users')->with('success', '  supprimé avec succès');
    }
	
	
	

	
	
	
	
	
	
	
}
