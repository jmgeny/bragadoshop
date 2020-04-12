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
						Swal.fire({
							icon: 'error',
							title: 'El porcentaje no puede superar 100!'
						})
						this.porcentaje_descuento = 100;
						this.precio_actual = 0;
						this.descuento_mensaje = 'El producto va sin cargo';
					} 

					if (this.porcentaje_descuento < 0) {
						Swal.fire({
							icon: 'error',
							title: 'El porcentaje no puede ser menor a 0'
						})				
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

				if (document.getElementById('editar')) {
					this.nombre = document.getElementById('urlbase').innerHTML;
					this.deshabilitar_boton = 0;
				} 
		} 

	});