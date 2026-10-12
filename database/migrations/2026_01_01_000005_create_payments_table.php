<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('rental_id')
                ->constrained('rentals')
                ->restrictOnDelete();

            $table->decimal('amount', 10, 2);
            $table->date('payment_date');

            $table->enum('method', [
                'cash', 'gcash', 'bank_transfer', 'card'
            ]);

            $table->string('reference_number')->nullable();

            $table->enum('status', [
                'pending', 'paid', 'failed', 'refunded'
            ])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};