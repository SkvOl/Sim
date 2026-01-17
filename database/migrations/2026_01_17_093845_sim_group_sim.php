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
        Schema::create('groups_to_sims', function (Blueprint $table) {
            $table->id()->comment('Идентификатор связи');
            $table->bigInteger('group_id')->unsigned()->index()->comment('Идентификатор группы');
            $table->bigInteger('sim_id')->unsigned()->index()->comment('Идентификатор сим-карты');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups_to_sims');
    }
};
