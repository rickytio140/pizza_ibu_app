<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Table;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function scanQr($kode_qr)
    {
        $table = Table::where('kode_qr', $kode_qr)->firstOrFail();
        
        // Simpan sesi meja
        session([
            'table_id' => $table->id,
            'nomor_meja' => $table->nomor_meja,
        ]);

        return redirect()->route('customer.catalog');
    }

    public function catalog()
    {
        if (!session()->has('table_id')) {
            return redirect('/')->with('error', 'Silakan scan QR Code di meja Anda terlebih dahulu.');
        }

        $categories = MenuCategory::with(['menus' => function($query) {
            $query->where('is_available', true);
        }])->get();

        $cart = session()->get('cart', []);
        $cartCount = collect($cart)->sum('qty');

        return view('customer.catalog', compact('categories', 'cartCount'));
    }

    public function viewCart()
    {
        if (!session()->has('table_id')) {
            return redirect('/')->with('error', 'Silakan scan QR Code di meja Anda terlebih dahulu.');
        }

        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['harga'] * $item['qty'];
        }

        return view('customer.cart', compact('cart', 'total'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'qty' => 'required|integer|min:1',
            'ukuran' => 'nullable|in:Small,Medium,Large',
        ]);

        $menu = Menu::with('category')->findOrFail($request->menu_id);
        $ukuran = $request->ukuran;
        $harga = 0;
        
        $isPizza = strtolower($menu->category->nama ?? '') === 'pizza';

        if ($isPizza) {
            if (!$ukuran) {
                return redirect()->back()->with('error', 'Ukuran wajib dipilih untuk Pizza.');
            }
            if ($ukuran == 'Small') $harga = $menu->harga_small;
            elseif ($ukuran == 'Medium') $harga = $menu->harga_medium;
            elseif ($ukuran == 'Large') $harga = $menu->harga_large;
        } else {
            $ukuran = null;
            $harga = $menu->harga;
        }

        if (!$harga) {
            return redirect()->back()->with('error', 'Ukuran atau harga tidak valid untuk menu ini.');
        }

        $cart = session()->get('cart', []);
        $cartKey = $isPizza ? $menu->id . '_' . $ukuran : $menu->id;

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['qty'] += $request->qty;
        } else {
            $cart[$cartKey] = [
                'menu_id' => $menu->id,
                'nama' => $menu->nama,
                'ukuran' => $ukuran,
                'harga' => $harga,
                'qty' => $request->qty,
                'gambar' => $menu->gambar,
            ];
        }

        session(['cart' => $cart]);

        $ukuranText = $ukuran ? ' (' . $ukuran . ')' : '';
        return redirect()->back()->with('success', $menu->nama . $ukuranText . ' berhasil ditambahkan ke keranjang!');
    }

    public function updateCart(Request $request)
    {
        $request->validate([
            'cart_key' => 'required|string',
            'action' => 'required|in:increase,decrease,remove',
        ]);

        $cart = session()->get('cart', []);
        $key = $request->cart_key;

        if (isset($cart[$key])) {
            if ($request->action == 'increase') {
                $cart[$key]['qty']++;
            } elseif ($request->action == 'decrease') {
                $cart[$key]['qty']--;
                if ($cart[$key]['qty'] <= 0) {
                    unset($cart[$key]);
                }
            } elseif ($request->action == 'remove') {
                unset($cart[$key]);
            }
            session(['cart' => $cart]);
        }

        return redirect()->route('customer.cart');
    }

    public function checkout(Request $request)
    {
        if (!session()->has('table_id')) {
            return redirect('/')->with('error', 'Sesi meja tidak ditemukan.');
        }

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('customer.catalog')->with('error', 'Keranjang belanja kosong.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['harga'] * $item['qty'];
        }

        $paymentMethod = $request->input('payment_method', 'Kasir');
        $status = $paymentMethod === 'QRIS' ? 'Menunggu Pembayaran QRIS' : 'Menunggu Konfirmasi';

        // Create Order
        $order = Order::create([
            'table_id' => session('table_id'),
            'total' => $total,
            'status' => $status,
        ]);

        // Create Order Details
        foreach ($cart as $key => $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'menu_id' => $item['menu_id'],
                'ukuran' => $item['ukuran'],
                'qty' => $item['qty'],
                'harga_satuan' => $item['harga'],
                'subtotal' => $item['harga'] * $item['qty'],
            ]);
        }

        // Clear session cart
        session()->forget('cart');

        return redirect()->route('customer.status', $order->id);
    }

    public function orderStatus($id)
    {
        if (!session()->has('table_id')) {
            return redirect('/')->with('error', 'Sesi meja tidak ditemukan.');
        }

        $order = Order::with('details.menu')->where('id', $id)->where('table_id', session('table_id'))->firstOrFail();

        return view('customer.status', compact('order'));
    }
}
