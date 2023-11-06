<template>
    <div class="container mx-auto my-5">
        <header>
            <Header />
        </header>
        <!-- Content container -->
        <div class="card">
            <div class="card-body">
                <div class="container-fluid d-flex flex-column align-items-center justify-content-center">
                        <router-view></router-view>
                </div>
            </div>
        </div>
        <footer>
            <Footer />
        </footer>
    </div>
</template>

<script>
import Header from './partials/Header.vue'
import Footer from './partials/Footer.vue';

export default {
    name: 'App',
    components: {
        Header,
        Footer,
    }
}
</script>
