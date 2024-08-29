class Task {
    constructor(url) {
        this.url = url;
        this.getAll();
        this.getStatus();
    }

    async create() {
        const title = document.getElementById("title").value.trim();
        const description = document.getElementById("description").value.trim();
        const s = document.getElementById("status");
        const valueStatus = parseInt(s.value);

        if (title === '') {
            document.getElementById("title").focus();
            return false
        }

        if (description === '') {
            document.getElementById("description").focus();
            return false
        }

        if (valueStatus === 0 || valueStatus === '' || valueStatus === null) {
            console.log('ok2')
            document.getElementById("status").focus();
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

        try {
            let res = await fetch(this.url, options);
            let response = await res.json();
            this.closeModal()
            await this.getAll();

        } catch (e) {

        }
    }


    async update(taskId) {
        const title = document.getElementById("title").value.trim();
        const description = document.getElementById("description").value.trim();
        const s = document.getElementById("status");
        const valueStatus = parseInt(s.value);

        if (title === '') {
            return false
        }

        if (description === '') {
            return false
        }

        if (valueStatus === 0 || valueStatus === '' || valueStatus === null) {

            return false
        }

        let data = {
            'taskId': taskId,
            'title': title,
            'description': description,
            'statusId': valueStatus,
        }

        let options = {
            "method": 'PATCH',
            "headers": {
                "Content-Type": "application/json",
                "accept": "application/json",
            },
            "body": JSON.stringify(data)
        };

        try {
            let res = await fetch(this.url, options);
            let response = await res.json();
            this.closeModal();
            await this.getAll();

        } catch (e) {
            console.log(e)
        }


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

        try {
            let res = await fetch(this.url, options);
            let response = await res.json();

            if (!res.ok) {
                throw new Error(`Error: ${res.status} - ${res.statusText}`);
            }
            let html = '';
            if (response.data.length === 0) {

                html = '<div class="alert alert-secondary" role="alert" style="width: 100%">\
                                No ninguna tarea en el sistema, añade un registro\
                            </div>';
                document.getElementById('messageTable').innerHTML = html
                document.getElementById('dataTable').innerHTML = '';
                return false
            }

            for (const task of response.data) {
                html += `<tr>\
                            <th scope='row'>${task['id']}</th>\
                            <td>${task['title']}</td>\
                            <td>${task['description']}</td>\
                            <td>${task['status']['name']}</td>\
                            <td>\
                                <button type='button' class='btn btn-success btn-sm' onclick='task.getById(${task['id']})'>✏️ Editar</button>\
                                <button type='button' class='btn btn-danger btn-sm' onclick='task.delete(${task['id']})'>🗑️ Eliminar</button>\
                            </td>\
                        </tr>`;

            }

            document.getElementById('dataTable').innerHTML = html;
            document.getElementById('messageTable').innerHTML = ''

        } catch (e) {
            console.error('Fetch error:', e);
        }
    }

    async getById(taskId) {
        let options = {
            "method": 'GET',
            "headers": {
                "Content-Type": "application/json",
                "Accept": "application/json",
                'X-Requested-With': 'XMLHttpRequest'
            }
        };
        let url = this.url + `?id=${taskId}`;

        try {
            let res = await fetch(url, options);
            let response = await res.json();
            document.getElementById("title").value = response.data.title;
            document.getElementById("description").value = response.data.description;
            document.getElementById("status").value = response.data.status.id;
        } catch (e) {
            console.log(e)
        }
        this.openModal(2, taskId)
    }

    async delete(taskId) {
        let options = {
            "method": 'DELETE',
            "headers": {
                "Content-Type": "application/json",
            }
        };
        let url = this.url + `?id=${taskId}`;
        try {
            let res = await fetch(url, options);
            if (res.ok) {
                console.log('Recurso eliminado exitosamente.');
                await this.getAll();
            }

        } catch (e) {
            console.log(e)
        }

    }

    openModal(action, taskId) {
        let html = "";
        switch (action) {
            case 1:
                html += `<button type='button' class='btn btn-primary' onclick='task.create()'>Crear Tarea</button>`
                break;

            case 2:
                html += `<button type='button' class='btn btn-primary' onclick='task.update(${taskId})'>Actualizar Tarea</button>`
                break;

            default:
                break;
        }
        html += "<button type='button' class='btn btn-secondary' onclick='task.closeModal()'>Cancelar</button>"

        document.getElementById('modalFooterTask').innerHTML = html;
        $('#modalTask').modal('show')
    }


    closeModal() {
        $('#modalTask').modal('hide')
        document.getElementById("taskForm").reset();
    }


    async getStatus() {
        let options = {
            "method": 'GET',
            "headers": {
                "Content-Type": "application/json",
                "Accept": "application/json",
                'X-Requested-With': 'XMLHttpRequest'
            }
        };
        let url = `${BASE_URL}/status`;
        try {
            let res = await fetch(url, options);
            let response = await res.json();
            const select = document.getElementById('status');
            select.innerHTML = '';
            select.appendChild(new Option('Selecciona una opción', ''));
            response.data.forEach(item => {
                const option = new Option(item.name, item.id);
                select.add(option);
            });

        } catch (e) {
            console.log(e)
        }
    }
}


// Crear una instancia de la clase
const task = new Task(`${BASE_URL}/task`);