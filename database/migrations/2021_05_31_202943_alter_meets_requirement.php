<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterMeetsRequirement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meets', function (Blueprint $table) {
            // Buka tutup data meet
            $table->dateTime('opened_at')->nullable();
            $table->dateTime('closed_at')->nullable();
            // Buka tutup presensi
            $table->time('presence_opened')->nullable();
            $table->time('presence_closed')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meets', function (Blueprint $table) {
            $table->dropColumn('opened_at');
            $table->dropColumn('closed_at');
            $table->dropColumn('presence_opened');
            $table->dropColumn('presence_closed');
        });
    }
}
