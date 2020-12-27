<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\User ;

class PagesController extends Controller
{
	
	  public function __construct()
    {
        $this->middleware('auth');
    } 
	 
 
      public function index()
    { 
         return view('home');
    }
	
      public function catalog($type,$famille1)
    { 
	return view('catalog',['type'=>$type,'famille1'=>$famille1]);
    }
	
	  public function orders()
    { 
         return view('orders');
    }
	
	  public function test()
    { 
         return view('test');
    }

	 public function findings()
    { 
         return view('products.findings');
    }
	
	 public function products()
    { 
         return view('products.products');
    }
	
	 public function jewelry()
    { 
         return view('products.jewelry');
    }
	
	 public function galvano()
    { 
         return view('products.galvano');
    }
	
	 public function refining()
    { 
         return view('products.refining');
    }

	 public function laboratory()
    { 
         return view('laboratory');
    }
	
      public function panier()
    { 
	return view('products.panier');
    }
	
/*	 public function refining()
    { 
         return view('refining');
    }
*/


}
