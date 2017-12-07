<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerformanceBudgetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performance_budget', function (Blueprint $table) {
            $table->increments('id');
            $table->string('client_name');
            $table->string('client_address');
            $table->string('job_title');
            $table->string('contract_number');
            $table->timestamp('contract_date');
            $table->bigInteger('value');
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
        Schema::drop('performance_budget');
    }
}
