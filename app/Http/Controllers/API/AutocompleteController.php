<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class AutocompleteController extends Controller
{
    public function autocomplete(Request $request) {

    	// obtengo parabraabuscar desde la URL
    	$palabraabuscar = $request->get('palabraabuscar');

    	$Productos = Product::where('name','like','%'.$palabraabuscar.'%')->orderBy('name')->get();

    		$resultados = []; //Variable con todos los resultados

    	foreach ($Productos as $producto) {
    		//encuentro las palabras que coninsiden y le corto la parte anterior
    		$encontrartexto = stristr($producto->name, $palabraabuscar);
    		//creo un campo y le pongo la palabra recortada $encontrartexto
    		$producto->encontrar = $encontrartexto;
    		//Creo otra variable y de la palabra recortada $encontrartexto le recorto la parte superiro
    		$recortar_texto = substr($encontrartexto,0,strlen($palabraabuscar));
    		//Creo otro campo y le pongo recortar_texto
    		$producto->substr = $recortar_texto;
    		//Reemplazo la palabra buscada dentro del nombre 
    		$producto->name_negrita = str_ireplace($palabraabuscar, "<b>$recortar_texto</b>", $producto->name);

    		$resultados[] = $producto;
    	}

    	return $resultados;
    }
}
