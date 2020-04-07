@extends('plantilla.admin')

@section('title', 'Crear Categoría')

@section('content')
<div id="apicategory">
  <form action="{{ route('admin.category.store') }}" method="POST">
    @csrf
    <!-- Default box -->
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

                class="form-control" type="text" name="name" id="name">
                <label for="slug">Slug</label>
                <input readonly v-model = "generarSlug" class="form-control" type="text" name="slug" id="slug">
                <div v-if="div_aparecer" v-bind:class="div_clase_slug">
                  @{{ div_mensajeslug }}
                </div>
                <br v-if="div_aparecer">
                <label for="description">Descripción</label>
                <textarea class="form-control" name="description" id="description" cols="30" rows="5"></textarea>
              </div>{{-- Fin Fomulario Crear --}}
          </div>
            <!-- /.card-body -->
          <div class="card-footer shadow">
              <input :disabled= "deshabilitar_boton==1" type="submit" value="Guardar" class="btn btn-primary float-right">
          </div>
          <!-- /.card-footer-->
    </div>
        <!-- /.card -->
  </form>
</div>
@endsection      