<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Size;
use App\Models\ProductBrand;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::
        join('sizes', 'sizes.id_size', '=', 'products.id_size')
        ->join('product_brand', 'product_brand.id_product_brand', '=', 'products.id_product_brand')
        ->get();
     
        return view('product.index',[
            'product'=>$products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $conteoSize = Size::count();
        $conteoProductBrand = ProductBrand::count();
        $sizes = Size::get();
        $productBrand = ProductBrand::get();
        //dd($productBrand);
        //dd($conteoSize,$conteoProductBrand);

        if($conteoSize >0 && $conteoProductBrand >0){
            return view('product.create',['sizes'=>$sizes,'productbrand'=>$productBrand]);
        }elseif($conteoSize > 0 && $conteoProductBrand >= 0){
            $msg = "No Existes Marcas Creadas Debe primero Crear Una Marca";
            return view('alertas',[
                'mensaje' =>$msg,
                'pag' =>'../brand'
            ]);

        }elseif($conteoSize <= 0 && $conteoProductBrand > 0){
            $msg = "No Existes Tallas Creadas Debe primero Crear Una Talla";
            return view('alertas',[
                'mensaje' =>$msg,
                'pag' =>'../size'
            ]);

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

        $request->validate([
                'product' => 'required|regex:/^[a-z\d\-_\s]+$/i',
                'id_size' => 'required|numeric',
                'observations' => 'required|regex:/^[a-z\d\-_\s]+$/i',
                'id_product_brand' => 'required|numeric',
                'quantity' => 'required|numeric',
                'date_shipment' => 'required|date',

            ],
            [
                'product.required' => 'El Nombre del Producto es obligatorio',
                'product.regex' => 'El Nombre del producto debe ser Alfanumerico',
                'id_size.required' => 'El Nombre del Producto es obligatorio',
                'id_size.numeric' => 'El Nombre del producto debe ser Numerico',
                'observations.required' => 'Las observaciones son obligatorio',
                'observations.regex' => 'Las observaciones deben ser Alfanumerico',
                'id_product_brand.required' => 'La Marca de Producto es obligatorio',
                'id_product_brand.numeric' => 'La Marca del Producto debe ser Numerico',
                'quantity.required' => 'La Cantidad de Inventario es obligatorio',
                'quantity.numeric' => 'La Cantidad de Inventario debe ser Numerico',
                'date_shipment.required' => 'La Fecha de Embarque de  es obligatorio',
                'date_shipment.date' => 'La Fecha de Embarque debe ser Tipo Fecha',



            ]
        );
        $product = new Product();
        $product->product = $request->get('product');
        $product->id_size = $request->get('id_size');
        $product->observations = $request->get('observations');
        $product->id_product_brand = $request->get('id_product_brand');
        $product->quantity = $request->get('quantity');
        $product->date_shipment = $request->get('date_shipment');
        if($product->save()){
            $msg = "Registro Almacenado Correctamente";
        }else{
            $msg = "Registro No Almacenado Correctamente";
        }

        return view('alertas',[
            'mensaje' =>$msg,
            'pag' =>'../product'
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
        $product = Product::where('id_product','=',$id)->get();
        $product = json_decode(json_encode($product), true);
        $sizes = Size::get();
        $productBrand = ProductBrand::get();
        

        return view('product.edit',[

            'product' =>$product,
            'sizes' =>$sizes,
            'productbrand' =>$productBrand,

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
            'product' => 'required|regex:/^[a-z\d\-_\s]+$/i',
            'id_size' => 'required|numeric',
            'observations' => 'required|regex:/^[a-z\d\-_\s]+$/i',
            'id_product_brand' => 'required|numeric',
            'quantity' => 'required|numeric',
            'date_shipment' => 'required|date',

        ],
        [
            'product.required' => 'El Nombre del Producto es obligatorio',
            'product.regex' => 'El Nombre del producto debe ser Alfanumerico',
            'id_size.required' => 'El Nombre del Producto es obligatorio',
            'id_size.numeric' => 'El Nombre del producto debe ser Numerico',
            'observations.required' => 'Las observaciones son obligatorio',
            'observations.regex' => 'Las observaciones deben ser Alfanumerico',
            'id_product_brand.required' => 'La Marca de Producto es obligatorio',
            'id_product_brand.numeric' => 'La Marca del Producto debe ser Numerico',
            'quantity.required' => 'La Cantidad de Inventario es obligatorio',
            'quantity.numeric' => 'La Cantidad de Inventario debe ser Numerico',
            'date_shipment.required' => 'La Fecha de Embarque de  es obligatorio',
            'date_shipment.date' => 'La Fecha de Embarque debe ser Tipo Fecha',



            ]
        );
        $product = Product::find($id);
        $product->product = $request->get('product');
        $product->id_size = $request->get('id_size');
        $product->observations = $request->get('observations');
        $product->id_product_brand = $request->get('id_product_brand');
        $product->quantity = $request->get('quantity');
        $product->date_shipment = $request->get('date_shipment');

        if($product->save()){
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

        $product = Product::find($id);
        if($product->delete()){
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
