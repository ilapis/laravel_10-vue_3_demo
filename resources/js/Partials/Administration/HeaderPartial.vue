<script setup>
import { useRouter } from 'vue-router';
import AuthService from '@/Services/authService.js';
import {onMounted, onUnmounted, ref} from "vue";
import { getLanguage, loadLanguage } from '@/utils.js';
import { useLanguageStore } from '@/Stores/languageStore.js';

const languageStore = new useLanguageStore();

let timerInterval;
let logoutTimer = ref('');

const router = useRouter();
const authService = new AuthService(router);

const logout = async () => {
    await authService.logout();
    //localStorage.removeItem('token');
    await router.push({name: 'admin'});
};

// Function to calculate and display the time left
const calculateTimeLeft = () => {
    const expirationTime = new Date(localStorage.getItem('token_expires_at')).getTime();
    const now = new Date().getTime();
    const difference = expirationTime - now;

    // Time calculations for days, hours, minutes and seconds
    const hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((difference % (1000 * 60)) / 1000);

    logoutTimer.value = hours + "h " + minutes + "m " + seconds + "s";

    if (difference < 0) {
        clearInterval(timerInterval);
        //logout();
    }
}

onMounted(() => {
    languageStore.fetchEnabled();
    calculateTimeLeft();
    timerInterval = setInterval(calculateTimeLeft, 1000);
});

onUnmounted(() => {
    clearInterval(timerInterval);
});

let language = ref(getLanguage());
</script>

<template>
  <div>
    <div
      class="inline float-left ml-4 bg-primary"
      style="width:200px;"
    >
      <InputSelect
        v-model="language"
        :options="languageStore.enabled"
        identifier="code"
        display="name"
        @change="loadLanguage(language)"
      />
    </div>

    <ButtonComponent
      label="logout"
      class="inline btn btn-primary float-right mr-4 mt-4"
      @click="logout"
    />
    <div class="logout-timer bg-primary inline line-height-3rem float-right mr-4 mt-4">
      {{ logoutTimer }}
    </div>
  </div>
</template>

<style scoped>

</style>
