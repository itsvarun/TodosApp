class Errors {

    constructor() {
        this.errors = {}
    }

    record(errors) {
        this.errors = errors
    }

    has(field) {
        return this.errors.hasOwnProperty(field);
    }

    get(field) {
        if (this.has(field)) {
            return this.errors[field][0];
        }
    }

    any() {
        return Object.keys(this.errors).length > 0;
    }

    clear(field) {
        if (field) delete this.errors[field]
        else this.errors = {}
    }
}

export default Errors
