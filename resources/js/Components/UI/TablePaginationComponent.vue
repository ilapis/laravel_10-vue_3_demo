<script setup>
const props = defineProps({
    links: {
        type: Object,
        required: true,
    },
    service: {
        type: Object,
        required: true,
    },
});

const changePage = async (url) => {
    if (url) {
        const urlParams = new URLSearchParams(new URL(url).search);
        const page = urlParams.get('page');
        await props.service.fetchPage(page);
    }
};

const decodeHtmlEntities = (str) => {
    let textArea = document.createElement('textarea');
    textArea.innerHTML = str.replace('&laquo;', '').replace('&raquo;', '').trim(' ');

    return textArea.value;
};
</script>

<template>
  <div class="pagination mt-3 py-4 bg-primary">
    <template
      v-for="(link, index) in links"
      :key="index"
    >
      <button
        class="btn btn-pagination mt-1 border-none box-shadow"
        :class="`${(link.active == true) ? 'btn-primary' : 'btn-default'}`"
        :disabled="!link.url"
        @click="changePage(link.url)"
      >
        <template v-if="!isNaN(link.label)">
          {{ decodeHtmlEntities(link.label.toLowerCase()) }}
        </template>
        <template v-else>
          {{ $t('button.' + decodeHtmlEntities(link.label.toLowerCase())) }}
        </template>
      </button>
    </template>
  </div>
</template>

<style scoped>

</style>
