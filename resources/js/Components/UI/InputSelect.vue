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
    let record = null;

    if (props?.options) {
        record = props?.options?.find((record) => {
            if (record[props.identifier] == props.modelValue) {
                return record;
            }
        });
    }

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
  <div
    ref="dropdownRef"
    class="select-wrapper line-height-3rem w-full mt-4 position-relative"
  >
    <label
      v-if="props.label"
      class="float-left"
    >{{ props.label }}</label>

    <div
      class="selection-display border border-bottom"
      @click="toggleDropdown"
    >
      <template v-if="displayRecord">
        {{ displayRecord[props.display] }}
      </template>
      <template v-else>
        {{ $t('Select option') }}
      </template>
      <DownIcon
        v-if="!showDropdown"
        class="line-height-3rem float-right mt-3"
      />
      <UpIcon
        v-else
        class="line-height-3rem float-right mt-3"
      />
    </div>

    <UnderlineComponent
      :underline-text="props.underlineText"
      :errors="props.errors"
    />

    <div
      v-if="showDropdown"
      class="select-content block box-shadow position-absolute w-100"
    >
      <template
        v-for="(option, index) in props.options"
        :key="index"
      >
        <slot
          name="option"
          :option="option"
          :index="index"
        >
          <div
            class="line-height-3rem bg-hover-grey"
            :class="`${(props.modelValue === option[props.identifier]) ? 'btn-primary ' : '' }`"
            @click="updateInputValue(option[props.identifier])"
          >
            {{ option[props.display] ?? option }}
          </div>
        </slot>
      </template>
    </div>
  </div>
</template>

<style setup>
.position-relative {
    position: relative;
}

.position-absolute {
    position: absolute;
}

.w-100 {
    width: 100%;
}
.select-wrapper {
    text-indent: 0;
}
.select-content {
    text-indent: 1rem;
    max-height: 15rem;
    overflow: auto;
    width:calc(100% + 2rem);
    margin-left: -1rem;
    z-index: 100;
}
.selection-display {
    margin-top: -1px;
}
</style>
