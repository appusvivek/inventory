<?php

namespace App\Http\Controllers;

use App\Car;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class CarController extends Controller
{
    public function index()
    {
        return response(Car::all()->jsonSerialize(), Response::HTTP_OK);
    }

    public function store(Request $request){ 
        
        $data = new Car();
        $data->name = $request->name;
        $data->color = $request->color;
        $data->manufacture_year = $request->manufacture_year;
        $data->registration_no = $request->registration_no;
        $data->note = $request->note;
        $data->image1 = $request->image1;
        $data->image2 = $request->image2;
        $data->manufacturer_id = $request->manufacturer_id;
        $data->save();

        return response($data->jsonSerialize(), Response::HTTP_CREATED);
    }

    public function update(Request $request, $id){
       
        $data = Car::findOrFail($id);
        $data->name = $request->name;
        $data->color = $request->color;
        $data->manufacture_year = $request->manufacture_year;
        $data->registration_no = $request->registration_no;
        $data->note = $request->note;
        $data->image1 = $request->image1;
        $data->image2 = $request->image2;
        $data->manufacturer_id = $request->manufacturer_id;
        $data->save();

        return response(null, Response::HTTP_OK);
    }

    public function destroy($id){
        
        Car::destroy($id);

        return response(null, Response::HTTP_OK);
    }

    public function show($id){
    
        return response(Car::findOrFail($id)->jsonSerialize(), Response::HTTP_OK);

    }
}
