<script setup>
import {onMounted, reactive} from "vue";

import { useUserStore } from '@/Stores/userStore.js';
import { useAbilitiesStore } from '@/Stores/abilitiesStore.js';
import InputCheckbox from "@/Components/UI/InputCheckbox.vue";
const userStore = new useUserStore();
const abilitiesStore = new useAbilitiesStore();

let localForm = userStore.getForm();
let groupedAbilities = reactive({});
let userAbilities = reactive([]);

onMounted(async () => {
    await abilitiesStore.fetchCollection();
    // Group abilities
    for (let ability of abilitiesStore.collection) {
        let split = ability.name.split('_');
        if (split[0] === 'user' || split[0] === '*') {
            userAbilities.push(ability);
        } else if (split.length === 3) {
            let type = split[2];
            let activity = split[1];

            if (!groupedAbilities[type]) {
                groupedAbilities[type] = {};
            }

            groupedAbilities[type][activity] = ability;
        } else {
            if (!groupedAbilities['other']) {
                groupedAbilities['other'] = {};
            }
            groupedAbilities['other'][ability.name] = ability;
        }
    }
});

const capitalize = (string) => {
    let capitalizedFirst = string[0].toUpperCase();
    let rest = string.slice(1);

    return capitalizedFirst + rest;
}

const toggleAbility = (ability) => {
    const index = localForm.abilities.indexOf(ability);
    if (index === -1) {
        localForm.abilities.push(ability);
    } else {
        localForm.abilities.splice(index, 1);
    }
}

const isSelected = (ability) => {
    return localForm.abilities.includes(ability);
}
</script>

<template>
  <div style="min-width: 800px;">
    <br>
    <div class="col-6 float-left">
      <InputText
        v-model="localForm.name"
        label="table.name"
        :underline-text="['&nbsp;']"
        :errors="userStore?.errors?.name"
      />

      <InputText
        v-model="localForm.email"
        label="table.email"
        :underline-text="['&nbsp;']"
        :errors="userStore?.errors?.email"
      />

      <InputText
        v-model="localForm.password"
        label="table.password"
        :underline-text="['&nbsp;']"
        :errors="userStore?.errors?.password"
      />

      <InputText
        v-model="localForm.password_confirmation"
        label="table.password_confirmation"
        :underline-text="['&nbsp;']"
        :errors="userStore?.errors?.password_confirmation"
      />
    </div>

    <div class="col-6 float-left text-indent-1rem">
      <h3>User type</h3>
      <div
        v-for="ability in userAbilities"
        :key="ability.id"
        class="block ml-4"
      >
        <InputCheckbox
          v-model="localForm.abilities[ability.name]"
          :label="ability.name"
          :checked="isSelected(ability.name)"
          @update:model-value="toggleAbility(ability.name)"
        />
      </div>
        <template v-if="!isSelected('*')">
      <template
        v-for="(types, type) in groupedAbilities"
        :key="type"
      >
        <h3>{{ capitalize(type) }}</h3>
        <div
          v-for="ability in types"
          :key="ability.id"
          class="block ml-4"
        >
          <InputCheckbox
            v-model="localForm.abilities[ability.name]"
            :label="ability.name"
            :checked="isSelected(ability.name)"
            @update:model-value="toggleAbility(ability.name)"
          />
        </div>
      </template>
        </template>
    </div>
  </div>
</template>

<style scoped>

</style>
