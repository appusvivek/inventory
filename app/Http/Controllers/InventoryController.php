<?php

namespace App\Http\Controllers;

use App\Car;
use App\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;


class InventoryController extends Controller
{
    public function index()
    {
        $data = DB::table('manufacturers')
        ->join('cars', 'manufacturers.id', '=', 'cars.manufacturer_id')
        ->get();
        
        return response($data->jsonSerialize(), Response::HTTP_OK);
    }
    
}
