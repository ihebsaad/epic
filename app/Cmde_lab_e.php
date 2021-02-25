<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class Cmde_lab_e extends Model
{
protected $table='cmde_lab_e';
protected $primaryKey = 'cmde_lab_ident';
protected $fillable = ['cl_ident','cmde_lab_date','cmde_lab_canal','cmde_lab_qte','cmde_lab_poids','statut','truck_number' ];
  
  
  
}