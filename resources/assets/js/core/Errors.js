class Errors {
    /**
     * Create new errors instance.
     */
    constructor() {
        this.errors = {};
    }


    /**
     * Determine if an error exists for a given field.
     *
     * @param {string}  field
     */
    has(field){
        return this.errors.hasOwnProperty(field);
    }


    /**
     * Determine if any error exists.
     */
    any(){
        return _.size(this.errors) > 0;
    }


    /**
     * Retrieve the first error message found.
     *
     * @param {string} field
     */
    first(){
        if(this.any()){
            return this.get(Object.keys(this.errors)[0])
        }
    }


    /**
     * Retrieve the error message for a field.
     *
     * @param {string} field
     */
    get(key){
        if(this.has(key)){
            return this.errors[key][0];
        }
    }


    /**
     * Retrieve all error messages.
     *
     * @param {string} field
     */
    all(){
        return this.errors;
    }


    /**
     * Record new errors.
     *
     * @param {object} errors
     */
    record(errors) {
        this.errors = errors;
    }


    /**
     * Clear one or all error fields.
     *
     * @param {string} field
     */
    clear(field) {
        if (field) {
            delete this.errors[field];

            return;
        }

        this.errors = {};
    }
}

export default Errors;
