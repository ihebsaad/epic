<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class Cmde_rmp_l extends Model
{
protected $table='temp_cmde_rmp_l';
protected $primaryKey = 'cmde_rmp_l_ident';
protected $fillable = [  'cmde_rmp_e_ident','nature_ident','cmde_rmp_poids','cmde_estim_titre_au','cmde_estim_titre_ag','cmde_estim_titre_pt','cmde_estim_titre_pd','assiste','statut','nom_modele','estimation_prix'  ];
  
}