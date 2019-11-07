<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManifestLine extends Model
{
    protected $fillable = [
        'manifest_id',
        'agent_tracking_number',
        'mawb',
        'master_date',
        'flight',
        'hawb',
        'client',
        'shipper',
        'origin_country',
        'shipper_address',
        'shipper_city',
        'shipper_zip',
        'consignee',
        'consignee_tell',
        'consignee_address_1',
        'consignee_address_2',
        'consignee_address_3',
        'contact',
        'consignee_city',
        'consignee_zip',
        'pieces',
        'contents',
        'value',
        'dead_weight',
        'vol_weight',
        'notes',
        'country_code',
        'job_id',
        'destination_cpuntry_name',
        'service_code',
        'bag'
    ];

    public function manifest() {
        return $this->belongsTo(Manifest::class);
    }
}
