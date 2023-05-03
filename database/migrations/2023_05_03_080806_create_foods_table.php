<?php

use App\Models\Food;
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
        Schema::create('food', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('calories');
            $table->float('fat');
            $table->integer('carbs');
            $table->float('protein');
            $table->integer('sodium');
            $table->string('calcium');
            $table->string('iron');
            $table->timestamps();
        });

        // add example data;
        Food::insert(Food::getData());
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food');
    }
};
