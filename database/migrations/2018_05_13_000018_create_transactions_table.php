<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'transactions';

    /**
     * Run the migrations.
     * @table transactions
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('transaction_id');
            $table->string('transaction_uuid', 191);
            $table->string('last_digit_unique_code', 3);
            $table->unsignedInteger('program_id');
            $table->unsignedInteger('user_id');
            $table->string('full_name');
            $table->string('email');
            $table->string('phone_number', 50)->nullable()->default(null);
            $table->integer('amount');
            $table->tinyInteger('status');
            $table->tinyInteger('hide_credential');
            $table->integer('proof_of_payment_id')->nullable()->default(null);
            $table->timestamp('expired_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->index(["user_id"], 'fk_transactions_users1_idx');

            $table->index(["proof_of_payment_id"], 'fk_transactions_proof_of_payments1_idx');

            $table->index(["program_id"], 'fk_transactions_programs1_idx');
            $table->timestamps();

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
