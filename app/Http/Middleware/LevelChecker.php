<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class LevelChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$levels)
    {
        // $currentRouteName = Route::currentRouteName();
        // $userLevel = auth()->user()->level;

        if (in_array($request->user()->level, $levels)) {
            return $next($request);
        }

        return redirect()->route('dashboard.index');
    }

    // private function userAccessRole()
    // {
    //     return [
    //         'admin' => [
    //             'dashboard',
    //             'history-pembayaran',
    //             'kelas',
    //             'pembayaran',
    //             'petugas',
    //             'siswa',
    //             'spp'
    //         ],
    //         'petugas' => [
    //             'dashboard',
    //             'history-pembayaran',
    //             'pembayaran',
    //         ],
    //         'siswa' => [
    //             'dashboard',
    //             'history-pembayaran',
    //         ]
    //     ];
    // }
}
