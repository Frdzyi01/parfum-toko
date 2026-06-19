<?php

namespace Tests\Feature;

use App\Models\Pengguna;
use App\Models\Produk;
use App\Models\Keranjang;
use App\Models\Transaksi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransaksiTest extends TestCase
{
    use RefreshDatabase;

    public function test_transaksi_dan_checkout_berhasil()
    {
        // 1. Buat pengguna
        $user = Pengguna::create([
            'nama' => 'User Test',
            'email' => 'usertest@example.com',
            'password' => bcrypt('password'),
            'peran' => 'pengguna'
        ]);

        // 2. Buat produk dengan stok
        $produk = Produk::create([
            'nama' => 'Parfum Test',
            'slug' => 'parfum-test',
            'deskripsi' => 'Deskripsi parfum test',
            'harga' => 100000,
            'stok' => 10,
            'gambar_mini' => 'dummy.jpg',
            'kategori' => 'Unisex'
        ]);

        // 3. Login sebagai user dan tambahkan ke keranjang
        $response = $this->actingAs($user)
            ->post(route('keranjang.tambah', $produk->id), [
                'jumlah' => 2
            ]);

        $response->assertRedirect(route('keranjang.index'));

        // Cek keranjang di database
        $keranjang = $user->fresh()->ambilAtauBuatKeranjang();
        $this->assertCount(1, $keranjang->item()->get());
        $this->assertEquals(2, $keranjang->item()->first()->jumlah);

        // 4. Buka halaman checkout
        $response = $this->actingAs($user->fresh())
            ->get(route('pemesanan.index'));
        $response->assertStatus(200);

        // 5. Proses checkout
        $response = $this->actingAs($user->fresh())
            ->post(route('pemesanan.proses'), [
                'catatan' => 'Catatan test'
            ]);

        // Cek transaksi di database
        $transaksi = Transaksi::first();
        $this->assertNotNull($transaksi);
        $this->assertEquals($user->id, $transaksi->pengguna_id);
        $this->assertEquals(200000, $transaksi->total);
        $this->assertEquals('menunggu_pembayaran', $transaksi->status);
        $this->assertEquals('Catatan test', $transaksi->catatan);

        // Cek stok produk berkurang
        $produk->refresh();
        $this->assertEquals(8, $produk->stok);

        // Cek keranjang kosong
        $keranjang->refresh();
        $this->assertCount(0, $keranjang->item);

        // Harus dialihkan ke halaman pembayaran transaksi dengan parameter invoice
        $response->assertRedirect(route('transaksi.pembayaran', $transaksi->nomor_invoice));

        // 6. Buka halaman pembayaran transaksi
        $response = $this->actingAs($user->fresh())
            ->get(route('transaksi.pembayaran', $transaksi->nomor_invoice));
        $response->assertStatus(200);
        $response->assertSee('Pembayaran QRIS');
        $response->assertSee($transaksi->nomor_invoice);

        // 7. Upload bukti pembayaran
        \Illuminate\Support\Facades\Storage::fake('public');
        $file = \Illuminate\Http\UploadedFile::fake()->image('bukti.png');

        $response = $this->actingAs($user->fresh())
            ->post(route('transaksi.upload-bukti', $transaksi->nomor_invoice), [
                'bukti_pembayaran' => $file
            ]);

        $transaksi->refresh();
        $this->assertEquals('dibayar', $transaksi->status);
        $this->assertNotNull($transaksi->bukti_pembayaran);
        $response->assertRedirect(route('transaksi.tampilkan', $transaksi->nomor_invoice));

        // 8. Buka halaman detail transaksi
        $response = $this->actingAs($user->fresh())
            ->get(route('transaksi.tampilkan', $transaksi->nomor_invoice));
        $response->assertStatus(200);
        $response->assertSee('Detail Pesanan');
        $response->assertSee($transaksi->nomor_invoice);
        $response->assertSee('Informasi Pembayaran');

        // 9. Buka halaman riwayat transaksi
        $response = $this->actingAs($user->fresh())
            ->get(route('transaksi.index'));
        $response->assertStatus(200);
        $response->assertSee($transaksi->nomor_invoice);
    }

    public function test_admin_mengelola_transaksi()
    {
        // 1. Buat admin
        $admin = Pengguna::create([
            'nama' => 'Admin Test',
            'email' => 'admintest@example.com',
            'password' => bcrypt('password'),
            'peran' => 'admin'
        ]);

        // 2. Buat user
        $user = Pengguna::create([
            'nama' => 'User Test',
            'email' => 'usertest@example.com',
            'password' => bcrypt('password'),
            'peran' => 'pengguna'
        ]);

        // 3. Buat transaksi
        $transaksi = Transaksi::create([
            'pengguna_id' => $user->id,
            'nomor_invoice' => 'INV-ABCD-12345678',
            'total' => 150000,
            'status' => 'dibayar',
            'catatan' => 'Test admin'
        ]);

        // 4. Admin melihat daftar transaksi
        $response = $this->actingAs($admin)
            ->get(route('admin.transaksi.index') . '?tab=semua_pesanan');
        $response->assertStatus(200);
        $response->assertSee('INV-ABCD-12345678');

        // 5. Admin melihat detail transaksi
        $response = $this->actingAs($admin)
            ->get(route('admin.transaksi.tampilkan', $transaksi->id));
        $response->assertStatus(200);
        $response->assertSee('INV-ABCD-12345678');

        // 6. Admin memperbarui status transaksi
        $response = $this->actingAs($admin)
            ->put(route('admin.transaksi.perbarui', $transaksi->id), [
                'status' => 'processing'
            ]);

        // Harus dialihkan ke route tampilkan (bukan route show)
        $response->assertRedirect(route('admin.transaksi.tampilkan', $transaksi->id));

        $transaksi->refresh();
        $this->assertEquals('processing', $transaksi->status);

        // 7. Admin melihat daftar pelanggan
        $response = $this->actingAs($admin)
            ->get(route('admin.pelanggan.index'));
        $response->assertStatus(200);
        $response->assertSee($user->nama);
        $response->assertSee($user->email);

        // 8. Admin melihat detail pelanggan beserta riwayat transaksinya
        $response = $this->actingAs($admin)
            ->get(route('admin.pelanggan.tampilkan', $user->id));
        $response->assertStatus(200);
        $response->assertSee($user->nama);
        $response->assertSee($transaksi->nomor_invoice);
    }
}
