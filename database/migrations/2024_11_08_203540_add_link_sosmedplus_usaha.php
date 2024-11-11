<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLinkSosmedplusUsaha extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usahas', function (Blueprint $table) {
            $table->string('whatsapp')->after('website')->nullable();
            $table->string('youtube')->after('tiktok')->nullable();
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
            $table->dropColumn('whatsapp');
            $table->dropColumn('youtube');
        });
    }
}
