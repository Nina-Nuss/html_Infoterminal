<<<<<<< HEAD
<?php include '../assets/links.html'; ?>
<?php include '../layout/header.php'; ?>
<?php include '../assets/scripts.html'; ?>
<html>

<body class="bg-light">

=======
<!DOCTYPE html>
<html lang="de">

</html>

<head>
    <?php include '../assets/links.html'; ?>
    <?php include '../assets/scripts.html'; ?>
    <title>Adminbereich</title>
</head>
<html>

<body class="bg-light">
    <?php include '../layout/header.php'; ?>
>>>>>>> origin/main
    <div class="container-fluid py-2">
        <div class="col-md-12 text-center pt-2">
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/layout/selectPanel.php'; ?>
        </div>
<<<<<<< HEAD
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-light text-dark border-bottom text-center">
=======
        <div class="row mt-3">
            <div class="col-12">
                <!-- <div class="card shadow-sm"> -->
                <!-- <div class="card-header bg-light text-dark border-bottom text-center">
>>>>>>> origin/main
                        <h3 class="card-title mb-0">
                            <i class="fas fa-cogs me-2"></i> Adminbereich
                        </h3>
                        <p class="mb-0 mt-2">Hier können Sie neue Infoterminals hinzufügen oder löschen</p>
<<<<<<< HEAD
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">
                                            <i class="fas fa-plus me-2"></i> Infoterminals hinzufügen
                                        </h5>
                                    </div>
                                    <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                                        <div class="alert alert-info" role="alert">
                                            <h6 class="alert-heading">
                                                <i class="fas fa-info-circle me-2"></i> Wichtige Hinweise:
                                            </h6>
                                            <ul class="mb-0">
                                                <li>Maximal 50 Infoterminals</li>
                                                <li>IP-Adresse soll dem Format "000.000.000.000" entsprechen</li>
                                                <li>Es dürfen keine Leerzeichen vorhanden sein</li>
                                                <li>Sonderzeichen sind nicht erlaubt</li>
                                            </ul>
                                        </div>

                                        <form id="formID" action="../php/bereitsVorhanden.php" method="post">
                                            <div class="form-group mb-3">
                                                <label for="infotherminalIp" class="form-label">
                                                    <i class="fas fa-network-wired me-2"></i> IP-Adresse:
                                                </label>
                                                <input class="form-control" type="text" id="infotherminalIp"
                                                    name="infotherminalIp" placeholder="z.B. 10.5.0.100" required>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="infotherminalName" class="form-label">
                                                    <i class="fas fa-tag me-2"></i> Name:
                                                </label>
                                                <input class="form-control" type="text" id="infotherminalName"
                                                    name="infotherminalName" placeholder="z.B. Terminal Empfang" required>
                                            </div>

                                            <button type="submit" class="btn btn-success shadow-sm">
                                                <i class="fas fa-plus me-2"></i> Hinzufügen
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">
                                            <i class="fas fa-trash me-2"></i> Infoterminals löschen
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group mb-3">
                                            <label for="infotherminalSelect" class="form-label">
                                                <i class="fas fa-list me-2"></i> Infoterminal auswählen:
                                            </label>
                                        </div>
                                        <div style="max-height: 300px; overflow-y: auto;">
                                            <table class="table table-hover position-relative">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>IP-Adresse</th>
                                                        <th>Name</th>
                                                        <th>Auswahl</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="deleteInfotherminal">
                                                    <!-- Infotherminal-Liste wird hier dynamisch geladen -->
                                                </tbody>
                                            </table>
                                        </div>

                                        <button type="button" class="btn btn-danger shadow-sm" onclick="Umgebung.remove_generate()">
                                            <i class="fas fa-trash me-2"></i> löschen
