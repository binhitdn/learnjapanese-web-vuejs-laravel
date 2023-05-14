<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        {{ Title }}
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="set-name">Tên Học phần</label>
                                <input type="text" class="form-control" id="set-name" v-model="setName">
                            </div>
                            <div class="form-group">
                                <label for="term">Mô tả</label>
                                <textarea class="form-control" id="description" rows="3" v-model="description"></textarea>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="card mt-2">
                    <div class="card-header bg-primary text-white">Tạo thẻ mới</div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="term">Thuật ngữ</label>
                                <input type="text" class="form-control" id="term" v-model="term">
                            </div>
                            <div class="form-group">
                                <label for="definition">Định nghĩa</label>
                                <input type="text" class="form-control" id="definition" v-model="definition">
                            </div>
                            <button type="button" class="btn btn-primary" @click="addTerm">Add Term</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Danh sách các thẻ trong set
                    </div>
                    <div class="card-body">
                        <ul v-if="terms.length" class="list-group">
                            <li v-for="(term, index) in terms" class="list-group-item">
                                <h5>{{ term.term }}</h5>
                                <p>{{ term.definition }}</p>
                                <button type="button" class="btn btn-danger btn-sm"
                                    @click="removeTerm(index)">Remove</button>
                            </li>
                        </ul>
                        <p v-else class="text-center">Chưa có thẻ nào, hãy thêm ngay!</p>
                    </div>

                    <div class="card-footer text-right">
                        <button type="button" class="btn btn-success" @click="saveSet">
                            {{ ButtonText }}
                        </button>
                    </div>
                </div>
            </div>

        </div>

    </div>
</template>

<script>
import axios from 'axios'
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

export default {
    data() {
        return {
            setName: '',
            definition: '',
            description: '',
            term: '',
            terms: [],
            isEdit: false,
        }
    },
    methods: {
        addTerm() {
            this.terms.push({ term: this.term, definition: this.definition })
            this.term = ''
            this.definition = ''

        },
        removeTerm(index) {
            this.terms.splice(index, 1)
        },
        saveSet() {
            const data = {
                setName: this.setName,
                description: this.description,

                terms: this.terms
            }
            axios.post('/api/courses', {
                user_id: 26, // Thay user_id bằng id của user muốn tạo khóa học
                name: this.setName, // Thay tên khóa học bằng tên muốn đặt
                description: this.description, // Thay mô tả khóa học bằng mô tả muốn đặt
                image: 'https://nordiccoder.com/app/uploads/2020/01/58-developer.jpg',
                cards: this.terms // Thay mảng cards bằng mảng các thẻ muốn đặt
            }).then(response => {
                console.log(response.data); // In ra dữ liệu trả về từ server
                toast.success('Tạo khóa học thành công', {
                    position: 'top-right',
                    duration: 3000,
                    theme: 'dark',
                    icon: '👏',
                    transition: 'Vue-Toastification__bounce',
                });

            }).catch(error => {
                console.log(error.response.data); // In ra thông báo lỗi từ server
            });


        }
    },
    computed: {
        Title() {
            return this.isEdit ? 'Edit Set' : 'Create Set'
        },
        ButtonText() {
            return this.isEdit ? 'Lưu thay đổi' : 'Lưu học phần mới'
        }
    },
}
</script>
<style scoped>
ul {
    max-height: 400px;
    /* Thiết lập chiều cao tối đa cho phần tử */
    overflow-y: auto;
    /* Tạo thanh cuộn */
}
</style>