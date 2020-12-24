<?php

namespace App;
 
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

'user',
'amount',
'comp_amount',
'weight',
'gold',
'silver',
'palladium',
'platine',
'status'

    ];

     
    }
