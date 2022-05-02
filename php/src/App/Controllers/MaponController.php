<?php

namespace App\Controllers;

use http\Client\Request;

class MaponController
{

    public static string $url = "https://mapon.com/api/v1";

    public static function view()
    {
        $unit = self::getUnitList()->data->units[0];

        $route = self::getRouteData($unit)->data->units[0]->routes[0];

        require_once __DIR__ . "/../../views/map.php";
    }

    public static function getUnitList()
    {
        $url = self::$url . "/unit.json?key=" . $_ENV['MAPON_API_KEY'];

        $response = file_get_contents($url);

        return json_decode($response);
    }

    public static function getRouteData(object $unit)
    {
        $yeterday = date('Y-m-d\TH:i:s',
                strtotime('yesterday')) . 'Z';
        $today    = date('Y-m-d\TH:i:s') . 'Z';

        $url = self::$url . "/route/list.json?key=" . $_ENV['MAPON_API_KEY'] . "&from=" . $yeterday . "&till=" . $today . "&unit_id=" . $unit->unit_id . "&include[]=polyline&include[]=decoded_route";

        $response = file_get_contents($url);

        return json_decode($response);
    }
}