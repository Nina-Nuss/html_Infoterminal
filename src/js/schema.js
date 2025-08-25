class CardObj {
    static idCounter = 0;
    static selectedID = null;
    static allCardObjekte = [];
    static temp_remove = [];
    static eleListe = []
    static list = [];
    static checkAllowed = false; // Variable to control checkbox behavior
    constructor(id, imagePath, selectedTime, aktiv, startTime, endTime, startDate, endDate, timeAktiv, dateAktiv, titel, beschreibung) {

        this.id = id;
        this.update = false;
        //AB hier kommt alles in die Datenbank rein:
        this.imagePath = imagePath //Der Pfad zum Bild
        this.startTime = startTime //Startzeit des Zeitplans
        this.endTime = endTime //Endzeit des Zeitplans
        this.startDate = startDate //Startdatum des Zeitplans
        this.endDate = endDate //Enddatum des Zeitplans
        this.selectedTime = selectedTime // Der aktuelle ausgewählte Wert
        this.timeAktiv = timeAktiv //True or false
        this.dateAktiv = dateAktiv //True or false
        this.aktiv = aktiv //true or false
        this.titel = titel //Der Titel des Objektes
        this.beschreibung = beschreibung //Die Beschreibung des Objektes
        //-------------------------------------

        //HTMLOBJEKTE-------------------------
        this.deleteBtn = `deleteBtn${this.id}`

        this.imageInputId = `imageInput${this.id}`;
        this.modalImageId = `modalImageID${this.id}`;
        this.checkAktiv = `activCheck${this.id}`;
        this.dateRangeInputId = `daterange${this.id}`;
        this.dateRangeContainerId = `selected-daterange${this.id}`;
        this.infoBtn = `infoBtn${this.id}`;
        this.selectedTimerLabel = `selectedTime${this.id}`
        this.cardObjekte = `cardObjekt${this.id}`
        this.infoCard = `infoCard${this.id}`

        this.checkSelect = `checkSelect${this.id}`

        //-------------------------------------    

        CardObj.list.push(this)

    }
    htmlBody(umgebung) {
        // Bestimme den korrekten Bildpfad basierend auf dem imagePathb
        const ext = this.imagePath.split('.').pop().toLowerCase();
        const imageExts = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'html', 'php']; // gängige Bildformate
        const videoExts = ['mp4', 'webm']; // nur Formate, die der Browser direkt kann

        let placeHolder;
        let src = `../../uploads/${imageExts.includes(ext) ? 'img' : 'video'}/${this.imagePath}`;

        if (imageExts.includes(ext)) {
            // Remove the onerror handler before setting fallback to avoid infinite error loop
            placeHolder = `<img class="card-img-small" src="${src}" alt="Bild" onerror="this.onerror=null;this.src='/img/bild.png'">`;
        }
        else if (videoExts.includes(ext)) {
            placeHolder = `
    <video class="card-img-small w-100" autoplay muted loop  >
      <source src="${src}">
      Ihr Browser unterstützt das Video-Tag nicht.
    </video>`;
        }
        else {
            // Ensure a src is present for the fallback so the image element doesn't remain empty
            placeHolder = `<img class="card-img-small" src="/img/bild.png" alt="Fallback">`;
        }
        const body = `
            <div class="card mb-2 text-wrap"  id="${this.cardObjekte}">
                <div class="card-header p-0">
                    <small class="text-muted">Uhrzeit: ${this.startTime} - ${this.endTime}</small>
                </div>
                ${placeHolder}
                <div class="card-body p-2 overflow-hidden">
                    <h5 class="card-title m-0 p-0">${this.titel}</h5>
                    <p class="card-text m-0">${this.beschreibung}</p>
                    <div class="form-check d-flex justify-content-center align-items-center">
                        <input class="form-check-input single-active-checkbox me-2" type="checkbox" value="" id="flexCheck${this.id}" onclick="erstelleFunktionForCardObj(${this.id})">
                        <label class="form-check-label mb-0" id="label${this.id}" name="label${this.id}" for="flexCheck${this.id}"></label>
                    </div>
                    <div class="form-check">
                        <small id="${this.selectedTimerLabel}" class="text-muted">Dauer: ${getSekMin(this.selectedTime)}</small>
                    </div>
                </div>
                <div class="card-footer p-0">
                    <small class="text-muted">Datum: ${formatDateToDayMonth(this.startDate)} bis ${formatDateToDayMonth(this.endDate)}</small>
                </div>
            </div>
    `;
        document.getElementById(umgebung).innerHTML += body;
    }
    removeHtmlElement() {
        const element = document.getElementById(this.cardObjekte);
        if (element) {
            element.remove();
        }
    }
    checkboxAktiv() {
        const cbAktiv = document.querySelectorAll('[id^="cbAktiv"]')
        cbAktiv.forEach(cb => {
            cb.addEventListener("change", (event) => {
                this.aktiv = event.target.checked;
            });
        });
    }




    static event_remove(id) {
        var element = document.getElementById(`checkDelSchema${id}`);
        if (element.checked && !this.temp_remove.includes(id)) {
            this.list.forEach(checkID => {
                if (checkID.id == id) {
                    checkID.check = true
                    // console.log(checkID)
                }
            });
            this.temp_remove.push(id);
        }
        else {
            this.list.forEach(checkID => {
                if (checkID.id == id) {
                    checkID.check = false
                    // console.log(checkID)
                }
            });
            this.temp_remove.forEach(idd => {
                if (id != idd) {
                    this.eleListe.push(idd)
                }
            });
            this.temp_remove = this.eleListe
            this.eleListe = []
        }
        console.log(this.temp_remove);
    };
    static async remove_generate() {
        if (this.temp_remove.length == 0) {
            alert("Bitte wählen Sie mindestens ein Schema aus, um es zu löschen.");
            return;
        }

        // Bestätigungsdialog anzeigen
        const confirmed = confirm(`Sind Sie sicher, dass Sie ${this.temp_remove.length} Schema(s) löschen möchten? Diese Aktion kann nicht rückgängig gemacht werden.`);

        if (!confirmed) {
            console.log("Löschvorgang vom Benutzer abgebrochen");
            return; // Benutzer hat abgebrochen
        }

        await this.removeFromListLogik();
        await this.update();
    }

    static async deleteCardObj() {
        const confirmed = confirm("Sind Sie sicher, dass Sie die Infoseite löschen möchten?");
        if (!confirmed) {
            console.log("Löschvorgang vom Benutzer abgebrochen");
            return; // Benutzer hat abgebrochen
        }
        await this.deleteCardObjDataBase(this.selectedID);
        await this.update();
    }

    static async removeFromListLogik() {
        // DIese Methode wird aufgerufen sobald wir auf Minus (-) klicken
        // Hier benötigen wir die Aktuellen IDS der Datenbank zum löschen
        console.log(this.list);

        // Warte auf alle Löschvorgänge bevor die Liste aktualisiert wird
        for (const id of this.temp_remove) {
            this.list = await this.removeFromListViaID(id, this.list);
        }
        this.temp_remove = []
        console.log(this.list);
    }

    static async removeFromListViaID(id, list) {
        var temp = [];
        console.log(list);

        for (const element of list) {
            if (element.id != id) {
                //ID muss aus Liste gelöscht werden
                temp.push(element);

            } else {
                await this.deleteCardObjDataBase(element.id);
                console.log("Das Element wurde gefunden und wird gelöscht! " + element.id);
                // Nicht sofort return, sondern weiter iterieren um alle anderen Elemente zu behalten
            }
        }
        return temp;
    }


    static async deleteCardObjDataBase(cardObjId) {
        try {
            // Erst ALLE Beziehungen für dieses Schema löschen
            const relationResponse = await fetch("../database/delete_All_Relations_For_Schema.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    cardObjektID: cardObjId
                })
            });

            const relationResult = await relationResponse.text();
            console.log("Beziehungen gelöscht:", relationResult);

            // Dann das Schema löschen
            const response = await fetch("../database/deleteCardObj.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    id: cardObjId
                })
            });
            if (!response.ok) {
                throw new Error(`Fehler beim Löschen: ${response.statusText}`);
            }
            const result = await response.text();
            console.log("Schema gelöscht:", result);
        } catch (error) {
            console.error("Fehler:", error);
        }
    }
    static async update() {
        var delSchema = document.getElementById("deleteSchema")
        console.log("bin in delschema drin");
        if (delSchema != null) {
            delSchema.innerHTML = "";
        }
        this.list = [];
        this.temp_remove = [];
        await CardObj.createCardObj();
        if (window.location.href.includes("templatebereich.php") ||
            window.location.href.includes("adminbereich.php")) {
            deaktivereCbx(true);
        }
        console.log(this.list);

    }
    static async createCardObj() {
        console.log("createCardObj wurde aufgerufen");
        var delSchema = document.getElementById("deleteSchema")
        const response = await readDatabase("selectSchemas");
        console.log(response);
        let objList = convertCardObjForDataBase(response)
        objList.forEach(cardObj => {
            if (cardObj.imagePath == null || cardObj.imagePath == "null" || cardObj.imagePath == "") {
                cardObj.imagePath = ""; // Setze einen Standardwert,
            } else {
                new CardObj(
                    cardObj.id,
                    cardObj.imagePath,
                    cardObj.selectedTime,
                    cardObj.isAktiv,
                    cardObj.startTime,
                    cardObj.endTime,
                    cardObj.startDate,
                    cardObj.endDate,
                    cardObj.timeAktiv,
                    cardObj.dateAktiv,
                    cardObj.titel,
                    cardObj.beschreibung
                )
                if (delSchema != null) {
                    delSchema.innerHTML += `<tr class="border-bottom">
                    <td class="p-2">${cardObj.id}</td>
                    <td class="p-2">${cardObj.titel}</td>
                    <td class="p-2">${cardObj.beschreibung}</td>
                    <td class="p-2 text-center"><input type="checkbox" name="${cardObj.id}" id="checkDelSchema${cardObj.id}" onchange="CardObj.event_remove(${cardObj.id})"></td>
                </tr>`;
                }
            }
        });
        createBodyCardObj();
        deakAktivCb(true);
        console.log(CardObj.list);
    }


    static checkAktiv() {
        if (CardObj.selectedID !== null) {
            var checkA = document.getElementById("checkA");
            var obj = findObj(CardObj.list, CardObj.selectedID);
            if (checkA.checked && obj !== null) {
                console.log("Checkbox ist aktiviert");
                obj.aktiv = true;
                console.log("Checkbox aktiviert für CardObjektID:", obj.id);

            } else {
                if (obj === null) {
                    console.warn("Objekt nicht gefunden für ID:", CardObj.selectedID);
                    return;
                }
                obj.aktiv = false;
                console.log("Checkbox deaktiviert für CardObjektID:", obj.id);
            }
        }
    }
    static async saveChanges() {
        if (CardObj.selectedID === null) {
            alert("Bitte wählen Sie ein Schema aus, um Änderungen zu speichern.");
            return;
        }
        CardObj.checkAktiv();
        const obj = findObj(CardObj.list, CardObj.selectedID);
        CardObj.prepareSelectedTimer(obj);

        if (obj === null) {
            console.warn("Objekt nicht gefunden für ID:", CardObj.selectedID);
            return;
        }
        try {
            CardObj.DateTimeHandler(obj); // Aktualisiere die Datums- und Zeitfelder
            var preCardObj = CardObj.prepareObjForUpdate(obj); // Bereite das Objekt für die Aktualisierung vor
            await updateDataBase(preCardObj, "updateSchema");
            alert("Änderungen erfolgreich gespeichert!");


            CardObj.loadChanges(obj); // Lade die Änderungen für das ausgewählte CardObj
        } catch (error) {
            console.error("Fehler beim Speichern der Änderungen:", error);
            alert("Fehler beim Speichern der Änderungen. Bitte versuchen Sie es erneut.");
        }
    }

    static prepareSelectedTimer(obj) {
        const selectSekunden = document.getElementById("selectSekunden");
        let selectMinuten = null;
        let selectMinutenInt = null;

        if (document.getElementById("selectMinuten")) {
            selectMinuten = document.getElementById("selectMinuten");
        } else {
            selectMinuten = null; // Wenn selectMinuten nicht existiert, setze es auf null
        }

        if (selectMinuten != null) {
            if (selectSekunden.value == "" && selectMinuten.value == "") {
                return; //keine Eingabe, also nichts tun
            }
        } else {
            if (selectSekunden.value == "") {
                return; //keine Eingabe, also nichts tun
            }
        }

        if (selectMinuten) {
            var resultMinuteBool = isParseableNumber(selectMinuten.value)
        } else {
            var resultMinuteBool = true; // Wenn selectMinuten nicht existiert, ist es gültig
        }
        var resultSekundenBool = isParseableNumber(selectSekunden.value)
        if (!resultMinuteBool || !resultSekundenBool) {
            alert("Bitte geben Sie gültige Werte für Minuten und Sekunden ein.");
            selectSekunden.value = "";
            if (!selectMinuten) {
                selectMinuten.value = "";
            }
            return;
        }
        let selectSekundenInt = parseInt(selectSekunden.value)

        if (selectMinuten) {
            selectMinutenInt = parseInt(selectMinuten.value)
            console.log("Minuten:", selectMinuten);
        } else {
            selectMinutenInt = null; // Wenn selectMinuten nicht existiert, setze es auf 0
        }
        console.log("Sekunden:", selectSekundenInt);

        if (selectMinutenInt > 59 || selectSekundenInt > 3599) {
            alert("Bitte Minuten und Sekunden im Bereich von 0-59 eingeben.");
            selectSekunden.value = "";
            if (selectMinuten) {
                selectMinuten.value = "";
            }
            return;
        }
        if (selectMinutenInt && selectSekundenInt) {
            obj.selectedTime = (selectMinutenInt * 60 + selectSekundenInt) * 1000; // Minuten und Sekunden in Millisekunden umrechnen
            console.log("Selected Time in Millisekunden: ", obj.selectedTime);
            console.log("sekunden und minuten vorhanden");

        } else if (selectMinuten) {
            obj.selectedTime = selectMinuten * 60 * 1000; // Minuten in Millisekunden umrechnen
            console.log("minuten vorhanden:", obj.selectMinuten);
        } else if (selectSekundenInt) {
            obj.selectedTime = selectSekundenInt * 1000; // Sekunden in Millisekunden umrechnen
            console.log("sekunden vorhanden:", obj.selectSekunden);

        } else {
            obj.selectedTime = 0; // Setze auf 0, wenn keine Eingabe vorhanden ist
            console.log("Keine Zeit ausgewählt, setze auf 0");
        }

    }

    static prepareObjForUpdate(obj) {
        // Hier können Sie das Objekt in den Zustand für die Aktualisierung versetzen
        CardObj.checkAktiv()

        console.log(obj.selectedTime);

        // var timerSelect = document.getElementById("timerSelectRange");
        // obj.selectedTime = timerSelect.value;

        var preObj = {
            id: obj.id,
            imagePath: obj.imagePath,
            selectedTime: obj.selectedTime,
            isAktiv: obj.aktiv,
            startTime: obj.startTime,
            endTime: obj.endTime,
            startDateTime: obj.startDate,
            endDateTime: obj.endDate,
            timeAktiv: obj.timeAktiv,
            dateAktiv: obj.dateAktiv,
            titel: obj.titel,
            beschreibung: obj.beschreibung
        }; // Erstellen Sie eine Kopie des Objekts
        preObj.update = true; // Setzen Sie das Update-Flag
        console.log("CardObjekt vorbereitet für Update:", preObj.id);
        return preObj;
    }

    static loadChanges(cardObj) {
        console.log("loadChanges aufgerufen für CardObjektID:", cardObj.id);
        var cardtimerLabel = document.getElementById(cardObj.selectedTimerLabel);
        // var timerbereich = document.getElementById("timerSelectRange");
        var titel = document.getElementById("websiteName");
        var anzeigeDauer = document.getElementById("anzeigeDauer");
        var checkA = document.getElementById("checkA");

        var startDate = document.getElementById("startDate");
        var endDate = document.getElementById("endDate");

        var startTimeRange = document.getElementById("startTimeRange");
        var endTimeRange = document.getElementById("endTimeRange");

        startDate.value = ""
        endDate.value = ""
        startTimeRange.value = ""
        endTimeRange.value = ""

        console.log("Startzeit:", cardObj.startTime);
        console.log("Endzeit:", cardObj.endTime);
        console.log("Startdatum:", cardObj.startDate);
        console.log("Enddatum:", cardObj.endDate);

        checkA.checked = cardObj.aktiv; // Set the checkbox state
        titel.value = cardObj.titel; // Set the title to the checkbox's title

        // timerbereich.value = cardObj.selectedTime; // Set the time range
        var selectedTime = cardObj.selectedTime / 1000; // Convert milliseconds to seconds
        var restSekunden = selectedTime % 60;
        var restMinuten = Math.floor(selectedTime / 60);
        console.log("Rest Minuten:", restMinuten);
        console.log("Rest Sekunden:", restSekunden);
        anzeigeDauer.value = restMinuten + " Min," + " Sek: " + restSekunden; // Set the display duration
        cardtimerLabel.innerHTML = `Dauer: ${anzeigeDauer.value}`; // Update the label with the selected time


     
        var startTimeSplit = cardObj.startDate.split(" ")[1];
        var startDateSplit = cardObj.startDate.split(" ")[0];
        var endTimeSplit = cardObj.endDate.split(" ")[1];
        var endDateSplit = cardObj.endDate.split(" ")[0];

        console.log("Startdatum:", startDateSplit);
        console.log("Startzeit:", startTimeSplit);
        console.log("Enddatum:", endDateSplit);
        console.log("Endzeit:", endTimeSplit);

        console.log("Startzeit:", startDateSplit, startTimeSplit);
        startDate.value = startDateSplit + "T" + startTimeSplit; // Set the start date
        endDate.value = endDateSplit + "T" + endTimeSplit; // Set the end date

        startTimeRange.value = cardObj.startTime;
        endTimeRange.value = cardObj.endTime;

        checkA.checked = cardObj.aktiv; // Set the checkbox state

    }
    static setTimerRange(value) {
        console.log("Timer Range gesetzt auf:", value);
        var timerbereich = document.getElementById("timerSelectRange");
        if (timerbereich) {
            timerbereich.value = value; // Set the time range
        } else {
            console.error("Timer Select Range Element nicht gefunden");
        }
    }



    static DateTimeHandler(cardObj) {
        console.log("DateTimeHandler aufgerufen für CardObjektID:", cardObj.id);
        let startDateID = document.getElementById("startDate");
        let endDateID = document.getElementById("endDate");
        let startTimeRange = document.getElementById("startTimeRange");
        let endTimeRange = document.getElementById("endTimeRange");

        let startTime = startDateID.value.split("T")[1];
        let endTime = endDateID.value.split("T")[1];


        let startDate = startDateID.value.split("T")[0];
        let endDate = endDateID.value.split("T")[0];

        console.log("End Date:", endDate);
        console.log("End Time:", endTime);
        debugger


        if (startDate && endDate && startTime && endTime) {
            let startDateTime = combineDateTime(startDate, startTime);
            let endDateTime = combineDateTime(endDate, endTime);
            alert("Startzeit: " + startDateTime + "\nEndzeit: " + endDateTime);
            if (startDateTime >= endDateTime) {
                alert("Ungültige Eingabe: Bis-Datum/Zeit kann nicht vor Von-Datum/Zeit liegen.");
                console.error("Ungültige Eingabe: Startdatum ist größer oder gleich dem Enddatum.");
                return;
            } else if (startDateTime < new Date()) {
                cardObj.startDate = new Date(); // Setze das heutige Datum mit der Startzeit
                cardObj.endDate = endDate + " " + endTime; // Setze das heutige Datum mit der Endzeit
                cardObj.dateAktiv = true;
            }
            else {
                cardObj.startDate = startDate + " " + startTime; // Setze das heutige Datum mit der Startzeit
                cardObj.endDate = endDate + " " + endTime; // Setze das heutige Datum mit der Endzeit
                cardObj.dateAktiv = true;
                console.log("alles klar, Datum und Zeit wurden gesetzt");
            }
            console.log("Startdatum:", cardObj.startDate);
            console.log("Enddatum:", cardObj.endDate);
        } else if (endDate && endTime) {
            alert("Nur Enddatum und Endzeit gesetzt");
            var now = new Date();
            var endDateTime = new Date(endDate + " " + endTime);
            if (endDateTime < now) {
                alert("Das Enddatum und die Endzeit müssen in der Zukunft liegen.");
                console.error("Ungültige Eingabe: Enddatum ist in der Vergangenheit.");
                return;
            }
            cardObj.endDate = endDate + " " + endTime;
            cardObj.startDate = getTodayDate() + " " + getCurrentTime(); // Setze ein Standard-Startdatum
            cardObj.dateAktiv = true;
            console.log("Enddatum wurde gesetzt");
            console.log("Startdatum:", cardObj.startDate);
            console.log("Enddatum:", cardObj.endDate);
        }
        else if (startTime && startDate) {
            alert("Nur Startdatum und Startzeit gesetzt");
            let startDateTime = new Date(startDate + " " + startTime);
            if (startDateTime < new Date()) {
                alert("Das Startdatum und die Startzeit müssen in der Zukunft liegen.");
                console.error("Ungültige Eingabe: Startdatum ist in der Vergangenheit.");
                return;
            }
            cardObj.endDate = "9999-12-31" + " 00:00";
            cardObj.startDate = startDate + " " + startTime; // Setze ein Standard-Startdatum
            cardObj.dateAktiv = true;
            console.log("Enddatum wurde gesetzt");
            console.log("Startdatum:", cardObj.startDate);
            console.log("Enddatum:", cardObj.endDate);

        }
        else {
            alert("Es wurden keine gültigen Daten eingegeben.");
            cardObj.startDate = "";
            cardObj.endDate = "";
            cardObj.dateAktiv = false;
            alert("Datum wurde nicht gespeichert, da die Eingabefelder nicht alle ausgefüllt sind.");
        }

        // Zeitbereich prüfen


        if (startTimeRange || endTimeRange) {
            if (startTimeRange.value && endTimeRange.value) {
                const startTimeOnly = combineDateTime("1970-01-01", startTimeRange.value);
                const endTimeOnly = combineDateTime("1970-01-01", endTimeRange.value);

                if (startTimeOnly >= endTimeOnly) {
                    alert("Die Startzeit muss vor der Endzeit liegen.");
                    console.error("Ungültige Eingabe: Startzeit ist größer oder gleich der Endzeit.");
                    return;
                } else {
                    cardObj.startTime = startTimeRange.value;
                    cardObj.endTime = endTimeRange.value;
                    cardObj.timeAktiv = true;
                    console.log("Zeitbereich wurde gesetzt");
                }
            } else if (startTimeRange.value) {
                cardObj.startTime = startTimeRange.value;
                cardObj.endTime = "23:59"; // Setze einen Standardwert, wenn nur Startzeit gesetzt ist
                cardObj.timeAktiv = true;
                console.log("Startzeit wurde gesetzt");
            } else if (endTimeRange.value) {
                cardObj.endTime = endTimeRange.value;
                cardObj.startTime = "00:00"; // Setze einen Standardwert, wenn nur Endzeit gesetzt ist
                cardObj.timeAktiv = true;
                console.log("Endzeit wurde gesetzt");
            } else {
                cardObj.startTime = "";
                cardObj.endTime = "";
                cardObj.timeAktiv = false;

            }
        } else {
            cardObj.startTime = "";
            cardObj.endTime = "";
            cardObj.timeAktiv = false;

        }
        console.log("Startzeit:", cardObj.startTime);
        console.log("Endzeit:", cardObj.endTime);
        console.log("Startdatum:", cardObj.startDate);
        console.log("Enddatum:", cardObj.endDate);

    }

    static removeDateRange(objID) {
        var btnDelDateTime = document.getElementById('btnDelDateTime');
        var startDate = document.getElementById("startDate");
        var endDate = document.getElementById("endDate");
        if (btnDelDateTime && objID !== null) {
            startDate.value = "";
            endDate.value = "";
        }
    }

    static removeTimeRangeFromDate(objID) {
        var startTime = document.getElementById("startTime");
        var endTime = document.getElementById("endTime");
        var btnDelDateTime = document.getElementById('btnDelDateTime');
        if (btnDelDateTime && startTime && endTime && objID !== null) {
            startTime.value = "";
            endTime.value = "";
        }
    }

    static removeTimeRange(objID) {
        var btnDelTime = document.getElementById('delTimeRange');
        var startTimeRange = document.getElementById("startTimeRange");
        var endTimeRange = document.getElementById("endTimeRange");
        if (btnDelTime && objID !== null) {
            startTimeRange.value = '';
            endTimeRange.value = '';
        }
    }

    static deleteDateTimeRange(objID) {
        console.log("deleteDateTimeRange aufgerufen für CardObjektID:", objID);

        var btnDelDateTime = document.getElementById('btnDelDateTime');
        if (btnDelDateTime && objID !== null) {
            CardObj.removeDateRange(objID);
            CardObj.removeTimeRangeFromDate(objID);
            console.log("Datum und Zeitbereich wurden gelöscht");
        } else {
            console.error("Button oder Objekt-ID nicht gefunden");
        }
    }

}
window.addEventListener("load", async function () {
    imgVideoPreview();
    const templatebereich = document.getElementById("templateBereich");
    if (templatebereich !== null) {
        templatebereich.addEventListener("click", async function (event) {
            window.location.href = 'templatebereich.php';
        });
    }
});

