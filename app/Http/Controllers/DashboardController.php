<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMeja = Table::count();
        $totalMenu = Menu::count();
        
        $pesananHariIni = Order::whereDate('created_at', Carbon::today())->count();
        $omzetHariIni = Order::whereDate('created_at', Carbon::today())
            ->where('status', 'Selesai')
            ->sum('total');

        $pesananTerbaru = Order::with('table')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalMeja', 
            'totalMenu', 
            'pesananHariIni', 
            'omzetHariIni', 
            'pesananTerbaru'
        ));
    }
}
