<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Country ;

class CountryController extends Controller
{
	
	/* public function __construct()
    {
        $this->middleware('auth:api');
    } 
	*/
	 public function index()
	{
 	return response()->json( Country::get(),200,array(),JSON_PRETTY_PRINT);
	}
	
	public function create(Request $request)
	{
 	}
	 public function show($id)
	{
 	return response()->json( Country::where('id',$id)->first(),200,array(),JSON_PRETTY_PRINT);
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
	
	
	
	public function countries()
	{
 	return response()->json( Country::get(),200,array(),JSON_PRETTY_PRINT);
	}
	
    public function country($id)
	{
 	return response()->json( Country::where('id',$id)->first(),200,array(),JSON_PRETTY_PRINT);
	}
	
}
