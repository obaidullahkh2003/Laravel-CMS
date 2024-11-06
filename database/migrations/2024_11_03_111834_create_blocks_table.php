<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blocks', function (Blueprint $table) {
            $table->id('block_id');
            $table->foreignId('region_id')->constrained('block_regions', 'id')->onDelete('cascade');
            $table->text('content');
            $table->boolean('is_active')->default(true);
            $table->string('title');
            $table->string('img')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blocks');
    }
};
