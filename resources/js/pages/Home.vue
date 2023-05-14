<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="my-4">Trang chủ</h1>
                <RecentCourses />
            </div>
            <!-- <div class="col-md-4">
                <h2 class="my-4">Danh mục</h2>
                <ul class="list-group">
                    <li class="list-group-item">Học phần</li>
                    <li class="list-group-item">Giảng viên</li>
                    <li class="list-group-item">Sự kiện</li>
                </ul>
            </div> -->
        </div>
    </div>
</template>

<script>
import RecentCourses from '../components/RecentCourses.vue';
export default {
    components: {
        RecentCourses,

    },
    setup() {
        return {
            //
        }
    }
}
</script>
