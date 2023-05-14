<template>
    <div class="container">
        <h2 class="mb-4">Danh sách học phần gần đây</h2>
        <div class="row">
            <div v-for="course in recentCourses" :key="course.id" class="col-md-4 mb-4">
                <div class="card shadow">
                    <img class="card-img-top" :src="course.image" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{ course.name }}</h5>
                        <p class="card-text">{{ course.description }}</p>
                        <router-link :to="{ name: 'Course', params: { id: course.id } }" class="btn btn-primary">Xem
                            chi tiết</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'RecentCourses',
    data() {
        return {
            recentCourses: [
                {
                    id: 1,
                    name: 'Lập trình web',
                    description: 'Học phần giảng dạy các kỹ năng lập trình web',
                    image: 'https://picsum.photos/id/1/200/150'
                },
                {
                    id: 2,
                    name: 'Toán rời rạc',
                    description: 'Học phần giảng dạy toán rời rạc và ứng dụng',
                    image: 'https://picsum.photos/id/2/200/150'
                },
                {
                    id: 3,
                    name: 'Kinh tế học cơ bản',
                    description: 'Học phần giảng dạy các kiến thức cơ bản về kinh tế',
                    image: 'https://picsum.photos/id/3/200/150'
                }
            ]
        }
    },
    created() {
        axios.get('/api/courses-list')
            .then(response => {
                this.recentCourses = response.data;
            })
            .catch(error => {
                console.log(error);
            });
    }
}
</script>

<style scoped>
.card {
    border: none;
    border-radius: 5px;
    transition: box-shadow 0.3s;
}

.card:hover {
    box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
}

.card-title {
    font-size: 1.2rem;
}

.card-text {
    margin-bottom: 1rem;
}
</style>
