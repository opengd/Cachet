<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterIncidentUpdateTemplateAddStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('incident_update_templates', function (Blueprint $table) {
            $table->integer('status')->default(0)->index()->after('template');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('incident_update_templates', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
