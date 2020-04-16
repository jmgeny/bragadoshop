	const api_search_autocomplete = new Vue({

		el: '#api_search_autocomplete',
		data: {
			palabra_a_buscar: '',
			resultados: []
				
		},
		methods: {
			autoComplete() {

				this.resultados=[];

					  	if (this.palabra_a_buscar.length >= 2) {
					  		axios.get('/api/autocomplete/',
					  			{params:{palabraabuscar:this.palabra_a_buscar}}
					  			).then(response => {
					  				this.resultados = response.data;
									console.log(response.data);
							});
					  	}

										
			},

			async select(resultado) {

				this.palabra_a_buscar = resultado.name;
				await this.$nextTick();
				this.Submitform();

			},

			Submitform() {
				console.log('Estoy ejecutando del submetform');
				this.$refs.SubmitButtonSearch.click();
				

			},
		},
		mounted() {

				console.log('datos cargados correctamente');
		} 

	});