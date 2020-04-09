@extends('plantilla.admin')

@section('title', 'Editar de Productos')

@section('breadcrumb')

<li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Productos</a></li>
<li class="breadcrumb-item active">@yield('title')</li>

@endsection

@section('content')

  {{ $producto }}

@endsection      