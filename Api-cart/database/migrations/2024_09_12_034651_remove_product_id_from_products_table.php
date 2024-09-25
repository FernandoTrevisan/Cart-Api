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
        Schema::table('products', function (Blueprint $table) {
            // Primeiro, remova a restrição de chave estrangeira
            $table->dropForeign(['product_id']); // Certifique-se de que o nome da coluna esteja correto

            // Agora, remova a coluna
            $table->dropColumn('product_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Se precisar reverter, adicione a coluna novamente e a chave estrangeira
            $table->unsignedBigInteger('product_id')->nullable();
            // Adicione a chave estrangeira de volta, se necessário
            $table->foreign('product_id')->references('id')->on('products');
        });
    }
};
