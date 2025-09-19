<?php

namespace App\Providers;
use App\Models\Pet;
use App\Models\Vaccination;
use App\Policies\PetPolicy;
use App\Policies\VaccinationPolicy;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        \App\Models\Pet::class => \App\Policies\PetPolicy::class,
        \App\Models\Vaccination::class => \App\Policies\VaccinationPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
