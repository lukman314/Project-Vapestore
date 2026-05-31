<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('spk_criteria', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('attribute'); // price, rating, purchase_count, nicotine
            $table->enum('type', ['benefit', 'cost']); // benefit=higher better, cost=lower better
            $table->decimal('weight', 4, 2); // must sum to 1
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spk_criteria');
    }
};
