export default (userOptions = {}, userInitOptions = () => {
}) => ({
    id: userOptions.id,
    name: userOptions.name,
    old: userOptions.value ?? '',
    value: userOptions.value ?? '',
    text: userOptions.text ?? userInitOptions.value ?? '',
    isEditing: false,
    toggle(value = false) {
        if (!value)
            this.value = this.old;
        this.isEditing = value;
    },
    submit() {
        window.axios.put(`${window.location.href}/${this.id}`, {
            [this.name]: this.value
        }, {
            headers: {
                'X-TYPE': 'inline',
                'Content-Type': 'application/json'
            }
        }).then(response => {
            window.Toast.fire({
                icon: 'success',
                title: response.data.success
            })
            window.dispatchEvent(new CustomEvent('refresh-datatable', {detail: true}))
        }).catch(err => {
            this.value = this.old;
            window.Toast.fire({
                icon: 'error',
                title: err.response.data.message
            })
        }).finally(() => {
            this.isEditing = false;
        })
    }
});
