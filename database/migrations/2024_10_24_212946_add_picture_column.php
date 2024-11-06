<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPictureColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usahas', function (Blueprint $table) {
            $table->string('logo')->after('link_maps')->nullable();
        });
        Schema::table('produks', function (Blueprint $table) {
            $table->string('foto')->after('deskripsi')->nullable();
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
            $table->dropColumn('logo');
        });
        Schema::table('produks', function (Blueprint $table) {
            $table->dropColumn('foto');
        });
    }
}
