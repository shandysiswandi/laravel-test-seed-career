<?php

namespace App\Services;

use App\Models\Transaction;
use Exception;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    public function getLog()
    {
        return DB::table('transactions as t')
            ->select('u.first_name', 'u.last_name', 'u.account', 'c.name', 't.type', 't.date', 't.amount', 'cb.amount as companyBugdetAmout')
            ->join('users as u', 'u.id', '=', 't.user_id')
            ->join('companies as c', 'c.id', '=', 'u.company_id')
            ->join('company_budgets as cb', 'cb.company_id', '=', 'c.id')
            ->get();
    }

    public function reimburse($companyBudget, $value, $request)
    {
        return $this->_funcRepeat($companyBudget, $value, $request, 'R');
    }

    public function disburse($companyBudget, $value, $request)
    {
        return $this->_funcRepeat($companyBudget, $value, $request, 'C');
    }

    public function close($companyBudget, $value, $request)
    {
        return $this->_funcRepeat($companyBudget, $value, $request, 'S');
    }

    private function _funcRepeat($companyBudget, $value, $request, $type = 'R')
    {
        DB::beginTransaction();

        try {
            $t = Transaction::create([
                'user_id' => $request->user_id,
                'type' => $type,
                'amount' => $request->amount,
                'date' => now()
            ]);

            $companyBudget->update([
                'amount' => $value
            ]);

            DB::commit();

            return $t;
        } catch (Exception $e) {
            DB::rollback();
            return false;
        }
    }
}