function combineDateTime(date, time) {
    return new Date(`${date}T${time}`);
}

function formatDateToDayMonth(dateTimeStr) {
    // Erwartetes Format: "YYYY-MM-DD HH:MM"
    if (!dateTimeStr || typeof dateTimeStr !== "string") return "";
    if (dateTimeStr === "9999-12-31 00:00") return "";
    const [datePart] = dateTimeStr.split(" ");
    if (!datePart) return "";
    const [year, month, day] = datePart.split("-");
    if (!day || !month) return "";
    return `${day}.${month}`;
}


function getTodayDate() {
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0'); // Monat von 0-11, daher +1
    const day = String(today.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
}

function getCurrentTime() {
    const now = new Date();
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    return `${hours}:${minutes}`;
}

function imgVideoPreview() {
    if (document.getElementById('img') !== null) {
        document.getElementById('img').addEventListener('change', function (event) {
            const [file] = event.target.files;
            const imgPreview = document.getElementById('imgPreview');
            const videoPreview = document.getElementById('videoPreview');
            // Beide Vorschauen verstecken
            if (imgPreview) {
                imgPreview.style.display = 'none';
                imgPreview.src = '#';
            }
            if (videoPreview) {
                videoPreview.style.display = 'none';
                videoPreview.src = '#';
            }
            if (file) {
                console.log(file.name);
                if (file.type.startsWith('image/')) {
                    // Bild-Vorschau anzeigen
                    if (imgPreview) {
                        imgPreview.src = URL.createObjectURL(file);
                        imgPreview.style.display = 'block';
                    }
                } else if (file.type.startsWith('video/')) {
                    // Video-Vorschau anzeigen
                    if (videoPreview) {
                        videoPreview.src = URL.createObjectURL(file);
                        videoPreview.style.display = 'block';
                        videoPreview.load(); // Video neu laden
                    }
                }
            }
        });
    }
}

async function meow(event) {
    event.preventDefault(); // Verhindert das Standardverhalten des Formulars
    const form = event.target.form;
    const formData = new FormData(form);
    const selectedTime = String(formData.get('selectedTime')); // Wert als Zahl
    const aktiv = formData.get('aktiv'); // Wert der ausgewählten Option
    const titel = formData.get('title');
    const description = formData.get('description');
    console.log("Selected Time:", selectedTime);
    const imgFile = formData.get("img");

    const localImageName = imgFile && imgFile.name ? imgFile.name : "";
    if (localImageName === "" || localImageName === null || selectedTime === null || aktiv === null || titel === "") {
        alert("Bitte füllen Sie alle Felder aus inkl Bild.");
        return;
    }
    // Bild hochladen und vom Server den Dateinamen erhalten
    const serverImageName = await sendPicture(formData);
    // CardObj mit dem vom Server erhaltenen Bildnamen erstellen
    if (serverImageName === "") {
        console.error("Bild konnte nicht hochgeladen werden.");
        alert("Fehler beim Hochladen des Bildes. Bitte versuchen Sie es erneut. Bitte keine ungültigen Zeichen verwenden.");
        return;
    }
    try {
        // Lokalen Dateinamen in den CardObj einfügen
        const obj1 = new CardObj(
            "",
            serverImageName, // Nur Bildname, kein Pfad
            selectedTime,
            aktiv,
            "",
            "",
            "",
            "",
            "",
            "",
            titel,
            description
        )
        console.log(obj1.selectedTime);
        await insertDatabase(obj1);
        alert("Schema erfolgreich erstellt!");
        await CardObj.update();

    } catch (error) {
        console.error("Fehler beim erstellen des CardObj:", error);
    }
    form.reset(); // Formular zurücksetzen
    const imgPreview = document.getElementById('imgPreview');
    imgPreview.src = '#'; // Bildvorschau zurücksetzen
    imgPreview.style.display = 'none';
    imgPreview.alt = 'Bildvorschau';
    const videoPreview = document.getElementById('videoPreview');
    videoPreview.src = '#'; // Video-Vorschau zurücksetzen
    videoPreview.style.display = 'none';
    videoPreview.alt = 'Video-Vorschau';

}
async function sendPicture(formData) {
    try {
        const response = await fetch("../php/movePic.php", {
            method: 'POST',
            body: formData
        });
        let imageName = await response.text();
        console.log("Bildname vom Server:", imageName);

        // Falls der Server einen Pfad zurückgibt, extrahiere nur den Dateinamen
        if (imageName.includes('../../uploads/img/')) {
            imageName = imageName.split('/').pop(); // Extrahiere nur den Dateinamen

        } else if (imageName.includes('../../uploads/video/')) {
            imageName = imageName.split('/').pop(); // Extrahiere nur den Dateinamen
        }
        return imageName;
    } catch (error) {
        console.error('Error:', error);

        return "";
    }
}

async function insertDatabase(cardObj) {
    // Erstellen eines JSON-Objekts
    const jsonData = {
        titel: cardObj.titel,
        beschreibung: cardObj.beschreibung,
        imagePath: cardObj.imagePath,
        selectedTime: cardObj.selectedTime,
        aktiv: cardObj.aktiv,
        startTime: cardObj.startTime,
        endTime: cardObj.endTime,
        startDateTime: cardObj.startDate,
        endDateTime: cardObj.endDate,
        timeAktiv: cardObj.timeAktiv,
        dateAktiv: cardObj.dateAktiv
    };
    console.log(jsonData.selectedTime);

    console.log(JSON.stringify(jsonData));
    // Senden der POST-Anfrage mit JSON-Daten
    const response = await fetch("../database/insertSchema.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(jsonData)
    });
    if (!response.ok) {
        console.error("Fehler beim Einfügen:", response.statusText);
    } else {
        const result = await response.text();
        console.log(result);
    }
}
function createBodyCardObj() {
    var cardContainer = document.getElementById("cardContainer");
    if (!cardContainer) {
        console.error("Card container not found");
        return;
    }
    cardContainer.innerHTML = ""; // Clear existing content
    CardObj.list.forEach(cardObj => {
        const cardContainer = "cardContainer"
        cardObj.htmlBody(cardContainer);

    });
    console.log(CardObj.list);
    // Alle Checkboxen mit ID, die mit "flexCheck" beginnt, auswählen und loopen
};

