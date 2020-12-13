<?php

namespace App;
 
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
 protected $table='demi_produit';
protected $primaryKey = 'DP_IDENT';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
	'DP_IDENT',
    'REFCO',
    'CODEFAM1',
    'CODEFAM2',
    'CODEFAM3',
	'VOLUME_U',
	'NAT_MESURE1',
	'MESURE1',
	'NAT_MESURE2',
	'MESURE2'

    ];

     
    }
