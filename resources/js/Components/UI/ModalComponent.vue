<script setup>
const props = defineProps({
    show: Boolean,
    headTitle: String,
})

const emit = defineEmits(['update:show', 'update:action'])

function closeModal() {
    emit('update:show', false)
}
function action(action) {
    emit('update:action', action)
}
</script>

<template>
    <template v-if="show">
        <div class="modal-backdrop">
            <div class="modal box-shadow-2">
                <div class="modal-header w-full">
                    <slot name="header"></slot>
                    <CloseIcon class="modal-close-icon" @click="closeModal" />
                </div>
                <div class="modal-body">
                    <slot></slot>
                </div>
                <div class="modal-footer height-12">
                    <slot name="footer">
                        <Button label="cancel" type="btn-default" @click="action('cancel')" />
                        <Button label="ok" class="float-right" @click="action('action')" />
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
    max-width: 100%;
    max-height: 400px;
    z-index:101;
    /* Your modal styles here */
    display: flex;
    flex-direction: column;
    /*max-height: 80vh; /* Adjust this value as needed */
    overflow: hidden;
}
.modal-header, .modal-footer {
    padding: 1rem;
}
.modal-close-icon {
    float: right;
    margin-right: 2rem;
    cursor: pointer;
}
.modal-body {
    flex-grow: 1;
    overflow: auto;
    padding: 0 1em; /* Adjust this value as needed */
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
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 9999;
}
</style>
