<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Sửa học phần
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="set-name">Sửa học phần</label>
                                <input type="text" class="form-control" id="set-name" v-model="setName">
                            </div>
                            <div class="form-group">
                                <label for="term">
                                    Mô tả
                                </label>
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
                            Sửa học phần
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
            setName: 'êfefe',
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
            axios.post('/api/courses/' + this.$route.params.id, {
                id: this.$route.params.id,
                name: this.setName,
                description: this.description,
                cards: this.terms
            }).then(response => {
                console.log(response.data); // In ra dữ liệu trả về từ server
                toast.success('Sửa học phần thành công!');

            }).catch(error => {
                console.log(error.response.data); // In ra thông báo lỗi từ server
            });


        }
    },
    created() {
        const id = this.$route.params.id
        axios.get(`/api/courses-detail/${id}`)
            .then(response => {
                this.terms = response.data
            })
            .catch(error => {
                console.log(error);
            });
        axios.get(`/api/courses-id/${id}`)
            .then(response => {
                this.setName = response.data.title
                this.description = response.data.description
                console.log(response.data);
            })
            .catch(error => {
                console.log(error);
            });
    }

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