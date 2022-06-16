id = "telefono";
nombre_id = "nombre";
var num = document.getElementById("telefono");
var nombre = document.getElementById(nombre_id);
var len = num.length;

num.addEventListener("keyup", function() {
    num = document.getElementById(id).value.replace(/[^\d\.]*/g, '');
    len = num.length;
    sep = '-'

    console.log(len);
    if (!isNaN(num)) {
        if (len <= 3) {
            document.getElementById(id).value = num;
        } else if (len == 4) {
            document.getElementById(id).value = num.replace(/(\d{3})(\d{1})/, '$1' + sep + '$2');
        } else if (len == 5) {
            document.getElementById(id).value = num.replace(/(\d{3})(\d{2})/, '$1' + sep + '$2');
        } else if (len == 6) {
            document.getElementById(id).value = num.replace(/(\d{3})(\d{3})/, '$1' + sep + '$2' + sep);
        } else if (len == 7) {
            document.getElementById(id).value = num.replace(/(\d{3})(\d{3})(\d{1})/, '$1' + '-' + '$2' + '-' + '$3');
        } else if (len == 8) {
            document.getElementById(id).value = num.replace(/(\d{3})(\d{3})(\d{2})/, '$1' + '-' + '$2' + '-' + '$3');
        } else if (len == 9) {
            document.getElementById(id).value = num.replace(/(\d{3})(\d{3})(\d{3})/, '$1' + '-' + '$2' + '-' + '$3');
        } else if (len == 10) {
            document.getElementById(id).value = num.replace(/(\d{3})(\d{3})(\d{4})/, '$1' + '-' + '$2' + '-' + '$3');
        } else if (len > 10) {
            document.getElementById(id).value = document.getElementById(id).value.slice(0, 12);
            document.getElementById('telefono').innerHTML = 'Telefono Válido';
        }
    } else {
        document.getElementById(id).value = document.getElementById(id).value.replace(/[^\d\.]*/g, '');
        //document.getElementById('error_materno').innerHTML = 'Ingresa solo DIGITOS.';
    }
});


nombre.addEventListener("keyup", function() {
    nombre = document.getElementById(nombre_id);
    let name = nombre.value;
    name = name.charAt(0).toUpperCase() + name.slice(1);
    console.log(name);
    document.getElementById(nombre_id).value = name;

});