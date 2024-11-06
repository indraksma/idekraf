<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJenisUsaha extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usahas', function (Blueprint $table) {
            $table->bigInteger('jenis_usaha_id')
                ->after('kategori_id');
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
            $table->dropColumn('jenis_usaha_id');
        });
    }
}
