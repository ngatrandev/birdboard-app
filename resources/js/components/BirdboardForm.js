class BirdboardForm {
    constructor(data) {
        this.originalData = JSON.parse(JSON.stringify(data));
        //để originalData là obj như data nhưng không chứa bất kì value nào
        // có đầy đủ các attribute như default

        Object.assign(this, data);
        //dùng assign thay cho cách viết this.title = title...

        this.errors = {};
        this.submitted = false;
    }

    data() {
        return Object.keys(this.originalData).reduce((data, attribute)=>{
            data[attribute] = this[attribute];

            return data;
        }, {});
    }

    post(endpoint) {
        return this.submit(endpoint);
    }


    patch(endpoint) {
        return this.submit(endpoint, 'patch');
    }

    delete(endpoint) {
        return this.submit(endpoint, 'delete');
    }

    submit(endpoint, requestType="post") {
        //endpoint ứng với /projects bên NewProjectModal.vue
        return axios[requestType](endpoint, this.data())
                    .catch(this.onFail.bind(this))
                    .then(this.onSuccess.bind(this));
    }

    onSuccess(response) {
        this.submitted = true;
        this.errors = {};

        return response;
    }

    onFail(error) {
        this.errors = error.response.data.errors;

        
        this.submitted = false;

        throw error;
    }

    reset() {
        //trả data về default
        Object.assign(this, this.originalData);
    }
}

export default BirdboardForm;