function obtenerDatos() {
    let ciudadForm = document.getElementsByName('ciudad')[0].value;
    let tipoForm = document.getElementsByName('tipo')[0].value;
    if (!(ciudadForm === "") || !(tipoForm === "")) {
        // Ocultamos los datos anteriores
        document.getElementsByClassName('tarjeta')[0].style.display = 'none';
        // Insertamos los datos en el div
        traerDatos(ciudadForm, tipoForm);
    } else {
        document.getElementsByClassName('tarjeta')[0].style.display = 'block';
    }
}

function traerDatos(ciudadForm, tipoForm) {
    const xhttp = new XMLHttpRequest;
    xhttp.open('POST', './data-1.json', true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let datos = JSON.parse(this.response);
            let busqueda = document.querySelector('#busqueda');
            let numResultados = document.querySelector('#numResultados');
            busqueda.innerHTML = '';
            numResultados.innerHTML = '';
            var i = 0;

            for (let dato of datos) {
                if (dato.Ciudad === ciudadForm) {
                    if (dato.Tipo === tipoForm) {
                        var i = i + 1;
                        busqueda.innerHTML += `
                    <div id="${dato.Id}">
                        <div class="col s4 imagen">
                            <img  alt="" src="./img/home.jpg" width="130px">
                        </div>
                        <div class="col s8">
                            Direccion: ${dato.Direccion}<br>
                            Ciudad: ${dato.Ciudad}<br>
                            Telefono: ${dato.Telefono}<br>
                            Codigo_Postal: ${dato.Codigo_Postal}<br>
                            Tipo: ${dato.Tipo}<br>
                            Precio: ${dato.Precio}<br>
                            <form action="./controllers/agregar.php" method="post">
                                <input style="display: none;" type="text" name="Id_json" id="Id_json" value="${dato.Id}">
                                <input style="display: none;" type="text" name="Direccion" id="Direccion" value="${dato.Direccion}">
                                <input style="display: none;" type="text" name="Ciudad" id="Ciudad" value="${dato.Ciudad}">
                                <input style="display: none;" type="text" name="Telefono" id="Telefono" value="${dato.Telefono}">
                                <input style="display: none;" type="text" name="Codigo_Postal" id="Codigo_Postal" value="${dato.Codigo_Postal}">
                                <input style="display: none;" type="text" name="Tipo" id="Tipo" value="${dato.Tipo}">
                                <input style="display: none;" type="text" name="Precio" id="Precio" value="${dato.Precio}">
                                <input class="btn waves-effect waves-light" style="width: 50%;" type="submit" name="action"  value="Guardar">
                            </form>
                        </div>
                    </div>
                    <hr>`
                    }
                }
                numResultados.innerHTML = i;
            }
        }
    }
}