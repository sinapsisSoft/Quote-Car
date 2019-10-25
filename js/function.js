var GET_JSON = "";
var arrayDealers;

function selectDealers(id) {
    //console.log(arrayDealers);
    let idCont = id - 1;
    document.getElementById("address").value = arrayDealers[idCont]["addres_branch_office"];
    document.getElementById("dealers").value = arrayDealers[idCont]["name_branch_office"];
    //console.log(arrayDealers);

}

function sendData(idForm, e) {

    if (idForm == "form-0") {
        $("#form-0").fadeOut("slow", function() {
            $("#form-1").removeClass("d-none");
            $("#groudButton").removeClass("d-none");
            $("#table-result").addClass("d-none");
            $("#btnSendMail").prop("disabled", true);
            $("#model").prop("disabled", true);
            $("#km").prop("disabled", true);
        });

        loadViewLine();
        loadViewKM();
    }
    if (idForm == "form-1") {
        sendQuote();

        //     sendMail(); //Aqui se debe enviar el id que retorna sendquote

    }
    e.preventDefault();
}

function back(id) {

    if (id == 0) {
        $("#table-result").addClass("d-none");
        $("#form-0").fadeIn("slow");
        $("#form-1").addClass("d-none");
        $("#groudButton").addClass("d-none");
        $("#btnSendMail").prop("disabled", false);
        $("#model").prop("disabled", false);
        $("#km").prop("disabled", false);
    }



}

function calculateMP(id) {
    let idLine = document.getElementById("line").value;
    let idKm = document.getElementById("km").value;
    loadViewMP(idLine, idKm);

}

function sendMail(consec) {
    try {
        let dataSetQuote = '{"POST":"MAIL","consec":"' + consec + '",' + GET_JSON;
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "mail/notification.php", true);
        xhttp.setRequestHeader("Content-Type", "application/json; charset=UTF-8");
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                console.log(xhttp.responseText);
                if (xhttp.responseText != 0) {
                    alert("Cotización enviada con éxito");
                    window.location.assign("https://jacmotors.com.co/Quote-Car/form.html")
                } else {
                    alert("Error al enviar el correo");
                }
            }
        }
        xhttp.send(dataSetQuote);
    } catch (error) {
        console.error(error);
        alert("Se presentó un error en el registro");
    }


}

function sendQuote() {

    try {
        let dataSetQuote = '{"POST":"CREATE",' + GET_JSON;
        var xhttp = new XMLHttpRequest();

        xhttp.open("POST", "php/bo/bo_quote.php", true);
        xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {

                let json = JSON.parse(xhttp.responseText);

                if (xhttp.responseText.length != 0 || xhttp.responseText != "") {
                    sendMail(json[0]["code_quote"]);
                    // return true;
                    //console.log(json[0]["code_quote"]);
                } else {
                    //return false;
                    alert("Se presento un error al crear la cotización");
                }
            }
        }
        xhttp.send(dataSetQuote);

    } catch (error) {
        console.error(error);
        alert("Se presentó un error en el registro");
        return false;
    }
}

function loadViewPageCity() {

    try {
        let dataSetQuote = '{"POST":"CITY"}';
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "php/bo/bo_quote.php", true);
        xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                let json = JSON.parse(xhttp.responseText);
                if (xhttp.responseText != 0) {
                    //alert("Correo enviado con éxito");
                    createSelect("city", json, 0);
                } else {

                    //alert("Error al enviar el correo");
                }
            }
        }
        xhttp.send(dataSetQuote);
    } catch (error) {
        console.error(error);
        alert("Se presentó un error en el registro");
    }
}

function loadViewPageBranchOffice() {

    try {
        let dataSetQuote = '{"POST":"OFFICE"}';
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "php/bo/bo_quote.php", true);
        xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                let json = JSON.parse(xhttp.responseText);
                if (xhttp.responseText != 0) {
                    //alert("Correo enviado con éxito");
                    arrayDealers = json;
                } else {

                    //alert("Error al enviar el correo");
                }
            }
        }
        xhttp.send(dataSetQuote);
    } catch (error) {
        console.error(error);
        alert("Se presentó un error en el registro");
    }
}

function loadViewLine() {

    try {
        let dataSetQuote = '{"POST":"LINE"}';
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "php/bo/bo_quote.php", true);
        xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                let json = JSON.parse(xhttp.responseText);
                if (xhttp.responseText != 0) {
                    //alert("Correo enviado con éxito");
                    createSelect("line", json, 1);
                } else {

                    //alert("Error al enviar el correo");
                }
            }
        }
        xhttp.send(dataSetQuote);
    } catch (error) {
        console.error(error);
        alert("Se presentó un error en el registro");
    }
}

