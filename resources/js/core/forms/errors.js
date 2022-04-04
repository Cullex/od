class Errors {

    // @keydown='errors.clear.($event.target.name)'

    constructor()
    {
        this.errors = {};
    }

    any()
    {
        return Object.keys(this.errors).length > 0;
    }

    record(errors)
    {
        this.errors = errors;
    }

    get(field)
    {
        if (this.errors)
        if (this.errors[field])
        {
           return this.errors[field][0];
        }
        return '';
    }

    // clear(field)
    // {
    //      delete this.errors[field];
    // }

    clear()
    {
        this.errors = null;
    }

    has(field)
    {
        return !!this.errors[field];
    }

}

export  default Errors;
