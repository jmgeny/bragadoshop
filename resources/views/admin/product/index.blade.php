@extends('plantilla.admin')

@section('title', 'Administración de Productos')

@section('breadcrumb')

{{-- <li class="breadcrumb-item"><a href="{{ route('admin.product') }}">Categorias</a></li> --}}
<li class="breadcrumb-item active">@yield('title')</li>

@endsection

@section('content')

<style type="text/css">
  .table1 {
    width: 100%;
    margin-bottom: 1rem;
    color: #212529;
    text-align: center;
  }
  .table1 td, .table1 th {
    padding: .75rem;
    vertical-align: center;
    border-top: 1px solid;
  }  

</style>
  
        <!-- /.row -->
        <div id="confirmareliminar" class="row">

          <span style="display:none;" id="urlbase" >{{ route('admin.product.index') }}</span>

          @include('custom.modal_eliminar')

          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Selección de Productos</h3>
                <div class="card-tools">
                  <form>
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="name" class="form-control float-right" 
                      placeholder="Buscar"
                      value="{{ request()->get('name') }}">
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <a class="m-2 btn btn-primary float-right" href="{{ route('admin.product.create') }}">Crear</a>
                <table class="table1 table-head-fixed text-nowrap shadow">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Imagen</th>
                      <th>Nombre</th>
                      <th>Estado</th>
                      <th>Activo</th>
                      <th>Slider</th>
                      <th colspan="3"></th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($productos as $product)
                    <tr>
                      <td>{{ $product->id }}</td>
                      <td>
                          @if ($product->images->count() <= 0)
                              <img src="/imagenes/avatar.png" alt="" style="height: 100px; width: 100px" class="img-circle">
                          @else
                            <img src="{{ $product->images->random()->url }}" alt="" style="height: 100px; width: 100px" class="img-circle">
                          @endif    
                    

                      </td>
                      <td>{{ $product->name }}</td>
                      <td>{{ $product->estado }}</td>
                      <td>{{ $product->activo }}</td>
                      <td>{{ $product->sliderprincipal }}</td>
                      <td><a class="btn btn-success" href="{{ route('admin.product.show', $product->slug) }}">Ver</a></td>
                      <td><a class="btn btn-warning" href="{{ route('admin.product.edit', $product->slug) }}">Editar</a></td>
                      <td><a class="btn btn-danger" 
                        {{-- data-toggle="modal" data-target="#modal_eliminar" --}}
                        href="{{ route('admin.product.index') }}" 
                        v-on:click.prevent="deseas_eliminar({{ $product->id }})"
                        >Eliminar</a></td>


                    </tr>
                  @endforeach

                  </tbody>
                </table>
                {{ $productos->appends($_GET)->links() }}
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->  

@endsection      