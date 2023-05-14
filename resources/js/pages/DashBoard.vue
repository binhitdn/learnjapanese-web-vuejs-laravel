<template>
    <div class="container">
        <h2>Dashboard: </h2>
        <button class="btn btn-danger" @click="logout">Logout</button>
    </div>
</template>
<script>
import { useRouter } from 'vue-router';
import { useStore } from 'vuex'
export default {
    setup() {
        const router = useRouter();
        const store = useStore();
        function logout() {
            store.dispatch('removeToken');
            router.push({ name: 'Login' });

        }
        return {
            logout
        }
    }
}

</script>