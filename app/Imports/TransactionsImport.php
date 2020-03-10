<?php

namespace App\Imports;

use App\Transactions;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TransactionsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return Transactions|null
     */
    public function model(array $row)
    {
        return new Transactions([
            'id' => $row['id'],
            'code' => $row['code'],
            'amount' => $row['amount'],
            'user_id' => $row['user_id'],
            'created_at' => $row['created_at'],
            'updated_at' => $row['updated_at'],
        ]);
    }
}
