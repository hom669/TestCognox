@extends('adminlte::page')

@section('title', 'Edición de Marcas de Productors')

@section('content_header')
    <h1>Edición de Marcas de Productos</h1>
@stop

@section('content')

<form action="..\update\{{$brand[0]['id_product_brand']}}" method="POST">
@csrf

<div class="form-row">

  <div class="form-group col-md-6">
    <label for="product_brand">Nombre de la Marca del Producto</label>
    <input type="text" class="form-control" id="product_brand" name="product_brand" value="{{$brand[0]['product_brand']}}">
  </div>
  @error('product_brand')
      <br>
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="form-group col-md-6">
      <label for="reference">Numero Referencia de la Marca (Numerico)</label>
      <input type="text" class="form-control" id="reference" name="reference" value="{{$brand[0]['reference']}}">
    </div>
    @error('reference')
        <br>
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror

</div>

  <div class="form-group">
        <button type="submit" class="btn btn-danger">
            <span class="fas fa-fw fa-plus"></span> Editar
        </button>

        <a href="../" type="button" class="btn btn-secondary">
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

          $("#date_birthday").pickadate({
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