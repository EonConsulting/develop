<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'orders';

    /**
     * Run the migrations.
     * @table orders
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('currency_id', 191);
            $table->string('fx_purchased', 191);
            $table->string('fx_exchange_rate', 191);
            $table->string('fx_surcharge', 191);
            $table->string('fx_purchased_amount', 191);
            $table->string('surcharge_amount', 191);
            $table->decimal('surcharge_amount_decimal', 13, 2);
            $table->string('total_zar', 191);
            $table->decimal('total_zar_decimal', 13, 2);

            $table->index(["currency_id"], 'orders_currency_id_foreign');
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->set_schema_table);
    }
}
