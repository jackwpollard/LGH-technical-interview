<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('onrent', static function (Blueprint $table)
        {
            $table->id();
            $table->date('generated_at');
            $table->unsignedInteger('total_contracts')->default(0);
            $table->unsignedInteger('total_quotes')->default(0);
            $table->decimal('weekly_value', 15)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('onrent');
    }
};
