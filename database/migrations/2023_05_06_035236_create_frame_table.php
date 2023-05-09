<?php

use App\Models\Frame;
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
        Schema::create('frame', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->integer('image_id');
            $table->timestamps();
        });
        // seed data
        Frame::insert(Frame::exampleData());
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frame');
    }
};
