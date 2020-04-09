@extends('plantilla.admin')

@section('title', 'Administración de Categorías')

@section('breadcrumb')

{{-- <li class="breadcrumb-item"><a href="{{ route('admin.category') }}">Categorias</a></li> --}}
<li class="breadcrumb-item active">@yield('title')</li>

@endsection

@section('content')
  
        <!-- /.row -->
        <div id="confirmareliminar" class="row">

          <span style="display:none;" id="urlbase" >{{ route('admin.category.index') }}</span>

          @include('custom.modal_eliminar')

          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Selección de Categorías</h3>

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
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <a class="m-2 btn btn-primary float-right" href="{{ route('admin.category.create') }}">Crear</a>
                <table class="table table-head-fixed text-nowrap">
                  <thead>

                    <tr>
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Slug</th>
                      <th>Descripción</th>
                      <th>Fecha de Creación</th>
                      <th>Fecha de Modificación</th>
                      <th colspan="3"></th>
                    </tr>

                  </thead>
                  <tbody>
                  @foreach ($categories as $categorie)
                    <tr>
                      <td>{{ $categorie->id }}</td>
                      <td>{{ $categorie->name }}</td>
                      <td>{{ $categorie->slug }}</td>
                      <td>{{ $categorie->description }}</td>
                      <td>{{ $categorie->created_at }}</td>
                      <td>{{ $categorie->updated_at }}</td>
                      <td><a class="btn btn-success" href="{{ route('admin.category.show', $categorie->slug) }}">Ver</a></td>
                      <td><a class="btn btn-warning" href="{{ route('admin.category.edit', $categorie->slug) }}">Editar</a></td>
                      <td><a class="btn btn-danger" 
                        {{-- data-toggle="modal" data-target="#modal_eliminar" --}}
                        href="{{ route('admin.category.index') }}" 
                        v-on:click.prevent="deseas_eliminar({{ $categorie->id }})"
                        >Eliminar</a></td>


                    </tr>
                  @endforeach

                  </tbody>
                </table>
                {{ $categories->appends($_GET)->links() }}
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->  

@endsection      