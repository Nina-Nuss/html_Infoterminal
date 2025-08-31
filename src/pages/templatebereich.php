<?php include  '../assets/links.html'; ?>
<?php include  '../layout/header.php'; ?>
<?php include  '../assets/scripts.html'; ?>


<body class="bg-light">
    <div class="container-fluid py-2">
        <div class="row ">
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/layout/sidebar.php'; ?>
            <div class="col-10 ">
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/layout/selectPanel.php'; ?>
                <div class="pt-3"></div>
                <div class="card  shadow-sm text-center ">
                    <div class="card-header bg-light text-dark border-bottom">
                        <h3 class="card-title mb-0">
                            <i class="fas fa-layer-group me-2"></i> Infoseiten-Neuauflage/Löschen
                        </h3>
                        <p class="mb-0 mt-2">Hier können Sie neue Infoseiten erstellen und oder löschen</p>
                    </div>
                    <div class="card-body" style="max-height: calc(90vh - 120px); overflow-y: auto;">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h6 class="card-title mb-0">
                                            <i class="fas fa-plus me-2"></i> Infoseiten NEU erstellen
                                        </h6>
                                    </div>
                                    <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                                       

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h6 class="card-title mb-0">
                                            <i class="fas fa-trash me-2"></i> Infoseiten LÖSCHEN
                                        </h6>
                                    </div>
                                    <div class="card-body" id="cardBodyForDelSchema">
                                        <div class="form-group mb-3">
                                            <label for="schemaSelect" class="form-label">
                                                <div class="fas fa-list me-2"></div> Schema auswählen:
                                            </label>

                                        </div>

                                        <div style="max-height: 300px; overflow-y: auto;">
                                            <table class="table table-hover position-relative">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Titel</th>
                                                        <th>Beschreibung</th>
                                                        <th>Auswahl</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="deleteSchema">

                                                </tbody>
                                            </table>
                                        </div>

                                        <button type="button" class="btn btn-danger shadow-sm" id="deleteBtnForSchemas" onclick="Infoseite.remove_generate()">
                                            <i class="fas fa-trash me-2"></i> löschen
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </bo>

    <script>

    </script>

    </html>