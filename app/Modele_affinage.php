<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class Modele_affinage extends Model
{
protected $table='modele_affinage';
protected $primaryKey = 'modele_affinage_ident';
protected $fillable = ['cl_ident','modele_nom','nature_lot_ident','pds_lot','estim_titre_au','estim_titre_ag','estim_titre_pt','estim_titre_pd','assiste'];
  
}