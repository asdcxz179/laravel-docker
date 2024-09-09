<?php

namespace Byg\Admin\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Route;

class Init
{    
    /**
     * 初始化忽略路由
     * @access protected
     * @var IgnoreInitRoute
     * @version 1.0
     * @author Henry
     */
    protected $IgnoreInitRoute = [
        // "Backend.Init.store",
        // "Backend.Init.index",
    ];

    /** 
     * 建構子
     * @version 1.0
     * @author Henry
    **/
    public function __construct()
    {
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        config(['auth.defaults.guard'=>'admin']);
        config(['auth.defaults.passwords'=>'admin_users']);
        // if(!$this->SettingsService->CheckInit() && !in_array(Route::currentRouteName(),$this->IgnoreInitRoute)) {
        //     $request = app(Request::class);
        //     if($request->ajax()) {

        //     }else{
        //         return redirect()->route("Backend.Init.index");
        //     }
        // }
        return $next($request);
    }
}