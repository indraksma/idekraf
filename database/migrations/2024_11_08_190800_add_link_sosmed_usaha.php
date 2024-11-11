<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLinkSosmedUsaha extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usahas', function (Blueprint $table) {
            $table->bigInteger('kriteria_id')->after('user_id')->nullable();
            $table->string('instagram')->after('website')->nullable();
            $table->string('tiktok')->after('instagram')->nullable();
            $table->string('facebook')->after('tiktok')->nullable();
            $table->string('twitter')->after('facebook')->nullable();
            $table->string('shopee')->after('twitter')->nullable();
            $table->string('tokopedia')->after('shopee')->nullable();
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
            $table->dropColumn('kriteria_id');
            $table->dropColumn('instagram');
            $table->dropColumn('tiktok');
            $table->dropColumn('facebook');
            $table->dropColumn('twitter');
            $table->dropColumn('shopee');
            $table->dropColumn('tokopedia');
        });
    }
}
