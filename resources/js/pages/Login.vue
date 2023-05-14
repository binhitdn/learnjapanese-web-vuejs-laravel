<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-sm-6 mt-4">
                <!-- {{ form  }} -->
                <form @submit.prevent="login">
                    <div class="form-group">
                        <label for="email">Email address:</label>
                        <input type="email" class="form-control" placeholder="Enter email" id="email" v-model="form.email">
                    </div>
                    <div class="form-group">
                        <label for="email">Password:</label>
                        <input type="password" class="form-control" placeholder="Enter password" id="password"
                            v-model="form.password">

                    </div>
                    <button class="btn btn-primary" type="submit">
                        Login
                    </button>

                </form>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
import { reactive } from 'vue'
import { useRouter } from 'vue-router';
import { useStore } from 'vuex';
export default {
    setup() {
        const router = useRouter();
        const store = useStore();
        let form = reactive({
            email: '',
            password: ''
        });

        const login = async () => {
            await axios.post('/api/login', form).then(response => {
                if (response.data.success) {
                    store.dispatch('setToken', response.data.data.token)
                    router.push({ name: 'Dashboard' });
                }
            }).catch(error => {
                console.log(error.response.data);
            }
            );
        }
        return {
            form,
            login
        }
    }
}
</script>
