<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Services\Csv\Csv;

class ManifestUploaded extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $manifest;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $manifest)
    {
        $this->name = $name;
        $this->manifest = $manifest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $header = [
            'PARCEL REFERENCE',
            'SHIPPER',
            'SHIPPER ADDRESS 1',
            'SHIPPER ADDRESS 2',
            'SHIPPER ADDRESS 3',
            'SHIPPER CITY',
            'SHIPPER ZIP',
            'SHIPPER COUNTRY ISO CODE',
            'TRUE SHIPPER CONTACT NAME',
            'TRUE SHIPPER CONTACT TEL',
            'CONSIGNEE',
            'CONSIGNEE ADDRESS 1',
            'CONSIGNEE ADDRESS 2',
            'CONSIGNEE ADDRESS 3',
            'CONSIGNEE CITY',
            'CONSIGNEE ZIP',
            'CONSIGNEE COUNTRY ISO CODE',
            'CONSIGNEE CONTACT NAME',
            'CONSIGNEE CONTACT TEL',
            'CONTENTS',
            'VALUE',
            'PIECES',
            'DEAD WEIGHT',
            'VOL WEIGHT',
            'SERVICE CODE'
        ];

        $csv = new Csv();
        $csv->setHeader($header);
        $records = [];
        foreach ($this->manifest->lines->toArray() as $line) {
            unset($line['id']);
            unset($line['manifest_id']);
            unset($line['created_at']);
            unset($line['updated_at']);
            $records[] = array_values($line);
        }

        $csv->setRecords($records);

        $name = $this->manifest->created_at.' '.$this->manifest->apiUser->api_name.'.csv';

        return $this->from('api@impactexpress.co.uk')->subject($this->name.' just uploaded a manifest!')->view('emails.manifest-uploaded')
            ->attachData($csv->getContent(), $name, [
                'mime' => 'application/csv'
            ]
        );
    }
}
