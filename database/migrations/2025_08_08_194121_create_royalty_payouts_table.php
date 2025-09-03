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
        Schema::create('royalty_payouts', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->integer('user_id');
            $table->integer('amount');
            $table->timestamp('distributed_at');
            $table->string('action');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('royalty_payouts');
    }
};
