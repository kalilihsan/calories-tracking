<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;

class MealController extends Controller
{
    public function save(Request $request) {

        $request->validate([
            'meal' => 'required',
            'calories' => 'required',
        ]);

        $meal = new Meal();
        $meal->user_id = auth()->user()->id;
        $meal->meal = $request->meal;
        $meal->calories = $request->calories;
        $meal->save();

        return redirect('/dashboard');
    }

    public function destroy($id) {
        $meal = Meal::find($id);
        $meal->delete();
        return redirect('/dashboard');
    }
}
