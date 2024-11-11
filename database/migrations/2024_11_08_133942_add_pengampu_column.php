<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPengampuColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jenis_usahas', function (Blueprint $table) {
            $table->bigInteger('user_id')->after('icon')->nullable();
        });
        Schema::table('usahas', function (Blueprint $table) {
            $table->integer('modal_usaha')->after('isVerified')->nullable();
            $table->integer('jumlah_pekerja')->after('modal_usaha')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jenis_usahas', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
        Schema::table('usahas', function (Blueprint $table) {
            $table->dropColumn('modal_usaha');
            $table->dropColumn('jumlah_pekerja');
        });
    }
}
