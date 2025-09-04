

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
<<<<<<< HEAD

=======
>>>>>>> origin/main
        const relationListe = await Beziehungen.getRelation();
        console.log(relationListe);
        relationListe.forEach(element => {
            new Beziehungen(element[0], element[1], element[2]);
        });

<<<<<<< HEAD
        if (Umgebung.list.length !== 0) {
            console.log("Umgebungsliste ist nicht leer, führe createList aus");
        }
        console.log(Umgebung.list);
=======
        if (Infoterminal.list.length !== 0) {
            console.log("Umgebungsliste ist nicht leer, führe createList aus");
        }
        console.log(Infoterminal.list);
>>>>>>> origin/main

        this.temp_remove = [];
        this.temp_list_add = [];
        this.temp_list_remove = [];
        this.temp_list = [];
        console.log("Update wird aufgerufen mit CardObjektID: " + cardObjID);

        this.createList(cardObjID)
        console.log("Temp Liste Add: " + this.temp_add);
        console.log("Temp Liste Remove: " + this.temp_remove);
<<<<<<< HEAD
        if (CardObj.selectedID != null) {
            this.createListForAnzeige();
        }

    }

    static createListForAnzeige() {

        var anzeigebereichV = document.getElementById("anzeigebereichV");
        var anzeigebereicht = document.getElementById("tabelleAdd");
        var anzeigebereichD = document.getElementById("anzeigebereichV");

        anzeigebereichV.innerHTML = "";
        anzeigebereicht.innerHTML = "";
        anzeigebereichD.innerHTML = "";

        // Display items to remove
        // if (anzeigebereichD && this.temp_remove.length > 0) {
        //     this.temp_remove.forEach(umgebungsId => {
        //         let obj = erstelleObj(umgebungsId);
        //         if (obj) {
        //             anzeigebereichD.innerHTML += `<tr>
        //             <td>${obj.titel}</td>
        //             <td><input type="checkbox" name="${obj.id}" id="checkDel${obj.id}" onchange="Beziehungen.event_remove(${obj.id})"></td>
        //         </tr>`;
        //         }
        //     });
        // }
=======
        if (Infoseite.selectedID != null) {
            this.createListForAnzeige();
        }
    }

    static createListForAnzeige() {
        var anzeigebereichA = document.getElementById("tabelleAdd");
        var anzeigebereichD = document.getElementById("tabelleDelete");
        var anzeigebereicht = document.getElementById("tabelleAdd");

        anzeigebereichA.innerHTML = "";
        anzeigebereichD.innerHTML = "";

        // Display items to remove
        if (anzeigebereichD && this.temp_remove.length > 0) {
            anzeigebereichD.innerHTML = `<tr>
                    <td>Alle auswählen</td>
                    <td><input type="checkbox" name="checkDelAll" id="checkDelAll" onchange="Beziehungen.remove_all(this)"></td>
                </tr>`;
            this.temp_remove.forEach(umgebungsId => {
                let obj = erstelleObj(umgebungsId);
                if (obj) {
                    anzeigebereichD.innerHTML += `<tr>
                    <td>${obj.titel}</td>
                    <td><input type="checkbox" name="${obj.id}" id="checkDel${obj.id}" onchange="Beziehungen.event_remove(${obj.id})"></td>
                </tr>`;
                }
            });
        }
>>>>>>> origin/main

        // Display items to add
        if (anzeigebereicht && this.temp_add.length > 0) {
            anzeigebereicht.innerHTML = `<tr>
                    <td>Alle auswählen</td>
                    <td><input type="checkbox" name="checkAddAll" id="checkAddAll" onchange="Beziehungen.add_all(this)"></td>
                </tr>`;
            this.temp_add.forEach(umgebungsId => {
                let obj = erstelleObj(umgebungsId);
                if (obj) {
                    anzeigebereicht.innerHTML += `<tr>
                    <td>${obj.titel}</td>
                    <td><input type="checkbox" name="${obj.id}" id="checkAdd${obj.id}" onchange="Beziehungen.event_add(${obj.id})"></td>
                </tr>`;
                }
            });
        }

<<<<<<< HEAD
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
=======
        // if (anzeigebereichD != null) {
        //     console.log("anzeigebereichv ist nicht null, füge Elemente hinzu");
        //     this.temp_remove.forEach(umgebungsId => {
        //         let obj = erstelleObj(umgebungsId);
        //         if (obj) {
        //             anzeigebereichD.innerHTML += `<div style="display: flex;">
        //             <span name="${obj.titel}" id="${obj.id}" style="float: left;  margin-right: 10px;">${obj.ipAdresse}</span>
        //             <label for="Schulaula" class="text-wrap" value="15">${obj.titel}</label>
        //         </div>`;
        //         }
        //     });
        // } else {
        //     console.log("anzeigebereichV ist null, keine Elemente hinzugefügt");
        // }
>>>>>>> origin/main

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
<<<<<<< HEAD
                console.log(`Beziehung gefunden: ${ele.id} mit CardObjektID: ${ele.cardObjektID}`);
=======

>>>>>>> origin/main
                Beziehungen.temp_remove.push(ele.umgebungsID);
            }
        });
        // Find available umgebungsIDs (not connected to this cardObjID)
