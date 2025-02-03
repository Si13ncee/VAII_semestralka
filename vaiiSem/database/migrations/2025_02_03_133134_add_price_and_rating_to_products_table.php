<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('products', function (Blueprint $table) {
        $table->decimal('price', 8, 2)->after('description'); // Cena s 2 desatinnými miestami
        $table->decimal('rating', 2, 1)->default(0)->after('price'); // Rating od 0 do 5 (napr. 4.5)
    });
}

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn(['price', 'rating']);
    });
}
};
