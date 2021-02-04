<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class mainController extends Controller
{
    public function index(){
        $data["cars"]=Car::all();
        return view('cars.table',$data);
    }
    public function store(Request $request){

        $car = new Car();

        $car->name = $request->name;
        $car->brand = $request->brand;
        $car->type = $request->type;

        $car->save();

        return redirect()->route('goCars');
    }
    public function update(Request $request){
        
        $car = Car::findOrFail($request->id);
        
        $car->name = $request->name;
        $car->brand = $request->brand;
        $car->type = $request->type;
        $car->save();

        return redirect()->route('goCars');
    }
    public function destroy(Request $request){
        Car::destroy($request->id);
        return redirect()->route('goCars');
    }
}
