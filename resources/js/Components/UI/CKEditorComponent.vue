<script>
import { defineComponent, ref, watch } from 'vue';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import CKEditor from '@ckeditor/ckeditor5-vue';

export default defineComponent({
    computed: {
        ClassicEditor() {
            return ClassicEditor
        }
    },
    components: {
        ckeditor: CKEditor.component,
    },
    props: {
        modelValue: {
            type: String,
            default: ''
        }
    },
    emits: ['update:modelValue'],
    // {{ClassicEditor.builtinPlugins.map( plugin => plugin.pluginName )}}
    setup(props, { emit }) {
        const editor = ref(ClassicEditor);
        const editorConfig = ref({});
        const content = ref(props.modelValue);

        watch(content, (newValue) => {
            emit('update:modelValue', newValue);
        });

        watch(() => props.modelValue, (newValue) => {
            content.value = newValue;
        });

        return {
            editor,
            editorConfig,
            content
        };
    }
});
</script>

<template>
    <ckeditor :editor="editor" v-model="content" :config="editorConfig"></ckeditor>
</template>
