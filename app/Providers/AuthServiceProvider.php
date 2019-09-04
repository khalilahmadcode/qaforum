<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

// Include the model
use App\Question; 

// Indclude the Auth Policy
use App\Policies\QuestionPolicy; 

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Question::class => QuestionPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Question Update auth
        // \Gate::define('update-question', function($user, $question) {
        //     return $user->id == $question->user_id;
        // }); 

        // Question delete auth
        // \Gate::define('delete-question', function($user, $question) {
        //     return $user->id == $question->user_id;
        // }); 
    }
}
