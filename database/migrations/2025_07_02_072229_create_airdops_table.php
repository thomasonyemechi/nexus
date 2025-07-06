<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('airdops', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('target_referrals'); // e.g., 10 referrals to earn full reward
            $table->decimal('reward_amount', 12, 2); // e.g., 50 USDT
            $table->string('currency')->default('usdt');
            $table->boolean('active')->default(true);
            $table->timestamp('start_at')->nullable();  // optional: for scheduling future campaigns
            $table->timestamp('end_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airdops');
    }
};
