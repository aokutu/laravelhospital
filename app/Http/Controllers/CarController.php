<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;


class CarController extends Controller
{
    public function index()
    {
             $cars = Car::all();
             return $cars;
    }

    public function create()
    {
        // Show the form
    }

    public function store(Request $request)
{
    Car::create([
        'client_name' => $request->client_name,
        'phone_number' => $request->phone_number,
        'car_number' => $request->car_number,
    ]);

    
    return view('drivermap');
}


    public function edit($id)
    {
        // Show edit form
    }

    public function update(Request $request, $id)
    {
        // Update the car
    }

    public function destroy($id)
    {
        // Delete the car
    }
}

