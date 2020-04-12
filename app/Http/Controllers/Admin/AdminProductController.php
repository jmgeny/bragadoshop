<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nombre = $request->get('name');

        $productos = Product::where('name','like',"%$nombre%")->orderBy('name')->paginate(2);

        return view('admin.product.index', compact('productos'));        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categorias = Category::orderBy('name')->get();

        return view('admin.product.create',compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:products,name',
            'slug' => 'required|unique:products,slug',
            'imagenes.*' => 'image|mimes:jpeg,bmp,png,svg,jpg|max:2048'
        ]);
            
            $urlimagenes = [];

        if ($request->hasFile('imagenes')) 
        {
             $imagenes = $request->file('imagenes');

             foreach ($imagenes as $imagen) {
                 $nombre = time().'_'.$imagen->getClientOriginalName();

                 $ruta = public_path().'/imagenes';

                 $imagen->move($ruta, $nombre);

                 $urlimagenes[]['url'] = '/imagenes/'.$nombre;
             }
             
        } 
        
        $prod = new Product;
        $prod->name = $request->name;
        $prod->slug = $request->slug;
        $prod->category_id = $request->category_id;
        $prod->cantidad = $request->cantidad;
        $prod->precio_actual = $request->precio_actual;
        $prod->precio_anterior = $request->precio_anterior;
        $prod->porcentaje_descuento = $request->porcentaje_descuento;
        $prod->descripcion_corta = $request->descripcion_corta;
        $prod->descripcion_larga = $request->descripcion_larga;
        $prod->especificaciones = $request->especificaciones;
        $prod->datos_de_interes = $request->datos_de_interes;
        $prod->visitas = $request->visitas;
        $prod->ventas = $request->ventas;
        $prod->estado = $request->estado;

        if ($request->activo) {
            $prod->activo = 'Si';
        } else {
            $prod->activo = 'No';
        }

        if ($request->sliderprincipal) {
            $prod->sliderprincipal = 'Si';
        } else {
            $prod->sliderprincipal = 'No';
        }

        $prod->save();
        $prod->images()->createMany($urlimagenes);

        return redirect()->route('admin.product.index')->with('datos','Se creó el nuevo producto');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $producto = Product::where('slug',$slug)->firstOrFail();
        $editar = 'Si';
        
        return view('admin.product.show',compact('producto','editar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $producto = Product::where('slug',$slug)->firstOrFail();
        $editar = 'Si';
        
        return view('admin.product.edit',compact('producto','editar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
