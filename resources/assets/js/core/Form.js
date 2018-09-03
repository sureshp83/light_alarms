import Errors from './Errors';

class Form {
    /**
     * Create new form instance.
     *
     * @param {object} data
     */
    constructor(data, fileUpload = false) {
        this.originalData = data;
        this._fileUpload  = fileUpload

        for (let field in data) {
            this[field] = data[field];
        }

        this.errors = new Errors();
        this.busy = false
    }


    /**
     * Fetch all form data.
     */
    data() {
        let data = this._fileUpload ? new FormData() : {};

        for (let key in this.originalData) {
            if (this._fileUpload) {
                data.append(key, this[key]);
            } else {
                data[key] = this[key];
            }
        }

        return data;
    }


    /**
     * Reset the form fields.
     */
    reset() {
        for (let field in this.originalData) {
            this[field] = '';
        }

        this.errors.clear();
    }


    /**
     * Submit form using POST.
     *
     * @param  {string} url
     */
    post(url) {
        return this.submit('post', url);
    }


    /**
     * Submit form using DELETE.
     *
     * @param  {string} url
     */
    delete(url) {
        return this.submit('delete', url);
    }


    /**
     * Submit new form.
     *
     * @param  {string} requestType
     * @param  {string} url
     */
    submit(requestType, url) {
        if (this.busy) return

        this.busy = true

        return new Promise((resolve, reject) => {
            axios[requestType](url, this.data())
                .then(res => {
                    let _data = res.data
                    if (_data.hasOwnProperty('errors')) {
                        this.onFail(_data);
                        reject(_data);
                    } else {
                        this.onSuccess(_data);
                        resolve(_data);
                    }
                })
                .catch(error => {
                    this.onFail(error.response.data);
                    reject(error.response.data);
                })
                .finally(() => this.busy = false);
        });
    }


    /**
     * Handle successfully form submission.
     *
     * @param  {object} data
     */
    onSuccess(data) {
        this.errors.clear();

        this.reset();
    }


    /**
     * Handle failed form submission.
     *
     * @param  {object} errors
     */
    onFail(data) {
        this.errors.record(data.errors);
    }
}

export default Form;
