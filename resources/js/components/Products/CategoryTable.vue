<template>
	<section class="mx-4 card">

		<div class="card-head d-flex justify-content-between p-3">
			<h2>Categories</h2>
			<button class="btn btn-primary" @click="mountModal">Crear categoria</button>
		</div>
		<div class="card-body">
			<table class="table" id="category_table">
				<thead>
					<tr>
						<th>Name</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(category, index) in categories" :key="index">
						<td>{{category.name}}</td>
						<td class="d-flex">
							<button class="m-1 btn btn-warning" @click="editCategory(category)">Editar</button>
							<button class="m-1 btn btn-danger" @click="askDelete(category.id)">Eliminar</button>
							<!-- <button><i class="fa-regular fa-trash"></i></button> -->
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div v-if="load_modal">
			<category-modal :category="category" />
		</div>
	</section>
</template>

<script>
	import CategoryModal from './CategoryModal.vue'

	export default {
		name: '',
		props: ['categories'],
		components: {
			CategoryModal
		},
		data() {
			return {
				modal: null,
				category: null,
				load_modal: false
			}
		},
		mounted() {
			$('#category_table').DataTable()
		},
		methods: {
			async askDelete(id_category) {
				const result = await swal.fire({
					icon: 'info',
					title: '¿Quieres eliminar la categoria?',
					showCancelButton: true,
					confirmButtonText: 'Eliminar'
				})
				if (!result.isConfirmed) return
				this.deleteCategory(id_category)
			},
			async deleteCategory(id_category) {
				// Peticion al backend -> laravel
				try {
					const { data } = await axios.delete(`/category-products/delete/${id_category}`)
					if (data.deleted == 'ok') {
						await swal.fire({
							icon: 'success',
							title: '¡Eliminado Correctamente!'
						})
						this.loadPage()
					}
				} catch (error) {
					await swal.fire({
						icon: 'error',
						title: '¡Ocurrio un error!'
					})
					console.error(error)
				}
			},
			loadPage() {
				window.location.reload()
			},
			openModal() {
				// Obtenemos el modal por el id
				const modal = document.getElementById('category_modal')

				// Instancia de objeto bootstrap y su metodo modal
				this.modal = new bootstrap.Modal(modal, { keyboard: false })

				// Abrimos el modal
				this.modal.show()

				// Escuchador que se ejecuta cuando el modal se cierra
				modal.addEventListener('hidden.bs.modal', () => {
					this.category = null
					this.load_modal = false
				})
			},
			mountModal() {
				this.load_modal = true
				setTimeout(() => this.openModal(), 300)
			},
			editCategory(category) {
				this.category = category
				this.mountModal()
			}
		}
	}
</script>

