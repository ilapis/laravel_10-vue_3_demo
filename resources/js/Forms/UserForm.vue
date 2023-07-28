<script setup>
import {onMounted, reactive, ref, watchEffect} from "vue";
import { defineProps, defineEmits } from "vue"

const props = defineProps({
    userStore: {
        type: Object,
        default: () => ({})
    },
    abilitiesStore: {
        type: Object,
        default: () => ({})
    },
    form: {
        type: Object,
        default: () => ({})
    },
})

const emit = defineEmits(['update:form'])

let localForm = ref({ ...props.form })

watchEffect(() => {
    localForm.value = { ...props.form }
})

watchEffect(() => {
    emit('update:form', localForm.value)
})

let groupedAbilities = reactive({});
let userAbilities = reactive([]);

onMounted(() => {
    // Group abilities
    for (let ability of props.abilitiesStore.collection) {
        let split = ability.name.split('_');
        if (split[split.length - 1] === 'user') {
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
    const index = localForm.value.abilities.indexOf(ability);
    if (index === -1) {
        localForm.value.abilities.push(ability);
    } else {
        localForm.value.abilities.splice(index, 1);
    }
    emit('update:form', localForm.value);
}

const isSelected = (ability) => {
    return localForm.value.abilities.includes(ability);
}
</script>

<template>
  <div style="min-width: 800px;">
    <br>
    <div class="col-6 float-left">
      <InputText
        v-model="localForm.name"
        label="Name"
        :underline-text="['&nbsp;']"
        :errors="userStore?.errors?.name"
      />

      <InputText
        v-model="localForm.email"
        label="Email"
        :underline-text="['&nbsp;']"
        :errors="userStore?.errors?.email"
      />

      <InputText
        v-model="localForm.password"
        label="Password"
        :underline-text="['&nbsp;']"
        :errors="userStore?.errors?.password"
      />

      <InputText
        v-model="localForm.password_confirmation"
        label="Password confirmation"
        :underline-text="['&nbsp;']"
        :errors="userStore?.errors?.password_confirmation"
      />
    </div>

    <div class="col-6 float-left text-indent-1rem">
      <h3>User Abilities</h3>
      <div
        v-for="ability in userAbilities"
        :key="ability.id"
        class="block ml-4"
      >
        <input
          type="checkbox"
          name="abilities[]"
          :value="ability.name"
          :checked="isSelected(ability.name)"
          @change="toggleAbility(ability.name)"
        >
        {{ ability.name }}
      </div>
      <template
        v-for="(types, type) in groupedAbilities"
        :key="type"
      >
        <h3>{{ capitalize(type) }}</h3>
        <div
          v-for="(ability, activity) in types"
          :key="ability.id"
          class="block ml-4"
        >
          <input
            type="checkbox"
            name="abilities[]"
            :value="ability.name"
            :checked="isSelected(ability.name)"
            @change="toggleAbility(ability.name)"
          >
          {{ $t('ability.' + activity) }}
        </div>
      </template>
    </div>
  </div>
</template>

<style scoped>

</style>
