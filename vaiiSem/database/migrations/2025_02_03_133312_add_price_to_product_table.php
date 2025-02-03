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
    Schema::table('product', function (Blueprint $table) {
        $table->decimal('price', 8, 2)->after('description'); // Cena s 2 desatinnými miestami
    });
}

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('product', function (Blueprint $table) {
        $table->dropColumn(['price']);
    });
}
};
