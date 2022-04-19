<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'programs';

    /**
     * Run the migrations.
     * @table programs
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('program_id');
            $table->unsignedInteger('category_id');
            $table->string('title', 191);
            $table->text('description');
            $table->double('fund_accumulation')->default('0');
            $table->double('fund_target')->nullable()->default('0');
            $table->text('slug');
            $table->tinyInteger('is_main_program')->default('0');
            $table->text('image');
            $table->date('closed_at')->nullable()->default(null);

            $table->index(["category_id"], 'fk_programs_categories1_idx');
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
