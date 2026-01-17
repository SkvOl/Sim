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
        Schema::create('groups_sims', function (Blueprint $table) {
            $table->id()->comment('Идентификатор группы сим-карт');
            $table->bigInteger('contract_id')->unsigned()->index()->comment('Идентификатор контракта');
            $table->string('name', 255)->comment('Название группы сим-карт');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups_sims');
    }
};
