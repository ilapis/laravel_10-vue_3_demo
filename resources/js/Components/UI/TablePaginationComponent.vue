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
    //TODO check and replace
    textArea.innerHTML = str;//.replace('&laquo;', '').replace('&raquo;', '').trim(' ');

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
          <template v-if="link.label.indexOf('&amp;laquo;') !== -1">
              {{$t('button.previous')}}
          </template>
          <template v-else-if="link.label.indexOf('&amp;raquo;') !== -1">
              {{$t('button.next')}}
          </template>
          <template v-else>
              {{ decodeHtmlEntities(link.label) }}
          </template>
      </button>
    </template>
  </div>
</template>

<style scoped>

</style>
