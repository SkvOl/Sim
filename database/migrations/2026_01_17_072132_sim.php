<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sims', function (Blueprint $table) {
            $table->id()->comment('Идентификатор сим-карты');
            $table->bigInteger('contract_id')->unsigned()->index()->comment('Идентификатор контракта');
            $table->integer('phone')->unsigned()->index()->comment('Номер телефона');
            $table->string('name', 255)->comment('Название сим-карты');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sims');
    }
};
