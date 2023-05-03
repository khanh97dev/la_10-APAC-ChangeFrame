/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import {
    createApp
} from 'vue';
import {
    Quasar
} from 'quasar'

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

// use plugins
app.use(Quasar)


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
Object.entries(
    import.meta.glob('./vue-html/**/*.vue', {
        eager: true
    })).forEach(([path, definition]) => {
    app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
});

/**
 * Import all components to vue
 */
import * as QuasarComponents from 'quasar';
Object.keys(QuasarComponents).forEach((name) => {
    app.component(name, QuasarComponents[name]);
});

/**
 * globalProperties function to define a set of global methods or properties that can be accessed from anywhere in your application.
 */
app.config.globalProperties.$cProperty = {
    passWindow(key, param) {
        if (window[key]) {
            window[key](param)
        }
    }
}

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */
app.mount('#app');
