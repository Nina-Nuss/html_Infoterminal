

class Beziehungen {
    static list = [];
    static temp_remove = [];
    static eleListe = [];
    static temp_add = [];
    static temp_list_add = [];
    static temp_list_remove = [];
    constructor(id, umgebungsID, cardObjektID) {
        this.id = id;
        this.umgebungsID = umgebungsID;
        this.cardObjektID = cardObjektID;
        Beziehungen.list.push(this);
    }
    static async getRelation() {
        try {
            const response = await fetch('../database/selectRelation.php', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                },
            });
            var relationlistee = await response.json();
            return relationlistee;
        } catch (error) {
            console.error("Fehler beim Abrufen der Beziehungen:", error);
            return [];
        }
    }
    static async update(cardObjID) {
        Beziehungen.list = [];

        const relationListe = await Beziehungen.getRelation();
        console.log(relationListe);
        relationListe.forEach(element => {
            new Beziehungen(element[0], element[1], element[2]);
        });

        if (Umgebung.list.length !== 0) {
            console.log("Umgebungsliste ist nicht leer, führe createList aus");
        }
        console.log(Umgebung.list);

        this.temp_remove = [];
        this.temp_list_add = [];
        this.temp_list_remove = [];
        this.temp_list = [];
        console.log("Update wird aufgerufen mit CardObjektID: " + cardObjID);

        this.createList(cardObjID)
        console.log("Temp Liste Add: " + this.temp_add);
        console.log("Temp Liste Remove: " + this.temp_remove);
        if (CardObj.selectedID != null) {
            this.createListForAnzeige();
        }

    }

    static createListForAnzeige() {

        var anzeigebereichV = document.getElementById("anzeigebereichV");
        var anzeigebereicht = document.getElementById("tabelleAdd");
        var anzeigebereichD = document.getElementById("tabelleDelete");

        anzeigebereichV.innerHTML = "";
        anzeigebereicht.innerHTML = "";
        anzeigebereichD.innerHTML = "";

        // Display items to remove
        if (anzeigebereichD && this.temp_remove.length > 0) {
            this.temp_remove.forEach(umgebungsId => {
                let obj = erstelleObj(umgebungsId);
                if (obj) {
                    anzeigebereichD.innerHTML += `<tr>
                    <td>${obj.id}</td>
                    <td>${obj.ipAdresse}</td>
                    <td>${obj.titel}</td>
                    <td><input type="checkbox" name="${obj.id}" id="checkDel${obj.id}" onchange="Beziehungen.event_remove(${obj.id})"></td>
                </tr>`;

                }
            });
        }

        // Display items to add
        if (anzeigebereicht && this.temp_add.length > 0) {
            this.temp_add.forEach(umgebungsId => {
                let obj = erstelleObj(umgebungsId);
                if (obj) {
                    anzeigebereicht.innerHTML += `<tr>
                    <td>${obj.id}</td>
                    <td>${obj.ipAdresse}</td>
                    <td>${obj.titel}</td>
                    <td><input type="checkbox" name="${obj.id}" id="checkAdd${obj.id}" onchange="Beziehungen.event_add(${obj.id})"></td>
                </tr>`;
                }
            });
        }

        if (anzeigebereichV != null) {
            console.log("anzeigebereichv ist nicht null, füge Elemente hinzu");
            this.temp_remove.forEach(umgebungsId => {
                let obj = erstelleObj(umgebungsId);
                if (obj) {
                    anzeigebereichV.innerHTML += `<div style="display: flex;">
                    <span name="${obj.titel}" id="${obj.id}" style="float: left;  margin-right: 10px;">${obj.ipAdresse}</span>
                    <label for="Schulaula" class="text-wrap" value="15">${obj.titel}</label>
                </div>`;
                }
            });
        } else {
            console.log("anzeigebereichV ist null, keine Elemente hinzugefügt");
        }

        console.log("Temp Remove verarbeitet:", this.temp_remove);
        console.log("Temp Add verarbeitet:", this.temp_add);
    }
    static createList(cardObjID) {
        console.log("createList aufgerufen mit CardObjektID: " + cardObjID);
        // Clear arrays first
        Beziehungen.temp_remove = [];
        Beziehungen.temp_add = [];

        Beziehungen.list.forEach(ele => {
            if (ele.cardObjektID == cardObjID) {
                console.log(`Beziehung gefunden: ${ele.id} mit CardObjektID: ${ele.cardObjektID}`);
                Beziehungen.temp_remove.push(ele.umgebungsID);
            }
        });
        // Find available umgebungsIDs (not connected to this cardObjID)
        Umgebung.list.forEach(umgebung => {
            if (!Beziehungen.temp_remove.includes(umgebung.id)) {
                Beziehungen.temp_add.push(umgebung.id);
            }
        });
        console.log("Temp Remove:", Beziehungen.temp_remove);
        console.log("Temp Add:", Beziehungen.temp_add);
        console.log("Beziehungen Temp Add:", Umgebung.list);

    }

    static event_remove(id) {
        console.log(`Event remove aufgerufen für ID: ${id}`);
        var element = document.getElementById(`checkDel${id}`);
        if (!this.temp_list_remove.includes(id)) {
            element.checked = true;
            this.temp_list_remove.push(id);
        } else {
            element.checked = false;
            this.temp_list_remove = this.temp_list_remove.filter(idd => id != idd);
        }
        console.log(this.temp_list_remove);
    }

    static event_add(id) {
        console.log(`Event add aufgerufen für ID: ${id}`);
        var element = document.getElementById(`checkAdd${id}`);
        if (!this.temp_list_add.includes(id)) {
            element.checked = true;
            this.temp_list_add.push(id);
        } else {
            element.checked = false;
            this.temp_list_add = this.temp_list_add.filter(idd => id != idd);
        }
        console.log(this.temp_list_add);
    }

    static async removeFromListLogik(id, list, databaseUrl) {
        for (const umgebungsID of list) {
            await this.addToDatabaseViaID(id, umgebungsID, databaseUrl);
        };
    }

    static showBeziehungsList() {
        const selectorInfoterminalForCards = document.getElementById('selectorInfoterminalForCards');
        if (selectorInfoterminalForCards != null) {
            selectorInfoterminalForCards.addEventListener('change', async (event) => {
                const selectedValue = event.target.value;
                console.log("Ausgewählter Wert:", selectedValue);
                if (selectedValue) {
                    let cardContainer = document.getElementById("cardContainer");
                    console.log("Kartencontainer gefunden:", cardContainer);
                    cardContainer.innerHTML = ''
                    Beziehungen.list.forEach(beziehung => {
                        if (selectedValue == beziehung.umgebungsID) {
                            let obj = findObj(CardObj.list, beziehung.cardObjektID);
                            console.log(obj);
                            obj.htmlBody("cardContainer");
                        }
                        // Hier kannst du die Logik hinzufügen, um die Beziehung anzuzeigen
                    });
                }
                // Hier können Sie die Logik hinzufügen, um die Beziehungen basierend auf dem ausgewählten Wert anzuzeigen
            });
        }
    }

    static async remove_generate(id, list, databaseUrl) {
        if (CardObj.selectedID == null || id === undefined || list === undefined || databaseUrl === undefined) {
            return;

        }
        console.log("remove_generate aufgerufen mit ID:", id, "List:", list, "Database URL:", databaseUrl);
        await this.removeFromListLogik(id, list, databaseUrl);

        this.update(id);
    }

    static async addToDatabaseViaID(cardObjektID, umgebungsID, databaseUrl) {
        console.log("addToDatabaseViaID aufgerufen mit UmgebungsID:", umgebungsID, "CardObjektID:", cardObjektID);
        await fetch(`../database/${databaseUrl}.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                umgebungsID: umgebungsID,
                cardObjektID: cardObjektID
            })
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.text();
            })
            .then(responseText => {
                try {
                    const jsonResponse = JSON.parse(responseText);
                    console.log("Daten erfolgreich hinzugefügt:", jsonResponse);
                } catch (jsonError) {
                    console.error("Fehler beim Parsen der Antwort:", jsonError);
                    console.log("Response Text:", responseText);
                }
            })
            .catch(error => {
                console.error("Fehler beim Hinzufügen der Daten:", error);
            });
    }

}


function leereListe(anzeigebereich) {
    if (anzeigebereich != null) {
        anzeigebereich.innerHTML = "";
    }
}


window.addEventListener("load", async () => {

    const relationListe = await Beziehungen.getRelation();
    console.log(relationListe);
    relationListe.forEach(element => {
        new Beziehungen(element[0], element[1], element[2]);
    });
    Beziehungen.showBeziehungsList();

})

function erstelleObj(element) {
    let obj = undefined;
    Umgebung.list.forEach(umgebung => {
        if (umgebung.id === element) {
            obj = {
                titel: umgebung.titel,
                ipAdresse: umgebung.ipAdresse,
                id: umgebung.id,
            };

        }
    });
    return obj;
}
