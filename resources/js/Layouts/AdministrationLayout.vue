<script>
import {markRaw} from "vue";

export default markRaw({
    name: 'AdministrationLayout'
});
</script>

<script setup>
import HeaderPartial from '@/Partials/Administration/HeaderPartial.vue';
import PagePartial from '@/Partials/Administration/PagePartial.vue';
import SidebarPartial from '@/Partials/Administration/SidebarPartial.vue';
</script>

<template>
  <div style="background: #fff;width:100%;height:100%">
    <SidebarPartial
      class="bg-primary box-shadow"
      style="z-index:100;position:relative;width:300px;height:100%;float:left;"
    />
    <HeaderPartial
      class="bg-primary box-shadow"
      style="position:relative;width:calc(100% - 301px);height:5rem;float:left;"
    />
    <PagePartial style="width:calc(100% - 300px);height:calc(100% - 5rem);float:left;overflow:auto;">
      <slot />
    </PagePartial>
  </div>
</template>

<style scoped>

</style>
