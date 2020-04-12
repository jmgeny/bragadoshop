<?php

	//0 saber si un usuario o un producto tiene por lo menos una imagen;
	$usuario = App\User::find(1);
	$imagen = $usuario->image; 

	if ($imagen) {
		echo 'Tiene una imagen';
	} else {
		echo 'No tiene una imagen';
	}
	
	return $imagen;

	//01 Crear una imagen utilizando el metodo save()
	$imagen = new App\Image(['url' => 'imagenes/avatar.png']);
	$usuario = App\User::find(1);
	$usuario->image()->save($imagen);

	return $usuario;

	//02 Obtener la información de las imagenes a traves del usuario
	
	$usuario = App\User::find(1);

	return $usuario->image;

	//03 Crear varias imagenes utilizando el metodo savemany() para el producto

	$producto = App\Product::find(3);
	$producto->images()->saveMany([
			new App\Image(['url' => 'imagenes/avatar.png']),
			new App\Image(['url' => 'imagenes/avatar2.png']),
			new App\Image(['url' => 'imagenes/avatar3.png']),
	]);
 
	return $producto->images;

    //04 Crear una imagen para un usuario utilizando el metodo create
	
	$usuario = App\User::find(1);
	$usuario->image()->create([
		'url' => 'imagenes/avatar2.png',
	]);

	return $usuario;	
    //04 otra forma
	
	$imagenes = [];
	$imagenes['url'] = 'imagenes/avatar3.png';

	$usuario = App\User::find(1);
	$usuario->image()->create($imagenes);

	return $usuario;

	//05 Crear varias imagenes para un producto utilizando el metodo createMany()
	
	$imagenes = [];
	$imagenes[]['url'] = 'imagenes/avatar.png';
	$imagenes[]['url'] = 'imagenes/avatar2.png';
	$imagenes[]['url'] = 'imagenes/avatar3.png';
	$imagenes[]['url'] = 'imagenes/a.png';
	$imagenes[]['url'] = 'imagenes/a.png';
	$imagenes[]['url'] = 'imagenes/a.png';

	$prod = Product::find(1);

	$prod->images()->createMany($imagenes);

	return $prod->images;

	//6 Actualizar la imagen del usuario con el metodo push()
	
	$usuario = App\User::find(1);
	$usuario->image->url='imagenes/avatar2';
	$usuario->push();

	return $usuario->image;

	//7 Actualizar la imagen de los productos con el metodo push()
	
	$producto = Product::find(3);
	$producto->images[0]->url='imagenes/a.png';
	$producto->push();

	return $producto->images;

	//8 Buscar el registro relacionado en la imagen
	
	$imagen = Image::find(9);

	return $imagen->imageable;

	//9 delimitar los registros
	
	$producto = Product::find(1);

	return $producto->images->where('url','imagenes/a.php');

	//10 ordernar registros que provienen de las relaciones
	
	$producto = Product::find(1);

	return $producto->images()->where('url','imagenes/a.php')->orderBy('id','desc')->get();

	//11 Contar registros relacionados coin withCount
	
	$usuarios = App\User::withCount('image')->get();
	$usuario = $usuarios->find(1);

	return $usuario->image_count;

	//12 Contar registros relacionados de productos con withCount
	
	$products = App\Product::withCount('images')->get();
	$product = $products->find(1);

	return $product->images_count;

	//13 Contar registros relacionados de productos utilizando loadCount()
	
	$product = App\Product::find(1);

	return $product->loadCount('images');

	// 14 lazy loading Carga diferida

	$product = App\Product::find(1);

	$imagenes = $product->images;

	$categoria = $product->category;

	//15 Carga previa o Eager Loading

	$usuario = App\User::with('image')->get();

	return $usuario;

	//16 Carga previa o Eager Loading

	$productos = Product::with('images')->get();

	return $productos;

	//17 carga previa de multiples relaciones

	$productos = Product::with('images','category')->get();

	return $productos;

	//18 carga previa de multiples relaciones eligiendo un solo registro

	$productos = Product::with('images','category')->find(3);

	return $productos->category;

	//19 delimitar los campos

	$productos = Product::with('images:id,url,imageable_id','category:id,name,slug')->find(3);

	return $productos;

	//20 eliminar imagen (el primer registro)

	$producto = Product::find(3);
	$producto->images[0]->delete();

	$producto->images()->delete();
	// elimina todas las imagenes

	return $producto->images;




	






