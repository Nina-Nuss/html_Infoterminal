<?php include  '../assets/links.html'; ?>
<?php include  '../layout/header.php'; ?>

<?php include  '../layout/modal/hinzufuegen.html'; ?>
<?php include  '../layout/modal/loeschen.html'; ?>
<?php include  '../layout/modal/addInfoSeite.html'; ?>


<div class="container-fluid py-2" style="height:100vh;">

    <div class="row h-100">
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/layout/sidebar.php'; ?>
        <div class="col-md-10 text-center">
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/src/layout/selectPanel.php'; ?>
            <div class="pt-3"></div>
            <div class="card">
                <div class="card-header text-center">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-cogs me-2"></i> Infoseite-Konfiguration
                    </h3>
                    <p class="mb-0 mt-2">Hier können die Infoseiten verwaltet werden</p>
                </div>
                <div class="card-body">
                    <div class="row d-flex justify-content-between">
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h6 class="mb-0"><i class="fas fa-cog me-2"></i> Infoseite Eigenschaften</h6>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="card-body w-25">
                                        <div class="d-flex align-items-center justify-content-space-between mb-3">
                                            <label for="websiteName" class="form-label me-2 mb-0 ">Infoseite Name:</label>
                                            <input type="text" class="form-control mx-sm-3 w-50  form-control-sm" id="websiteName" value="Infoseite auswählen" readonly>
                                        </div>

                                        <div class="form-group mb-2">
                                            <p class="text-md-left"></p>
                                            <div class="d-flex align-items-center  mb-2 ">
                                                <label for="anzeigeDauer" class="form-label me-2 mb-0 ">Anzeige Dauer:</label>
                                                <input class="form-control w-50 mx-sm-3 form-control-sm " id="anzeigeDauer" value="Infoseite auswählen" readonly></input>
                                            </div>
                                            <div class="align-items-center d-flex">
                                                <!-- <i class="fas fa-circle" style="font-size:10px;color:#333;margin-right:10px; margin-left:10px;"></i> -->
                                                <label for="selectSekunden">Sekunden:</label>
                                                <input type="text" id="selectSekunden" class="form-control form-control-sm ml-5" maxlength="4" style="width: 70px;">
                                                <!--  -->
                                                <small class="form-text text-muted ml-2">10-3599</small>
                                            </div>

                                        </div>

                                        <div class="form-group form-check">
                                            <input class="form-check-input " type="checkbox" id="checkA" name="checkA" onchange="CardObj.checkAktiv()">
                                            <label class="form-check-label" for="checkA">
                                                anzeigen
                                            </label>
                                        </div>

                                    </div>
                                    <div class="card-body w-25">
                                        <div class="mb-2">
                                            <label class="form-label fw-bold">Zeit-Konfigurieren</label>
                                            <div class="btn-group w-100" role="group">
                                                <button class="btn btn-outline-primary" type="button" id="btnShowZeitraum" onclick="showDateTime('zeitspanne')">
                                                    <i class="bi bi-calendar-range me-1"></i> Datum & Uhrzeit
                                                </button>
                                                <button class="btn btn-outline-primary" type="button" id="btnShowUhrzeit" onclick="showDateTime('uhrzeit')">
                                                    <i class="bi bi-clock me-1"></i> Täglich
                                                </button>
                                            </div>
                                        </div>
                                        <div id="panelForDateTime">
                                            <div id="zeitspannePanel" class="border rounded-3 shadow-sm p-3 mb-3 bg-light" style="display:none;">
                                                <div class="row g-2">
                                                    <div class="col-6">
                                                        <label for="startDate" class="form-label small">Von Datum</label>
                                                        <input type="date" class="form-control form-control-sm" id="startDate" name="startDate">
                                                    </div>
                                                    <div class="col-6">
                                                        <label for="endDate" class="form-label small">Bis Datum</label>
                                                        <input type="date" class="form-control form-control-sm" id="endDate" name="endDate">
                                                    </div>
                                                </div>
                                                <div class="row g-2 mt-1">
                                                    <div class="col-6">
                                                        <label for="startTimeDate" class="form-label small">Von Zeit</label>
                                                        <input type="time" class="form-control form-control-sm" id="startTimeDate" name="startTimeDate">
                                                    </div>
                                                    <div class="col-6">
                                                        <label for="endTimeDate" class="form-label small">Bis Zeit</label>
                                                        <input type="time" class="form-control form-control-sm" id="endTimeDate" name="endTimeDate">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 text-end mt-2">
                                                        <button id="btnDelDateTime" class="btn btn-outline-danger btn-sm px-3" onclick="CardObj.deleteDateTimeRange(CardObj.selectedID)">
                                                            <i class="fas fa-trash-alt"></i> Zeitspanne löschen
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="uhrzeitPanel" class="border rounded-3 shadow-sm p-3 bg-light" style="display:none;">
                                                <div class="row g-2">
                                                    <div class="col-6">
                                                        <label for="startTimeRange" class="form-label small">Von Zeit</label>
                                                        <input type="time" class="form-control form-control-sm" id="startTimeRange" name="startTimeRange">
                                                    </div>
                                                    <div class="col-6">
                                                        <label for="endTimeRange" class="form-label small">Bis Zeit</label>
                                                        <input type="time" class="form-control form-control-sm" id="endTimeRange" name="endTimeRange">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 text-end mt-2">
                                                        <button id="delTimeRange" class="btn btn-outline-danger btn-sm px-3" onclick="CardObj.removeTimeRange(CardObj.selectedID)">
                                                            <i class="fas fa-trash-alt"></i> Uhrzeit löschen
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12 d-flex justify-content-center">
                                        <button id="btn_save_changes" type="button" onclick="CardObj.saveChanges()" class="btn btn-success shadow-sm w-25">
                                            <i class="fas fa-save"></i> Speichern
                                        </button>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card h-35">
                                <div class="card-header">
                                    <h6 class="mb-0"><i class="fas fa-desktop me-2"></i> Infoseite öffnen(Testanzeige)</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="infotherminalSelect" class="form-label">Infoterminal wählen:</label>
                                        <select class="form-select" id="infotherminalSelect">
                                            <option value="">-- Bitte wählen --</option>
                                        </select>
                                    </div>
                                    <button id="openTerminalBtn" class="btn btn-primary w-50">
                                        <i class="fas fa-external-link-alt me-1"></i> Anzeige öffnen
                                    </button>
                                </div>
                            </div>
                            <hr />
                            <div class="card h-35">
                                <div class="card-header">
                                    <h6 class="mb-0"><i class="fas fa-image me-2"></i> Infoseiten Neuauflage/Löschen</h6>
                                </div>
                                <div class="card-body">

                                    <div class="d-flex mb-3">
                                        <button id="btn_addInfoSeite" type="button" class="btn btn-primary" data-toggle="modal" data-target="#addInfoSeite">
                                            Hinzufügen
                                        </button>
                                        <button  type="button" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Löschen
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
                                        <button id="btn_hinzufuegen" type="button" data-toggle="modal" data-target="#modal_hinzufuegen" class="btn btn-success btn-sm me-2">
                                            <i class="fas fa-plus"></i> Hinzufügen
                                        </button>
                                        <button id="btn_loeschen" type="button" data-toggle="modal" class="btn btn-danger btn-sm" data-target="#modal_loeschen">
                                            <i class="fas fa-trash"></i> Löschen
                                        </button>
                                    </div>
                                    <div class="border rounded p-2" style="max-height: 200px; overflow-y: auto; overflow-x: hidden; border-radius: 8px;" id="anzeigebereichV">
                                        <!-- IP Adressen werden hier angezeigt -->
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>





                </div>

            </div>

            <hr />

        </div>

    </div>




</div>
<?php include  '../assets/scripts.html'; ?>