// import './bootstrap';
import '../css/app.css'

import type { DefineComponent } from 'vue'
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m'

import BaseLayout from './Layouts/BaseLayout.vue'

const appName = import.meta.env.VITE_APP_NAME || 'Todo App'

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: async (name) => {
    const page = resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob<DefineComponent>('./Pages/**/*.vue'))
    page.then((pageModule) => {
      if (pageModule.layout === undefined) {
        pageModule.default.layout = BaseLayout
      }

      return pageModule
    })

    return await page
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue, Ziggy)
      .mount(el)
  },
  progress: {
    color: '#4B5563',
  },
})
