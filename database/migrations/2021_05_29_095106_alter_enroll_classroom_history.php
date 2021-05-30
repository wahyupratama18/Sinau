<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterEnrollClassroomHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enroll_classrooms', function (Blueprint $table) {
            $table->renameColumn('classroom_history_id', 'history_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enroll_classrooms', function (Blueprint $table) {
            $table->renameColumn('history_id', 'classroom_history_id');
        });
    }
}
