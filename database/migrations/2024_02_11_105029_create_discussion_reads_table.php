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
        Schema::create('discussion_reads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('discussion_id')->constrained()
                ->onDelete('cascade');
            $table->bigInteger('request_count')->default(0);
            $table->bigInteger('long_read_count')->default(0);
            $table->integer('last_seconds_spent')->default(0);
            $table->integer('max_seconds_spent')->default(0);
            $table->unique(['user_id', 'discussion_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discussion_reads');
    }
};
