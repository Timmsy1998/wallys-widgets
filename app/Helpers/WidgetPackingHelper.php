<?php

namespace App\Helpers;

class WidgetPackingHelper
{
    // Function to calculate optimal packs for a given order size
    public static function calculateOptimalPacks($orderSize)
    {
        // Retrieve available pack sizes from environment configuration
        $packSizes = explode(',', env('PACK_SIZES'));

        // Sort the pack sizes in descending order for efficient processing
        rsort($packSizes);

        // Call the function to find the optimal packs for the order
        return self::findOptimalPacks($orderSize, $packSizes);
    }

    // Function to find the optimal packs for a given order size
    private static function findOptimalPacks($orderSize, $packSizes)
    {
        // If the order size is zero or negative, no packs are needed
        if ($orderSize <= 0) {
            return [];
        }

        // Initialize an array to store the individual packs needed to fulfill the order
        $packs = [];

        // Initialize a variable to keep track of the remaining widgets in the order
        $remainingSize = $orderSize;

        // Loop through available pack sizes to determine the number of packs needed
        foreach ($packSizes as $packSize) {
            // While there are enough widgets to fit a complete pack
            while ($remainingSize >= $packSize) {
                // Add the pack size to the list of packs
                $packs[] = $packSize;

                // Update the remaining widgets in the order
                $remainingSize -= $packSize;
            }
        }

        // If there are remaining widgets that don't fit in available packs, add the smallest pack size
        $smallestPack = min($packSizes);
        $packs[] = $smallestPack;

        // Call the function to combine smaller packs into larger ones (if optimal)
        $combinedPacks = self::combinePacks($packs, $packSizes);

        // Return the combined packs
        return $combinedPacks;
    }

    // Function to combine smaller packs into larger ones if it's the most optimal solution
    private static function combinePacks($packs, $packSizes)
    {
        // Calculate the total number of widgets in the individual packs
        $remainingWidgets = array_reduce($packs, function ($carry, $packSize) {
            return $carry + $packSize;
        }, 0);

        // Initialize an array to store the combined packs
        $combinedPacks = [];

        // Loop through available pack sizes to optimize the packing
        foreach ($packSizes as $packSize) {
            // While there are enough widgets to fit a complete pack
            while ($remainingWidgets >= $packSize) {
                // Add the larger pack size to the list of combined packs
                $combinedPacks[] = $packSize;

                // Update the remaining widgets
                $remainingWidgets -= $packSize;
            }
        }

        // Return the list of combined packs
        return $combinedPacks;
    }
}
