<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class Modele_rmp extends Model
{
protected $table='modele_rmp';
protected $primaryKey = 'modele_rmp_ident';
protected $fillable = ['cl_ident','modele_nom','nature_lot_ident','pds_lot','estim_titre_au','estim_titre_ag','estim_titre_pt','estim_titre_pd','assiste','choix_couv_ident','demande_acompte'];
  
}