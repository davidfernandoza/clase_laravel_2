<template>
	<h1>Hola mundo desde vue</h1>
	<div v-for="(product, index) in products" :key="index">
		<h2 v-if="product.stock > 3" style="color:red">{{product.title}}</h2>
		<h2 v-else>{{product.title}}</h2>
	</div>
</template>

<script>
	export default {
		props: ['products'],
		data() {
			return {}
		},
		created() {
			this.index()
		},
		methods: {
			async index() {
				const { data } = await axios.get('/getProducts')
				console.log(data)
				console.log(this.products)
			}
		}
	}
</script>


