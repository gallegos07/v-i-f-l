require('./bootstrap');

window.Vue = require('vue').default;

import { App, plugin } from '@inertiajs/inertia-vue'
import Vue from 'vue'
import Vuetify from 'vuetify'
import es from 'vuetify/es5/locale/es'

Vue.mixin({ methods: { route }});
Vue.use(plugin)
Vue.use(Vuetify)

const el = document.getElementById('app')

new Vue({
    vuetify: new Vuetify ({
      theme: { light: true},
      lang: {
        locales: {es},
        current: 'es'
     },
    }),
    render: h => h(App, {
        props: {
          initialPage: JSON.parse(el.dataset.page),
          resolveComponent: name => require(`./Pages/${name}`).default,
        },
    }),
}).$mount(el)