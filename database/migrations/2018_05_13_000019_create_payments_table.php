<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'payments';

    /**
     * Run the migrations.
     * @table payments
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('payment_id');
            $table->string('payment_uuid', 191);
            $table->string('transaction_uuid', 191);
            $table->unsignedInteger('verifier_id')->nullable()->default('0');
            $table->integer('payment_type');
            $table->integer('amount');
            $table->tinyInteger('is_manual_checked');
            $table->integer('status');
            $table->timestamp('confirmed_at')->nullable()->default(null);

            $table->index(["verifier_id"], 'fk_payments_users1_idx');

            $table->index(["transaction_uuid"], 'fk_payments_transactions2_idx');
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
