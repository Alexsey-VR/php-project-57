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
        if (config('database.default') === 'pgsql' && config('app.env') === 'testing') {
            Schema::create('sessions', function (Blueprint $table) {
                $table->id()->primary();
                $table->foreignId('user_id')->constrained('users');
                $table->varchar('ip_address');
                $table->text('user_agent');
                $table->text('payload');
                $table->integer('last_activity');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (config('database.default') === 'pgsql' && config('app.env') === 'testing') {
            Schema::dropIfExists('sessions');
        }
    }
};
