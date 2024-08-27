class Task {
    constructor() {}

    async create(){
        const title = document.getElementById("title").value.trim();
        const description = document.getElementById("description").value.trim();
        const s = document.getElementById("status");
        const valueStatus = s.value;

        if(title === ''){
            return false
        }

        if(description === ''){
            return false
        }

        if(valueStatus === 0 || valueStatus === ''){
            return false
        }

        let data = {
            'title': title,
            'description': description,
            'statusId': valueStatus,
        }

        let options = {
            "method": 'POST',
            "headers": {
                "Content-Type": "application/json",
                "accept": "application/json",
            },
            "body": JSON.stringify(data)
        };

        let url = BASE_URL + '/task';

        console.log(valueStatus)

        try {
            let res = await fetch(url, options);
            let response = await res.json();

        } catch (e) {

        }
    }

    update(){

    }

    get(){

    }

    getById(){

    }

    delete(){

    }

    openModal(){
        $('#modalTask').modal('show')
    }

    clearInputs(){
        this.getElementById("")
    }
}

// Crear una instancia de la clase
const task = new Task();