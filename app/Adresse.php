<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class Adresse extends Model
{
protected $table='adresse_livraison';
protected $primaryKey = 'adresse_liv_ident';

protected $fillable = ['cl_ident','adresse_liv_nom'];
	
}