	const apicategory = new Vue({

		el: '#apicategory',
		data: {
			nombre: '',
			slug: ' ',
			div_mensajeslug: 'Slug Existe',
			div_clase_slug: 'badge badge-danger',
			div_aparecer: false,
			deshabilitar_boton: 1
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
			}
		},
		methods: {
			getCategory() {
				if (this.slug) {
				let url ='/api/category/'+this.slug;
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