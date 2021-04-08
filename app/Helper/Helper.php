<?php

namespace App\Helper;

class Helper
{
    public static function successMessage($param, $msgType, $routeParent)
    {
        $param = $param;
        $msgType = $msgType;
        $routeParent = $routeParent;
        if (!is_null($param)) {
            return redirect()->route($routeParent.'.index')->with(['success' => 'Data berhasil '.$msgType.'!']);
        } else {
            return back()->with(['error' => 'Data gagal '.$msgType.'!']);
        }
    }

    // public static function failedMessage($param, $msgType, $routeParent)
    // {
    //     $param = $param;
    //     $msgType = $msgType;
    //     $routeParent = $routeParent;
    //     if ($param) {
    //         return redirect()->route($routeParent.'.index')->with(['success' => 'Data berhasil '.$msgType.'!']);
    //     } else {
    //         return redirect()->route($routeParent.'.index')->with(['error' => 'Data gagal '.$msgType.'!']);
    //     }
    // }
}