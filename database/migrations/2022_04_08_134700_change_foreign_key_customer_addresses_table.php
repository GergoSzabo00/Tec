<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_addresses', function (Blueprint $table)
        {
            $table->dropForeign('customer_addresses_customer_id_foreign');
            $table->dropColumn('customer_id');
        });
        Schema::table('customer_addresses', function (Blueprint $table)
        {
            $table->foreignId('customer_id')->after('id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_addresses', function (Blueprint $table)
        {
            $table->dropForeign('customer_addresses_customer_id_foreign');
            $table->dropColumn('customer_id');
        });
        Schema::table('customer_addresses', function (Blueprint $table)
        {
            $table->foreignId('customer_id')->after('id')->references('id')->on('customer_info')->onDelete('cascade');
        });
    }
};
