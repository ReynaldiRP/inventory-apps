<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Receipt;


class DashboardController extends Controller
{
    public function productOutCurrentMonth()
    {
        // Query to get the count of products that went out in the current month
    }

    public function productInCurrentMonth()
    {
        // Query to get the count of products that came in during the current month
    }

    public function productWarningStock()
    {
        // Query to get the count of products that are at warning stock levels
    }

    public function productOutPerMonth()
    {
        // Query to get the count of products that went out per month
        $monthFunction = "CAST(strftime('%m', created_at) AS INTEGER)";

        $productOut = Receipt::where('type', 'out')
            ->selectRaw("$monthFunction as month, COUNT(*) as count")
            ->groupBy(DB::raw($monthFunction))
            ->pluck('count', 'month')
            ->toArray();

        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        $outData = [];
        for ($i = 1; $i <= 12; $i++) {
            $outData[] = $productOut[$i] ?? 0;
        }

        return response()->json([
            'months' => $months,
            'data' => $outData,
        ]);

    }

    public function productInPerMonth()
    {
        // Query to get the count of products that came in per month
        $monthFunction = "CAST(strftime('%m', created_at) AS INTEGER)";
        $productIn = Receipt::where('type', 'in')
            ->selectRaw("$monthFunction as month, COUNT(*) as count")
            ->groupBy(DB::raw($monthFunction))
            ->pluck('count', 'month')
            ->toArray();

        $months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        $inData = [];
        for ($i = 1; $i <= 12; $i++) {
            $inData[] = $productIn[$i] ?? 0;
        }

        return response()->json([
            'months' => $months,
            'data' => $inData,
        ]);
    }
}
