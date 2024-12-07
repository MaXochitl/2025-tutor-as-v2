document.addEventListener("DOMContentLoaded", function () {
    p_view = document.getElementById("p_actual");

    var options = { year: 'numeric', month: 'long' };

    fetch(ruta, {
        method: "GET",
    }).then(response => response.json()).then(response => {
        console.log(response);

        // Convertir las fechas correctamente
        let fecha1Parts = response[0].split("-");
        let fecha2Parts = response[1].split("-");

        // Crear fechas con año, mes y día de manera explícita
        let fecha1 = new Date(fecha1Parts[0], fecha1Parts[1] - 1, fecha1Parts[2]);
        let fecha2 = new Date(fecha2Parts[0], fecha2Parts[1] - 1, fecha2Parts[2]);

        // Formatear las fechas con toLocaleDateString
        let periodo_view = formatDate(fecha1, options) + " - " + formatDate(fecha2, options);

        // Eliminar las palabras "de"
        let periodo_v = periodo_view.replace(/ de /g, " ");
        console.log(periodo_v);
        p_view.textContent = periodo_v;
    });

    // Función para capitalizar la primera letra del mes
    function formatDate(date, options) {
        let dateStr = date.toLocaleDateString("es-ES", options);
        return dateStr.charAt(0).toUpperCase() + dateStr.slice(1); // Capitaliza la primera letra
    }
});



/*document.addEventListener("DOMContentLoaded", function () {
    var options = { year: 'numeric', month: 'long' };
    fetch(ruta, {
        method: "GET",

    }).then(response => response.json()).then(response => {
        console.log(response);
        fecha1 = new Date(response[0]);
        fecha2 = new Date(response[1]);

        periodo_view = fecha1.toLocaleDateString("es-ES", options) + " - " + fecha2.toLocaleDateString("es-ES", options);

        let periodo_v = periodo_view.replace(/ de /g, " ");
        console.log(periodo_v);
    });
});

*/

/* esto tal vez sirva mas adelante
var fecha = new Date(1995, 11, 17);
var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };

console.log(
  fecha.toLocaleDateString("es-ES", options)
);

fecha = new Date("2017-08-21");
console.log(
  fecha.toLocaleDateString("es-ES", options)
);
*/
