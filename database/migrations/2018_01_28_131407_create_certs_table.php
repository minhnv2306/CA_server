<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certs', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content');
            $table->string('email')->unique();
            $table->string('customer_name');
            $table->string('identification_card')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('date_create_id_cart')->nullable();
            $table->string('address')->nullable();
            $table->unsignedInteger('user_id');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certs');
    }
}
