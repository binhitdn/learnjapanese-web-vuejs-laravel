<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <router-link class="navbar-brand" to="/">
                <img src="../assets/logo.png" alt="logo" class="img-fluid" width="100" height="100">
            </router-link>
            <router-link class="navbar-brand nav-text" to="/">Học phần của bạn</router-link>
            <router-link class="navbar-brand nav-text" to="/learn">Học phần khác</router-link>
            <router-link class="navbar-brand nav-text" to="/test">
                Bảng xếp hạng
            </router-link>
            <!-- Tìm kiếm  -->
            <div class="input-group box-search">
                <font-awesome-icon :icon="['fas', 'magnifying-glass']" />
                <input type="text" class="form-control box-search-input" placeholder="Tìm kiếm học phần"
                    aria-label="Recipient's username" aria-describedby="basic-addon2">
            </div>

            <div class="collapse navbar-collapse " id="navbarNav">
                <ul class="navbar-nav">
                    <li class="navbar-item">
                        <router-link class="navbar-brand" to="/login" v-if="$store.state.token == 0">Login</router-link>
                    </li>
                    <li class="navbar-nav">
                        <router-link class="navbar-brand" to="/register"
                            v-if="$store.state.token == 0">Register</router-link>
                    </li>
                    <li class="navbar-nav">
                        <router-link class="navbar-brand" to="/dashboard" v-if="$store.state.token != 0">

                        </router-link>
                    </li>
                </ul>
            </div>
            <div class="nav-item dropdown text-center">
                <a class="nav-link dropdown-toggle btn btn-primary rounded-circle d-block" id="navbarDropdownMenuLink2"
                    href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span>+</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink2">
                    <a class="dropdown-item" href="/create-set">Học phần</a>
                    <a class="dropdown-item" href="#">Thư mục</a>
                </div>
            </div>
            <div v-if="$store.state.token != 0">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown text-center">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <img src="https://haycafe.vn/wp-content/uploads/2022/01/Hinh-anh-cute.jpg" alt="user"
                                class="img-fluid rounded-circle" width="50" height="50" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="/dashboard">Profile</a>
                            <a class="dropdown-item" href="#">Settings</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
    <router-view></router-view>
</template>

<script>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
export default {
    components: {
        'font-awesome-icon': FontAwesomeIcon
    }
};
</script>
<style>
.dropdown-toggle::after {
    display: none;
}

.box-search {
    width: 500px;
    border-radius: 30px;
    border: 1px solid #ced4da;
    outline: 1px solid #4c97e2;

}

.box-search-input {
    width: 400px;
    margin-left: 50px;
    margin-right: 50px;
    border-radius: 30px;
    border: none;
    padding: 10px;
    margin-bottom: 10px;
}

.box-search-input:focus {
    outline: none !important;
}

.nav-text {
    font-size: 20px;
    font-weight: bold;
    margin-left: 20px;
    margin-right: 20px;
    color: #85b9ed;
}
</style>