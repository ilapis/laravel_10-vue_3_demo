import {ref} from 'vue';

export function useModalForm(store, actionMethod) {

    const showModal = ref(false);

    const hideModal = () => {
        showModal.value = false;
        store.errors = null;
        store.resetForm();
    }

    const openModal = (clean = false) => {
        showModal.value = true;
        store.errors = null;
        if (clean) {
            store.resetForm();
        }
    }

    const doModalAction = async (action) => {
        if (action === 'cancel') hideModal();
        if (action === 'action') {
            try {
                await actionMethod();
                if (!store?.errors) {
                    hideModal();
                }
            } catch (error) {
                console.error(error);
            }
        }
    }

    return { showModal, hideModal, openModal, doModalAction };
}
