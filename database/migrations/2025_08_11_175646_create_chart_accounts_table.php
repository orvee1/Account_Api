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
        Schema::create('chart_accounts', function (Blueprint $table) {
             $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->string('account_no', 20);
            $table->string('name');
            $table->enum('type', ['asset','liability','equity','income','expense']);
            $table->string('detail_type')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('accounts')->nullOnDelete();
            $table->boolean('is_header')->default(false);
            $table->boolean('is_active')->default(true);
            $table->decimal('balance', 20, 2)->default(0);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['company_id','account_no','deleted_at']);
            $table->index(['company_id','parent_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chart_accounts');
    }
};
