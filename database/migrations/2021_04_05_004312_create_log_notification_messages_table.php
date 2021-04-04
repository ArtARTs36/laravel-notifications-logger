<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogNotificationMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_notification_messages', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('subject');
            $table->string('sender');
            $table->text('body');
            $table->string('recipient');

            $table->unsignedBigInteger('system_id')->nullable();
            $table->foreign('system_id')->references('id')->on('log_notification_systems');

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
        Schema::dropIfExists('log_notification_messages');
    }
}
