<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('transaction.index');
    }

    public function create(Request $request)
    {

        if($request->type_transaction == 'other'){
            $account_own = Account::where('id_user','=',auth()->user()->id)->count();

            $account_up = Account::where('id_user','<>',auth()->user()->id)->count();

            if($account_own > 1 && $account_up == 0){
                return view('alertas',[
                    'mensaje' =>"No hay Cuenta de Terceros Disponibles",
                    'pag' =>'../transactions'
                ]);
            }else if($account_own == 0 && $account_up == 0){
                return view('alertas',[
                    'mensaje' =>"No hay Cuenta de Terceros Disponibles Ni Cuentas Propias",
                    'pag' =>'../transactions'
                ]);
            }else{
                $account_own = Account::where('id_user','=',auth()->user()->id)->get();
                $account_up = Account::where('id_user','<>',auth()->user()->id)->get();
                return view('transaction.create',[
                    'accounts_from' => $account_own,
                    'accounts_up' => $account_up,
                ]);
    
            }

        }else{
            $account_own = Account::where('id_user','=',auth()->user()->id)->count();

            if($account_own == 0){
                return view('alertas',[
                    'mensaje' =>"El usuario No tiene Cuentas a Su Nombre Debe Crear Una cuenta Primero",
                    'pag' =>'../transactions'
                ]);
            }else if($account_own == 1){
                return view('alertas',[
                    'mensaje' =>"El usuario solo tiene una cuenta inscrita no puede hacer transferencias entre cuentas suyas",
                    'pag' =>'../transactions'
                ]);
            }else{
                $account_own = Account::where('id_user','=',auth()->user()->id)->get();
                $account_up = Account::where('id_user','<>',auth()->user()->id)->get();
                return view('transaction.create',[
                    'accounts_from' => $account_own,
                    'accounts_up' => $account_own,
                ]);       
            }

        }
    
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
                'account_from' => 'required|numeric|different:account_up',
                'account_up' => 'required|numeric',
                'amount' => 'required|numeric|min:10000|max:300000'

            ],
            [
                'account_from.required' => 'El Producto Origen es Obligatorio',
                'account_up.required' => 'El Producto Origen es Obligatorio',
                'account_from.different' => 'La Cuenta Origen No Puede Ser Igual a la de Origen',
                'amount.required' => 'El Monto es obligatorio',
                'amount.numeric' => 'El Monto debe ser un valor numerico',
                'amount.min' => 'Minimo Monto de Transaccion es de $10.000',
                'amount.max' => 'Minimo Monto de Transaccion es de $300.000',
            ]
        );


        $balance_from = Account::where('id_account','=',$request->account_from)->select('balance')->first();
        $balance_from = $balance_from->balance;

        $balance_up = Account::where('id_account','=',$request->account_up)->select('balance')->first();
        $balance_up = isset($balance_up->balance)?$balance_up->balance:0;

        if($balance_from > $request->amount){
            $discount = $balance_from-$request->get('amount');
            $send = $balance_up+$request->get('amount');
            $updAccountFrom = Account::where('id_account','=',$request->account_from)
            ->update(['balance' => $discount]);

            $updAccountUp = Account::where('id_account','=',$request->account_up)
            ->update(['balance' => $send]);

            if($updAccountFrom && $updAccountUp){
                $transaction = new Transaction();
                $transaction->id_account_from = $request->get('account_from');
                $transaction->id_account_up = $request->get('account_up');
                $transaction->amount = $request->get('amount');
                if($transaction->save()){
                    $msg = "Transferencia Realizada Correctamente con codigo ".$transaction->id_transactions." Y un Monto de $".$request->get('amount');
                }else{
                    $msg = "Transfera No Realizada Correctamente";
                }
            }else{
                $msg = "Error Descontando";
            }

            return view('alertas',[
                'mensaje' =>$msg,
                'pag' =>'../transactions'
            ]);

        }else{
            return view('alertas',[
                'mensaje' =>'No se Puede Realizar la Transaccion el Monto supera al valor disponible',
                'pag' =>'../transactions'
            ]);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaction = Producttransaction::where('id_product_transaction','=',$id)->get();
        $transaction = json_decode(json_encode($transaction), true);
        

        return view('transaction.edit',[

            'transaction' =>$transaction

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'product_transaction' => 'required|alpha_num',
            'reference' => 'required|numeric'

        ],
        [
            'product_transaction.required' => 'El Nombre de la Marca del Producto de la marca es obligatorio',
            'product_transaction.alfanumeric' => 'El Nombre de la Marca del Producto debe ser Alfanumerico',
            'reference.required' => 'El Numero Referencia de la Marca es obligatorio',
            'reference.alfanumeric' => 'El Numero Referencia de la Marca debe ser Numerico'
        ]
        );

        $transaction = Producttransaction::find($id);
        $transaction->product_transaction = $request->get('product_transaction');
        $transaction->reference = $request->get('reference');
        if($transaction->save()){
            $msg = "Registro Actualizdo Correctamente";
        }else{
            $msg = "Registro No Actualizado Correctamente";
        }

        return view('alertas',[
            'mensaje' =>$msg,
            'pag' =>'../'
        ]);
        
    }

    public function confirmdestroy($id)
    {

        
        return view('confirm',[
            'mensaje' =>'Esta seguro que quiere eliminar el registro',
            'can' =>'../',
            'ok' =>'../destroy/'.$id,

        ]);

    }
 

    public function destroy($id)
    {
        $products = Product::where('id_product_transaction','=',$id);
        $products->delete();

        $transaction = Producttransaction::find($id);
        if($transaction->delete()){
            $msg = "Registro Eliminado Correctamente";
        }else{
            $msg = "Registro No Eliminado Correctamente";
        }

        return view('alertas',[
            'mensaje' =>$msg,
            'pag' =>'../'
        ]);

    }
}
