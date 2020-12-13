<?php

namespace App;
 
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
 protected $table='commande_e';
protected $primaryKey = 'cmde_ident';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
	'cmde_ident',
    'cl_ident',
    'cmde_date',
    'total_qte',
    'total_poids',
	'estim_au',
	'estim_pt',
	'estim_pd',
	'cmde_canal',
	'cmde_etat',
	'cmde_valide',
	'cmde_facon_e'

    ];

     
    }
