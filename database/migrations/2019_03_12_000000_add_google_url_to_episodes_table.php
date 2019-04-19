<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class AddGoogleUrlToEpisodesTable
 */
class AddGoogleUrlToEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('episodes', function (Blueprint $table) {
            $table->string('sd_gg_video_url')->after('video_embeded_url')->default(null)->nullable();
            $table->string('hd_gg_docid')->after('sd_gg_video_url')->default(null)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->dropColumn('sd_gg_video_url');
            $table->dropColumn('hd_gg_docid');
        });
    }
}
