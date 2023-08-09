<script setup>
import { useLanguageStore } from '@/Stores/languageStore.js'
import { useUserStore } from '@/Stores/userStore.js'
import { useArticleStore } from '@/Stores/articleStore.js';
import articleForm from "@/FormsDefaults/articleForm.js";
import {defineAsyncComponent, onMounted, ref} from "vue";
import { useRouter } from 'vue-router';

const CKEditorComponent = defineAsyncComponent(() => import('@/Components/UI/CKEditorComponent.vue'));
const languageStore = new useLanguageStore()
const userStore = new useUserStore()
const articleStore = new useArticleStore();
const router = useRouter();
const localForm = ref(articleForm);
articleStore.setForm(articleForm);

const props = defineProps({
    id : {
        type: Number,
        required: false,
        default: null,
    }
})

onMounted( async () => {
    articleStore.errors = null;
    languageStore.fetchCollection();
    await userStore.fetchEnabled();
    localForm.value = JSON.parse(JSON.stringify(articleForm));
    if (props.id !== null) {
        localForm.value = await articleStore.get(props.id);
    }
});

const submitForm = async (id) => {
    if (id) {
        articleStore.update(props.id, localForm.value).then(() => {
            if (!articleStore.hasErrors()) {
                router.push({name: 'admin-articles'});
            }
        });
    } else {
        articleStore.create(localForm.value).then(() => {
            if (!articleStore.hasErrors()) {
                router.push({name: 'admin-articles'});
            }
        });
    }
}
</script>

<template>
  <div
    v-if="localForm"
    class="p-4"
  >
    <div class="w-full height-12">
      <ButtonComponent
        :label="`${props.id ? 'Update' : 'Create'}`"
        class="btn-primary height-12"
        @click="submitForm(props.id)"
      />
    </div>
    <div class="page-content">
      <InputSelect
        v-model="localForm.language_id"
        style="max-width:400px;float:left;margin-right:1rem;"
        class="mt-4"
        label="table.language"
        :options="languageStore?.collection?.data"
        identifier="id"
        display="name"
        :underline-text="['The language field is required.']"
        :errors="articleStore?.errors?.language_id"
      />

      <InputSelect
        v-model="localForm.user_id"
        style="max-width:400px;float:left;"
        class="mt-4"
        label="table.user"
        :options="userStore.enabled"
        identifier="id"
        display="name"
        :underline-text="['The user field is required.']"
        :errors="articleStore?.errors?.user_id"
      />

      <InputText
        v-model="localForm.title"
        style="clear:both;"
        label="table.title"
        :underline-text="['The group field is required.']"
        :errors="articleStore?.errors?.title"
        :validate-with-dry-request="true"
        @validate-with-dry-request="value => {articleStore.validateField('title', value, props.id)}"
      />
        <br/>
        <CKEditorComponent v-model="localForm.text" />
    </div>
  </div>
</template>

<style scoped>
.page-content {
    height: calc(100% - 11rem);
    display: block;
    overflow-y: auto;
    margin: 1rem 0 0 0;
    position: absolute;
    width: calc(100% - 22rem);
    padding: 0 1rem;
    overflow-x: hidden;
}
</style>
