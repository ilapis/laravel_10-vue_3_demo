<script>
import {markRaw} from "vue";

export default markRaw({
    name: 'InputSelect'
});
</script>

<script setup>
import {defineProps, ref, defineEmits, computed, onMounted, onBeforeUnmount} from "vue";
import { sharedInputProps } from '@/Helpers/sharedInputProps.js';

const props = defineProps(sharedInputProps);
const emit = defineEmits(['change', 'update:modelValue']);

const updateInputValue = (value) => {
    emit('update:modelValue', value);
    emit('change', value);
    toggleDropdown();
};

const displayRecord = computed(() => {
    let record = props?.options?.find((record) => {
        if (record[props.identifier] == props.modelValue) {
            return record
        }
    });

    return record;
});

const showDropdown = ref(false);
const toggleDropdown = () => {
    showDropdown.value = !showDropdown.value;
}
const dropdownRef = ref(null);
const handleClickOutside = (event) => {
    if (dropdownRef.value && !dropdownRef.value.contains(event.target)) {
        showDropdown.value = false;
    }
};

onMounted(() => {
    window.addEventListener('click', handleClickOutside);
});

onBeforeUnmount(() => {
    window.removeEventListener('click', handleClickOutside);
});
</script>

<template>
    <div class="line-height-3rem w-full mt-4" ref="dropdownRef">
        <div @click="toggleDropdown" class="border border-bottom" style="margin-top: -1px;">
            {{displayRecord?.name}}
            <DownIcon v-if="!showDropdown" class="line-height-3rem float-right mt-3" />
            <UpIcon v-else class="line-height-3rem float-right mt-3" />
        </div>

        <UnderlineComponent
            :underlineText="props.underlineText"
            :errors="props.errors"
        />

        <div v-if="showDropdown" class="w-full block box-shadow" style="width:232px;text-indent:1rem;max-height: 15rem;overflow: auto;margin-left: -1rem;position: sticky;">
            <template v-for="(option, index) in props.options" :key="index">
                <slot name="option" :option="option" :index="index">
                    <div
                        @click="updateInputValue(option[props.identifier])"
                        class="line-height-3rem bg-hover-grey"
                        :class="`${(props.modelValue === option[props.identifier]) ? 'btn-primary ' : '' }`">
                        {{option[props.identifier] ?? option}}
                    </div>
                </slot>
            </template>
        </div>
    </div>
</template>

<style setup>

</style>
