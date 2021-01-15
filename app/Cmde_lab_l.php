<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class Cmde_lab_e extends Model
{
protected $table='cmde_lab_e';
protected $primaryKey = 'cmde_lab_l_ident';
protected $fillable = [ 'type_lab_ident', 'choix_lab_ident', 'cmde_lab_e_ident', 'nature_ident', 'qte','poids' ,'titrage_au','titrage_ag','titrage_pt','titrage_pd',];
  
  
 
}