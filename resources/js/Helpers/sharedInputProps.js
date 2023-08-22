export const sharedInputProps = {
    label: {
        type: String,
        default: '',
    },
    placeholder: {
        type: String,
        default: '',
    },
    underlineText: {
        type: Array,
        default: [''],
    },
    errors: {
        type: Array,
        default: null,
    },
    modelValue: {
        default: null,
    },
    type: {
        default: 'text',
    },
    value: {
        default: null,
    },
    options: {
        default: null,
    },
    identifier: {
        default: null,
    },
    display: {
        type: String,
    },
    checked: {
        type: Boolean,
        default: false,
    },
    validateWithDryRequest: {
        type: Boolean,
        default: false,
    },
};
