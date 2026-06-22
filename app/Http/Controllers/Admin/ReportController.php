<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['table', 'payment'])->whereIn('status', ['Selesai', 'Lunas (QRIS)', 'Lunas (Cash)']);

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
        }

        $orders = $query->orderBy('created_at', 'desc')->get();
        
        $totalPendapatan = $orders->sum('total');

        return view('admin.reports.index', compact('orders', 'totalPendapatan'));
    }
}
