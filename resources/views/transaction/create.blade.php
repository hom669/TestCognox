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
    <label for="account_from">Producto Origen</label>

    <select class="form-control" id="account_from" name="account_from">
        <option value="" selected>Seleccion Cuenta Origen</option>
        @for ($i = 0; $i < count($accounts_from); $i++)
            <option value="{{$accounts_from[$i]['id_account']}}">{{$accounts_from[$i]['code_account']}}</option>
        @endfor
    </select>
    @error('account_from')
      <br>
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>
  
    <div class="form-group col-md-6">
      <label for="account_up">Producto Destino</label>

      <select class="form-control" id="account_up" name="account_up">
          <option value="" selected>Seleccion Cuenta Destino</option>
          @for ($i = 0; $i < count($accounts_up); $i++)
              <option value="{{$accounts_up[$i]['id_account']}}">{{$accounts_up[$i]['code_account']}}</option>
          @endfor
      </select>
      @error('accounts_up')
        <br>
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group col-md-6">
      <label for="amount">Monto</label>

      <input type="text" class="form-control" id="amount" name="amount" value="{{old('amount')}}" placeholder="$0">
      @error('amount')
        <br>
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    

</div>

  <div class="form-group">
        <button type="submit" class="btn btn-success">
            <span class="fas fa-fw fa-plus"></span> Guardar
        </button>

        <a href="/transactions" type="button" class="btn btn-secondary">
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
    
@stop