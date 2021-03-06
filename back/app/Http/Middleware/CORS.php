<?php

namespace App\Http\Middleware;

use App\Role;
use Closure;
use Illuminate\Support\Facades\Gate;

class CORS
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
            $request->headers->set('Accept', 'application/json');
            header("Access-Control-Allow-Origin:*");
            header('Access-Control-Allow-Credentials', 'true');
            header('Access-Control-Allow-Methods', 'GET,HEAD,OPTIONS,POST,PUT"');
            header('Access-Control-Allow-Headers: Content-type, X-Auth-Token, Authorization, Origin, Accept, X-Access-Token');
            $user = \Auth::user();

            if (!app()->runningInConsole() && $user) {
                $roles = Role::with('permissions')->get();

                foreach ($roles as $role) {
                    foreach ($role->permissions as $permissions) {
                        $permissionsArray[$permissions->title][] = $role->id;
                    }
                }

                foreach ($permissionsArray as $title => $roles) {
                    Gate::define($title, function (\App\User $user) use ($roles) {
                        return count(array_intersect($user->roles->pluck('id')->toArray(), $roles)) > 0;
                    });
                }
            }

        return $next($request);
    }
}
