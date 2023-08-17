<script>
import {markRaw} from "vue";

export default markRaw({
    name: 'ArticleEditLink'
});
</script>

<script setup>
import { defineProps } from "vue";
import { useRouter } from 'vue-router';
import Button from "primevue/button";
const router = useRouter(); // getting router instance

const props = defineProps({
    id: {
        type: Number,
        default: null
    },
    service:{
        type: Object,
        default: null
    },
})

const navigateToEditArticle = (id) => {
    router.push({ name: 'admin-article-edit', params: { id } });
}
</script>

<template>
    <Button class="ml-4" :label="$t('button.edit')" @click="navigateToEditArticle(props.id)" />
</template>
