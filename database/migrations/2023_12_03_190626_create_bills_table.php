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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 15,2);
            $table->boolean('is_paid')->nullable()->default(false);
            $table->decimal('total_paid', 15,2)->nullable()->default(0.00);
            $table->date('due_date');
            $table->foreignId('tag_id')->nullable()->constrained('tags')->onDelete('SET NULL');
            $table->foreignId('notebook_id')->constrained('notebooks')->onDelete('CASCADE');
            $table->foreignId('user_id')->constrained('users')->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
