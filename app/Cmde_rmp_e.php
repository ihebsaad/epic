<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class Cmde_rmp_e extends Model
{
protected $table='cmde_rmp_e';
protected $primaryKey = 'cmde_rmp_ident';
protected $fillable = [ 'cl_ident','cmde_rmp_date','cmde_rmp_canal','cmde_rmp_poids_brut','cmde_rmp_poids_lot','estim_au','estim_ag','estim_pt','estim_pd','assiste','demande_acompte','choix_couv_ident','statut' ];
  
}