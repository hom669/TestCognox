@extends('adminlte::page')

@section('title', 'Edición de Marcas de Productors')

@section('content_header')
    <h1>Edición de Marcas de Productos</h1>
@stop

@section('content')

<form action="..\update\{{$product[0]['id_product']}}" method="POST">
@csrf

<div class="form-row">
  <div class="form-group col-md-6">
    <label for="product">Nombres del Producto</label>
    <input type="text" class="form-control" id="product" name="product" value="{{ $product[0]['product'] }}" placeholder="Nombres del Producto">
    @error('product')
      <br>
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>
  <div class="form-group col-md-6">
    <label for="id_size">Tallas</label>

    <select class="form-control" id="id_size" name="id_size">
        <option value="" selected>Seleccion un Talla</option>
        @for ($i = 0; $i < count($sizes); $i++)
            <option value="{{$sizes[$i]['id_size']}}">{{$sizes[$i]['size']}}</option>
        @endfor
    </select>
  </div>
  
</div>

<div class="form-row">
  <div class="form-group col-md-6">
    <label for="observations">Observaciones</label>
    <input type="textarea" class="form-control" id="observations" name="observations" value="{{ $product[0]['observations'] }}" placeholder="Observaciones">
    @error('observations')
      <br>
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>
  <div class="form-group col-md-6">
    <label for="id_product_brand">Marca de Producto</label>

    <select class="form-control" id="id_product_brand" name="id_product_brand">
        <option value="" selected>Seleccion una Marca</option>
        @for ($d = 0; $d < count($productbrand); $d++)
            <option value="{{$productbrand[$d]['id_product_brand']}}">{{$productbrand[$d]['product_brand']."-".$productbrand[$d]['reference']}}</option>
        @endfor
    </select>

    @error('id_product_brand')
      <br>
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>
  
</div>

<div class="form-row">

  <div class="form-group col-md-6">
    <label for="quantity">Cantidad en Inventario</label>
    <input type="number" class="form-control" id="quantity" name="quantity"  value="{{$product[0]['quantity']}}" placeholder="Cantidad en Inventario">
    @error('quantity')
      <br>
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>

  <div class="form-group col-md-6">
    <label for="date_shipment">Fecha de Embarque</label>
    <input type="text" class="form-control" id="date_shipment" name="date_shipment" value="{{$product[0]['date_shipment']}}" placeholder="Fecha de Embarque">
    @error('date_shipment')
      <br>
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>

</div>


</div>

<div class="form-group">
      <button type="submit" class="btn btn-success">
          <span class="fas fa-fw fa-plus"></span> Guardar
      </button>

      <a href="./" type="button" class="btn btn-secondary">
          <span class="fas fa-fw fa-times"></span> Cancelar
      </a>
</div>
 
</form>
@stop

@section('css')
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap4.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link href="{{ asset('js/pickadate/lib/themes/classic.css') }}" rel="stylesheet">
    <link href="{{ asset('js/pickadate/lib/themes/classic.date.css') }}" rel="stylesheet">
    <link href="{{ asset('js/pickadate/lib/themes/classic.time.css') }}" rel="stylesheet">
@stop
@section('js')
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="{{ asset('js/pickadate/lib/legacy.js') }}"></script>
    <script src="{{ asset('js/pickadate/lib/picker.js') }}"></script>
    <script src="{{ asset('js/pickadate/lib/picker.date.js') }}"></script>
    <script src="{{ asset('js/pickadate/lib/picker.time.js') }}"></script>
    <!-- Languaje -->

    <script src="{{ asset('js/readyDocument.js') }}" defer></script>
    <script>
        $(document).ready(function() {

          $('#id_size').val(<?php echo $product[0]['id_size'] ?>);
          $("#id_size").select2();
          $('#id_product_brand').val(<?php echo $product[0]['id_product_brand'] ?>);
          $("#id_product_brand").select2();

          $("#date_shipment").pickadate({
            selectYears: true,
            selectMonths: true,
            selectYears: 50,
            weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],            
            monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthsShort: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            format: 'yyyy-mm-dd',
            formatSubmit: 'yyyy-mm-dd',
            labelMonthNext: 'Ir al proximo mes',
            labelMonthPrev: 'Ir al mes anterior',
            labelMonthSelect: 'Pick a month from the dropdown',
            labelYearSelect: 'Pick a year from the dropdown',
            showMonthsShort: true
          })

        } );

        
    </script>
    
@stop