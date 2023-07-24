<script setup>
const props = defineProps({
    show: Boolean,
    actionLabel: String,
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
            <div class="modal box-shadow">
                <div class="modal-header w-full">
                    <slot name="header"></slot>
                    <CloseIcon class="modal-close-icon" @click="closeModal" />
                </div>
                <div class="modal-body">
                    <slot></slot>
                </div>
                <div class="modal-footer height-12">
                    <slot name="footer">
                        <ButtonComponent label="Cancel" class="btn-default float-left" @click="action('cancel')" />
                        <ButtonComponent :label="actionLabel" class="btn-primary float-right" @click="action('action')" />
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
    z-index:101;
    display: block;
    flex-direction: column;
    overflow: hidden;
}

.modal-header {
    padding: 1.5rem 0;
    text-indent: 0;
}
.modal-footer {
    padding: 1.5rem;
    text-indent: 0;
}
.modal-close-icon {
    float: right;
    margin-right: 1rem;
    cursor: pointer;
}
.modal-body {
    flex-grow: 1;
    padding: 0 1.5em; /* Adjust this value as needed */
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
