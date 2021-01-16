<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class Cmde_aff_l extends Model
{
protected $table='cmde_aff_l';
protected $primaryKey = 'cmde_aff_l_ident';
protected $fillable = [ 'cmde_aff_e_ident','nature_ident','cmde_aff_poids_lot','cmde_estim_titre_au','cmde_estim_titre_ag','cmde_estim_titre_pt','cmde_estim_titre_pd','assiste','statut'  ];
  
}