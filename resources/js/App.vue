<template>
  <div class="wrapper">
    <Sidebar />
    <div id="content">
      <Navbar />
      <main class="container">
        <div class="space">
            <router-view></router-view>
          </div>
      </main>
    </div>
  </div>
</template>

<script>
import Navbar from "./components/Navbar.vue";
import Sidebar from "./components/Sidebar.vue";
import Footer from "./components/Footer.vue";

export default {
  name: "App",
  components: {
    Navbar,
    Sidebar,
    Footer,
  },
};
</script>
