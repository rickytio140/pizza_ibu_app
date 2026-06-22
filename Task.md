# Task Management (task.md) - Sistem Pemesanan Online (QR Menu)

Dokumen ini berisi daftar tugas (task) untuk pengembangan Sistem Pemesanan Online (QR Menu) berbasis Laravel. Checklist ini dapat digunakan pada Kanban board (Trello, Jira, Github Projects) atau sebagai panduan *sprint*.

## Phase 1: Persiapan & Setup Proyek 🚀
- [x] **Task 1.1:** Inisiasi project Laravel baru (versi terbaru).
- [x] **Task 1.2:** Setup environment dan koneksi database (`.env`).
- [x] **Task 1.3:** Setup *Authentication* (Breeze/UI/Jetstream) untuk Admin dan Kasir.
- [x] **Task 1.4:** Setup template/layout (Blade) untuk Front-end (Customer) dan Back-end (Admin & Kasir).
- [x] **Task 1.5:** Instalasi library tambahan (contoh: *QR Code generator* seperti `simplesoftwareio/simple-qrcode`).

## Phase 2: Database & Models (Migration) 🗄️
- [x] **Task 2.1:** Buat model dan migration untuk `tables` (id, nomor_meja, kode_qr).
- [x] **Task 2.2:** Buat model dan migration untuk kategori menu dan `menus` (id, nama, deskripsi, harga, gambar, kategori_id).
- [x] **Task 2.3:** Buat model dan migration untuk `orders` (id, table_id, total, status, created_at).
- [x] **Task 2.4:** Buat model dan migration untuk `order_details` (id, order_id, menu_id, qty, subtotal).
- [x] **Task 2.5:** Buat model dan migration untuk `payments` (id, order_id, metode, status, waktu_bayar).
- [x] **Task 2.6:** Buat *seeder* data awal (akun Admin, akun Kasir, beberapa meja, dan menu dummy).

## Phase 3: Fitur Admin (Pengelolaan Sistem) 🔐
- [x] **Task 3.1:** CRUD Data Meja (Generate QR Code untuk setiap nomor meja).
- [x] **Task 3.2:** CRUD Kategori Menu.
- [x] **Task 3.3:** CRUD Data Menu (Upload gambar, nama, harga, status ketersediaan).
- [x] **Task 3.4:** Halaman Laporan Transaksi (Filter berdasarkan tanggal, metode pembayaran, total pendapatan).

## Phase 4: Fitur Customer (Front-end Web) 📱
- [x] **Task 4.1:** Buat *routing* untuk scan QR (Contoh: `/meja/{kode_qr}`).
- [x] **Task 4.2:** Simpan sesi (*session*) nomor meja saat customer berhasil scan QR.
- [x] **Task 4.3:** Halaman Katalog Menu (Menampilkan daftar menu dikelompokkan per kategori).
- [x] **Task 4.4:** Fitur *Cart* / Keranjang Belanja (Tambah item, kurangi item, total harga).
- [x] **Task 4.5:** Proses *Checkout* (Simpan ke tabel `orders` dan `order_details` dengan status `Menunggu Konfirmasi`).
- [x] **Task 4.6:** Halaman Status Pesanan (Memberi tahu customer pesanan berhasil dicatat dan mengarahkan mereka untuk ke kasir).

## Phase 5: Fitur Kasir (Point of Sales / POSS Sederhana) 💻
- [x] **Task 5.1:** Halaman Dashboard Kasir (Menampilkan pesanan masuk secara real-time atau *auto-refresh*).
- [x] **Task 5.2:** Filter/Pencarian pesanan aktif berdasarkan **Nomor Meja**.
- [x] **Task 5.3:** Halaman Detail Pesanan (Menampilkan rincian pesanan untuk dikonfirmasi ulang ke customer).
- [x] **Task 5.4:** Fitur Pembayaran (Pilih metode pembayaran: QRIS atau Cash).
- [x] **Task 5.5:** Tampilkan gambar QRIS statis jika kasir memilih metode QRIS.
- [x] **Task 5.6:** Update status pesanan (Ubah status dari `Menunggu Konfirmasi` menjadi `Lunas (QRIS)` atau `Lunas (Cash)`).
- [x] **Task 5.7:** Tombol "Selesaikan Pesanan" (Ubah status menjadi `Selesai` setelah makanan diberikan).

## Phase 6: Pengujian (Testing) & Debugging 🐛
- [x] **Task 6.1:** Uji coba alur Customer (Scan QR -> Pesan -> Muncul di Kasir).
- [x] **Task 6.2:** Uji coba alur Kasir (Konfirmasi -> Bayar -> Update Status).
- [x] **Task 6.3:** Uji coba CRUD Admin dan cetak laporan.
- [x] **Task 6.4:** Perbaiki bug UI/UX di tampilan *mobile* (responsif untuk Customer).

## Phase 7: Deployment & Peluncuran 🌍
- [x] **Task 7.1:** Setup server/hosting (VPS atau Shared Hosting dengan dukungan Laravel).
- [x] **Task 7.2:** Setup *domain* dan SSL (HTTPS wajib untuk kemanan sesi dan scan QR).
- [ ] **Task 7.3:** *Deploy* aplikasi ke server produksi.
- [ ] **Task 7.4:** Cetak fisik QR Code untuk setiap meja.
- [ ] **Task 7.5:** *Training* atau *Onboarding* staf kasir.