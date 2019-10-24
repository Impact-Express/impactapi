<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManifestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manifests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('agent_tracking_number')->nullable();
            $table->string('mawb')->nullable();
            $table->string('master_date')->nullable();
            $table->string('flight')->nullable();
            $table->string('hawb')->nullable();
            $table->string('client')->nullable();
            $table->string('shipper')->nullable();
            $table->string('origin_country')->nullable();
            $table->string('shipper_address')->nullable();
            $table->string('shipper_city')->nullable();
            $table->string('shipper_zip')->nullable();
            $table->string('consignee')->nullable();
            $table->string('consignee_tel')->nullable();
            $table->string('consignee_address_1')->nullable();
            $table->string('consignee_address_2')->nullable();
            $table->string('consignee_address_3')->nullable();
            $table->string('contact')->nullable();
            $table->string('consignee_city')->nullable();
            $table->string('consignee_zip')->nullable();
            $table->string('pieces')->nullable();
            $table->string('contents')->nullable();
            $table->string('value')->nullable();
            $table->string('dead_weight')->nullable();
            $table->string('vol_weight')->nullable();
            $table->string('notes')->nullable();
            $table->string('country_code')->nullable();
            $table->string('job_id')->nullable();
            $table->string('destination_country_name')->nullable();
            $table->string('service_code')->nullable();
            $table->string('bag')->nullable();
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
        Schema::dropIfExists('manifests');
    }
}
