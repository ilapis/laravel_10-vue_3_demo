<script setup>
import {defineProps} from "vue";

const props = defineProps({
    id: {
        type: Number,
        default: null,
    },
    data: {
        type: Object,
        default: null,
    },
    service: {
        type: Object,
        default: null,
    },
    component_settings: {
        type: Object,
        default: {
            display: 'manufacturers.name',
            soft_deleted: 'manufacturers.deleted_at'
        },
    }
})
</script>

<template>
    {{props.data[props.component_settings.display]}}
    <template v-if="props.data[props.component_settings.soft_deleted] !== null">
        <Badge :value="$t('record.soft_deleted')" severity="danger"></Badge>
    </template>
</template>

<style scoped>

</style>
