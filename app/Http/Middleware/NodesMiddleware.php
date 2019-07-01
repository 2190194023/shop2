<?php

namespace App\Http\Middleware;

use Closure;

class NodesMiddleware
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
        // 获取session
        $nodes = session('admin_user_nodes');

        // 获取所有可以操作的控制器
        $controller_all = array_keys($nodes);

        // 获取当前正在操作的控制器
        $actions=explode('\\', \Route::current()->getActionName());
        //或$actions=explode('\\', \Route::currentRouteAction());
        $modelName=$actions[count($actions)-2]=='Controllers'?null:$actions[count($actions)-2];
        $func=explode('@', $actions[count($actions)-1]);
        $controllerName=$func[0];
        $actionName=$func[1];

        if (!in_array($controllerName,$controller_all)) {
            return redirect('admin/rbac');
            exit;
        }

        // 所有可以操作的方法名
        $action_all = $nodes[$controllerName];

        if (!in_array($actionName, $action_all)) {
            return redirect('admin/rbac');
            exit;
        }

        return $next($request);
    }
}
