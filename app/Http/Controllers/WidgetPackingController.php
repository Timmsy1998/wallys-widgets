<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\WidgetPackingHelper;

class WidgetPackingController extends Controller
{
    public function packWidgets(Request $request)
    {
        $orderSize = $request->input('orderSize');
        $result = WidgetPackingHelper::calculateOptimalPacks($orderSize);

        if (isset($result['error'])) {
            return response()->json($result, 400);
        }

        return response()->json(['packs' => $result]);
    }
}
