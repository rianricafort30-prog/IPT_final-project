<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();

            $table->foreignId('customer_id')
                ->constrained('customers')
                ->restrictOnDelete();

            $table->foreignId('motorcycle_id')
                ->constrained('motorcycles')
                ->restrictOnDelete();

            $table->foreignId('rental_package_id')
                ->constrained('rental_packages')
                ->restrictOnDelete();

            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('total_amount', 10, 2);

            $table->enum('status', [
                'pending', 'active', 'completed', 'cancelled'
            ])->default('pending');

            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};