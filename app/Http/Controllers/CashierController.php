<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('table')->whereIn('status', ['Menunggu Konfirmasi', 'Menunggu Pembayaran QRIS', 'Lunas (QRIS)', 'Lunas (Cash)']);

        if ($request->filled('nomor_meja')) {
            $query->whereHas('table', function ($q) use ($request) {
                $q->where('nomor_meja', 'like', '%' . $request->nomor_meja . '%');
            });
        }

        $orders = $query->orderBy('created_at', 'desc')->get();

        return view('cashier.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['details.menu', 'table', 'payment']);
        return view('cashier.orders.show', compact('order'));
    }

    public function processPayment(Request $request, Order $order)
    {
        $request->validate([
            'metode' => 'required|in:QRIS,Cash',
            'nominal_bayar' => 'nullable|numeric|min:' . $order->total,
        ]);

        // Cek apakah sudah pernah dibayar
        if ($order->payment) {
            return redirect()->back()->with('error', 'Pesanan ini sudah dibayar.');
        }

        $nominalBayar = null;
        $kembalian = null;

        if ($request->metode == 'Cash') {
            if (!$request->filled('nominal_bayar')) {
                return redirect()->back()->with('error', 'Nominal uang harus diisi untuk pembayaran Cash.');
            }
            $nominalBayar = $request->nominal_bayar;
            $kembalian = $nominalBayar - $order->total;
        }

        Payment::create([
            'order_id' => $order->id,
            'metode' => $request->metode,
            'status' => 'Berhasil',
            'waktu_bayar' => now(),
            'nominal_bayar' => $nominalBayar,
            'kembalian' => $kembalian,
        ]);

        $order->update([
            'status' => 'Lunas (' . $request->metode . ')'
        ]);

        return redirect()->route('kasir.orders.show', $order->id)->with('success', 'Pembayaran berhasil diproses!');
    }

    public function completeOrder(Order $order)
    {
        if (!in_array($order->status, ['Lunas (QRIS)', 'Lunas (Cash)'])) {
            return redirect()->back()->with('error', 'Pesanan belum dibayar lunas.');
        }

        $order->update([
            'status' => 'Selesai'
        ]);

        return redirect()->route('kasir.orders.index')->with('success', 'Pesanan #' . $order->id . ' telah diselesaikan.');
    }
}