function erstelleFunktionForCardObj(objID) {
    const checkbox = document.getElementById(`flexCheck${objID}`);
    const label = document.getElementById(`label${objID}`);
    const cbForSelectSchema = document.querySelectorAll('[id^="flexCheck"]');
    const labelForSelectSchema = document.querySelectorAll('[id^="label"]');
    if (checkbox.checked) {
        console.log("moew uwu kabum omi");
        const id = extractNumberFromString(checkbox.id);
        CardObj.selectedID = id; // Set the selected ID
        var obj = findObj(CardObj.list, id);
        deakAktivCb(false);
        CardObj.loadChanges(obj); // Load changes for the selected CardObj
        // CardObj.DateTimeHandler(obj);

        cbForSelectSchema.forEach(cb => {
            console.log(id + " " + extractNumberFromString(cb.id));

            if (id !== extractNumberFromString(cb.id)) {
                cb.checked = false;
            }
        });


        console.log("Checkbox mit ID " + id + " wurde aktiviert.");

        console.log(CardObj.selectedID);


        if (objID == CardObj.selectedID) {
            label.innerHTML = "Ausgewählt"; // Set the label text to "checked" when checked
            labelForSelectSchema.forEach(label => {
                if (id !== extractNumberFromString(label.id)) {
                    label.innerHTML = ""; // Clear the label text for unchecked checkboxes
                }
            });
        } else {
            label.innerHTML = ""; // Clear the label text for unchecked checkboxes
            console.log("Checkbox mit ID " + labelId + " wurde deaktiviert.");
        }
    } else {
        var checkA = document.getElementById("checkA");
        deakAktivCb(true);
        CardObj.selectedID = null; // Reset the selected ID
        labelForSelectSchema.forEach(label => {
            label.innerHTML = ""; // Clear the label text for unchecked checkboxes
        });
        checkA.checked = false;

    }
    Beziehungen.update(CardObj.selectedID);
}

