<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6 mt-4">

                <h2>Register</h2>


                <form @submit.prevent="register">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" v-model="form.name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address:</label>
                        <input type="email" class="form-control" id="email" v-model="form.email">
                    </div>

                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" v-model="form.password">
                    </div>
                    <div class="form-group">
                        <label for="c_password">Confirm Password:</label>
                        <input type="password" class="form-control" id="c_password" v-model="form.c_password">
                    </div>

                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import { reactive } from 'vue'
import { useRouter } from "vue-router"
export default {
    setup() {
        const router = useRouter();

        let form = reactive({
            name: '',
            email: '',
            password: '',
            c_password: '',
        });

        const register = async () => {
            await axios.post('/api/register', form).then(res => {

                if (res.data.success) {

                    localStorage.setItem('token', response.data.data.token);

                    console.log("Hi", localStorage.getItem('user')); // kiểm tra giá trị user được lưu trữ trong localStorage
                    router.push({ name: 'Dashboard' }); // chuyển hướng đến trang Dashboard
                }
            }).catch(e => {
            })
        }
        return {
            form,
            register,

        }
    }
}
</script>