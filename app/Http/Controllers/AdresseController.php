<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Adresse ;

class AdresseController extends Controller
{
	
	/* public function __construct()
    {
        $this->middleware('auth:api');
    } 
	*/
	 public function index()
	{
 	return response()->json( Adresse::get(),200,array(),JSON_PRETTY_PRINT);
	}
	
	public function create(Request $request)
	{
 	}
	 public function show($id)
	{
 	return response()->json( Adresse::where('adresse_liv_ident',$id)->first(),200,array(),JSON_PRETTY_PRINT);
	}
	
	public function store(Request $request)
	{
 	}
	
	public function edit( $id)
	{
 	}
	
	public function update(Request $request,$id)
	{
 	}	
	public function destroy(Request $request)
	{
 	}		
	
	
 
	
}
