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
        Schema::table('sub_servers', function (Blueprint $table) {
           $table->dropForeign(['vps_server_id']);
            $table->dropColumn('vps_server_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sub_servers', function (Blueprint $table) {
            $table->unsignedBigInteger('vps_server_id')->nullable();
        });
    }
};
