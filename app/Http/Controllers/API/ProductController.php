<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Image;
use Illuminate\support\Facades\File;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        if (Product::where('slug',$slug)->first()) {
            return 'Slug Existe';
        } else {
            return 'Slug Disponible';
        }
    }

        public function eliminarimagen($id)
    {
        // return 'En el controlador voy a eliminar el id ';
        $imagen = Image::find($id);
        $archivo = substr($imagen->url,1);

        $eliminar = File::delete($archivo);

        $imagen->delete();

        return 'eliminado id: '.$id.' '.$eliminar;
    }

}
