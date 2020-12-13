<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class Client extends Model
{
protected $table='client';
protected $primaryKey = 'cl_ident';

protected $fillable = ['siret','num_tva'];
	
}