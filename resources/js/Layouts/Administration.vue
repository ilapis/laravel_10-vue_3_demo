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
        <Sidebar class="bg-primary box-shadow" style="z-index:100;position:relative;width:300px;height:100%;float:left;"></Sidebar>
        <Header class="bg-primary box-shadow" style="position:relative;width:calc(100% - 301px);height:5rem;float:left;"></Header>
        <Page style="width:calc(100% - 300px);height:calc(100% - 6.375rem);float:left;">
            <slot></slot>
        </Page>
    </div>
</template>

<style scoped>

</style>