function deakAktivCb(aktiv) {
    console.log("deakAktivCb aufgerufen mit aktiv:", aktiv);
    var titel = document.getElementById("websiteName");
    var checkA = document.getElementById("checkA");
    var btn_hinzufuegen = document.getElementById("btn_hinzufuegen");
    var btn_loeschen = document.getElementById("btn_loeschen");
    var btn_save_changes = document.getElementById("btn_save_changes");

    var panelForDateTime = document.getElementById("panelForDateTime");
    var anzeigeDauer = document.getElementById("anzeigeDauer");
    var selectSekunden = document.getElementById("selectSekunden");
    var btn_deleteInfoSeite = document.getElementById("btn_deleteInfoSeite");
    var tabelleDelete = document.getElementById("tabelleDelete");

    if (window.location.href.includes("templatebereich.php")) {
        return;
    }
    if (aktiv == true) {
        titel.disabled = true; // Deaktiviert das Titel-Eingabefeld
        titel.value = "Infoseite auswählen"; // Setzt den Titel auf leer
        anzeigeDauer.value = "Infoseite auswählen"; // Setzt den Titel auf leer
        checkA.disabled = true; // Deaktiviert die Aktiv-Checkbox
        btn_hinzufuegen.disabled = true; // Deaktiviert den Hinzufügen-
        btn_loeschen.disabled = true; // Deaktiviert den Löschen-Button
        btn_save_changes.disabled = true; // Deaktiviert den Speichern-Button

        anzeigeDauer.disabled = true; // Deaktiviert die Anzeige-Dauer

        selectSekunden.disabled = true; // Deaktiviert die Sekunden-Auswahl
        btn_deleteInfoSeite.disabled = true; // Deaktiviert den Löschen-Button für die Info-Seite   
        btn_deleteInfoSeite.disabled = true; // Deaktiviert den Löschen-Button für die Info-Seite   
        selectSekunden.value = ""; // Setzt die Sekunden-Auswahl auf leer
        tabelleDelete.innerHTML = ""    ; // Versteckt die Tabelle für das Löschen von Schemas
    } else {
        titel.disabled = false; // Aktiviert das Titel-Eingabefeld
        checkA.disabled = false; // Aktiviert die Aktiv-Checkbox
        btn_hinzufuegen.disabled = false; // Aktiviert den Hinzufügen-Button
        btn_loeschen.disabled = false; // Aktiviert den Löschen-Button
        btn_save_changes.disabled = false; // Aktiviert den Speichern-Button

        anzeigeDauer.disabled = false; // Aktiviert die Anzeige-Dauer
        selectSekunden.disabled = false; // Deaktiviert die Sekunden-Auswahl
        btn_deleteInfoSeite.disabled = false; // Aktiviert den Löschen-Button für die Info-Seite
        panelForDateTime.style.display = "block"; // Zeigt das Panel für Datum und Uhrzeit an
    }
}

function deaktivereCbx(aktiv) {
    const cardContainer = document.getElementById('cardContainer');
    if (cardContainer) {
        const checkboxes = cardContainer.querySelectorAll('input[type="checkbox"]');
        const labels = cardContainer.querySelectorAll('label[name^="label"]');
        console.log(`Checkboxes gefunden: ${checkboxes.length}, Labels gefunden: ${labels.length}`);

        checkboxes.forEach(checkbox => {
            checkbox.disabled = aktiv;

        });
        labels.forEach(label => {
            label.innerHTML = ""; // Clear the label text for unchecked checkboxes
        });
        CardObj.selectedID = null; // Update the checkAllowed state
        console.log(`${checkboxes.length} Checkboxes im cardContainer wurden deaktiviert`);

    } else {
        console.log("cardContainer nicht gefunden");
    }
}

