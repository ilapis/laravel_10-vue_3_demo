<script setup>
import {onMounted, onUnmounted, ref, watch, watchEffect} from "vue";

const props = defineProps({
    show: {
        type: Boolean,
        default: false
    },
    actionLabel: {
        type: String,
        default: 'submit',
    },
    headTitle: {
        type: String,
        default: '',
    },
})

const emit = defineEmits(['update:show', 'update:action'])

function closeModal() {
    emit('update:action', 'cancel');
}
function action(action) {
    emit('update:action', action)
}

const modalBodyId = ref("modal_body_" + generateRandomId());
const modalId = ref("modal_" + generateRandomId());

const setModalBodyHeight = () => {
    const modal = document.getElementById(modalId.value);
    const modalBody = document.getElementById(modalBodyId.value);
    if (modal && modalBody) {
        // Check if the modal's height is too large
        let windowHeight = window.innerHeight;
        if (modal.offsetHeight > windowHeight) {
            // Reduce the modal's height to fit within the window
            let newHeight = windowHeight * 0.9;  // 90% of the window's height
            modal.style.height = newHeight + "px";

            // Reduce the modal body's height accordingly
            //let headerFooterHeight = modal.offsetHeight - modalBody.offsetHeight;
            //modalBody.style.height = (newHeight - headerFooterHeight - 0) + "px";
        }
        if (modalBody.offsetHeight > modal.offsetHeight) {
            modalBody.style.height = (modal.offsetHeight - 96 - 96) + 'px';
        }
    }
};

onMounted( () => {
    setModalBodyHeight();
    window.addEventListener('resize', setModalBodyHeight);
});

onUnmounted( () => {
    window.removeEventListener('resize', setModalBodyHeight);
});

watch(() => props.show, (newVal, oldVal) => {
    if (newVal) {
        setTimeout(setModalBodyHeight, 100);
    }
}, { immediate: false });
// Function to generate a random ID
function generateRandomId() {
    return Math.random().toString(36).substr(2, 9);
}
</script>

<template>
  <template v-if="show">
    <div class="modal-backdrop">
      <div :id="modalId" class="modal box-shadow">
        <div class="modal-header w-full">
          <slot name="header" />
          <CloseIcon
            class="modal-close-icon box-shadow"
            @click="closeModal"
          />
        </div>
        <div :id="modalBodyId" class="modal-body">
          <slot />
        </div>
        <div class="modal-footer height-12">
          <slot name="footer">
            <ButtonComponent
              label="Cancel"
              class="btn-default float-left"
              @click="action('cancel')"
            />
            <ButtonComponent
              :label="actionLabel"
              class="btn-primary float-right"
              @click="action('action')"
            />
          </slot>
        </div>
      </div>
    </div>
  </template>
</template>

<style scoped>
.modal {
    position: absolute;
    background: #ffffff;
    min-width: 480px;
    max-height:90%;
    z-index:101;
    display: block;
    flex-direction: column;
    overflow: auto;
    border-radius: 8px;
}

.modal-header {
    height: 3rem;
    padding: 1.5rem 0;
    text-indent: 0;
}
.modal-footer {
    height: 3rem;
    padding: 1.5rem;
    text-indent: 0;
    clear:both;
}
.modal-close-icon {
    float: right;
    cursor: pointer;
    border-radius: 8px;
    padding: 0.5rem;
    margin-right: 1.5rem;
    position: relative;
}
.modal-body {
    overflow-y: auto;
    overflow-x: hidden;
    flex-grow: 1;
    margin-left: 1rem;
    width: calc(100% - 4rem);
    margin-top: -2rem;
    padding: 0 1rem;
}
.modal-backdrop {
    display: flex;
    justify-content: center;
    align-items: center;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 9999;

    /* From https://css.glass */
    background: rgba(0, 0, 0, 0.55);
    border-radius: 16px;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
}
</style>
