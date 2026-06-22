<?php

namespace Tests\Feature;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Order;
use App\Models\Table;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_can_scan_qr_and_checkout_then_cashier_process_payment()
    {
        // 1. Persiapan Data (Seeding)
        $admin = User::factory()->create(['role' => 'admin', 'password' => bcrypt('password')]);
        
        $table = Table::create(['nomor_meja' => 'Meja 01', 'kode_qr' => 'meja-01-abc']);
        
        $category = MenuCategory::create(['nama' => 'Pizza', 'deskripsi' => 'Menu Pizza']);
        
        $menu = Menu::create([
            'menu_category_id' => $category->id,
            'nama' => 'Pizza Margherita',
            'harga' => 50000,
            'is_available' => true,
        ]);

        // 2. Alur Customer (Scan QR)
        $response = $this->get('/meja/' . $table->kode_qr);
        $response->assertRedirect(route('customer.catalog'));
        $response->assertSessionHas('table_id', $table->id);

        // 3. Alur Customer (Tambah Keranjang)
        $response = $this->withSession(['table_id' => $table->id])
                         ->post(route('customer.cart.add'), [
                             'menu_id' => $menu->id,
                             'qty' => 2,
                         ]);
        $response->assertRedirect();
        $response->assertSessionHas('cart');
        $cart = session('cart');
        $this->assertEquals(2, $cart[$menu->id]['qty']);

        // 4. Alur Customer (Checkout)
        $response = $this->withSession(['table_id' => $table->id, 'cart' => $cart])
                         ->post(route('customer.checkout'));
        
        $order = Order::first();
        $this->assertNotNull($order);
        $this->assertEquals('Menunggu Konfirmasi', $order->status);
        $this->assertEquals(100000, $order->total); // 50000 x 2
        
        $response->assertRedirect(route('customer.status', $order->id));
        $response->assertSessionMissing('cart');

        // 5. Alur Kasir (Lihat Pesanan & Proses Pembayaran)
        $response = $this->actingAs($admin)->get(route('kasir.orders.index'));
        $response->assertStatus(200);
        $response->assertSee('#' . $order->id);

        $response = $this->actingAs($admin)
                         ->post(route('kasir.orders.pay', $order->id), [
                             'metode' => 'QRIS',
                         ]);
        
        $order->refresh();
        $this->assertEquals('Lunas (QRIS)', $order->status);
        $this->assertNotNull($order->payment);
        $this->assertEquals('QRIS', $order->payment->metode);

        // 6. Alur Kasir (Selesaikan Pesanan)
        $response = $this->actingAs($admin)
                         ->post(route('kasir.orders.complete', $order->id));
        
        $order->refresh();
        $this->assertEquals('Selesai', $order->status);
    }
}
