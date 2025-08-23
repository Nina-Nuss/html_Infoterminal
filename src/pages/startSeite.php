<?php include '../assets/links.html'; ?>
<?php include '../layout/header.php'; ?>

<?php include '../layout/modal/hinzufuegen.html'; ?>
<?php include '../layout/modal/loeschen.html'; ?>
<?php include '../layout/modal/addInfoSeite.html'; ?>


<div class="container-fluid py-2" style="height:100vh;">
    <div class="row" style="height:90vh;">
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/layout/sidebar.php'; ?>
        <div class="col-md-10 text-center">
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/layout/selectPanel.php'; ?>
            <div class="pt-2"></div>
            <div class="card-body h-100">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-header">
                                <h6 class="mb-0"><i class="fas fa-cog me-2"></i> Infoseite Eigenschaften</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="card-body">
                                    <div class="form-group mt-0">
                                        <div class="d-flex align-items-center justify-content-start mb-3">
                                            <label for="websiteName" class="form-label mb-0 w-50 ">Infoseite Name:
                                            </label>
                                            <input type="text" class="form-control  w-50 ml-0 form-control-sm"
                                                id="websiteName" value="Infoseite auswählen" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="d-flex align-items-center  justify-content-start mb-2 ">
                                            <label for="anzeigeDauer" class="form-label mb-0  w-50">
                                                Anzeige Dauer:</label>
                                            <input class="form-control w-50  form-control-sm " id="anzeigeDauer"
                                                value="Infoseite auswählen" readonly></input>
                                        </div>
                                        <div class="d-flex align-items-center   justify-content-evenly">
                                            <!-- <i class="fas fa-circle" style="font-size:10px;color:#333;margin-right:10px; margin-left:10px;"></i> -->
                                            <div class="d-flex align-items-center gap-2">
                                                <input class="form-check-input" type="checkbox" id="checkA"
                                                    name="checkA" onchange="CardObj.checkAktiv()">
                                                <label class="form-check-label mb-0" for="checkA">
                                                    anzeigen
                                                </label>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <div for="selectSekunden">Sekunden:</div>
                                                <input type="text" id="selectSekunden"
                                                    class="form-control form-control-sm ml-2" maxlength="4"
                                                    style="width: 70px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body w-75">
                                    <div class="d-flex align-items-center justify-content-between gap-2 mb-2">
                                        <select class="form-select form-select-sm mb-2" style="width: 200px;" id="btnShowZeitraum"
                                            onchange="handleDateTimeSelector(this)">
                                            <option value="" selected disabled>Zeit Konfiguration</option>
                                            <option value="zeitspanne">Datum</option>
                                            <option value="uhrzeit">Täglich</option>
                                        </select>
                                        <button id="btn_save_changes" type="button" onclick="CardObj.saveChanges()"
                                            class="btn btn-success shadow-sm btn-sm" style="width: 200px;">
                                            <i class="fas fa-save"></i> Speichern
                                        </button>
                                        <script>
                                            function handleDateTimeSelector(sel) {
                                                if (sel.value === "zeitspanne") {
                                                    showDateTime('zeitspanne');
                                                } else if (sel.value === "uhrzeit") {
                                                    showDateTime('uhrzeit');
                                                }
                                            }
                                        </script>

                                    </div>
                                    <div class="d-flex">
                                        <div id="panelForDateTime" class="w-100">
                                            <div id="zeitspannePanel"
                                                class="border rounded-3 shadow-sm p-2  mb-2 bg-light"
                                                style="display:none;">
                                                <div class="row d-flex g-2">
                                                    <div class="col-6">
                                                        <div class="d-flex align-items-center" style="min-width:0;">
                                                            <label for="startDate"
                                                                class="form-label small mb-0 me-2"></label>
                                                            <input type="datetime-local"
                                                                class="form-control form-control-sm flex-fill"
                                                                id="startDate" name="startDate" style="min-width:0;">
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="d-flex align-items-center" style="min-width:0;">
                                                            <label for="endDate"
                                                                class="form-label small mb-0 me-2">-</label>
                                                            <input type="datetime-local"
                                                                class="form-control form-control-sm flex-fill"
                                                                id="endDate" name="endDate" style="min-width:0;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row ">
                                                    <div class="col-12 mt-2">
                                                        <button id="btnDelDateTime"
                                                            class="btn btn-outline-danger btn-sm px-3"
                                                            onclick="CardObj.deleteDateTimeRange(CardObj.selectedID)">
                                                            <i class="fas fa-trash-alt"></i> Zeitspanne löschen
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="uhrzeitPanel" class="border rounded-3 shadow-sm p-2 bg-light"
                                                style="display:none;">
                                                <div class="row g-2 justify-content-center">
                                                    <div class="col-6 d-flex align-items-center" style="min-width:0;">
                                                        <label for="startTimeRange" class="form-label small mb-0 me-2"
                                                            style="width:40px;">von</label>
                                                        <input type="time"
                                                            class="form-control form-control-sm flex-fill"
                                                            id="startTimeRange" name="startTimeRange"
                                                            style="min-width:0;">
                                                    </div>
                                                    <div class="col-6 d-flex align-items-center" style="min-width:0;">
                                                        <label for="endTimeRange" class="form-label small mb-0 me-2"
                                                            style="width:40px;">bis</label>
                                                        <input type="time"
                                                            class="form-control form-control-sm flex-fill"
                                                            id="endTimeRange" name="endTimeRange" style="min-width:0;">
                                                    </div>

                                                    <button id="delTimeRange" class="btn btn-outline-danger btn-sm px-3"
                                                        onclick="CardObj.removeTimeRange(CardObj.selectedID)">
                                                        <i class="fas fa-trash-alt"></i> Uhrzeit löschen
                                                    </button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0"><i class="fas fa-image me-2"></i> Infoseiten</h6>
                            </div>
                            <div class="card-body pl-0">
                                <div class="d-flex">
                                    <button id="btn_addInfoSeite" type="button" class="btn btn-success btn-sm me-2"
                                        data-bs-toggle="modal" data-bs-target="#addInfoSeite">
                                        <i class="fas fa-pen-to-square"></i> Erstellen
                                    </button>
                                    <button id="btn_deleteInfoSeite" onclick="CardObj.deleteCardObj()" type="button"
                                        class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Löschen
                                    </button>
                                </div>

                            </div>
                        </div>
                        <hr />
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0"><i class="fas fa-desktop me-2"></i>Testanzeige</h6>
                            </div>
                            <div class="card-body">
                                <div class=" g-2 d-flex align-items-center justify-content-center">
                                    <select class="form-control form-select-sm w-75 " id="infotherminalSelect">
                                        <option value="">-- Bitte wählen --</option>
                                    </select>
                                    <button id="openTerminalBtn" class="btn text-dark start-btn btn-sm w-25"
                                        style="border-color: #006c99;  background-color: rgba(255, 255, 255, 0.952);">
                                        <i class="fas fa-external-link-alt me-1"></i>öffnen
                                    </button>

                                </div>

                            </div>
                        </div>


                    </div>

                    <div class="col-md-3">
                        <div class="card h-100">
                            <div class="card-header">
                                <h6 class="mb-0"><i class="fas fa-tv me-2"></i> Bildschirm Verwaltung</h6>
                            </div>
                            <div class="card-body">
                                <div class="d-flex mb-3">
                                    <button id="btn_hinzufuegen" type="button" data-bs-toggle="modal"
                                        data-bs-target="#modal_hinzufuegen" class="btn btn-success btn-sm me-2">
                                        <i class="fas fa-plus"></i> Hinzufügen
                                    </button>
                                    <button id="btn_loeschen" type="button" data-bs-toggle="modal"
                                        class="btn btn-danger btn-sm" data-bs-target="#modal_loeschen">
                                        <i class="fas fa-minus"></i> Entfernen
                                    </button>
                                </div>
                                <div class="border rounded p-2"
                                    style="max-height: 200px; overflow-y: auto; overflow-x: hidden; border-radius: 8px;"
                                    id="anzeigebereichV">
                                    <!-- IP Adressen werden hier angezeigt -->

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