<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ManifestLine;

class Manifest extends Model
{
    protected $fillable = ['customer_id', 'ref'];

    public static function createWithLines($customer_id, $ref, $lines) {

        if (self::where('ref', $ref)->exists()) {
            return ['status' => 'failure', 'message' => 'Duplicate entry'];
        }

        $manifest = self::create(['customer_id' => $customer_id, 'ref' => $ref]);
        foreach ($lines as $line) {
            ManifestLine::create(
                array_merge(
                    [
                        'manifest_id' => $manifest->id
                    ],
                    [
                        'parcel_reference' => $line['ParcelReference'],
                        'shipper' => $line['Shipper'],
                        'shipper_address_1' => $line['ShipperAddress1'],
                        'shipper_address_2' => isset($line['ShipperAddress2']) ? $line['ShipperAddress2'] : '',
                        'shipper_address_3' => isset($line['ShipperAddress3']) ? $line['ShipperAddress3'] : '',
                        'shipper_city' => $line['ShipperCity'],
                        'shipper_zip' => $line['ShipperZip'],
                        'shipper_country_iso_code' => $line['ShipperCountryISOCode'],
                        'true_shipper_contact_name' => $line['TrueShipperContactName'],
                        'true_shipper_contact_tel' => $line['TrueShipperContactTel'],
                        'consignee' => $line['Consignee'],
                        'consignee_address_1' => $line['ConsigneeAddress1'],
                        'consignee_address_2' => isset($line['ConsigneeAddress2']) ? $line['ConsigneeAddress2'] : '',
                        'consignee_address_3' => isset($line['ConsigneeAddress3']) ? $line['ConsigneeAddress3'] : '',
                        'consignee_city' => $line['ConsigneeCity'],
                        'consignee_zip' => $line['ConsigneeZip'],
                        'consignee_country_iso_code' => $line['ConsigneeCountryISOCode'],
                        'consignee_contact_name' => $line['ConsigneeContactName'],
                        'consignee_contact_tel' => $line['ConsigneeContactTel'],
                        'contents' => $line['Contents'],
                        'value' => $line['Value'],
                        'pieces' => $line['Pieces'],
                        'dead_weight' => $line['DeadWeight'],
                        'vol_weight' => $line['VolWeight'],
                        'service_code' => $line['ServiceCode'],
                    ]
                )
            );
        }
        return $manifest;
    }

    public function apiUser() {
        return $this->belongsTo(ApiUser::class, 'customer_id');
    }

    public function lines() {
        return $this->hasMany(ManifestLine::class);
    }
}
