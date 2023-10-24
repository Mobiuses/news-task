<template>
    <router-view></router-view>
</template>

<script>
import NewsItemContainer from './components/NewsItemContainer.vue'

export default {
    name: 'app',
    components: {
        NewsItemContainer
    },
    data() {
        return {}
    },
}
</script>
