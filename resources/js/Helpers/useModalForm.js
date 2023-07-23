import { ref, reactive } from 'vue';

export function useModalForm(store, initForm, actionMethod) {
    const showModal = ref(false);
    //let form = reactive(initForm);

    const hideModal = () => showModal.value = false;
    const openModal = () => showModal.value = true;

    const doModalAction = async (action) => {
        if (action === 'cancel') hideModal();
        if (action === 'action') {
            try {
                await actionMethod(initForm);
                //await actionMethod(form);
                if (!store?.errors) {
                    hideModal();
                }
            } catch (error) {
                console.error(error);
            }
        }
    }

    return { showModal, hideModal, openModal, doModalAction };
    //return { showModal, initForm, hideModal, openModal, doModalAction };
    //return { showModal, form, hideModal, openModal, doModalAction };
}
