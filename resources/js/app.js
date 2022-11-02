import './bootstrap'
import { createApp } from 'vue'

// Components ---------------------------------------------------
import ExampleComponent from './components/ExampleComponent.vue'

const app = createApp({
	components: {
		ExampleComponent
	}
})

app.mount('#app')
