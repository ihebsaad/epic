<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport ;
use Carbon\Carbon;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        
		Passport::routes();
	 	
		$startTime=date('Y-m-d H:i:s');
		$endTime=date('Y-m-d H:i:s',strtotime('+900 minutes'  ,strtotime($startTime)));
		$expire= \DateTime::createFromFormat('Y-m-d H:i:s',$endTime);
 		 Passport::tokensExpireIn(Carbon::now()->addMinutes('900'));
		 
		 
     }
}
