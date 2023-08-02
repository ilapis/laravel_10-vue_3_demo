<script setup>
</script>

<template>
  <div>
    <div
      class="bg-primary"
      style="height:6rem;"
    />
    <div class="has-router width-full block line-height-3rem text-indent-1rem">
      <RouterLink :to="{ name: 'admin-articles'}">
        {{ $t('menu.articles') }}
      </RouterLink>
    </div>
    <div class="has-router width-full block line-height-3rem text-indent-1rem">
      <RouterLink :to="{ name: 'admin-languages'}">
        {{ $t('menu.languages') }}
      </RouterLink>
    </div>
    <div class="has-router width-full block line-height-3rem text-indent-1rem">
      <RouterLink :to="{ name: 'admin-translations'}">
        {{ $t('menu.translations') }}
      </RouterLink>
    </div>
    <div class="has-router width-full block line-height-3rem text-indent-1rem">
      <RouterLink :to="{ name: 'admin-users'}">
        {{ $t('menu.users') }}
      </RouterLink>
    </div>
  </div>
</template>

<style scoped>

</style>
