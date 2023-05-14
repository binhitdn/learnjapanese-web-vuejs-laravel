<template>
    <div class="container my-5">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Bài kiểm tra từ vựng</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2 class="mb-4">{{ questionNumber + 1 }} {{ currentQuestion.term }}</h2>
                        <h3>
                            Time: {{ timer }}
                        </h3>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <div class="list-group">
                            <div v-for="(option, index) in answerOptions" :key="index"
                                class="list-group-item list-group-item-action"
                                :class="{ active: selectedOption === option }" @click="selectedOption = option">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" :id="option" :value="option"
                                        v-model="selectedOption" />
                                    <label class="form-check-label" :for="option">{{ option }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button class="btn btn-primary" @click="checkAnswer" :disabled="!selectedOption">Trả lời</button>
                    </div>

                </div>
            </div>
        </div>
        <div v-if="showNext" class="my-4 text-center">

            <button class="btn btn-success btn-lg" @click="nextQuestion" :disabled="questionNumber === totalQuestions">
                {{ questionNumber === totalQuestions ? 'Xem kết quả' : 'Câu tiếp theo' }}
            </button>
        </div>
        <div v-if="showScore" class="card my-5">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Kết quả</h2>
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <div class="list-group">
                            <div class="list-group-item">
                                Số câu đúng: {{ correctAnswers }}
                            </div>
                            <div class="list-group-item">
                                Số câu sai: {{ incorrectAnswers }}
                            </div>
                            <div class="list-group-item">
                                Tổng số câu hỏi: {{ totalQuestions }}
                            </div>
                            <div class="list-group-item">
                                Tỉ lệ đúng: {{ scorePercentage }}%
                            </div>
                            <div class="list-group-item">
                                <strong>{{ scoreMessage }}</strong>
                            </div>
                            <div class="list-group-item">
                                <strong>Tổng điểm: {{ totalMarks }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script>

const START_TIME = 100;
export default {
    props: {

    },
    data() {
        return {
            cards: [],
            currentQuestion: {},
            answerOptions: [],
            selectedOption: "",
            showNext: false,
            correctAnswer: "",
            correctAnswers: 0,
            incorrectAnswers: 0,
            questionNumber: 0,
            totalQuestions: 0,
            showScore: false,
            score: 0,
            scorePercentage: 0,
            scoreMessage: "",
            timer: START_TIME,
            totalMarks: 0,
        };
    },

    async created() {
        await axios.get(`/api/courses-detail/${this.$route.params.id}`)
            .then(response => {
                this.cards = response.data;


            })
            .catch(error => {
                console.log(error);
            });





        let shuffledCards = this.shuffle(this.cards);
        this.totalQuestions = shuffledCards.length;
        this.cards = shuffledCards;
        for (let i = 0; i < this.totalQuestions; i++) {
            this.cards[i].isEdit = false;
        }
        this.getQuestion();

        let interval = setInterval(() => {
            this.timer--;
            if (this.timer === 0) {
                this.checkAnswer();
                this.nextQuestion();
                this.timer = START_TIME;
            }
            if (this.questionNumber === this.totalQuestions) {
                clearInterval(interval);
            }
        }, 1000);


        return () => clearInterval(interval);

    },

    methods: {
        getQuestion() {
            this.currentQuestion = this.cards[this.questionNumber];
            this.answerOptions = [this.currentQuestion.definition, ...this.cards
                .filter(card => card.id !== this.currentQuestion.id)
                .map(card => card.definition)
                .sort(() => 0.5 - Math.random())
                .slice(0, 3)
            ];
            this.correctAnswer = this.currentQuestion.definition;
            this.answerOptions = this.shuffle(this.answerOptions);
        },
        shuffle(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
            return array;
        },
        checkAnswer() {
            if (this.cards[this.questionNumber].isEdit == false) {
                if (this.selectedOption === this.correctAnswer) {
                    this.cards[this.questionNumber].isEdit = true;
                    this.correctAnswers++;
                    this.totalMarks += this.timer;
                } else {
                    this.incorrectAnswers++;

                }
                this.showNext = true;
            } else {

            }
        },
        nextQuestion() {
            this.questionNumber++;
            if (this.questionNumber < this.totalQuestions) {
                this.getQuestion();
                this.selectedOption = '';
                this.showNext = false;
            } else {
                this.showScore = true;
                this.score = this.correctAnswers;
                this.scorePercentage = Math.round((this.correctAnswers / this.totalQuestions) * 100);
                if (this.scorePercentage >= 80) {
                    this.scoreMessage = 'Chúc mừng bạn đã hoàn thành bài kiểm tra!';
                } else {
                    this.scoreMessage = 'Bạn cần cố gắng hơn nữa!';
                }
            }
        },
        previousQuestion() {
            this.questionNumber--;
            this.getQuestion();
            this.selectedOption = '';
            this.showNext = false;
        },
    },
}
</script>
<style>
.test-page {
    width: 100%;
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    text-align: center;
}

.question-container {
    margin-bottom: 20px;
}

.question-text {
    font-size: 24px;
    margin-bottom: 20px;
}

.answer-options {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.answer-option {
    width: 150px;
    height: 100px;
    margin: 10px;
    padding: 20px;
    border: 2px solid #ccc;
    border-radius: 8px;
    font-size: 20px;
    text-align: center;
    cursor: pointer;
}

.answer-option:hover {
    background-color: #ccc;
}

.selected {
    background-color: #ccc;
}

.answer-btn {
    margin-top: 20px;
    padding: 10px 20px;
    font-size: 18px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}

.next-question {
    margin-top: 20px;
}

.next-question-btn {
    padding: 10px 20px;
    font-size: 18px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}

.next-question-btn:hover {
    background-color: #0056b3;
}
</style>