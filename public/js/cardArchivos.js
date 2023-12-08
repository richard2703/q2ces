
function omitir(id, nombre) {
	// Obtener el input del archivo y el contenedor del icono
	var facturaInput = document.getElementById(id);
	var nullInput = document.getElementById("omitido"+ id);
	var iconContainer = document.getElementById("iconContainer" + id);
	var omitirFacturaButton = document.getElementById("omitirButton" + id);
	var cancelarOmitirButton = document.getElementById("cancelarOmitirButton" + id);
	var FechaInput = document.getElementById("fecha" + id);

	// Deshabilitar el input del archivo
	facturaInput != null ? facturaInput.disabled = true: null;
	FechaInput != null ? FechaInput.disabled = true : null;
	//checkboxInput.disabled = true;
	FechaInput != null ? FechaInput.value = null: null;
	

	// Cambiar el valor del input a 1
	facturaInput != null ? facturaInput.value = "": null;
	nullInput != null ? nullInput.value = '1': null;

	// Cambiar el icono en el contenedor
	iconContainer != null ? iconContainer.innerHTML =
		'<lord-icon src="https://cdn.lordicon.com/jvihlqtw.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>': null;

	// Mostrar el botón "Cancelar" y ocultar el botón "Omitir"
	omitirFacturaButton != null ? omitirFacturaButton.style.display = "none" : null;
	cancelarOmitirButton != null ? cancelarOmitirButton.style.display = "block": null;
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
	function handleDocumento(id, nombre, isEdit, ruta) {
		
		var FechaInput = document.getElementById("fecha" + id);
		// Resto del código que utilizas para manejar los eventos, pero ahora con el ID proporcionado
		var facturaInput = document.getElementById(id);
		var nullInput = document.getElementById(nombre);

		document.getElementById('modificacion' + id).value = '1';
		
		var downloadFacturaButton = document.getElementById("downloadButton" + id);
		var removeFacturaButton = document.getElementById("removeButton" + id);
		var omitirFacturaButton = document.getElementById("omitirButton" + id);
		var cancelarOmitirButton = document.getElementById("cancelarOmitirButton" + id);
		var iconContainer = document.getElementById("iconContainer" + id);
		var checkboxInput = document.getElementById("check" + id);
		facturaInput.addEventListener("change", function(event) {
			let alertShownEdit = false;
			// Aquí verificamos si ya hay un documento en ruta
			console.log('facturaInput.value', facturaInput.value);
			//var hasDocumento = (facturaInput.value !== "");
			// if(isEdit !== undefined && facturaInput.value !== ""){
			// 	alertShownEdit = true; 
			// 	facturaInput.addEventListener("click", function (event) {
			// 		event.stopPropagation();
			// 		event.preventDefault();
			// 		Swal.fire({
			// 			title: "¿Estás seguro?",
			// 			text: "Se reemplazará la imagen actual por una nueva. ¿Deseas continuar?",
			// 			icon: "warning",
			// 			showCancelButton: true,
			// 			confirmButtonColor: "#3085d6",
			// 			cancelButtonColor: "#d33",
			// 			confirmButtonText: "Continuar",
			// 			cancelButtonText: "Cancelar",
			// 		}).then((result) => {
			// 			if (result.isConfirmed) {
			// 			alertShown = true; // Set the flag to true to prevent the alert from showing again
			// 			facturaInput.click();
			// 			}
			// 		});
			// 	});
				
			// }
			if (event.target.files.length > 0) {
				
				facturaInput.addEventListener("click", createClickHandler(id));
				var file = event.target.files[0];
				var fileURL = URL.createObjectURL(file);
				downloadFacturaButton.setAttribute("href", fileURL);
				downloadFacturaButton.style.display = "block";
				removeFacturaButton.style.display = "block";
				omitirFacturaButton.style.display = "none";
				cancelarOmitirButton.style.display = "none";
				//nullInput.value = id + '-1';
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
				alertShown = false;
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
			nullInput.value = id;
			
			iconContainer.innerHTML =
				'<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';
		});
	}
	

	function eliminarBotonera(id){
		console.log('so');
		var FechaInput = document.getElementById("fecha" + id);
		// Resto del código que utilizas para manejar los eventos, pero ahora con el ID proporcionado
		var facturaInput = document.getElementById(id);
		
		var downloadFacturaButton = document.getElementById("downloadButton" + id);
		var removeFacturaButton = document.getElementById("removeButton" + id);
		var omitirFacturaButton = document.getElementById("omitirButton" + id);
		var cancelarOmitirButton = document.getElementById("cancelarOmitirButton" + id);
		var iconContainer = document.getElementById("iconContainer" + id);
		var checkboxInput = document.getElementById("check" + id);
		var paragraphElement = omitirFacturaButton.querySelector('p');

		facturaInput.value = null;
		downloadFacturaButton.removeAttribute("href");
		downloadFacturaButton.style.display = "none";
		removeFacturaButton.style.display = "none";
		omitirFacturaButton.style.display = "block";
		cancelarOmitirButton.style.display = "none";
		FechaInput.disabled = true;
		checkboxInput.style.visibility = "hidden";
		paragraphElement.style.display = "block";
		iconContainer.innerHTML =
			'<lord-icon src="https://cdn.lordicon.com/koyivthb.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" stroke="65" style="width:50px;height:70px"></lord-icon>';
	}
	
	// Función para crear el manejador de eventos "click" usando el ID específico
	function createClickHandler(id) {
	return function (event) {
		var facturaInput = document.getElementById(id);
		var iconContainer = document.getElementById("iconContainer" + id);
		var icon = document.getElementById("icon" + id);
		var expectedIconHTML =
		'<lord-icon src="https://cdn.lordicon.com/nxaaasqe.json" trigger="hover" colors="primary:#86c716,secondary:#e8e230" style="width:50px;height:70px"></lord-icon>';
		console.log('expectedIconHTML',expectedIconHTML);

		if (!alertShown && iconContainer.innerHTML === expectedIconHTML) {
		event.stopPropagation(); // Prevent the file explorer from opening immediately
		event.preventDefault(); // Prevent any default behavior

		Swal.fire({
			title: "¿Estás seguro?",
			text: "Se reemplazará la imagen actual por una nueva. ¿Deseas continuar?",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "Continuar",
			cancelButtonText: "Cancelar",
		}).then((result) => {
			if (result.isConfirmed) {
			alertShown = true; // Set the flag to true to prevent the alert from showing again
			facturaInput.click();
			}
		});
		}
	};
	}
	