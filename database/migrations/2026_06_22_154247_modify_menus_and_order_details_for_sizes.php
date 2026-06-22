<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropColumn('deskripsi');
            $table->dropColumn('harga');
            $table->integer('harga_small')->nullable()->after('nama');
            $table->integer('harga_medium')->nullable()->after('harga_small');
            $table->integer('harga_large')->nullable()->after('harga_medium');
        });

        Schema::table('order_details', function (Blueprint $table) {
            $table->string('ukuran')->nullable()->after('menu_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->text('deskripsi')->nullable();
            $table->integer('harga')->default(0);
            $table->dropColumn(['harga_small', 'harga_medium', 'harga_large']);
        });

        Schema::table('order_details', function (Blueprint $table) {
            $table->dropColumn('ukuran');
        });
    }
};
