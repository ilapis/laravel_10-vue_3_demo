<script>
import {markRaw} from "vue";

export default markRaw({
    name: 'ArticleEditLink'
});
</script>

<script setup>
import { defineProps } from "vue";
import { useRouter } from 'vue-router';
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
  <button
    class="btn btn-primary border-none height-12 box-shadow ml-4"
    @click="navigateToEditArticle(props.id)"
  >
    {{ $t('button.edit') }}
    <slot />
  </button>
</template>
