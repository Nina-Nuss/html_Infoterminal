<!DOCTYPE html>
<html lang="de">

<head>
    <?php include '../assets/links.html'; ?>
    <?php include '../layout/modal/hinzufuegen.html'; ?>
    <?php include '../layout/modal/addInfoSeite.html'; ?>

</head>


<body>
    <?php include '../layout/header.php'; ?>
    <div class="container-fluid py-2" style="height:100vh;">
        <div class="row" style="height:90vh;">
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/layout/sidebar.php'; ?>
            <div class="col-md-10 text-center">
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/layout/selectPanel.php'; ?>
                <hr>
                <div class="d-flex justify-content-center">
                    <button id="btn_save_changes" type="button" onclick="CardObj.saveChanges(null)"
                        class="btn btn-success btn-sm me-2">
                        <i class="fas fa-save"></i> Speichern
                    </button>
                    <!--  -->
                    <button id="btn_addInfoSeite" type="button" class="btn btn-success btn-sm me-2"
                        data-bs-toggle="modal" data-bs-target="#addInfoSeite">
                        <i class="fas fa-pen-to-square"></i> Erstellen
                    </button>
                    <button id="btn_deleteInfoSeite" onclick="CardObj.deleteCardObj()" type="button"
                        class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i> Löschen
                    </button>
                </div>
                <div class="pt-2"></div>
                <div class="card-body h-100">
                    <div class="row">
                        <div class="col-md-9" id="konfigContainer">
                            <div class="card">
                                <div class="card-header p-1">
                                    <h6 class="mb-0"><i class="fas fa-cog me-2 font-bold"></i> Infoseite konfigurieren</>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <div class="card-body" style="width: 25%;">
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
                                            <div class="d-flex align-items-center  justify-content-between mb-2 ">
                                                <i class="fas fa-hourglass-half"></i>
                                                <!-- Uhr-Icon für Sekunden -->
                                                <div for="anzeigeDauer" class="mb-0 ms-2">
                                                    Sekunden:</div>
                                                <input type="text" id="selectSekunden"
                                                    class="form-control form-control-sm ms-2 me-auto" maxlength="4"
                                                    style="width: 70px;">
                                                <div class="fw-bolder w-auto" id="anzeigeDauer"></div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-start gap-2">

                                                <label class="form-check-label mb-0" for="checkA">
                                                    Aktiv:
                                                </label>

                                                <input class="form-check-input" type="checkbox" id="checkA"
                                                    name="checkA" >
                                            </div>

                                        </div>
                                    </div>


                                    <div class="card-body" style="width: 15%;">

                                    </div>

                                    <div class="card-body" style="width: 50%;">
                                        <div class="d-flex">
                                            <div id="panelForDateTime" class="w-100">
                                                <div id="dateTimeInfoPanel">
                                                    <div class="d-flex align-items-center mb-3">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas text-dark  fa-calendar-alt me-2"></i>
                                                            <span class="me-3">Datum:</span>
                                                            <div class="d-flex align-items-center" style="min-width:0;">

                                                                <input type="date"
                                                                    class="form-control form-control-sm"
                                                                    id="startDate" name="startDate"
                                                                    style="min-width:0;">
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="d-flex align-items-center">
                                                                <label for="endDate"
                                                                    class="form-label mb-0 ms-5 mx-2 text-secondary">bis</label>
                                                                <input type="date"
                                                                    class="form-control form-control-sm w-auto"
                                                                    id="endDate" name="endDate" style="min-width:0;">
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center ms-2"
                                                            style="width: 50px;">
                                                            <button id="btnDelDateTime"
                                                                class="btn btn-outline-danger btn-sm px-3"
                                                                onclick="CardObj.deleteDateTimeRange(CardObj.selectedID)">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <!-- Uhrzeit -->
                                                    <div class="d-flex align-items-center mb-3">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-clock text-dark me-2"></i>
                                                            <span class="me-2">Uhrzeit:</span>

                                                            <input type="time"
                                                                class="form-control form-control-sm flex-fill"
                                                                id="startTimeRange" name="startTimeRange">
                                                            <label for="endTimeRange"
                                                                class="form-label mb-0 mx-2 text-secondary">Uhr</label>
                                                        </div>
                                                        <div class="d-flex align-items-center"
                                                            style="margin-left: 3.8rem;">
                                                            <label for="endTimeRange"
                                                                class="form-label mb-0 me-2 text-secondary"
                                                                style="width: auto;">bis</label>
                                                            <input type="time"
                                                                class="form-control form-control-sm flex-fill"
                                                                id="endTimeRange" name="endTimeRange"
                                                                style="min-width:0;">
                                                            <label for="endTimeRange"
                                                                class="form-label mb-0 mx-2 text-secondary">Uhr</label>
                                                        </div>
                                                        <div class="d-flex align-items-center" style="width: 50px;">
                                                            <button id="delTimeRange"
                                                                class="btn btn-outline-danger btn-sm px-3"
                                                                onclick="CardObj.removeTimeRange(CardObj.selectedID)">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <div class="d-flex align-items-center">
                                                        <label for="openTerminalBtn" class="form-label mb-0 me-2">
                                                            <i class="fas fa-desktop me-2"></i>Anzeige:
                                                        </label>
                                                        <select class="form-control form-select-sm w-25"
                                                            id="infotherminalSelect">
                                                            <option value="">auswählen</option>
                                                        </select>
                                                        <button id="openTerminalBtn"
                                                            class="btn text-dark start-btn btn-sm"
                                                            style="border-color: #006c99;  background-color: rgba(255, 255, 255, 0.952); width: 40px;">
                                                            <i class="fas fa-external-link-alt me-1"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div id="zeitspannePanel"
                                                    class="border rounded-3 shadow-sm p-3 bg-light"
                                                    style="display:none;">
                                                    <div class="row d-flex g-2">
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center" style="min-width:0;">
                                                            </div>
                                                        </div>

                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center" style="min-width:0;">

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
                                                        <div class="col-6 d-flex align-items-center"
                                                            style="min-width:0;">

                                                        </div>
                                                        <div class="col-6 d-flex align-items-center"
                                                            style="min-width:0;">

                                                        </div>



                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card h-100">
                                <div class="card-header p-1">
                                    <h6 class="mb-0"><i class="fas fa-tv me-2"></i>Bildschirm Verwaltung</h6>
                                </div>
                                <div class="card-body pb-0">
                                    <div class="d-flex">
                                        <button id="btn_hinzufuegen" type="button" data-bs-toggle="modal"
                                            data-bs-target="#modal_hinzufuegen" class="btn btn-success btn-sm me-2">
                                            <i class="fas fa-plus"></i> Hinzufügen
                                        </button>
                                        <button id="btn_loeschen" type="button" class="btn btn-danger btn-sm"
                                            onclick="Beziehungen.remove_generate(CardObj.selectedID, Beziehungen.temp_list_remove, 'delete_Relation')">
                                            <i class="fas fa-minus"></i> Entfernen
                                        </button>
                                    </div>
                                    <div class="mt-2">
                                        <div style="height: 100px; overflow-y: auto;">
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
                </div>
            </div>
        </div>
    </div>
    <?php include '../assets/scripts.html'; ?>
</body>

</html>