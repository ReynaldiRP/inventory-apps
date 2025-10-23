<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Receipt;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function productOutCurrentMonth()
    {
        // Query to get the count of products that went out in the current month
        $count = Receipt::where('type', 'out')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('quantity');

        return response()->json(['count' => $count]);
    }

    public function productInCurrentMonth()
    {
        // Query to get the count of products that came in during the current month
        $count = Receipt::where('type', 'in')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('quantity');

        return response()->json(['count' => $count]);
    }

    public function productWarningStock()
    {
        // Query to get the count of products that are at warning stock levels show product name and their stock
        $warningStockThreshold = 10;
        $products = Product::where('stock', '<=', $warningStockThreshold)->get(['name', 'stock']);

        return response()->json(['products' => $products]);
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

        for ($i = 1; $i <= count($months); $i++) {
            $outData[] = $productOut[$i] ?? 0;
        }

        return response()->json([
            'months' => $months,
            'outData' => $outData,
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

        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $inData = [];

        for ($i = 1; $i <= count($months); $i++) {
            $inData[] = $productIn[$i] ?? 0;
        }

        return response()->json([
            'months' => $months,
            'inData' => $inData,
        ]);
    }

    public function newestReceipts()
    {
        // Query to get the newest receipts
        $receipts = Receipt::with(['product', 'user'])->latest()->take(3)->get();
        return response()->json(['receipts' => $receipts]);
    }
}
