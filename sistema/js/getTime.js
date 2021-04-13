//
// Created by ChristianG.
//

function startTime() { //Funcion que obtiene la hora

    var reloj = new Date(); // instancia reloj como una clase para datos de horarios
        
    var h = reloj.getHours(); // captura la hora
    var m = reloj.getMinutes(); // captura los minutos
    var s = reloj.getSeconds(); // captura los segundos

    h = checkTime(h); // agrega un cero si el numero es menor a 10
    m = checkTime(m); // agrega un cero si el numero es menor a 10
    s = checkTime(s); // agrega un cero si el numero es menor a 10

    var hora = h+':'+m+':'+s; // instancia una variable con la hora

    document.getElementById('hora').value = hora; // muestra el dato 
        
    t = setTimeout('startTime()', 500); // hace que la hora se actualice en tiempo real
}

function checkTime(i) {  // funcion para agreagar cero a la izquierda

    if (i < 10) {
        i = '0' + i;
    }
    return i;
}

function startDay() { // funcion para capturar el dia

    var hoy = new Date(); // instancia la variable como una clase para datos de horarios

    var d = hoy.getDate(); // captura el dia
    var m = (hoy.getMonth() + 1); // captura el mes 
    var y = hoy.getFullYear(); // captura el año

    d = checkTime(d); // agrega un cero si el numero es menor a 10
    m = checkTime(m); // agrega un cero si el numero es menor a 10
    y = checkTime(y); // agrega un cero si el numero es menor a 10

    var day = d+'/'+m+'/'+y; // instancia una variable con el dia que se obtuvo

    document.getElementById('dia').value = day; // muestra el dato
}

window.onload=function(){startDay(); startTime();} // cuando la pagina se carga totalmente llama las funciones