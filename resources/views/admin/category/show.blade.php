@extends('plantilla.admin')

@section('title', 'Ver Categoría')

@section('content')

<div id="apicategory">
  <form>
    @csrf
    <!-- Default box -->
    <span style="display:none" id="editar"> {{ $editar }} </span><br>
    <span style="display:none" id="nombretem"> {{ $cat->name }} </span>
    <div class="card shadow">
          <div class="card-header shadow">
            <h3 class="card-title">Administración de Categorías</h3>

            <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body shadow">
            {{-- Fomulario Crear --}}

              <div class="form-group">
                <label for="name">Nombre</label>
                <input v-model = "nombre" 

                @blur="getCategory"
                @focus="div_aparecer = false"

                class="form-control" type="text" name="name" id="name" value="{{ $cat->name }}" readonly>
                <label for="slug">Slug</label>
                <input readonly v-model = "generarSlug" class="form-control" type="text" name="slug" id="slug" value="{{ $cat->slug }}">

                <label for="description">Descripción</label>
                <textarea class="form-control" name="description" id="description" cols="30" rows="5" readonly>{{ $cat->description }} </textarea>
              </div>{{-- Fin Fomulario Crear --}}
          </div>
            <!-- /.card-body -->
          <div class="card-footer shadow">

            <a class="btn btn-outline-danger" href="{{ route('cancelar','admin.category.index') }}">Cancelar</a>
            <a class="btn btn-outline-success float-right" href="{{ route('admin.category.edit',$cat->slug) }}">Editar</a>            
            
          </div>
          <!-- /.card-footer-->
    </div>
        <!-- /.card -->
  </form>
</div>
@endsection      