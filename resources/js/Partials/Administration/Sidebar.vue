<script setup>
</script>

<template>
    <div>
        <div class="width-full display-block line-height-3rem text-indent-1rem">
            <RouterLink :to="{ name: 'admin-languages'}">Languages</RouterLink>
        </div>
        <div class="width-full display-block line-height-3rem text-indent-1rem">
            <RouterLink :to="{ name: 'admin-translations'}">Translations</RouterLink>
        </div>
    </div>
</template>

<style scoped>

</style>
