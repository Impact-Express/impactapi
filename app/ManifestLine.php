<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManifestLine extends Model
{
    protected $fillable = [
        'manifest_id',
        'parcel_reference',
        'shipper',
        'shipper_address',
        'shipper_city',
        'shipper_zip',
        'shipper_country_name',
        'shipper_country_iso_code',
        'true_shipper_contact_name',
        'true_shipper_contact_tel',
        'consignee',
        'consignee_address_1',
        'consignee_address_2',
        'consignee_address_3',
        'consignee_city',
        'consignee_zip',
        'consignee_country_name',
        'consignee_country_iso_code',
        'consignee_contact_name',
        'consignee_contact_tel',
        'contents',
        'value',
        'pieces',
        'dead_weight',
        'vol_weight',
        'service_code'
    ];

    public function manifest() {
        return $this->belongsTo(Manifest::class);
    }
}
