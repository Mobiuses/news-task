<template>
    <div class="row justify-content-center news-item">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title" @click="viewArticlePage(this.article.id)">{{ this.article.title }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ this.article.short_description}}</h6>
                    <div class="row card-datetime-row">
                        <div class="col-6">
                            <button class="btn btn-primary card-read-more-btn" @click="viewArticlePage(this.article.id)">Read more</button>
                        </div>
                        <div class="col-6">
                            <h6 class="card-datetime card-subtitle mb-2 text-muted">{{ this.article.created_at }}</h6>
                        </div>
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
        return {}
    },
    methods: {
        activeToggle() {
            this.axios.patch('./api/news/' + this.article.id).then(response => this.article.status = response.data.status)
        },
        viewArticlePage(id)
        {
            this.$router.push({ path: `/article/${id}` });
        }
    }
}
</script>
