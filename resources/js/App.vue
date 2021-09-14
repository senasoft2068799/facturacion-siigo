<template>
    <div>
        <Navbar/>
        <main class="py-4">
            <div class="container">
                <router-view></router-view>
            </div>
        </main>
        <Footer/>
    </div>
</template>

<script>
import Navbar from "./components/Navbar.vue";
import Footer from "./components/Footer.vue";

export default {
    name: "App",
    components: {
        Navbar,
        Footer
    }
};
</script>
