<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSettingsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'user_settings';

    /**
     * Run the migrations.
     * @table user_settings
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('user_setting_id');
            $table->unsignedInteger('user_id');
            $table->tinyInteger('accept_email_notification')->default(1);
            $table->tinyInteger('accept_sms_notification')->default(1);
            $table->timestamps();

            $table->index(["user_id"], 'fk_user_settings_users1_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->set_schema_table);
     }
}
