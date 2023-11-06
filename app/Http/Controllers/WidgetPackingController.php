<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WidgetPackingController extends Controller
{
    public function packWidgets(Request $request)
    {
        // Validate the input: Check that 'orderSize' is provided, is an integer, and is at least 1.
        $request->validate([
            'orderSize' => 'required|integer|min:1',
        ]);

        // Get the order size from the request.
        $orderSize = $request->input('orderSize');

        // Get the available pack sizes from the environment configuration.
        $packSizes = explode(',', env('PACK_SIZES'));

        // Sort the pack sizes in descending order to start with larger packs.
        rsort($packSizes);

        // Initialize an array to store the recommended packs and quantities.
        $result = [];

        // Initialize a variable to track the remaining widgets to pack.
        $remainingWidgets = $orderSize;

        // Loop through the pack sizes to determine the most efficient packing.
        foreach ($packSizes as $packSize) {
            // Calculate how many packs of the current size can be used.
            $packs = intval($remainingWidgets / $packSize);

            // If any packs of this size can be used, record it in the result.
            if ($packs > 0) {
                $result[$packSize] = $packs;
                // Update the remaining widgets.
                $remainingWidgets -= $packs * $packSize;
            }
        }

        // Check if all widgets have been packed according to the rules.
        if ($remainingWidgets === 0) {
            // Respond with the recommended packs and quantities.
            return response()->json(['packs' => $result]);
        } else {
            // If there are remaining widgets, it's not possible to pack them.
            return response()->json(['error' => 'Invalid order size. Cannot be packed.'], 400);
        }
    }
}
