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

                    createTableEdit(json);
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

    loadViewLine();
}



function loadViewLine() {

    try {
        let dataSetQuote = '{"POST":"LINE"}';
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "../../../php/bo/bo_quote.php", true);
        xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                let json = JSON.parse(xhttp.responseText);
                if (xhttp.responseText != 0) {

                    console.log(json);
                    createTableEdit(json);

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





function getItems(e) {
    let mp = document.getElementById("selectMp").value;
    let line = document.getElementById("selectLine").value;
    //console.log(mp + " " + line);


    loadViewMP(mp, line);

    e.preventDefault();
}




function createTableEdit(json) {
    let thead = '<thead><tr><th>Número</th><th>Nombre de la Línea</th><th>Selección</th><th>Acción</th></tr></thead>';
    let tbody = '<tbody>';
    let tfoot = ' <tfoot></tfoot> ';
    for (let i = 0; i < json.length; i++) {

        tbody += '<tr id="row_' + json[i]["id_line"] + '"><td>' + json[i]["id_line"] + '</td><td><input type="text" class="form-control" value="' + json[i]["name_line"] + '" disabled></td><td><input type="radio" onclick="getRow(this.value)" name="items" value="' + json[i]["id_line"] + '"></td><td><button type="button" onclick="changeCost(' + "'" + json[i]["id_line"] + "'" + ')"class="btn btn-primary mb-2" disabled><i class="fas fa-save"></i></button></td></tr>';
    }
    tbody += '</tbody>';
    document.getElementById("dataTableEdit").innerHTML = thead + tfoot + tbody;


}

function getRow(strValue) {
    let idRow = "row_" + strValue;
    let objRow = document.getElementById(idRow);
    let objInput = objRow.querySelectorAll("input");
    let objButton = objRow.querySelectorAll("button");
    // alert(strValue);
    disableRadio(true);
    for (let i = 0; i < objInput.length; i++) {
        //console.log();
        let objType = objInput[i].type;

        if (objType == "text") {
            objInput[i].disabled = false;
            for (let j = 0; j < objButton.length; j++) {
                objButton[j].disabled = false;
                objButton[j].classList.remove('btn-primary');
                objButton[j].classList.add('btn-warning');
            }

        }

    }
}

function disableRadio(state) {
    let objTable = document.getElementById("dataTableEdit");
    let objInput = objTable.querySelectorAll("input");

    for (let i = 0; i < objInput.length; i++) {
        //console.log();
        let objType = objInput[i].type;

        if (objType == "radio") {
            objInput[i].disabled = state;
        }
    }
}

function disableText(state) {
    let objTable = document.getElementById("dataTableEdit");
    let objInput = objTable.querySelectorAll("input");

    for (let i = 0; i < objInput.length; i++) {
        //console.log();
        let objType = objInput[i].type;

        if (objType == "text") {
            objInput[i].disabled = state;
        }
    }
}

function disableButton(state) {
    let objTable = document.getElementById("dataTableEdit");
    let objButton = objTable.querySelectorAll("button");

    for (let i = 0; i < objButton.length; i++) {
        //console.log();
        objButton[i].disabled = state;
        //objButton[i].classList.remove('btn-success');
        //objButton[i].classList.add('btn-primary');
    }
}

function changeCost(dataId) {
    let idRow = "row_" + dataId;
    let objRow = document.getElementById(idRow);
    let objInput = objRow.querySelectorAll("input");
    let objButton = objRow.querySelectorAll("button");
    let mp = document.getElementById("selectMp").value;
    let line = document.getElementById("selectLine").value;
    let srtVar = "";
    let expreg = /^([0-9])*$/;
    let validate = true;
    disableButton(true);
    for (let i = 0; i < objInput.length; i++) {
        let objType = objInput[i].type;
        if (objType == "text") {
            srtVar = objInput[i].value;
            if ((srtVar.length >= 1 || srtVar != "") && !expreg.test(srtVar)) {
                for (let j = 0; j < objButton.length; j++) {
                    objButton[j].disabled = true;
                    objButton[j].classList.remove('btn-primary', 'btn-warning');
                    objButton[j].classList.add('btn-success');
                }
            } else {
                for (let j = 0; j < objButton.length; j++) {
                    objButton[j].disabled = false;

                }
                validate = false;
                alert("Valide la información");
                break;

            }
        }
    }
    if (validate) {
        disableText(true);
        disableRadio(false);
        console.log(srtVar + "-" + mp + "-" + line + "-" + dataId);
    }

}