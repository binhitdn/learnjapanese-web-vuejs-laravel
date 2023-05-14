<template>
    <Splide :options="options" aria-label="My Favorite Images">
        <!-- <SplideSlide>
            <div class="flashcard">
                <Card />
            </div>
        </SplideSlide> -->
        <SplideSlide v-for="card in cards" :key="card.id">
            <div class="flashcard">
                <Card :card="card" />
            </div>
        </SplideSlide>
    </Splide>
</template>
<script>
import { Splide, SplideSlide } from '@splidejs/vue-splide';
import { defineComponent } from 'vue';
import '@splidejs/vue-splide/css';
import '@splidejs/vue-splide/css/skyblue';
import '@splidejs/vue-splide/css/sea-green';
import '@splidejs/vue-splide/css/core';
import Card from './FlashCard/Card.vue';

export default defineComponent({
    props: {
        cards: {
            type: Array,
            required: true,
        },
    },
    components: {
        Splide,
        SplideSlide,
        Card
    },

    setup() {
        const options = {
            rewind: true,
            gap: '1rem',
        };
        return { options };
    },
});
</script>
<style scoped>
.flashcard {
    background-color: #fff;
    width: 100%;
    height: 300px;
    border-radius: 8px;
    display: flex;
    justify-content: center;
    align-items: center;

    perspective: 1000px;
    cursor: pointer;
    border: 2px solid #11019c;
}

.flashcard:hover .flashcard-inner {
    transform: rotateY(180deg);
}

.flashcard-inner {
    position: relative;
    width: 100%;
    height: 100%;
    transition: transform 0.6s;
    transform-style: preserve-3d;
}

.flashcard-front,
.flashcard-back {
    position: absolute;
    width: 100%;
    height: 100%;
    backface-visibility: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
}

.flashcard-front {
    z-index: 1;
    background-color: #2c3e50;
    color: #fff;
}

.flashcard-back {
    transform: rotateY(180deg);
    background-color: #eee;
}

.flashcard h2 {
    font-size: 24px;
}
</style>