<script setup>
</script>

<template>
    <div>
        <div class="bg-primary" style="height:6rem;"></div>
        <div class="has-router width-full block line-height-3rem text-indent-1rem">
            <RouterLink :to="{ name: 'admin-languages'}">Languages</RouterLink>
        </div>
        <div class="has-router width-full block line-height-3rem text-indent-1rem">
            <RouterLink :to="{ name: 'admin-translations'}">Translations</RouterLink>
        </div>
    </div>
</template>

<style scoped>

</style>
