// Import necessary dependencies and configuration files.
import "./bootstrap"; // Include Javascript Bootstrap
import { createApp } from "vue"; // Create a Vue 3 app instance
import { createRouter, createWebHistory } from "vue-router"; // Set up Vue Router

// Import the root Vue component.
import App from "./components/App.vue";

// Create a new Vue Router instance.
const router = createRouter({
  history: createWebHistory(),
  routes: [
    // Define the routes for the application
  ]
});

// Create a new Vue app instance and configure it with Vue Router.
const app = createApp(App);
app.use(router); // Use the Vue Router in the app
app.mount("#app"); // Mount the app to the HTML element with id 'app'
