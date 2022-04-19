<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'users';

    /**
     * Run the migrations.
     * @table users
     *
     * @return void
     */
    public function up() {
        if (Schema::hasTable($this->set_schema_table)) {
            return;
        }

        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('user_id');
            $table->string('first_name', 50);
            $table->string('last_name', 50)->nullable()->default(null);
            $table->enum('gender', ['male', 'female']);
            $table->text('address')->nullable()->default(null);
            $table->string('phone_number', 50)->nullable()->default(null);
            $table->string('email', 50);
            $table->string('password');
            $table->string('birth_place')->nullable()->default(null);
            $table->date('birth_date')->nullable()->default(null);
            $table->string('remember_token')->default(null);
            $table->string('provider', 50)->default(null);
            $table->string('provider_id')->default(null);

            $table->unique(["email"], 'email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists($this->set_schema_table);
    }
}
