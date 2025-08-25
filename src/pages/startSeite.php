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
                    <button id="btn_save_changes" type="button" onclick="CardObj.saveChanges()"
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
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header p-0">
                                    <small class="mb-0"><i class="fas fa-cog me-2"></i> Infoseite konfigurieren</small>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <div class="card-body" style="width:30%;">

                                        <div class="form-group mt-0">
                                          
                                            <div class="d-flex align-items-center justify-content-start mb-3">
                                                  <i class="fas fa-file-alt me-2"></i>
                                                <label for="websiteName" class="form-label mb-0 ">Infoseite Name:
                                                </label>
                                                <input type="text" class="form-control  w-50 ml-0 form-control-sm mx-2"
                                                    id="websiteName" value="Infoseite auswählen" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="d-flex align-items-center  justify-content-start mb-2 ">
                                                    <i class="fas fa-clock text-secondary"></i> <!-- Uhr-Icon für Sekunden -->
                                                <label for="anzeigeDauer" class="form-label mb-0 ">
                                                    Anzeige Dauer:</label>
                                                <input class="form-control w-50  form-control-sm mx-3" id="anzeigeDauer"
                                                    value="Infoseite auswählen" readonly></input>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center gap-2">
                                                <i class="fas fa-arrow-right"></i>


                                                <div for="selectSekunden">Sekunden:</div>
                                                <input type="text" id="selectSekunden"
                                                    class="form-control form-control-sm ml-2" maxlength="4"
                                                    style="width: 70px;">
                                                <input class="form-check-input" type="checkbox" id="checkA"
                                                    name="checkA" onchange="CardObj.checkAktiv()">
                                                <label class="form-check-label mb-0" for="checkA">
                                                    anzeigen
                                                </label>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="card-body" style="width: 50%;">


                                        <div class="d-flex">
                                            <div id="panelForDateTime" class="w-100">
                                                <div id="dateTimeInfoPanel">
                                                    <div class="d-flex align-items-center mb-3">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas text-dark  fa-calendar-alt me-2"></i>
                                                            <span class="me-3">Datum</span>
                                                            <div class="d-flex align-items-center" style="min-width:0;">
                                                                <label for="startDate"
                                                                    class="form-label mb-0 mx-2 text-secondary">von</label>
                                                                <input type="datetime-local"
                                                                    class="form-control form-control-sm flex-fill"
                                                                    id="startDate" name="startDate"
                                                                    style="min-width:0;">
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class="d-flex align-items-center">
                                                                <label for="endDate"
                                                                    class="form-label mb-0 mx-2 text-secondary">bis:</label>
                                                                <input type="datetime-local"
                                                                    class="form-control form-control-sm flex-fill"
                                                                    id="endDate" name="endDate" style="min-width:0;">
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center w-25 ">
                                                            <button id="delTimeRange"
                                                                class="btn btn-outline-danger btn-sm px-3" style="width: 50px;"
                                                                onclick="CardObj.removeTimeRange(CardObj.selectedID)">
                                                                <i class="fas fa-trash-alt"></i> 
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <!-- Uhrzeit -->
                                                    <div class="d-flex align-items-center mb-3">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-clock text-dark me-2"></i>
                                                            <span class="me-3">Uhrzeit</span>
                                                            <label for="startTimeRange"
                                                                class="form-label mb-0 me-2 text-secondary"
                                                                style="width:40px;">von</label>
                                                            <input type="time"
                                                                class="form-control form-control-sm flex-fill"
                                                                id="startTimeRange" name="startTimeRange"
                                                                style="min-width:0;">
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <label for="endTimeRange"
                                                                class="form-label mb-0 me-2 text-secondary"
                                                                style="width:40px;">bis</label>
                                                            <input type="time"
                                                                class="form-control form-control-sm flex-fill"
                                                                id="endTimeRange" name="endTimeRange"
                                                                style="min-width:0;">
                                                        </div>
                                                        <div class="d-flex align-items-center" style="width: 50px;">
                                                            <button id="btnDelDateTime"
                                                                class="btn btn-outline-danger btn-sm px-3"
                                                                onclick="CardObj.deleteDateTimeRange(CardObj.selectedID)">
                                                                <i class="fas fa-trash-alt"></i> 
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <div class="d-flex align-items-center">
                                                        <label for="openTerminalBtn" class="form-label mb-0 me-2">
                                                            <i class="fas fa-tv me-2"></i> Testanzeige:
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
                                <div class="card-header p-0">
                                    <small class="mb-0"><i class="fas fa-tv me-2"></i>Bildschirm Verwaltung</small>
                                </div>
                                <div class="card-body">
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
                                        <div style="height: 80px; overflow-y: auto;">
                                            <table class="table table-hover w-100 mb-0">
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