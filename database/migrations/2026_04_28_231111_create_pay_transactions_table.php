<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->string('getway',100)->nullable();
            $table->timestamp('transaction_date')->nullable();
            $table->string('account_number',100)->nullable();
            $table->string('sub_account',250)->nullable();
            $table->string('transfer_type',5)->nullable();
            $table->integer('amount');
            $table->integer('money_web');
            $table->string('code',30);
            $table->string('transactions_code',50)->nullable();
            $table->tinyInteger('status')->default(1)->comment('1: pending, 2: success, 3: failed, 4: canceled');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pay_transactions');
    }
}
