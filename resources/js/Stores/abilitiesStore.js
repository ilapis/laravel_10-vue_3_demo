import {defineStore} from "pinia";
import http from "@/http.js";

export const useAbilitiesStore = defineStore('abilities-store', {
    state: () => ({
        collection: null,
    }),
    actions: {

        async fetchCollection() {
            await http.get(`/api/v1/abilities`).then((response) => {
                this.collection = response.data.data;
            });
        },
    },
})
