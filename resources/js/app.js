import { createApp } from 'vue';
import IndexLogin from './components/login/App.vue'
import UserIndex from './components/Users/Index.vue';
import ActorIndex from './components/Actores/Index.vue';
import PeliculaIndex from './components/Peliculas/Index.vue';
import RolesIndex from './components/Roles/Index.vue';
import AsignarIndex from './components/Asignar/Index.vue'

const app = createApp({});

app.component('login-index', IndexLogin);
app.component('user-index', UserIndex);
app.component('actor-index', ActorIndex);
app.component('pelicula-index', PeliculaIndex);
app.component('roles-index', RolesIndex);
app.component('asignar-index',AsignarIndex)
app.mount('#app');
