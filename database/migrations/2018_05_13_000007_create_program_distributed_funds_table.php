<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramDistributedFundsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'program_distributed_funds';

    /**
     * Run the migrations.
     * @table program_distributed_funds
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('program_distributed_fund_id');
            $table->unsignedInteger('program_id');
            $table->integer('zone_id');
            $table->string('recipient');
            $table->text('description');
            $table->double('amount');

            $table->index(["program_id"], 'fk_program_fund_outflows_programs1_idx');

            $table->index(["zone_id"], 'fk_program_fund_outflows_zone1_idx');
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
