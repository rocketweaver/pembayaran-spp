<?php

namespace App\Helper;

class Helper
{
    public static function successMessage($param, $msgType, $routeParent)
    {
        $param = $param;
        $msgType = $msgType;
        $routeParent = $routeParent;
        if ($param) {
            return redirect()->route($routeParent.'.index')->with(['success' => 'Data berhasil '.$msgType.'!']);
        } else {
            return redirect()->route($routeParent.'.index')->with(['error' => 'Data gagal '.$msgType.'!']);
        }
    }
}