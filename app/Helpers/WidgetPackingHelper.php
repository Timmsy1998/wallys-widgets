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
        if ($orderSize <= 0) {
            return [];
        }

        $packs = [];
        $remainingSize = $orderSize;

        // Iterating through available pack sizes
        foreach ($packSizes as $packSize) {
            // Try to pack as many widgets as possible with the current pack size
            while ($remainingSize >= $packSize) {
                $packs[] = $packSize;
                $remainingSize -= $packSize;
            }
        }

        if ($remainingSize > 0) {
            // If there are remaining widgets, add the smallest available pack size
            $smallestPack = min($packSizes);
            $packs[] = $smallestPack;
        }

        // Combine packs for an efficient solution
        $combinedPacks = self::combinePacks($packs, $packSizes);

        return $combinedPacks;
    }

    // Function to combine packs into an optimal solution
    private static function combinePacks($packs, $packSizes)
    {
        $remainingWidgets = array_reduce($packs, function ($carry, $packSize) {
            return $carry + $packSize;
        }, 0);

        $combinedPacks = [];

        // Iterating through available pack sizes for combining
        foreach ($packSizes as $packSize) {
            // Combine widgets into packs of the current size
            while ($remainingWidgets >= $packSize) {
                $combinedPacks[] = $packSize;
                $remainingWidgets -= $packSize;
            }
        }

        return $combinedPacks;
    }
}
