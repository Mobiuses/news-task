<template>
    <div class="container-fluid" v-show="ready">
        <button class="btn btn-primary back-btn" @click="goBack()">back</button>
        <div class="container">
            <div class="row">
                <h2 class="card-title">{{ this.article.title }}</h2>
                <p>{{ this.article.text }}</p>
                <div class="row card-datetime-row">
                    <div class="col-6">
                        <button
                            class="btn card-read-more-btn"
                            :class="[status.class]"
                            @click="activeToggle(this.article.id)"
                        >
                            {{ this.status.title}}
                        </button>
                    </div>
                    <div class="col-6">
                        <h6 class="card-datetime card-subtitle mb-2 text-muted">{{ this.article.created_at }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "NewsItem",
    props: ['article'],
    data() {
        return {
            article: {},
            ready: false,
            status: {
                'class' : 'btn-primary',
                'title' : 'Set Active'
            }
        }
    },
    created() {
        this.axios.get(`/api/news/${this.$route.params.id}`).then(
            response => {
                this.article = response.data.data
                this.setupActiveToggleBtn()
                this.ready = true
            }
        )
    },
    methods: {
        setupActiveToggleBtn()
        {
            if (this.article.status === 'active') {
                this.status.class = 'btn-danger'
                this.status.title = 'Set Inactive'
            } else {
                this.status.class = 'btn-primary'
                this.status.title = 'Set Active'
            }
        },
            activeToggle() {
            this.axios.patch('/api/news/' + this.article.id).then(
                response => {
                    this.article.status = response.data.data.status
                    this.setupActiveToggleBtn()
                }
            )
        },
        goBack() {
            window.history.length > 1 ? this.$router.go(-1) : this.$router.push('/')
        }
    }
}
</script>
