<template>
    <div class="container row justify-content-center">
        <div>
            <router-link :to="{
                name: 'EditSet',
                params: {
                    id: $route.params.id
                }
            }">
                <button class="btn btn-primary">
                    Sửa học phần
                </button>
            </router-link>
        </div>
        <div class="container row justify-content-center">
            <FlashCard :cards="cards" class="col-md-8" />
        </div>
        <router-link :to="{
            name: 'Test',
            params: {
                id: $route.params.id
            },
            props: {
                tcards: 3333
            }
        }">
            <button class="btn btn-primary">
                Bắt đầu làm bài
            </button>
            <!-- Edit -->

        </router-link>

    </div>
</template>
<script>
import FlashCard from '../components/FlashCard.vue';
import TestPage from './TestPage.vue';
export default {


    data() {

        return {
            cards: [],
        }
    },
    created() {
        axios.get(`/api/courses-detail/${this.$route.params.id}`)
            .then(response => {
                this.cards = response.data;
                console.log(response.data);
            })
            .catch(error => {
                console.log(error);
            });
    },
    components: {
        FlashCard,
        TestPage
    }
}
</script>