import Errors from './Errors.js'

class Form {
    constructor(fields) {
        this.fields = Object.keys(fields)
        this.forEveryField(field => {
            this[field] = fields[field]
        })

        this.errors = new Errors()
    }

    forEveryField(callback)  {
        this.fields.forEach(field => {
            callback(field)
        })
    }

    data() {
        let data = {}
        this.forEveryField(field => {
            data[field] = this[field];
        })
        return data
    }

    submit(method, url) {
        return new Promise((reslove, reject) => {
            axios[method](url, this.data())
            .then(response => {
                this.onSuccess()
                reslove(response.data)
            })
            .catch(error => {
                const errors = error.response.data.errors
                reject(errors)
                this.onFail(errors)
            })
        })
    }

    onSuccess() {
        this.reset()
    }

    onFail(errors) {
        this.errors.record(errors)
    }

    reset() {
        this.forEveryField(field => {
            this[field] = ''
        })
        this.errors.clear()
    }
}

export default Form
