import { ref, reactive } from 'vue';

export function useModalForm(store, initForm, actionMethod) {
    const showModal = ref(false);

    const hideModal = () => showModal.value = false;
    const openModal = () => showModal.value = true;

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
