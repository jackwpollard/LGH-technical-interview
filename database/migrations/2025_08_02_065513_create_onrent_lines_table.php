<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('onrent_lines', static function (Blueprint $table)
        {
            $table->id();
            $table->foreignId('onrent_id')->constrained('onrent')->cascadeOnDelete();
            $table->string('account', 10);
            $table->integer('order_number');
            $table->date('rental_start');
            $table->integer('dispatch_id');
            $table->decimal('order_value', 15);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('onrent_lines');
    }
};
