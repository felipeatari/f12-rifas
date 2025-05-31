<?php

use App\Models\Sortition;
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
        Schema::create('numbers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Sortition::class)->constrained()->onDelete('cascade');
            $table->integer('number');
            $table->string('number_str');
            $table->enum('status', ['available', 'reserved', 'sold'])->default('available');
            $table->timestamp('reserved_at')->nullable();
            $table->timestamps();

            $table->unique(['sortition_id', 'number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('numbers');
    }
};
