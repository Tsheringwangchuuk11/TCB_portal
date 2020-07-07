<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Upload;

class UploadExample implements ToModel, WithHeadingRow, WithChunkReading
{
    private $transactionDate, $eapiUser;

    public function __construct($eapiUser, $transactionDate)
    {
        $this->transactionDate = $transactionDate;
        $this->eapiUser = $eapiUser;
    }

    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {        
        return new Upload([
            'eapi_user' => $this->eapiUser,
            'transaction_date' => $this->transactionDate,
            'mobile_number' => $row['ftphoneid'],
            'amount' => $row['ftamount'], 
            'date_time' => $row['created_at'],          
            'created_by' => auth()->user()->id,
        ]);
    }

    public function chunkSize(): int
    {
        return 50;
    }
}
