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
        Schema::create('airdrop_referrals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('airdrop_id');
            $table->foreignId('user_id'); // who referred
            $table->foreignId('referred_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airdrop_referrals');
    }
};
