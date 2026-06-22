# Product Requirements Document (PRD) - Sistem Pemesanan Online (QR Menu)

## 1. Gambaran Umum Sistem
Sistem Pemesanan Online (QR Menu) adalah aplikasi pemesanan makanan berbasis web (menggunakan framework Laravel). Sistem ini dirancang untuk memudahkan proses pemesanan dengan memanfaatkan QR Code yang ditempatkan di setiap meja pelanggan. 

**Catatan Penting:** QR Code hanya berfungsi untuk akses menu dan identitas meja, bukan untuk pembayaran. Seluruh transaksi pembayaran tetap dilakukan secara manual di kasir.

## 2. Aktor Sistem (User Personas)
Sistem ini melibatkan tiga jenis pengguna utama:

### 1. Customer (Pelanggan)
* **Tugas & Perilaku:** * Melakukan *scan* QR Code yang terdapat di meja restoran.
  * Melihat dan memilih menu makanan/minuman dari aplikasi.
  * Melakukan pemesanan langsung dari perangkat mereka.
  * Menuju ke kasir dan menyebutkan nomor meja untuk melakukan pembayaran.

### 2. Kasir
* **Tugas & Perilaku:**
  * Memantau daftar pesanan baru yang masuk ke sistem.
  * Mengidentifikasi pesanan pelanggan berdasarkan **nomor meja**.
  * Mengulang/mengkonfirmasi rincian pesanan kepada pelanggan.
  * Menanyakan dan memproses metode pembayaran (QRIS atau Cash).
  * Mengupdate status pembayaran pelanggan.

### 3. Admin (Pengelola)
* **Tugas & Perilaku:**
  * Mengelola daftar menu (Tambah, Edit, Hapus).
  * Mengelola kategori menu.
  * Melihat dan mencetak laporan transaksi.

## 3. Konsep Utama Sistem (Core Concepts)
Sistem ini menghilangkan kebutuhan pemindaian barcode pada saat transaksi pembayaran, dengan fokus pada:
1. **QR Meja:** Digunakan eksklusif untuk otentikasi masuk ke sistem pemesanan dan membawa data identitas nomor meja.
2. **Nomor Meja sebagai Penghubung Utama:** Nomor meja menggantikan fungsi barcode struk. Nomor meja adalah identifier utama (kunci pencarian) untuk pesanan saat customer berada di kasir.
3. **Pembayaran Terpusat di Kasir:** Aplikasi tidak memproses *payment gateway* secara mandiri. Kasir adalah pusat kontrol transaksi (QRIS ditampilkan oleh kasir atau Cash).

## 4. Alur Kerja Sistem (System Workflow)

### Fase A: Pemesanan (Ordering)
1. Customer *scan* QR Code di meja.
2. Sistem secara otomatis mengenali nomor meja.
3. Customer menelusuri katalog menu, memilih item, dan menekan tombol 'Pesan'.
4. Sistem menyimpan data pesanan beserta nomor meja ke dalam database.
5. **Status Awal:** `Menunggu Konfirmasi`.

### Fase B: Masuk ke Kasir
1. Pesanan otomatis masuk ke *dashboard* / sistem kasir (tanpa perlu reload/sinkronisasi manual).
2. Pesanan diurutkan atau ditampilkan dengan jelas berdasarkan nomor meja.

### Fase C: Konfirmasi di Kasir
1. Customer mendatangi meja kasir.
2. Customer menyebutkan **nomor meja** mereka.
3. Kasir mencari pesanan berdasarkan nomor meja tersebut.
4. Kasir membaca ulang pesanan untuk memvalidasi kesesuaian pesanan dengan kehendak customer.

### Fase D: Proses Pembayaran
1. Kasir menanyakan metode pembayaran: "QRIS atau Cash?".
2. **Skenario QRIS:** Kasir menampilkan kode QRIS toko, customer melakukan *scan* dan bayar.
3. **Skenario Cash:** Customer memberikan uang tunai, kasir menerima dan memasukkan ke mesin kasir.

### Fase E: Penyelesaian (Fulfillment)
1. Kasir memperbarui status pesanan menjadi `Lunas (QRIS)` atau `Lunas (Cash)`.
2. Pesanan diteruskan ke dapur (siap disajikan).
3. Status akhir: `Selesai`.

## 5. Status Pesanan (Order States)
Sistem harus mengakomodasi siklus status pesanan berikut:
* `Menunggu Konfirmasi`: Pesanan baru saja dibuat oleh customer.
* `Diproses`: Pesanan sedang disiapkan.
* `Lunas (QRIS)`: Pembayaran telah diselesaikan via QRIS di kasir.
* `Lunas (Cash)`: Pembayaran telah diselesaikan dengan uang tunai di kasir.
* `Selesai`: Pesanan telah diberikan ke customer dan siklus ditutup.

## 6. Analisa Kebutuhan Database (Struktur Sederhana)
Database disederhanakan karena tidak ada pencatatan barcode transaksi atau token payment gateway aplikasi.

* **Tabel `tables`**
  * `id`
  * `nomor_meja`
  * `kode_qr`
* **Tabel `orders`**
  * `id`
  * `table_id`
  * `total`
  * `status`
  * `created_at`
* **Tabel `order_details`**
  * `id`
  * `order_id`
  * `menu_id`
  * `qty`
  * `subtotal`
* **Tabel `payments`**
  * `id`
  * `order_id`
  * `metode` (qris / cash)
  * `status`
  * `waktu_bayar`

## 7. Analisa Kelebihan dan Kekurangan
* **Kelebihan:**
  * Arsitektur sistem sangat sederhana dan minim *error*.
  * Tidak memerlukan generator barcode tambahan pada struk/pesanan.
  * Sangat mudah dipahami oleh *user* awam.
  * Transaksi terpusat dan aman karena dikendalikan langsung oleh kasir.
* **Kekurangan:**
  * Pelanggan tetap harus berjalan dan antri di kasir untuk menyelesaikan transaksi.
  * Sistem tidak *full otomatis* (proses pembayaran manual).
  * Kecepatan transaksi sangat bergantung pada kinerja kasir.

---
*Dokumen ini disusun berdasarkan Revisi 4 Analisa Sistem Pemesanan Online.*