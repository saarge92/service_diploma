<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceInOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'service_in_orders',
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('id_order')->unsigned();
                $table->integer('id_service')->unsigned();
                $table->integer('quantity')->unsigned();
                $table->integer('price')->unsigned();

                $table->foreign('id_order')->references('id')->on('orders')
                    ->onDelete('NO ACTION')->onUpdate('CASCADE');
                $table->foreign('id_service')->references('id')->on('services')
                    ->onDelete('NO ACTION')->onUpdate('CASCADE');

                $table->unique(['id_order', 'id_service']);

                $table->softDeletes();
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_in_orders');
    }
}
