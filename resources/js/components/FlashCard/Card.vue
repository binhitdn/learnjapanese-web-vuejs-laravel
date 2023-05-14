<template>
    <div class="flip-card" @click="isFlipped = !isFlipped" :class="{ flipped: isFlipped }">
        <div class="flip-card-inner">
            <div class="flip-card-front">
                <h2>
                    {{ card.term }}
                </h2>
            </div>
            <div class="flip-card-back">
                <h2>
                    {{ card.definition }}
                </h2>
            </div>
        </div>
    </div>
</template>
  
<script>
export default {
    props: {
        card: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            isFlipped: false,
        };
    },
};
</script>
  
<style>
.flip-card {

    width: 300px;
    transform-style: preserve-3d;
    text-align: center;
    margin: 0 auto;
    font-size: 30px;
    font-weight: bold;
}

.flip-card-front,
.flip-card-back {
    position: absolute;
    width: 100%;
    height: 100%;
    backface-visibility: hidden;
    transition: transform 0.5s ease-out;
}

.flip-card-front {
    transform: rotateX(0deg);
}

.flip-card-back {
    transform: rotateX(180deg);
}

.flip-card.flipped .flip-card-front {
    transform: rotateX(-180deg);
}

.flip-card.flipped .flip-card-back {
    transform: rotateX(0deg);
}
</style>