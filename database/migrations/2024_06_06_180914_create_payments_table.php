<?php

use App\Models\Debt;
use App\Models\Student;
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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['semestral', 'fee']);
            $table->unsignedInteger('ammount');
            $table->foreignIdFor(Debt::class)->cascadeOnDelte();
            $table->foreignIdFor(Student::class)->cascadeOnDelte();
            $table->dateTime('date_of_payment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
