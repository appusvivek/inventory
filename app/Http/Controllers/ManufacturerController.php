<?php

namespace App\Http\Controllers;

use App\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ManufacturerController extends Controller
{
    public function index()
    {
        return response(Manufacturer::all()->jsonSerialize(), Response::HTTP_OK);
    }

    public function store(Request $request){ 
        
        $data = new Manufacturer();
        $data->name = $request->name;
        $data->save();

        return response($data->jsonSerialize(), Response::HTTP_CREATED);
    }

    public function update(Request $request, $id){
       
        $data = Manufacturer::findOrFail($id);
        $data->name = $request->name;
        $data->save();

        return response(null, Response::HTTP_OK);
    }

    public function destroy($id){
        
        Manufacturer::destroy($id);

        return response(null, Response::HTTP_OK);
    }
}
