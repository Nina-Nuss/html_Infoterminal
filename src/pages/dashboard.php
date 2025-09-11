<?php
include '../php/noCache.php';
include '../php/auth.php';

?>
<?php
// if (isset($_COOKIE['username'])) {
//     $username = $_COOKIE['username'];
//     echo 'Hallo ' . htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
// } else {
//     echo 'Kein Cookie vorhanden';
// }
// echo '<br>';
// echo $_SESSION['login_success'];
?>

<!DOCTYPE ht
    <html lang="de">

<head>
    <?php include '../assets/links.html'; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>


<body>
    <?php include '../layout/header.php'; ?>

    <?php include '../layout/modal/hinzufuegen.html'; ?>
    <?php include '../layout/modal/addInfoSeite.html'; ?>
    <div class="container-fluid pt-3">
        <div class="row" style="height:90vh;">
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/layout/sidebar.php'; ?>
            <div class="col-md-10 text-center">
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/layout/selectPanel.php'; ?>
                <hr>
                <div class="row justify-content-center">
                    <div class="col-md-10 pb-2">
                        <div class="col-md-8 flex-wrap">
                            <button id="btn_save_changes" type="button" onclick="Infoseite.saveChanges(null)"
                                class="btn btn-success btn-sm me-2">
                                <i class="fas fa-save"></i> Speichern
                            </button>
                            <!--  -->
                            <button id="btn_addInfoSeite" type="button" class="btn btn-success btn-sm me-2"
                                data-bs-toggle="modal" data-bs-target="#addInfoSeite">
                                <i class="fas fa-pen-to-square"></i> Erstellen
                            </button>
                            <button id="btn_deleteInfoSeite" onclick="Infoseite.deleteCardObj()" type="button"
                                class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> Löschen
                            </button>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center gap-2 col-md-12">
                        <div class="col-md-7">
                            <div id="konfigContainer">
                                <div class="card">
                                    <div class="card-header p-2">
                                        <h6 class="mb-0"><i class="fas fa-cog me-2 font-bold"></i> Infoseite konfigurieren
                                    </div>
                                    <div class="d-flex justify-content-around">
                                        <div class="p-3" style="width: 18rem;">
                                            <div class="form-group mt-0">
                                                <div class="d-flex align-items-center justify-content-between mb-3">
                                                    <i class="fas fa-file-alt me-2"></i>
                                                    <div class="mb-0 me-auto">Infoseite Name:
                                                    </div>
                                                    <div type="text" class="w-auto fw-bolder" id="websiteName" value="-">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="d-flex flex-wrap align-items-center  justify-content-start mb-2 ">
                                                    <i class="fas fa-hourglass-half"></i>
                                                    <!-- Uhr-Icon für Sekunden -->
                                                    <div for="anzeigeDauer" class="mb-0 ms-2">
                                                        Sekunden:</div>
                                                    <input type="text" id="selectSekunden"
                                                        class="form-control form-control-sm ms-2 me-auto" maxlength="4"
                                                        style="width: 50px;">
                                                    <div class="fw-bolder w-auto" id="anzeigeDauer"></div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-start gap-2 ">
                                                    <label class="form-check-label mb-0" for="checkA">
                                                        Aktiv:
                                                    </label>

                                                    <input class="form-check-input" type="checkbox" id="checkA"
                                                        name="checkA">
                                                </div>

                                            </div>
                                        </div>
                                      
                                        <div class="p-3" style="width: 32rem;  overflow-y: auto;">
                                            <div id="panelForDateTime" class="w-100">
                                                <div id="dateTimeInfoPanel ">
                                                    <div class="d-flex align-items-center mb-3">
                                                        <div class="d-flex  align-items-center">
                                                            <i class="fas text-dark  fa-calendar-alt me-2"></i>
                                                            <span>Datum:</span>
                                                            <div class="d-flex align-items-center ms-4">
                                                                <input type="date" class="form-control form-control-sm" style="width: 9rem; "
                                                                    id="startDate" name="startDate">
                                                            </div>
                                                        </div>

                                                        <div class="d-flex align-items-center justify-content-between ms-auto">
                                                            <label for="endDate"
                                                                class="form-label mb-0 text-secondary mx-2">bis</label>
                                                            <input type="date"
                                                                class="form-control form-control-sm"  style="width: 9rem; "
                                                                id="endDate" name="endDate">
                                                            <button id="btnDelDateTime"
                                                                class="btn btn-outline-danger trashbtn btn-sm ms-3"
                                                                onclick="Infoseite.deleteDateTimeRange(Infoseite.selectedID)">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <!-- Uhrzeit -->
                                                    <div class="d-flex align-items-center">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fa fa-clock text-dark me-2" aria-hidden="true"></i>
                                                            <span style="margin-right: 0.5rem;">Uhrzeit:</span>

                                                            <input type="time"
                                                                class="form-control form-control-sm flex-fill mx-2" style="width: 6rem;"
                                                                id="startTimeRange" name="startTimeRange">
                                                            <label for="endTimeRange"
                                                                class="form-label mb-0 me-2 text-secondary">Uhr</label>
                                                        </div>
                                                        <div class="d-flex align-items-center ms-auto">
                                                            <label for="endTimeRange"
                                                                class="form-label mb-0 me-2 text-secondary"
                                                                style="width: auto;">bis</label>
                                                            <input type="time" style="width: 6rem;"
                                                                class="form-control form-control-sm flex-fill"
                                                                id="endTimeRange" name="endTimeRange">
                                                            <label for="endTimeRange"
                                                                class="form-label mb-0 text-secondary me-3 mx-2"> Uhr</label>
                                                            <button id="delTimeRange"
                                                                class="btn btn-outline-danger trashBtn me-auto ms-3"
                                                                onclick="Infoseite.removeTimeRange(Infoseite.selectedID)">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-group mt-3">
                                                    <div class="d-flex align-items-center">
                                                        <label for="openTerminalBtn" class="form-label ">
                                                            <i class="fas fa-desktop mb-0 me-2"></i>Anzeige:
                                                        </label>
                                                        <select class="form-control form-select-sm" style="width: 7vw; margin-left: 0.5rem;"
                                                            id="infotherminalSelect">
                                                            <option value="">auswählen</option>
                                                        </select>
                                                        <button id="openTerminalBtn"
                                                            class="btn text-dark start-btn btn-sm trashBtn "
                                                            style="border-color: #08445f;  background-color: rgba(255, 255, 255, 0.952); width: 2vw;">
                                                            <i class="fas fa-external-link-alt"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div id="zeitspannePanel"
                                                    class="border rounded-3 shadow-sm p-3 bg-light"
                                                    style="display:none;">
                                                    <div class="row d-flex g-2">
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center" style="margin-left: 1rem;">
                                                            </div>
                                                        </div>

                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center" style="margin-left: 1rem;">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row ">
                                                        <div class="col-12 mt-2">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="uhrzeitPanel" class="border rounded-3 shadow-sm p-3 bg-light"
                                                    style="display:none;">
                                                    <div class="row g-2 justify-content-center">
                                                        <div class="col-6 d-flex align-items-center">

                                                        </div>
                                                        <div class="col-6 d-flex align-items-center">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-3" id="bildschirmVerwaltung">
                            <div class="card h-100">
                                <div class="card-header  p-2">
                                    <h6 class="mb-0"><i class="fas fa-tv me-2"></i>Bildschirm verwalten</h6>
                                </div>
                                <div class="card-body d-flex">
                                    <div class="d-flex flex-column justify-content-center  align-content-center gap-2 me-3" style="height: 120px;">
                                        <button id="btn_hinzufuegen" type="button" data-bs-toggle="modal"
                                            data-bs-target="#modal_hinzufuegen"
                                            class="btn btn-success align-items-stretch m-0 würfelbtn">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                        <button id="btn_loeschen" type="button"
                                            class="btn btn-danger align-items-stretch m-0 würfelbtn"
                                            onclick="Beziehungen.remove_generate(Infoseite.selectedID, Beziehungen.temp_list_remove, 'delete_Relation')">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                    <div class="w-100 overflow-auto">
                                        <div style="height: 120px; overflow-y: auto;">
                                            <table class="table table-hover w-100 mb-0 p-0">
                                                <thead class="table-light"
                                                    style="position: sticky; top: 0; z-index: 2;">
                                                    <!-- <tr>
                                                    <th style="background: #fff;">Titel</th>
                                                    <th style="background: #fff;">auswählen</th>
                                                </tr> -->
                                                </thead>
                                                <tbody id="tabelleDelete">
                                                    <!-- Tabellenzeilen hier -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3"></div>
                </div>

            </div>
        </div>
    </div>
    <?php include '../assets/scripts.html'; ?>
</body>

</html>