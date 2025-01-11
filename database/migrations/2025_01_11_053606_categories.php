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
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key 'id'
            $table->string('name', 80); // Column 'name' with max length 80
            $table->unsignedBigInteger('seller_id'); // Foreign key to 'sellers'
            $table->unsignedBigInteger('store_id'); // Foreign key to 'stores'
            $table->timestamps(0); // Creates both 'created_at' and 'updated_at' columns

            // Foreign key constraints
            $table->foreign('seller_id')
                ->references('id')->on('sellers')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('store_id')
                ->references('id')->on('stores')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
