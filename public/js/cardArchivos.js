function omitir(id, nombre) {
	// Obtener el input del archivo y el contenedor del icono
	var facturaInput = document.getElementById(id);
	var nullInput = document.getElementById("omitido"+ id);
	var iconContainer = document.getElementById("iconContainer" + id);
	var omitirFacturaButton = document.getElementById("omitirButton" + id);
	var cancelarOmitirButton = document.getElementById("cancelarOmitirButton" + id);
	var FechaInput = document.getElementById("fecha" + id);

	// Deshabilitar el input del archivo
	facturaInput.disabled = true;
	FechaInput.disabled = true;
	//checkboxInput.disabled = true;
	FechaInput.value = null;
	

	// Cambiar el valor del input a 1
	facturaInput.value = "";
	nullInput.value = '1'

	// Cambiar el icono en el contenedor
	iconContainer.innerHTML =
		'<lord-icon src="https://cdn.lordicon.com/jvihlqtw.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';

	// Mostrar el botón "Cancelar" y ocultar el botón "Omitir"
	omitirFacturaButton.style.display = "none";
	cancelarOmitirButton.style.display = "block";
}

function cancelarOmitir(id, nombre) {

	// Obtener el input del archivo y el contenedor del icono
	var facturaInput = document.getElementById(id);
	var nullInput = document.getElementById("omitido"+ id);
	var iconContainer = document.getElementById("iconContainer" + id);
	var omitirFacturaButton = document.getElementById("omitirButton" + id);
	var cancelarOmitirButton = document.getElementById("cancelarOmitirButton" + id);
	var FechaInput = document.getElementById("fecha" + id);

	// Habilitar el input del archivo, la fecha y el comentario
	facturaInput.disabled = false;

	// Restaurar el valor del input a su estado original (vacío)
	facturaInput.value = "";
	nullInput.value = '0'

	// Restaurar el icono original en el contenedor
	iconContainer.innerHTML =
		'<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';

	// Mostrar el botón "Omitir" y ocultar el botón "Cancelar"
	omitirFacturaButton.style.display = "block";
	cancelarOmitirButton.style.display = "none";
}

function handleCheckboxChange(id) {
var checkboxInput = document.getElementById("check" + id);
var fechaInput = document.getElementById("fecha" + id);

if (checkboxInput.checked) {
	fechaInput.disabled = false;
} else {
	fechaInput.disabled = true;
	fechaInput.value = null;
}
}
let alertShown = true;
function handleDocumento(id, nombre) {
	var FechaInput = document.getElementById("fecha" + id);
	// Resto del código que utilizas para manejar los eventos, pero ahora con el ID proporcionado
	var facturaInput = document.getElementById(id);
	// var nullInput = document.getElementById(nombre);
	var downloadFacturaButton = document.getElementById("downloadButton" + id);
	var removeFacturaButton = document.getElementById("removeButton" + id);
	var omitirFacturaButton = document.getElementById("omitirButton" + id);
	var cancelarOmitirButton = document.getElementById("cancelarOmitirButton" + id);
	var iconContainer = document.getElementById("iconContainer" + id);
	var checkboxInput = document.getElementById("check" + id);

	facturaInput.addEventListener("click", function(event) {
		// if (!alertShown) {
		//     event.stopPropagation(); // Prevent the file explorer from opening immediately
		//     event.preventDefault(); // Prevent any default behavior

		//     Swal.fire({
		//         title: "¿Estás seguro?",
		//         text: "Se reemplazará la imagen actual por una nueva. ¿Deseas continuar?",
		//         icon: "warning",
		//         showCancelButton: true,
		//         confirmButtonColor: "#3085d6",
		//         cancelButtonColor: "#d33",
		//         confirmButtonText: "Continuar",
		//         cancelButtonText: "Cancelar",
		//     }).then((result) => {
		//         if (result.isConfirmed) {
		//             alertShown =
		//                 true; // Set the flag to true to prevent the alert from showing again
		//             facturaInput.click();
		//         }
		//     });
		// }
	});

	facturaInput.addEventListener("change", function(event) {
		if (event.target.files.length > 0) {
			var file = event.target.files[0];
			var fileURL = URL.createObjectURL(file);
			downloadFacturaButton.setAttribute("href", fileURL);
			downloadFacturaButton.style.display = "block";
			removeFacturaButton.style.display = "block";
			omitirFacturaButton.style.display = "none";
			cancelarOmitirButton.style.display = "none";
			// nullInput.value = id + '-1';
			alertShown = false;
			FechaInput.disabled = false;
			checkboxInput.checked = true;
			checkboxInput.style.visibility = "visible";
			iconContainer.innerHTML =
				'<lord-icon src="https://cdn.lordicon.com/nxaaasqe.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" style="width:50px;height:70px"></lord-icon>';
		} else {
			downloadFacturaButton.style.display = "none";
			removeFacturaButton.style.display = "none";
			omitirFacturaButton.style.display = "block";
			cancelarOmitirButton.style.display = "none";
			alertShown = true;
			FechaInput.disabled = true;
			checkboxInput.style.visibility = "hidden";
			iconContainer.innerHTML =
				'<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';
		}
	});

	removeFacturaButton.addEventListener("click", function() {
		facturaInput.value = null;
		downloadFacturaButton.removeAttribute("href");
		downloadFacturaButton.style.display = "none";
		removeFacturaButton.style.display = "none";
		omitirFacturaButton.style.display = "block";
		cancelarOmitirButton.style.display = "none";
		FechaInput.disabled = true;
		checkboxInput.style.visibility = "hidden";
		FechaInput.value = null;
		// nullInput.value = id;
		alertShown = true;
		iconContainer.innerHTML =
			'<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';
	});
}