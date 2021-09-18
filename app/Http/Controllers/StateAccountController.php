<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Transaction;

class StateAccountController extends Controller
{
    public function index(Request $request)
    {
        $stateaccount = Transaction::join('accounts AS af', 'af.id_account', '=', 'transactions.id_account_from')
        ->join('accounts AS au', 'au.id_account', '=', 'transactions.id_account_up')
        ->join('users AS u', 'u.id', '=', 'au.id_user')
        ->selectRaw('transactions.id_transactions,au.code_account as account_up,af.code_account as account_from,transactions.amount,transactions.created_at')
        ->where('u.id','=',auth()->user()->id)
        ->get();

        //$stateaccount = json_decode(json_encode($stateaccount), true);
        

        return view('stateaccount.index',[

            'stateaccount' =>$stateaccount

        ]);
    }
}
