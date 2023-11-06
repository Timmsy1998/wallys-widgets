<template>
    <div class="container">
        <header>
            <div class="px-3 py-2 bg-dark text-white">
                <div class="container">
                    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                        <!-- Logo and navigation links -->
                        <router-link to="/"
                            class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
                            <img src="https://www.adaptivewfs.com/wp-content/uploads/2020/07/logo-placeholder-image.png"
                                style="height:60px;" />
                        </router-link>
                        <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
                            <!-- Home link -->
                            <li>
                                <router-link to="/" class="nav-link text-white"
                                    style="text-decoration: none; color: white;">
                                    <svg class="bi d-block mx-auto mb-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M4.5 21q-.625 0-1.063-.438T3 19.5v-1.9l4-3.55V21H4.5ZM8 21v-4h8v4H8Zm9 0v-8.2L12.725 9l3.025-2.675l4.75 4.225q.25.225.375.513t.125.612V19.5q0 .625-.438 1.063T19.5 21H17ZM3 16.25v-4.575q0-.325.125-.625t.375-.5L11 3.9q.2-.2.463-.287T12 3.525q.275 0.537.088T13 3.9l2 1.775L3 16.25Z" />
                                    </svg>Home
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <!-- Content container -->
        <div class="card">
            <div class="card-body">
                <div class="container-fluid">
                    <!-- Display the Vue Router view -->
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'App'  // The name of the Vue component
}
</script>
