<template>
	<div class="modal fade" id="category_modal" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h2 class="modal-title h5" id="category_modal_label">
						{{`${is_create ? 'Crear':'Actualizar'} Categoria`}}
					</h2>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
					</button>
				</div>
				<div class="modal-body">
					<form @submit.prevent="storeCategory">

						<div class="mb-3">
							<label for="name" class="form-label">Name</label>
							<input type="text" class="form-control" id="name" v-model="category_send.name">
						</div>

						<hr>
						<section class="d-flex justify-content-end mt-3">
							<button type="button" class="btn btn-secondary me-1" data-bs-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary me-1">
								{{`${is_create ? 'Crear' : 'Actualizar'}`}}
							</button>
						</section>
					</form>
				</div>

			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: ['category'],
		data() {
			return {
				is_create: false,
				category_send: {},
				route: null
			}
		},
		created() {
			this.is_create = this.category ? false : true
			if (!this.is_create) this.category_send = this.category //actualizar
		},
		methods: {
			async storeCategory() {
				this.route = '/category-products'
				if (this.is_create) this.route = this.route + '/create'
				else this.route = this.route + `/update/${this.category.id}`

				try {
					const { data } = await axios.post(this.route, this.category_send)
					if (data.saved == 'ok') {
						await swal.fire({
							icon: 'success',
							title: 'Elemento Almacenado Correctamente!'
						})
						this.$parent.loadPage()
					}
				} catch (error) {
					if (error.response.status != '422') {
						await swal.fire({
							icon: 'error',
							title: '¡Ocurrio un error!'
						})
						console.error(error)
						return
					}

					if (!Array.isArray(error.response.data)) {
						await swal.fire({
							icon: 'warning',
							title: error.response.data.message
						})
					} else {
						let message = ''
						error.response.data.array.forEach(element => {
							message += ` - ${element.message} `
						})
						await swal.fire({
							icon: 'warning',
							title: message
						})
					}
				}
			}
		}
	}
</script>

<style>
</style>
