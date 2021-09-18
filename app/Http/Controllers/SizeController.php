<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\Product;
use Illuminate\Http\Request;

class SizeController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sizes = Size::get();
     
        return view('size.index',[
            'size'=>$sizes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('size.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
                'size' => 'required|alpha_num',
            ],
            [
                'product_size.required' => 'El Nombre de la Talla es obligatorio',
                'product_size.alfanumeric' => 'El Nombre de la Talla debe ser Alfanumerico',
                          ]
        );
        $size = new Size();
        $size->size = $request->get('size');

        if($size->save()){
            $msg = "Registro Almacenado Correctamente";
        }else{
            $msg = "Registro No Almacenado Correctamente";
        }

        return view('alertas',[
            'mensaje' =>$msg,
            'pag' =>'../size'
        ]);
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
        $size = Size::where('id_size','=',$id)->get();
        $size = json_decode(json_encode($size), true);
        

        return view('size.edit',[

            'size' =>$size

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
            'size' => 'required|alpha_num',
        ],
        [
            'product_size.required' => 'El Nombre de la Talla es obligatorio',
            'product_size.alfanumeric' => 'El Nombre de la Talla debe ser Alfanumerico',
                      ]
        );

        $size = Size::find($id);
        $size->size = $request->get('size');

        if($size->save()){
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
        $products = Product::where('id_size','=',$id);
        $products->delete();

        $size = Size::find($id);
        if($size->delete()){
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
