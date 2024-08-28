<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include './app/resources/template.php';
    ?>
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/task.css" crossorigin="anonymous">
    <script src="<?= BASE_URL ?>/public/js/task.js"></script>
    
    <title>Lista de Tareas</title>
</head>

<body>

    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Lista de Tareas</a>

        <div class="form-inline my-2 my-lg-0">

            <span class="navbar-text">
                👤 <?= $_SESSION['username'] ?>
            </span>
            <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Cerrar Sesión</button>
        </div>
    </nav>

    <br><br>

    <div class="container">
        <div class="row">
            <button type="button" class="btn btn-success" onclick="task.openModal(1)">➕ Crear Nueva Terea</button>
        </div>
        <br><br>
        <div class="row">

            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody id="dataTable">
                </tbody>
            </table>

            <div id="messageTable" style="width: 100%; text-align: center;"></div>

        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalTask" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title" id="exampleModalLongTitle">Nueva Tarea</h5>
                    <button type="button" class="close" onclick="task.closeModal()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="taskForm">

                        <label for="title">Titulo</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">@</div>
                            </div>
                            <input type="text" class="form-control" id="title"
                                placeholder="Titulo">
                        </div>

                        <label for="description">Descripción</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">@</div>
                            </div>
                            <input type="text" class="form-control" id="description"
                                placeholder="Descripción">
                        </div>

                        <label for="status">Descripción</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="status">@</label>
                            </div>
                            <select class="custom-select" id="status">
                                <option value="0" selected>Estado</option>
                                <option value="1">Pendiente</option>
                                <option value="2">En progresowo</option>
                                <option value="3">Completada</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer" id="modalFooterTask">
                </div>
            </div>
        </div>
    </div>

</body>

</html>