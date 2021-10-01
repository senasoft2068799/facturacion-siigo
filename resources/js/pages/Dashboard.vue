<template>
    <div>
        <p class="text-center">{{currentUser.name}}</p>
        <button class="btn btn-danger" @click="logout()">Cerrar sesión</button>
    </div>
</template>
<script>
export default {
    data(){
        return {
            currentUser: {

            },
            token: localStorage.getItem("token")
        }
    },
    mounted(){
        window.axios.defaults.headers.common["Authorization"] = `Bearer ${this.token}`;
        axios.get("/api/user").then((res)=>{
            this.currentUser = res.data;
        }).catch((err)=>{
            console.log(err);
        })
    },
    methods: {
        logout(){
            axios.post("/api/logout").then((res)=>{
                localStorage.removeItem("token");
                this.$router.push("/login");
            }).catch((err)=>{
                console.log(err);
            })
        }
    }
}
</script>