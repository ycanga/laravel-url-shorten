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
        Schema::create('all_urls', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('url');
            $table->string('short_url');
            $table->integer('clicks')->default(0);
            $table->string('user_id')->nullable()->comment('User ID or User IP address.');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('all_urls');
    }
};
