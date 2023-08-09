export const sharedInputProps = {
    label: {
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