=======
                    </div> -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h6 class="card-title mb-0">
                                        <i class="fas fa-plus me-2"></i> Infoterminals hinzufügen
                                    </h6>
                                </div>
                                <div class="card-body position-relative" style="overflow-y: auto;">
                                    <form id="formID" action="../php/bereitsVorhanden.php" method="post">
                                        <div class="form-group mb-3">
                                            <label for="infotherminalIp" class="form-label">
                                                <i class="fas fa-network-wired me-2"></i> IP-Adresse:
                                            </label>
                                            <input class="form-control" type="text" id="infotherminalIp"
                                                name="infotherminalIp" placeholder="z.B. 10.5.0.100" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="infotherminalName" class="form-label">
                                                <i class="fas fa-tag me-2"></i> Name:
                                            </label>
                                            <input class="form-control" type="text" id="infotherminalName"
                                                name="infotherminalName" placeholder="z.B. Terminal Empfang" required>
                                        </div>
                                        <div class="center-bottom">
                                            <button type="submit" class="btn btn-success shadow-sm">
                                                <i class="fas fa-plus me-2"></i> Hinzufügen
                                            </button>
                                            <button type="button" data-bs-placement="top"
                                                class="btn btn-lg btn-secondary" style="width: 40px;"
                                                data-bs-toggle="popover" title="Popover title"
                                                data-bs-content="IP-Adresse soll dem Format 000.000.000.000 entsprechen">i</button>
                                            <script>
                                                document.querySelectorAll('[data-bs-toggle="popover"]').forEach(function (el) {
                                                    new bootstrap.Popover(el, { trigger: 'hover', html: true, placement: el.getAttribute('data-bs-placement') || 'top' });
                                                });
                                            </script>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h6 class="card-title mb-0">
                                        <i class="fas fa-trash me-2"></i> Infoterminals löschen
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label for="infotherminalSelect" class="form-label">
                                            <i class="fas fa-list me-2"></i> Infoterminal auswählen:
                                        </label>
                                    </div>
                                    <div style="max-height: 300px; overflow-y: auto;">
                                        <table class="table table-hover position-relative">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>IP-Adresse</th>
                                                    <th>Name</th>
                                                    <th>Auswahl</th>
                                                </tr>
                                            </thead>
                                            <tbody id="deleteInfotherminal" style="height: 250px; overflow-y: auto;">
                                            </tbody>
                                            <!-- Infotherminal-Liste wird hier dynamisch geladen -->
                                            </tbody>
                                        </table>
                                    </div>

                                    <button type="button" class="btn btn-danger shadow-sm d-flex justify-content-center"
                                        onclick="Infoterminal.remove_generate()">
                                        <i class="fas fa-trash me-2"></i> löschen
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h6 class="card-title mb-0">
                                        <i class="fas fa-cogs me-2"></i> Einstellungen
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <!-- <div class="form-group mb-3">
                                        <label for="refreshSelect" class="form-label">
                                            <i class="fas fa-clock me-2"></i> Refresh-Zeit:
                                        </label>
                                        <select id="refreshSelect" class="form-select" style="padding: 5px;">
                                            <!-- Optionen werden per JS aus config.json befüllt -->
                                    <!-- </select> -->
                                    <!-- </div> -->
                                    <div class="form-group mb-3">
                                        <label for="cardCounterLimit" class="form-label">
                                            <i class="fas fa-hashtag me-2"></i> Infoterminal-Limit:
                                        </label>
                                        <select id="cardCounterLimit" class="form-select" style="padding: 5px;">
                                            <!-- Optionen werden per JS aus config.json befüllt -->
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="infoCounterLimit" class="form-label">
                                            <i class="fas fa-hashtag me-2"></i> Infoseiten-Limit:
                                        </label>
                                        <select id="infoCounterLimit" class="form-select" style="padding: 5px;">
                                            <!-- Optionen werden per JS aus config.json befüllt -->
                                        </select>
                                    </div>
                                    <div class="form-group mb-3 center-bottom">
                                        <button type="button" class="btn btn-danger"
                                            onclick="bereinigeDatenbankUndFolder()">
                                            <i class="fas fa-broom me-2"></i></i> Daten bereinigen
>>>>>>> origin/main
                                        </button>
                                    </div>
                                </div>
                            </div>
<<<<<<< HEAD
                            <div class="col-md-2">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">
                                            <i class="fas fa-cogs me-2"></i> Einstellungen
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group mb-3">
                                            <label for="refreshSelect" class="form-label">
                                                <i class="fas fa-clock me-2"></i> Refresh-Zeit:
                                            </label>
                                            <select id="refreshSelect" class="form-select" style="padding: 5px;">
                                                <!-- Optionen werden per JS aus config.json befüllt -->
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="cardCounterLimit" class="form-label">
                                                <i class="fas fa-hashtag me-2"></i> Infoterminal-Limit:
                                            </label>
                                            <select id="cardCounterLimit" class="form-select" style="padding: 5px;">
                                                <!-- Optionen werden per JS aus config.json befüllt -->
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="infoCounterLimit" class="form-label">
                                                <i class="fas fa-hashtag me-2"></i> Infoseiten-Limit:
                                            </label>
                                            <select id="infoCounterLimit" class="form-select" style="padding: 5px;">
                                                <!-- Optionen werden per JS aus config.json befüllt -->
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
=======
                        </div>
                    </div>

                </div>
                <!-- </div> -->
>>>>>>> origin/main
            </div>
        </div>
    </div>
    </div>
<<<<<<< HEAD

=======
>>>>>>> origin/main
    <!-- Bootstrap JS -->

</body>

</html>