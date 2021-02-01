<?php

namespace App;
 
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
	 	 
		'orderid',		 
		'article',	 
		'libelle',
		'qte',		 
		'unite',		 
		'poids',	 
		'montant',		 
		'montant_compl',	 
		'gold',		 
		'silver',	 
		'palladium',	 
		'platine',
		'type',
		'famille1',
		'famille2',
		'famille3',
		'alliage',
		'mesure1',
		'mesure2',
		'comp_id',
		'comp_val',
		'etat_id',
		'fact_id',
		'tarif',
		'status',

    ];

     
    }
