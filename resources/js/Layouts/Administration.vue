<script>
import {markRaw} from "vue";

export default markRaw({
    name: 'AdministrationLayout'
});
</script>

<script setup>
import Header from '@/Partials/Administration/Header.vue';
import Page from '@/Partials/Administration/Page.vue';
import Sidebar from '@/Partials/Administration/Sidebar.vue';
</script>

<template>
    <div style="background: #fff;width:100%;height:100%">
        <Sidebar class="box-shadow-2" style="width:292px;height:100%;float:left;margin-right: 8px;"></Sidebar>
        <Header style="width:calc(100% - 300px);height:3rem;float:left;"></Header>
        <Page style="width:calc(100% - 300px);height:calc(100% - 3rem);float:left;">
            <slot></slot>
        </Page>
    </div>
</template>

<style scoped>

</style>
