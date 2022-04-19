<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSocialMediaLinksInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('instagram_link')->after('shortbio');
            $table->string('facebook_link')->after('shortbio');
            $table->string('youtube_link')->after('shortbio');
            $table->string('twitter_link')->after('shortbio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('instagram_link');
            $table->dropColumn('facebook_link');
            $table->dropColumn('youtube_link');
            $table->dropColumn('twitter_link');
        });
    }
}
