<template>
	<table class="table">
		<thead>
			<tr>
				<th>Titulo</th>
				<th>Autor</th>
				<th>Stock</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			<tr v-for="(book, index) in books" :key="index">
				<th>{{book.title}}</th>
				<td>{{book.author.name}}</td>
				<td>{{book.stock}}</td>
				<td>
					<button class="btn btn-warning me-2" @click="getBook(book)">Editar</button>
					<button class="btn btn-danger" @click="deletBook(book)">Eliminar</button>
				</td>
			</tr>
		</tbody>
	</table>
</template>

<script>
	export default {
		props: ['books_data'],
		data() {
			return {
				books: []
			}
		},
		created() {
			this.index()
		},
		methods: {
			index() {
				this.books = [...this.books_data]
			},

			async getBook(book) {
				try {
					// const { data } = await axios.get(`Books/GetABook/${book.id}`)
					this.$parent.editBook(book)
				} catch (error) {
					console.error(error)
				}
			},
			async deletBook(book) {
				try {
					const result = await swal.fire({
						icon: 'info',
						title: 'Quieres eliminar el libro?',
						showCancelButton: true,
						confirmButtonText: 'Eliminar'
					})

					if (!result.isConfirmed) return

					await axios.delete(`Books/DeleteABook/${book.id}`)
					this.$parent.getBooks()
					swal.fire({
						icon: 'success',
						title: 'Felicidades!',
						text: 'Libro Eliminado!'
					})
				} catch (error) {
					console.error(error)
				}
			}
		}
	}
</script>


