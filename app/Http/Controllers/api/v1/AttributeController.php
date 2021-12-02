<?php

namespace App\Http\Controllers\api\v1;

use App\CPU\Helpers;
use App\Http\Controllers\Controller;
use App\Model\Attribute;
use Illuminate\Support\Facades\DB;

class AttributeController extends Controller
{
    public function get_attributes()
    {
        $attributes = Attribute::all();

        return response()->json($attributes, 200);
    }

    public function country()
    {
        $country = DB::table('country')->get();
        // $country['country'] = Helpers::product_data_formatting($country['country'], true);

        return response()->json($country, 200);
    }
}