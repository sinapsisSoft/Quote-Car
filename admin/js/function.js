function loadView() {
    loadViewPageQoute();
};

function loadViewPageQoute() {

    try {
        let dataSetQuote = '{"POST":"QUOTE"}';
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "../php/bo/bo_quote.php", true);
        xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                let json = JSON.parse(xhttp.responseText);
                if (xhttp.responseText != 0) {
                    //alert("Correo enviado con éxito");
                    //createSelect("city", json, 0);
                    //console.log(json);
                    createTable(json);
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

function loadItem() {
    loadViewMp();
    loadViewLine();
}

function loadViewMp() {

    try {
        let dataSetQuote = '{"POST":"KM"}';
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "../php/bo/bo_quote.php", true);
        xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                let json = JSON.parse(xhttp.responseText);
                if (xhttp.responseText != 0) {

                    // console.log(json);
                    createSelect("selectMp", json, 2);

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
        xhttp.open("POST", "../php/bo/bo_quote.php", true);
        xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                let json = JSON.parse(xhttp.responseText);
                if (xhttp.responseText != 0) {

                    //console.log(json);
                    createSelect("selectLine", json, 1);

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

function createTable(json) {
    let thead = '<thead><tr><th>Codigo</th><th>Documento</th><th>Nombre</th><th>Ciudad</th><th>Línea</th><th>Mantenimiento</th></tr></thead>';
    let tbody = '<tbody>';
    let tfoot = ' <tfoot></tfoot> ';
    for (let i = 0; i < json.length; i++) {

        tbody += '<tr><td>' + json[i]["code_quote"] + '</td><td>' + json[i]["document_client"] + '</td><td>' + json[i]["name_client"] + '</td><td>' + json[i]["name_city"] + '</td><td>' + json[i]["name_line"] + '</td><td>' + json[i]["name_mp"] + '</td></tr>';
    }
    tbody += '</tbody>';
    document.getElementById("dataTable").innerHTML = thead + tfoot + tbody;


}

function createSelect(id, json, type) {
    var objSelect = document.getElementById(id);
    let strOption = "<option>Seleccione</option>";

    for (let i = 0; i < json.length; i++) {

        if (type == 1) {
            strOption += '<option value="' + json[i]["id_line"] + '">' + json[i]["name_line"] + '</option>';
        } else if (type == 2) {
            strOption += '<option value="' + json[i]["id_mp"] + '">' + json[i]["name_mp"] + '</option>';
        }
    }
    objSelect.innerHTML = strOption;
    //console.log(json);
}

function getItems(e) {
    let mp = document.getElementById("selectMp").value;
    let line = document.getElementById("selectLine").value;
    //console.log(mp + " " + line);


    loadViewMP(mp, line);

    e.preventDefault();
}



function loadViewMP(line, mp) {

    try {
        let dataSetQuote = '{"POST":"MP","line":"' + line + '","mp":"' + mp + '"}';
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "../php/bo/bo_quote.php", true);
        xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                let json = JSON.parse(xhttp.responseText);
                if (xhttp.responseText != 0) {
                    //console.log(json);

                    createTableEdit(json);
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

function createTableEdit(json) {
    let thead = '<thead><tr><th>Ítem</th><th>Costo</th><th>Acción</th></tr></thead>';
    let tbody = '<tbody>';
    let tfoot = ' <tfoot></tfoot> ';
    for (let i = 0; i < json.length; i++) {

        tbody += '<tr><td>' + json[i]["name_article"] + '</td><td>' + json[i]["cost_article_mp"] + '</td><td><input type="radio" name="items" value="' + json[i]["id_article_mp"] + '"> <i class="fas fa-save"></i></div></td></tr>';
    }
    tbody += '</tbody>';
    document.getElementById("dataTableEdit").innerHTML = thead + tfoot + tbody;


}