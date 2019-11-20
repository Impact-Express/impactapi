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
            'AGENT TRACKING NUMBER',
            'MAWB',
            'MASTER DATE',
            'FLIGHT',
            'HAWB',
            'CLIENT',
            'ORIGIN COUNTRY',
            'SHIPPER ADDRESS',
            'SHIPPER CITY',
            'SHIPPER ZIP',
            'CONSIGNEE',
            'CNEE TEL',
            'CNEE ADDRESS',
            'CNEE ADDRESS 2',
            'CNEE ADDRESS 3',
            'CONTACT',
            'CNEE CITY',
            'CNEE ZIP',
            'PIECES',
            'CONTENTS',
            'VALUE',
            'DEAD WEIGHT',
            'VOL WEIGHT',
            'NOTES',
            'COUNTRY CODE',
            'JOB ID',
            'DEST COUNTRY NAME',
            'SERVICE CODE',
            'BAG'
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
            ->attachData($csv->getContent(), 'manifest.csv', [
                'mime' => 'application/csv'
            ]
        );
    }
}
