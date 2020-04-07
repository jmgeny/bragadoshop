@extends('plantilla.admin')

@section('title', 'Administración de Categorías')

@section('content')
  
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Selección de Categorías</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
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
                      <td><a class="btn btn-default" href="{{ route('admin.category.show', $categorie->slug) }}"><i class="far fa-eye"></i></a></td>
                      <td><a class="btn btn-default" href="{{ route('admin.category.edit', $categorie->slug) }}"><i class="far fa-edit"></i></a></td>
                      <td><a class="btn btn-default" href="{{ route('admin.category.show', $categorie->slug) }}"><i class="far fa-trash-alt"></i></a></td>


                    </tr>
                  @endforeach

                  </tbody>
                </table>
                {{ $categories->links() }}
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->  

@endsection      