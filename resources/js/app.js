import './bootstrap';
import BookList from './components/BooksIndex.vue';
import { createApp } from 'vue';

Vue.use(VueRouter);

const routes = [
    { path: '/', component: BookList },
];

const router = new VueRouter({
    mode: 'history',
    routes,
});

// const app = new Vue({
//     el: '#app',
//     router,
// });

createApp(BookList).mount('#app');
