<template>
    <div class="container">
        <div class="row">
            <h1 class="title">TODAY'S NEWS</h1>
            <news-item v-for="article in news" :article="article" />
        </div>
    </div>
</template>

<script>

import NewsItem from './NewsItem.vue'

export default {
    name: "NewsItemContainer",
    components: {
        NewsItem
    },
    props: ['source'],
    data() {
        return {
            news: [],
            nextPage: null
        }
    },
    beforeMount() {
        this.getNews();
    },
    mounted() {
        this.loadMore();
    },
    methods: {
        getNews(nextPage = null)
        {
            const url = nextPage ? nextPage : '/api/news';
            this.axios.get(url).then(
                response => {
                    if (nextPage === null) {
                        this.news = response.data.data
                    } else {
                        response.data.data.map((value) => {

                            this.news.push(value)
                        });
                    }
                    this.nextPage = response.data.links.next
                }
            )
        },
        loadMore() {
            window.onscroll = () => {
                let bottomOfWindow = document.documentElement.scrollTop + window.innerHeight === document.documentElement.offsetHeight;
                if (bottomOfWindow && this.nextPage) {
                    this.getNews(this.nextPage);
                }
            }
        }
    }
}
</script>
