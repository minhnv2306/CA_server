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
            $table->string('identification_card');
            $table->string('phone_number');
            $table->string('date_create_id_cart');
            $table->string('address');
            $table->unsignedInteger('user_id');
            $table->boolean('status')->default(true);
            $table->timestamp('deleted_at')->nullable();
            $table->unsignedInteger('deleted_id')->default(0);
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
