<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Promos;
use Illuminate\Http\Request;

class AddData extends Controller
{
    public function AddPromo(Request $request){

        $data = new Promos;
        $data->promo_name = $request->promo_name;
        $data->promo_percentage = $request->promo_percentage;
        $data->save();
        return redirect()->back();

    }
}
