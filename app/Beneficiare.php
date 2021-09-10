<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class Beneficiaire extends Model
{
protected $table='beneficiaire';
protected $primaryKey = 'bene_ident';

protected $fillable = [ 'statut'];
	
}