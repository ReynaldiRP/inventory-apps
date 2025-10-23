<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    }

    public function productInPerMonth()
    {
        // Query to get the count of products that came in per month
    }
}
