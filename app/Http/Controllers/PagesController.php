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
	
	
 	 public function livraison()
    { 
         return view('livraison');
    }
	
 	



 	 public function trading()
    { 
         return view('trading');
    }

 	 public function virement()
    { 
         return view('virement');
    }
	
  	 public function euros()
    { 
         return view('euros');
    }
	
  	 public function poids()
    { 
         return view('poids');
    }
	
	/**** Affinage ***/
	 public function affinage()
    { 
         return view('affinage.affinage');
    }
	
  	 public function modeles()
    { 
         return view('affinage.modeles');
    }
	
	 public function modele()
    { 
         return view('affinage.modele');
    }
	
	public function viewmodele($id)
    { 
         return view('affinage.viewmodele',['id'=>$id]);
    }	
	
	
	public function commande($id)
    { 
         return view('affinage.commande',['id'=>$id]);
    }
	
	
 	 public function laboratoire()
    { 
         return view('laboratoire.laboratoire');
    }	
	
	 public function modelelab()
    { 
         return view('laboratoire.modele');
    }
	
	public function commandelab($id)
    { 
         return view('laboratoire.commande',['id'=>$id]);
    }	
	
	

}
