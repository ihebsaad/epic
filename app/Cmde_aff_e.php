<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class Cmde_aff_e extends Model
{
protected $table='cmde_aff_e';
protected $primaryKey = 'cmde_aff_ident';
protected $fillable = [ 'cl_ident' ,'cmde_aff_date','cmde_aff_canal','cmde_aff_poids_brut','cmde_aff_poids_lot','','','','','',''];
  
}