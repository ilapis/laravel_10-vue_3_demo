<script setup>
import {onMounted, reactive} from "vue";

const props = defineProps({
    userStore: Object,
    abilitiesStore: Object,
    form: Object,
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
    const index = props.form.abilities.indexOf(ability);
    if (index === -1) {
        props.form.abilities.push(ability);
    } else {
        props.form.abilities.splice(index, 1);
    }
}

const isSelected = (ability) => {
    return props.form.abilities.includes(ability);
}
</script>

<template>
        <div style="min-width: 800px;">
            <br/>
            <div class="col-6 float-left">
            <InputText
                label="Name"
                :underlineText="['&nbsp;']"
                :errors="userStore?.errors?.name"
                v-model="form.name"
            />

            <InputText
                label="Email"
                :underlineText="['&nbsp;']"
                :errors="userStore?.errors?.email"
                v-model="form.email"
            />

            <InputText
                label="Password"
                :underlineText="['&nbsp;']"
                :errors="userStore?.errors?.password"
                v-model="form.password"
            />

            <InputText
                label="Password confirmation"
                :underlineText="['&nbsp;']"
                :errors="userStore?.errors?.password_confirmation"
                v-model="form.password_confirmation"
            />
            </div>
            <div class="col-6 float-left text-indent-1rem">
                <h3>User Abilities</h3>
                <div v-for="ability in userAbilities" v-bind:key="ability.id" class="block ml-4">
                    <input type="checkbox" name="abilities[]" :value="ability.name" :checked="isSelected(ability.name)" @change="toggleAbility(ability.name)" />
                    {{ability.name}}
                </div>
                <template v-for="(types, type) in groupedAbilities" v-bind:key="type">
                    <h3>{{capitalize(type)}}</h3>
                    <div v-for="(ability, activity) in types" v-bind:key="ability.id" class="block ml-4">
                        <input type="checkbox" name="abilities[]" :value="ability.name" :checked="isSelected(ability.name)" @change="toggleAbility(ability.name)" />
                        {{$t('ability.' + activity)}}
                    </div>
                </template>
            </div>
        </div>
</template>

<style scoped>

</style>
