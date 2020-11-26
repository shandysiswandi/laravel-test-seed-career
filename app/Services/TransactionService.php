<?php

namespace App\Services;

use App\Models\Transaction;

class TransactionService
{
    public function reimburse($request)
    {
        return Transaction::create([
            'user_id' => $request->user_id,
            'type' => 'R',
            'amount' => $request->amount,
            'date' => now()
        ]);
    }

    public function disburse($request)
    {
        return Transaction::create([
            'user_id' => $request->user_id,
            'type' => 'C',
            'amount' =>  $request->amount,
            'date' => now()
        ]);
    }

    public function close($request)
    {
        return Transaction::create([
            'user_id' => $request->user_id,
            'type' => 'S',
            'amount' =>  $request->amount,
            'date' => now()
        ]);
    }
}
