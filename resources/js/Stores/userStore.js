import {defineStore} from "pinia";
import http from "@/http.js";
import {formMethods} from '@/Helpers/formMethods.js';
import {fetchCollections} from '@/Helpers/fetchCollections.js';
import {apiState} from '@/Helpers/apiState.js';
import {modalCrud} from '@/Helpers/modalCrud.js';

export const useUserStore = defineStore('user-store', {
    state: () => ({
        ...apiState,
        _api_endpoint: '/api/v1/user',
    }),
    actions: {

        ...formMethods,
        ...fetchCollections,
        ...modalCrud,

        async fetchEnabled() {
            await http.get(`/api/v1/user/enabled`).then((response) => {
                this.enabled = response.data.data;
            });
        },
    },
})
