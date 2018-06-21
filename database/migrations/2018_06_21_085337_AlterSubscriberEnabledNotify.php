<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSubscriberEnabledNotify extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscribers', function (Blueprint $table) {
            $table->boolean('email_notify')->default(true)->index()->after('sms_number');
        });

        Schema::table('subscribers', function (Blueprint $table) {
            $table->boolean('sms_notify')->default(true)->index()->after('email_notify');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscribers', function (Blueprint $table) {
            $table->dropColumn('email_notify');
        });

        Schema::table('subscribers', function (Blueprint $table) {
            $table->dropColumn('sms_notify');
        });
    }
}
