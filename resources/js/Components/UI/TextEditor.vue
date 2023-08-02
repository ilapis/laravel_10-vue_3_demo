<script>
import {markRaw} from "vue";

//https://vueup.github.io/vue-quill/guide/modules.html
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

export default markRaw({
    name: 'TextEditor',
    components: {
        QuillEditor
    },
});
</script>

<script setup>
import {defineProps, defineEmits, ref} from "vue";
import { sharedInputProps } from '@/Helpers/sharedInputProps.js';

const props = defineProps(sharedInputProps);
const emit = defineEmits(['update:modelValue']);
const quill = ref(null);
const text = ref(null);

const updateInputValue = () => {
    text.value = quill.value.getHTML();
    emit('update:modelValue', text.value);
}
const onEditorReady = (editor) => {
    quill.value = editor;
    //TODO find better way
    setTimeout(() => {
        quill.value.setHTML(props.modelValue);
        }, 2000);
};
</script>

<template>
  <label
    v-if="props.label"
    class="float-left"
  >{{ $t(props.label) }}</label>

  <UnderlineComponent
    :underline-text="props.underlineText"
    :errors="props.errors"
  />

  <QuillEditor
    ref="quill"
    theme="snow"
    @ready="onEditorReady"
    @text-change="updateInputValue"
  />
</template>