function loadViewKM() {

    try {
        let dataSetQuote = '{"POST":"KM"}';
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "php/bo/bo_quote.php", true);
        xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                let json = JSON.parse(xhttp.responseText);
                if (xhttp.responseText != 0) {
                    //alert("Correo enviado con éxito");
                    createSelect("km", json, 2);
                } else {

                    //alert("Error al enviar el correo");
                }
            }
        }
        xhttp.send(dataSetQuote);
    } catch (error) {
        console.error(error);
        alert("Se presentó un error en el registro");
    }
}

function loadViewMP(line, mp) {

    try {
        let dataSetQuote = '{"POST":"MP","line":"' + line + '","mp":"' + mp + '"}';
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "php/bo/bo_quote.php", true);
        xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                let json = JSON.parse(xhttp.responseText);
                if (xhttp.responseText != 0) {
                    //console.log(json);
                    createTable(json);
                } else {

                }
            }
        }
        xhttp.send(dataSetQuote);
    } catch (error) {
        console.error(error);
        alert("Se presentó un error en el registro");
    }
}

function loadView() {
    loadViewPageCity();
    loadViewPageBranchOffice();
}

function createSelect(id, json, type) {
    var objSelect = document.getElementById(id);
    let strOption = "<option>Seleccione</option>";
    for (let i = 0; i < json.length; i++) {
        if (type == 0) {
            strOption += '<option value="' + json[i]["id_city"] + '">' + json[i]["name_city"] + '</option>';
        } else if (type == 1) {
            strOption += '<option value="' + json[i]["id_line"] + '">' + json[i]["name_line"] + '</option>';
        } else if (type == 2) {
            strOption += '<option value="' + json[i]["id_mp"] + '">' + json[i]["name_mp"] + '</option>';
        }
    }
    objSelect.innerHTML = strOption;
    //console.log(json);
}


function createTable(json) {
    let tbody = "";
    let tfoot = "";
    let cost = 0;
    let name = document.getElementById("name").value;
    let doc = document.getElementById("document").value;
    let mail = document.getElementById("email").value;
    let cellphone = document.getElementById("cellPhone").value;
    let city = document.getElementById("city").value;
    let dealers = document.getElementById("dealers").value;
    let address = document.getElementById("address").value;
    let objLine = document.getElementById("line");
    let line = objLine.options[objLine.selectedIndex].text;
    let objKm = document.getElementById("km");
    let km = objKm.options[objKm.selectedIndex].text;
    let model = document.getElementById("model").value;
    let thead = '<label><h2>Resumen</h2></label><thead class="thead-light"><tr class="text-center"><th scope="col">#</th><th scope="col">Nombre</th><th scope="col">Correo</th><th scope="col">Celular</th><th scope="col">Concesionario</th><th scope="col">Linea</th><th scope="col">Km</th><th scope="col">Modelo</th></tr></thead>';
    tbody = '<tbody><tr><td>1</td>';
    tbody += '<td class="text-center">' + name + '</td>';
    tbody += '<td class="text-center">' + mail + '</td>';
    tbody += '<td class="text-center">' + cellphone + '</td>';
    tbody += '<td class="text-center">' + address + '</td>';
    tbody += '<td class="text-center">' + line + '</td>';
    tbody += '<td class="text-center">' + km + '</td>';
    tbody += '<td class="text-center">' + model + '</td></tr>';
    tbody += '<tr><th scope="col" class="text-center"colspan="6">Ítems</th><th colspan="2"class="text-center" scope="col">Costo</th></tr>';
    for (let i = 0; i < json.length; i++) {
        cost += parseInt(json[i]["cost_article_mp"]);
        tbody += '<tr><td colspan="6">' + json[i]["name_article"] + '<td class="text-right">$</td></td><td class="text-right">' + json[i]["cost_article_mp"].toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') + '</td></tr>';
    }
    // console.log(json);
    tfoot = '<tfoot><tr><td colspan="6" class="text-center">Total</td><td class="text-right">$</td><td class="text-right">' + cost.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') + '</td></tr></tfoot>';

    $("#table-result").removeClass("d-none");
    $("#table-result").fadeIn("slow");
    $("#btnSendMail").prop("disabled", false);
    document.getElementById("table-result").innerHTML = thead + tbody + tfoot;
    GET_JSON = '"idLine":"' + objLine.value + '","idMP":"' + objKm.value + '","name":"' + name + '","mail":"' + mail + '","cellphone":"' + cellphone + '","line":"' + line + '","km":"' + km + '","model":"' + model + '","doc":"' + doc + '","address":"' + address + '","city":"' + city + '"}';
}

function disabledObj(id) {
    let obj = document.getElementById(id);
    if (obj.disabled) {
        obj.disabled = false;
    } else {
        obj.disabled = true;
    }
}