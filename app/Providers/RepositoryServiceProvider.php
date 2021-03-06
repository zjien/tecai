<?php

namespace tecai\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //System
        $this->app->singleton('tecai\Repositories\Interfaces\System\PermissionRepository', 'tecai\Repositories\System\PermissionRepositoryEloquent');
        $this->app->singleton('tecai\Repositories\Interfaces\System\RoleRepository', 'tecai\Repositories\System\RoleRepositoryEloquent');
        $this->app->singleton('tecai\Repositories\Interfaces\System\AccountRepository', 'tecai\Repositories\System\AccountRepositoryEloquent');
        $this->app->singleton('tecai\Repositories\Interfaces\System\AdminRepository', 'tecai\Repositories\System\AdminRepositoryEloquent');
        //User
        $this->app->singleton('tecai\Repositories\Interfaces\User\UserRepository', 'tecai\Repositories\User\UserRepositoryEloquent');
        $this->app->singleton('tecai\Repositories\Interfaces\User\JobRepository', 'tecai\Repositories\User\JobRepositoryEloquent');
        $this->app->singleton('tecai\Repositories\Interfaces\User\IndustryRepository', 'tecai\Repositories\User\IndustryRepositoryEloquent');
        $this->app->singleton('tecai\Repositories\Interfaces\User\SchoolRepository', 'tecai\Repositories\User\SchoolRepositoryEloquent');
        $this->app->singleton('tecai\Repositories\Interfaces\User\ResumeRepository', 'tecai\Repositories\User\ResumeRepositoryEloquent');
        //Common
        $this->app->singleton('tecai\Repositories\Interfaces\Common\TagRepository', 'tecai\Repositories\Common\TagRepositoryEloquent');
        //Organization
        $this->app->singleton('tecai\Repositories\Interfaces\Organization\CorporationRepository', 'tecai\Repositories\Organization\CorporationRepositoryEloquent');
        $this->app->singleton('tecai\Repositories\Interfaces\Organization\ClientRepository', 'tecai\Repositories\Organization\ClientRepositoryEloquent');
    }
}
