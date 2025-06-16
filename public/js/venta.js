document.addEventListener('DOMContentLoaded', function () {
    const selectCliente = document.getElementById('id_cliente');
    const inputClienteId = document.getElementById('cliente_id');

    selectCliente.addEventListener('change', function () {
        inputClienteId.value = this.value;
    });

    const selectMaterial = document.getElementById('id_material');
    const inputCodigo = document.getElementById('codigo');
    const inputPrecio = document.getElementById('precio');
    const inputUnidad = document.getElementById('unidad');
    const inputStock = document.getElementById('stock');

    selectMaterial.addEventListener('change', function () {
        const selected = this.options[this.selectedIndex];
        inputCodigo.value = selected.value;
        inputPrecio.value = selected.getAttribute('data-precio');
        inputUnidad.value = selected.getAttribute('data-unidad');
        inputStock.value = selected.getAttribute('data-stock');
    });

    const inputCantidad = document.getElementById('cantidad');
    const tablaDetalles = document.getElementById('detalles').querySelector('tbody');
    const totalVenta = document.getElementById('total');
    const btnAgregarArt = document.getElementById('btnAgregarArt');
    let total = 0;
//boton para agregar
    btnAgregarArt.addEventListener('click', function () {
        const idMaterial = selectMaterial.value;
        const descripcion = selectMaterial.options[selectMaterial.selectedIndex].text;
        const precio = parseFloat(inputPrecio.value);
        const stock = parseInt(inputStock.value);
        const cantidad = parseInt(inputCantidad.value);

        if (!idMaterial || !cantidad || cantidad <= 0 || cantidad > stock) {
            alert('Datos inválidos');
            return;
        }

        //verificar si el productro ya fue agregado
        const filas = tablaDetalles.querySelectorAll('tr');
        for(let fila of filas){
            const idFila = fila.children[0].textContent;
            if(idFila === idMaterial){
                alert(`El producto "${descripcion}" ya ha sido agregado.`);
                return;
            }
        }

        const subtotal = precio * cantidad;
        total += subtotal;

        const fila = document.createElement('tr');
        fila.innerHTML = `
            <td>${idMaterial}</td>
            <td>${descripcion}</td>
            <td>${stock}</td>
            <td>${precio.toFixed(2)}</td>
            <td>${cantidad}</td>
            <td>${subtotal.toFixed(2)}</td>
            <td><button type="button" class="btn btn-danger btn-sm btnEliminar"><i class="fa fa-trash"></i></button></td>
        `;
        tablaDetalles.appendChild(fila);

        totalVenta.innerHTML = `Bs. ${total.toFixed(2)}`;
        document.getElementById('total_venta').value = total.toFixed(2);
        inputCantidad.value = '';
    });

    tablaDetalles.addEventListener('click', function (e) {
        if (e.target.closest('.btnEliminar')) {
            const fila = e.target.closest('tr');
            const subtotal = parseFloat(fila.children[5].textContent);
            total -= subtotal;
            totalVenta.innerHTML = `Bs. ${total.toFixed(2)}`;
            document.getElementById('total_venta').value = total.toFixed(2);
            fila.remove();
        }
    });

    const btnGuardar = document.getElementById('btnGuardar');
    const formulario = document.getElementById('formulario');

//boton guardar
    btnGuardar.addEventListener('click', function (e) {
        e.preventDefault();

        if (!selectCliente.value || !document.getElementById('fecha').value) {
            alert('Completa los campos requeridos');
            return;
        }

        const filas = tablaDetalles.querySelectorAll('tr');
        const detalles = [];

        filas.forEach(fila =>{
            const idMaterial = fila.children[0].textContent;
            const cantidad = parseInt(fila.children[4].textContent);
            const precio = parseFloat(fila.children[3].textContent);


            detalles.push({
                id_material: idMaterial,
                cantidad: cantidad,
                precio: precio

            });
        });

        if(detalles.length === 0) {
            alert('Agrega al menos un detalle de venta');
            return;
        }
        document.getElementById('detalles_json').value = JSON.stringify(detalles);

    
        formulario.submit();
    });
});