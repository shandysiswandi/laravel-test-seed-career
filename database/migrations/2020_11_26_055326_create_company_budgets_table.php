<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyBudgetsTable extends Migration
{
    public function up()
    {
        Schema::create('company_budgets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->double('amount', 19, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('company_budgets');
    }
}
