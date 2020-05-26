	const apiproduct = new Vue({

		el: '#apiproduct',
		data: {
			nombre: '',
			slug: ' ',
			div_mensajeslug: 'Slug Existe',
			div_clase_slug: 'badge badge-danger',
			div_aparecer: false,
			deshabilitar_boton: 1,
			// variables de precio
				precio_actual: 0,
				precio_anterior: 0,
				porcentaje_descuento: 0,
				descuento: 0,
				descuento_mensaje: '0'			
		},
		computed: {
			generarSlug : function(){
				var char = {
					"Á":"a","É":"e","Í":"i","Ó":"o","Ú":"u",
					"á":"a","é":"e","í":"i","ó":"o","ú":"u",
					"Ñ":"n","ñ":"n"," ":"-","_":"-"

				}
				var expr = /[áéíóúÁÉÍÓÚÑñ_ ]/g;

				this.slug = this.nombre.trim().replace(expr, function(e){
					return char[e]
				}).toLowerCase()

				return this.slug; 

				// return this.nombre.trim().replace(/ /g,'-').toLowerCase() 
			},
			generardescuento : function(){

					if (this.porcentaje_descuento > 100) {
						swal("Atento", "El porcentaje no puede superar 100!", "error");
						this.porcentaje_descuento = 100;
						this.precio_actual = 0;
						this.descuento_mensaje = 'El producto va sin cargo';
					} 

					if (this.porcentaje_descuento < 0) {
						swal("Atento", "El porcentaje no puede ser inferior a 0!", "error")				
						this.porcentaje_descuento = 0;
						this.precio_actual = this.precio_anterior;
						this.descuento_mensaje = '';
					}

					if (this.porcentaje_descuento > 0) {
						this.descuento = (this.porcentaje_descuento * this.precio_anterior) / 100;
						this.precio_actual = this.precio_anterior - this.descuento;

						if (this.porcentaje_descuento == 100) {
							this.descuento_mensaje = 'El producto va sin cargo';
						} else {
							this.descuento_mensaje = 'El descuento es del '+ this.porcentaje_descuento + '%';
						}


					} else {
						this.descuento = '';
						this.precio_actual = this.precio_anterior;
						this.descuento_mensaje = '';
					}

					return this.descuento_mensaje; 
				}
		},
		methods: {
			eliminarImagen(imagen) {
					// console.log(imagen);
					Swal.fire({
					  title: 'Esta seguro que desea eliminar el archivo '+ imagen.id +' ?',
					  text: "No podra revertir los cambios",
					  icon: 'warning',
					  showCancelButton: true,
					  confirmButtonColor: '#3085d6',
					  cancelButtonColor: '#d33',
					  confirmButtonText: 'Si, eliminar',
					  cancelButtonText: 'Cancelar'
					}).then((result) => {
					  if (result.value) {
					  	
					  	let url ='/api/eliminarimagen/'+imagen.id;
						axios.delete(url).then(response => {
							console.log(response.data);
						});

					  	var elemento = document.getElementById('idimagen-'+imagen.id);
					  	// console.log(elemento);
					  	elemento.parentNode.removeChild(elemento);

					    Swal.fire(
					      'Eliminado!',
					      'Su archivo a sido eliminado.',
					      'success'
					    )
					  }
					})					
			},

			getProduct() {
				if (this.slug) {
				let url ='/api/product/'+this.slug;
				axios.get(url).then(response => {
					this.div_mensajeslug = response.data;
					if (this.div_mensajeslug === "Slug Disponible") {
						this.div_clase_slug = 'badge badge-success';
						this.deshabilitar_boton = 0;
					} else {
						this.div_clase_slug = 'badge badge-danger';
						this.deshabilitar_boton = 1;
					}
					this.div_aparecer = true;

					if (data.datos.name) {
						if (data.datos.name === this.nombre) {
							this.deshabilitar_boton = 0;
							this.div_mensajeslug ='';
							this.div_clase_slug ='';
							this.div_aparecer = false;
						}
					}
				})
				} else {
					this.div_mensajeslug = "Debe ingresar un valor";
					this.div_clase_slug = 'badge badge-danger';
					this.deshabilitar_boton = 1;
					this.div_aparecer = true;
				}
			}

		},
		mounted() {

				if (data.editar == 'Si') 
				{
					this.nombre = data.datos.name;
					this.precio_anterior = data.datos.precio_anterior;
					this.porcentaje_descuento = data.datos.porcentaje_descuento;
					this.deshabilitar_boton = 0;
				}

				console.log('data');
		} 

	});