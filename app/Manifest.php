<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ManifestLine;

class Manifest extends Model
{
    protected $fillable = ['customer_id'];

    public static function createWithLines($customer_id, $lines) {
        $manifest = self::create(['customer_id' => $customer_id]);
        foreach ($lines as $line) {
            ManifestLine::create(
                array_merge(
                    [
                        'manifest_id' => $manifest->id
                    ],
                    [
                        'agent_tracking_number' => $line['AgentTrackingNumber'],
                        'mawb' => $line['MAWB'],
                        'master_date' => $line['MasterDate'],
                        'flight' => $line['Flight'],
                        'hawb' => $line['HAWB'],
                        'client' => $line['Client'],
                        'shipper' => $line['Shipper'],
                        'origin_country' => $line['OriginCountry'],
                        'shipper_address' => $line['ShipperAddress'],
                        'shipper_city' => $line['ShipperCity'],
                        'shipper_zip' => $line['ShipperZip'],
                        'consignee' => $line['Consignee'],
                        'consignee_tel' => $line['ConsigneeTel'],
                        'consignee_address_1' => $line['ConsigneeAddress1'],
                        'consignee_address_2' => $line['ConsigneeAddress2'],
                        'consignee_address_3' => $line['ConsigneeAddress3'],
                        'contact' => $line['Contact'],
                        'consignee_city' => $line['ConsigneeCity'],
                        'consignee_zip' => $line['ConsigneeZip'],
                        'pieces' => $line['Pieces'],
                        'contents' => $line['Contents'],
                        'value' => $line['Value'],
                        'dead_weight' => $line['DeadWeight'],
                        'vol_weight' => $line['VolWeight'],
                        'notes' => $line['Notes'],
                        'country_code' => $line['CountryCode'],
                        'job_id' => $line['JobId'],
                        'destination_country_name' => $line['DestinationCountryName'],
                        'service_code' => $line['ServiceCode'],
                        'bag' => $line['Bag']
                    ]
                )
            );
        }
    }

    public function apiUser() {
        return $this->belongsTo(ApiUser::class, 'customer_id');
    }

    public function lines() {
        return $this->hasMany(ManifestLine::class);
    }
}
