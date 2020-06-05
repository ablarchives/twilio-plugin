<?php namespace AlbrightLabs\Twilio\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class UpdateclientsTableAddTwilio extends Migration
{
    public function up()
    {
        Schema::table('albrightlabs_client_clients', function(Blueprint $table) {
            $table->double('is_unsubscribed_sms')->nullable();
        });
    }

    public function down()
    {
        Schema::table('albrightlabs_client_clients', function(Blueprint $table) {
            $table->dropColumn('is_unsubscribed_sms');
        });
    }
}
