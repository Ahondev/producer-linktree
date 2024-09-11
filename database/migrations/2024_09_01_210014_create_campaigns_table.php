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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name');
            $table->string('link');
            $table->integer('views')->default(0);
            $table->unsignedBigInteger('page_id'); // Foreign key to page table
            $table->unsignedBigInteger('appearance_id'); // Foreign key to appearance table
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
            $table->foreign('appearance_id')->references('id')->on('appearances')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
