<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->string('metode_pembayaran')->nullable()->after('status');
            $table->string('bukti_pembayaran')->nullable()->after('metode_pembayaran');
            $table->timestamp('dibayar_pada')->nullable()->after('bukti_pembayaran');
        });

        // Ubah enum status agar mencakup seluruh alur bisnis
        DB::statement("ALTER TABLE transaksi MODIFY COLUMN status ENUM('pending','menunggu_pembayaran','dibayar','processing','completed','cancelled') DEFAULT 'menunggu_pembayaran'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE transaksi MODIFY COLUMN status ENUM('pending','processing','completed','cancelled') DEFAULT 'pending'");

        Schema::table('transaksi', function (Blueprint $table) {
            $table->dropColumn(['metode_pembayaran', 'bukti_pembayaran', 'dibayar_pada']);
        });
    }
};
