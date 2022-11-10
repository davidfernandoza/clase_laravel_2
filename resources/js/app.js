import './bootstrap'
import { createApp } from 'vue'

// Components ---------------------------------------------------
import ExampleComponent from './components/ExampleComponent.vue'
import BooksList from './components/Books/Index.vue'

const app = createApp({
	components: {
		ExampleComponent,
		BooksList
	}
})

app.mount('#app')
