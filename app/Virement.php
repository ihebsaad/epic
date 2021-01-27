<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class Virement extends Model
{
protected $table='virement';
protected $primaryKey = 'vir_ident';
protected $fillable = [ 'cl_ident' ,'vir_date','bene_cl_ident','pds','metal_ident','commentaire','etat'];
  
}