<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class Modele_lab extends Model
{
protected $table='modele_lab';
protected $primaryKey = 'modele_lab_ident';
protected $fillable = ['cl_ident','modele_nom','nature_lot_ident','poids','titrage_au','titrage_ag','titrage_pt','titrage_pd','qte','valeur','type_lab_ident','choix_lab_ident','user_id'];
  
}