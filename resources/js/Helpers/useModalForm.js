import {ref} from 'vue';

export function useModalForm(store, initForm, actionMethod) {
    const showModal = ref(false);

    const hideModal = () => {
        showModal.value = false;
        store.errors = null;
        store.resetForm();
    }
    const openModal = () => {
        showModal.value = true;
        store.errors = null;
    }

    const doModalAction = async (action) => {
        if (action === 'cancel') hideModal();
        if (action === 'action') {
            try {
                await actionMethod(initForm);
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
