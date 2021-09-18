<?php

namespace App\Http\Controllers;

use App\Models\ProductBrand;
use App\Models\Product;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //sdd($request->user()->identification);
        $brands = ProductBrand::get();
        return view('brand.index',[
            'brand'=>$brands,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brand.create');
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
                'product_brand' => 'required|alpha_num',
                'reference' => 'required|numeric'

            ],
            [
                'product_brand.required' => 'El Nombre de la Marca del Producto de la marca es obligatorio',
                'product_brand.alfanumeric' => 'El Nombre de la Marca del Producto debe ser Alfanumerico',
                'reference.required' => 'El Numero Referencia de la Marca es obligatorio',
                'reference.alfanumeric' => 'El Numero Referencia de la Marca debe ser Numerico'
            ]
        );
        $brand = new ProductBrand();
        $brand->product_brand = $request->get('product_brand');
        $brand->reference = $request->get('reference');
        if($brand->save()){
            $msg = "Registro Almacenado Correctamente";
        }else{
            $msg = "Registro No Almacenado Correctamente";
        }

        return view('alertas',[
            'mensaje' =>$msg,
            'pag' =>'../brand'
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
        $brand = ProductBrand::where('id_product_brand','=',$id)->get();
        $brand = json_decode(json_encode($brand), true);
        

        return view('brand.edit',[

            'brand' =>$brand

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
            'product_brand' => 'required|alpha_num',
            'reference' => 'required|numeric'

        ],
        [
            'product_brand.required' => 'El Nombre de la Marca del Producto de la marca es obligatorio',
            'product_brand.alfanumeric' => 'El Nombre de la Marca del Producto debe ser Alfanumerico',
            'reference.required' => 'El Numero Referencia de la Marca es obligatorio',
            'reference.alfanumeric' => 'El Numero Referencia de la Marca debe ser Numerico'
        ]
        );

        $brand = ProductBrand::find($id);
        $brand->product_brand = $request->get('product_brand');
        $brand->reference = $request->get('reference');
        if($brand->save()){
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
        $products = Product::where('id_product_brand','=',$id);
        $products->delete();

        $brand = ProductBrand::find($id);
        if($brand->delete()){
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
