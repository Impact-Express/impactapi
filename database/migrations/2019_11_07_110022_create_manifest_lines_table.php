<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManifestLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manifest_lines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('manifest_id');
            $table->string('shipper_vat_eori');
            $table->string('shipment_reference');
            $table->string('shipper');
            $table->string('shipper_address_1');
            $table->string('shipper_address_2');
            $table->string('shipper_address_3');
            $table->string('shipper_city');
            $table->string('shipper_zip');
            $table->string('shipper_country_iso_code');
            $table->string('true_shipper_contact_name');
            $table->string('true_shipper_contact_tel');
            $table->string('consignee');
            $table->string('consignee_address_1');
            $table->string('consignee_address_2');
            $table->string('consignee_address_3');
            $table->string('consignee_city');
            $table->string('consignee_zip');
            $table->string('consignee_country_iso_code');
            $table->string('consignee_contact_name');
            $table->string('consignee_contact_tel');
            $table->string('contents');
            $table->string('value');
            $table->string('pieces');
            $table->string('dead_weight');
            $table->string('vol_weight');
            $table->string('service_code');
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
        Schema::dropIfExists('manifest_lines');
    }
}
