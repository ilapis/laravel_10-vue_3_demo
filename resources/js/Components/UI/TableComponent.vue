<script setup>
import {onMounted, onUnmounted, ref} from "vue";

const props = defineProps({
    rows: {
        type: Object,
        default: {}
    },
    rowSettings: {
        type: Object,
        default: {}
    },
});

const tableBodyId = ref("table_body_" + generateRandomId());

const setTableBodyHeight = () => {
    const tableBody = document.getElementById(tableBodyId.value);
    if (tableBody) {
        tableBody.style.height = window.innerHeight - 276 + "px";
    }
};
onMounted( () => {
    setTableBodyHeight();
    window.addEventListener('resize', setTableBodyHeight);
});

onUnmounted( () => {
    window.removeEventListener('resize', setTableBodyHeight);
});

// Function to generate a random ID
function generateRandomId() {
    return Math.random().toString(36).substr(2, 9);
}
</script>


<template>
    <div class="w-full" style="height:calc(100% - 8rem);">

        <table class="w-full" style="height:calc(100% - 8rem);">
            <thead>
            <tr class="line-height-4rem text-indent-1rem text-align-left">
                <template class=" height-12" v-for="(header, index) in rowSettings" :key="index">
                    <th :style="'width:'+`${header?.width}`+';'">
                        <template v-if="header.type !== 'component'">
                        {{header?.column}}
                        </template>
                    </th>
                </template>
            </tr>
            </thead>
            <tbody :id="tableBodyId" class="w-full">
            <tr class="line-height-4rem text-indent-1rem text-align-left bg-hover-grey" v-for="row in rows" :key="row.id">
                <template class=" height-12" v-for="(header, index) in rowSettings" :key="header">
                    <td :style="'width:'+`${header?.width}`+';'">
                        <component v-if="header?.type == 'component'"
                                   :is="header.component"
                                   :id="row.id"
                        />
                        <template v-else>
                            {{row[header.column]}}
                        </template>
                    </td>
                </template>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<style scoped>

</style>
