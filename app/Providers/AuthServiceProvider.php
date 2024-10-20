<?php

namespace App\Providers;

use App\Enums\GroupRole;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Enums\GroupsEnum;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $groups = GroupsEnum::asArray();
        // Định nghĩa Gate
        foreach ($groups as $key => $group) {
            foreach ($group['permission'] as $key => $permission) {
                Gate::define($permission['role'], function(User $user) use($permission) {
                    $is_admin = $user->group->slug == GroupRole::ADMIN['slug'];
                    $roles = $user->group->permissions;
                    if ($is_admin || is_array($roles) && in_array($permission['role'], $roles)) {
                        return true;
                    }
                    return false;
                });
            }
        }
    }
}
