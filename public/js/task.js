class Task {
    constructor() {
        this.getAll();
    }

    async create() {
        const title = document.getElementById("title").value.trim();
        const description = document.getElementById("description").value.trim();
        const s = document.getElementById("status");
        const valueStatus = s.value;

        if (title === '') {
            return false
        }

        if (description === '') {
            return false
        }

        if (valueStatus === 0 || valueStatus === '') {
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
            $('#modalTask').modal('hide')
            document.getElementById("taskForm").reset();

            await this.getAll();

        } catch (e) {

        }
    }

    update() {

    }

    async getAll() {
        let options = {
            "method": 'GET',
            "headers": {
                "Content-Type": "application/json",
                "Accept": "application/json",
                'X-Requested-With': 'XMLHttpRequest'
            }
        };
        let url = BASE_URL + '/task';

        try {
            let res = await fetch(url, options);
            let response = await res.json();
            // if (!res.ok) {
            //     throw new Error(`Error: ${res.status} - ${res.statusText}`);
            // }

            let html = '';
            for (const task of response.data) {
                html += "<tr>\
                            <th scope='row'>"+ task['id'] + "</th>\
                            <td>"+ task['title'] + "</td>\
                            <td>"+ task['description'] + "</td>\
                            <td>"+ task['status_id'] + "</td>\
                            <td>\
                                <button type='button' class='btn btn-success btn-sm' onclick='task.openModal(2, "+ task['id'] + ", " + JSON.stringify(task) + " )'>✏️ Editar</button>\
                                <button type='button' class='btn btn-danger btn-sm' onclick='deleteUser("+ task['id'] + ")'>🗑️ Eliminar</button>\
                            </td>\
                        </tr>";

            }

            document.getElementById('dataTable').innerHTML = html;

        } catch (e) {
            console.error('Fetch error:', e);
        }
    }

    getById() {

    }

    delete() {

    }

    openModal(action) {
        let html = "";
        switch (action) {
            case 1:
                html += "<button type='button' class='btn btn-primary' onclick='task.create(1)'>Crear Tarea</button>"
                break;
            
            case 2:
                html += "<button type='button' class='btn btn-primary' onclick='task.create(2)'>Actualizar Tarea</button>"
                break;
        
            default:
                break;
        }
         html += "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>"
        
        document.getElementById('modalFooterTask').innerHTML = html;
        $('#modalTask').modal('show')
    }

}

// Crear una instancia de la clase
const task = new Task();