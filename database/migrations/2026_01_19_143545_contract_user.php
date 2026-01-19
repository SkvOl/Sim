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
        Schema::create('contract_user', function (Blueprint $table) {
            $table->id()->comment('Идентификатор связи пользователя и контаркта');
            $table->bigInteger('user_id')->unsigned()->index()->comment('Идентификатор пользователя');
            $table->bigInteger('contract_id')->unsigned()->index()->comment('Идентификатор контракта');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_user');
    }
};
