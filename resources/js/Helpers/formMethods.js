export const formMethods = {
    setForm(form) {
        this._form = form;
        this._form_deep_copy = JSON.parse(JSON.stringify(form));
    },

    updateForm(form) {
        if (form) {
            this._form = form;
        }
    },

    getForm() {
        return this._form;
    },

    resetForm() {
        this._form = JSON.parse(JSON.stringify(this._form_deep_copy));
    },

    hasErrors() {
        return this.errors && Object.keys(this.errors).length > 0;
    },

    clearErrors() {
        return this.errors = {};
    },
}
