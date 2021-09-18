@extends('adminlte::page')

@section('title', 'Creación Marcas de Productos')

@section('content_header')
    <h1>Creación Marcas de Productos</h1>
@stop


@section('content')

<form action="store" method="POST" autocomplete="off">
@csrf

<div class="form-row">

  <div class="form-group col-md-6">
    <label for="product_brand">Nombre de la Marca del Producto</label>
    <input type="text" class="form-control" id="product_brand" name="product_brand" value="{{old('name_monitor')}}" placeholder="Nombre de la Marca del Producto">
  </div>
  @error('product_brand')
      <br>
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="form-group col-md-6">
      <label for="reference">Numero Referencia de la Marca (Numerico)</label>
      <input type="text" class="form-control" id="reference" name="reference" value="{{old('name_monitor')}}" placeholder="Numero Referencia de la Marca (Numerico)">
    </div>
    @error('reference')
        <br>
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror

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
    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css" rel="stylesheet">
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

          $('#idmonitor').val(<?php echo old('idmonitor') ?>);
          $("#idmonitor").select2();
          $('#idplace').val(<?php echo old('idplace') ?>);
          $("#idplace").select2();
          $('#idtipotiempo').val(<?php echo old('idtipotiempo') ?>);
          $("#idtipotiempo").select2();
          $('#idencuentro').val(<?php echo old('idencuentro') ?>);
          $("#idencuentro").select2();

          $("#date_birthday").pickadate({
            selectYears: true,
            selectMonths: true,
            selectYears: 200,
            weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],            
            monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthsShort: ['En', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
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