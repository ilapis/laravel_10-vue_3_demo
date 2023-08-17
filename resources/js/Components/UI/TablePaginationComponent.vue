<script setup>
import {loadLanguage} from "@/utils.js";
import {ref} from "vue";

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

const perPage = ref(props.service._query_parameter_per_page ?? 10);
const pageLast = ref(1);
const perPageOptions = ref([10, 20, 50]);

const changePage = async (url) => {
    if (url) {
        const urlParams = new URLSearchParams(new URL(url).search);
        const page = parseInt(urlParams.get('page'));
        pageLast.value = page;
        await props.service.fetchPage(page, perPage.value);
    }
};

const changePageSize = async () => {
    console.log('changePageSize', perPage.value);
    await props.service.fetchPage(pageLast.value, perPage.value);
};

const decodeHtmlEntities = (str) => {
    let textArea = document.createElement('textarea');
    //TODO check and replace
    textArea.innerHTML = str;//.replace('&laquo;', '').replace('&raquo;', '').trim(' ');

    return textArea.value;
};
</script>

<template>
  <div class="pagination py-4">

      <div class="inline float-left ml-4" style="margin-top: -0.75rem;">
          <InputSelect
              v-model="perPage"
              :options="perPageOptions"
              @change="changePageSize"
          />
      </div>

    <template
      v-for="(link, index) in links"
      :key="index"
    >
      <button
        class="btn btn-pagination mt-1 border-none"
        :class="`${(link.active == true) ? 'btn-primary box-shadow' : 'btn-default'}`"
        :disabled="!link.url"
        @click="changePage(link.url)"
      >
        <template v-if="link.label.indexOf('&amp;laquo;') !== -1">
          {{ $t('button.previous') }}
        </template>
        <template v-else-if="link.label.indexOf('&amp;raquo;') !== -1">
          {{ $t('button.next') }}
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