<<<<<<< HEAD
        Umgebung.list.forEach(umgebung => {
=======
        Infoterminal.list.forEach(umgebung => {
>>>>>>> origin/main
            if (!Beziehungen.temp_remove.includes(umgebung.id)) {
                Beziehungen.temp_add.push(umgebung.id);
            }
        });
        console.log("Temp Remove:", Beziehungen.temp_remove);
        console.log("Temp Add:", Beziehungen.temp_add);
<<<<<<< HEAD
        console.log("Beziehungen Temp Add:", Umgebung.list);
=======
        console.log("Beziehungen Temp Add:", Infoterminal.list);
>>>>>>> origin/main

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

<<<<<<< HEAD
=======

>>>>>>> origin/main
    static async removeFromListLogik(id, list, databaseUrl) {
        for (const umgebungsID of list) {
            await this.addToDatabaseViaID(id, umgebungsID, databaseUrl);
        };
    }

    static add_all(cbx) {
        console.log(cbx);
        if (cbx.checked) {
            this.temp_add.forEach(id => {
                if (!this.temp_list_add.includes(id)) {
                    this.event_add(id);
                }
            });
        } else {
            this.temp_list_add.forEach(id => {
                if (this.temp_list_add.includes(id)) {
                    this.event_add(id);
                }

            });
            this.temp_list_add = [];
            console.log("Alle Elemente wurden abgewählt");
        }
    }
<<<<<<< HEAD
=======
    static remove_all(cbx) {
        console.log(cbx);
        if (cbx.checked) {
            this.temp_remove.forEach(id => {
                if (!this.temp_list_remove.includes(id)) {
                    this.event_remove(id);
                }
            });
        } else {
            this.temp_list_remove.forEach(id => {
                if (this.temp_list_remove.includes(id)) {
                    this.event_remove(id);
                }
            });
            this.temp_list_remove = [];
            console.log("Alle Elemente wurden abgewählt");
        }
    }
>>>>>>> origin/main

    static showBeziehungsList() {
        const selectorInfoterminalForCards = document.getElementById('selectorInfoterminalForCards');
        if (selectorInfoterminalForCards != null) {
            selectorInfoterminalForCards.addEventListener('change', async (event) => {
<<<<<<< HEAD
                const selectedValue = event.target.value;
                console.log(selectorInfoterminalForCards[0]);

=======
                Infoseite.überprüfenÄnderungen();
                const selectedValue = event.target.value;
                Infoseite.selectedID = null;
                console.log(selectorInfoterminalForCards[0]);
>>>>>>> origin/main
                console.log("Ausgewählter Wert:", selectedValue);
                if (selectedValue) {
                    let cardContainer = document.getElementById("cardContainer");
                    console.log("Kartencontainer gefunden:", cardContainer);
                    cardContainer.innerHTML = ''
<<<<<<< HEAD
                    Beziehungen.list.forEach(beziehung => {
                        if (selectedValue == beziehung.umgebungsID) {
                            let obj = findObj(CardObj.list, beziehung.cardObjektID);
                            console.log(obj);
                            obj.htmlBody("cardContainer");
                        }

                        // Hier kannst du die Logik hinzufügen, um die Beziehung anzuzeigen
                    });
                    if (selectedValue == "alle") {
                        CardObj.list.forEach(obj => {
=======
                    Infoseite.deaktiviereAllElements(true);
                    Infoseite.removeChanges();
                    Beziehungen.list.forEach(beziehung => {
                        if (selectedValue == beziehung.umgebungsID) {
                            let obj = findObj(Infoseite.list, beziehung.cardObjektID);
                            console.log(obj);
                            obj.htmlBody("cardContainer");
                        }
                        // Hier kannst du die Logik hinzufügen, um die Beziehung anzuzeigen
                    });
                    if (selectedValue == "alle") {
                        Infoseite.list.forEach(obj => {
>>>>>>> origin/main
                            console.log(obj);
                            obj.htmlBody("cardContainer");
                        });
                    }
<<<<<<< HEAD
                }
                // Hier können Sie die Logik hinzufügen, um die Beziehungen basierend auf dem ausgewählten Wert anzuzeigen
=======
                    wähleErstesInfoseite();
                }
>>>>>>> origin/main
            });
        }
    }

    static async remove_generate(id, list, databaseUrl) {
<<<<<<< HEAD
        if (CardObj.selectedID == null || id === undefined || list === undefined || databaseUrl === undefined) {
=======
        if (Infoseite.selectedID == null || id === undefined || list === undefined || databaseUrl === undefined) {
>>>>>>> origin/main
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
<<<<<<< HEAD


window.addEventListener("load", async () => {

=======
window.addEventListener("load", async () => {
>>>>>>> origin/main
    const relationListe = await Beziehungen.getRelation();
    console.log(relationListe);
    relationListe.forEach(element => {
        new Beziehungen(element[0], element[1], element[2]);
    });
    Beziehungen.showBeziehungsList();

})

function erstelleObj(element) {
    let obj = undefined;
<<<<<<< HEAD
    Umgebung.list.forEach(umgebung => {
=======
    Infoterminal.list.forEach(umgebung => {
>>>>>>> origin/main
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
