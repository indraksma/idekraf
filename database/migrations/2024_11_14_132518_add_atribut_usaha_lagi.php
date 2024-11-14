<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAtributUsahaLagi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usahas', function (Blueprint $table) {
            $table->string('nib')->after('jumlah_pekerja')->nullable();
            $table->string('omzet')->after('nib')->nullable();
            $table->text('keterangan')->after('omzet')->nullable();
            $table->bigInteger('kecamatan_id')->after('jenis_usaha_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usahas', function (Blueprint $table) {
            $table->dropColumn('nib');
            $table->dropColumn('omzet');
            $table->dropColumn('keterangan');
            $table->dropColumn('kecamatan_id');
        });
    }
}
