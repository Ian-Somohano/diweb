/*
Crea un objeto que represente a un producto a la venta que tenga por nombre 
      
“Auriculares BT”, precio 23 € y con stock de 44 unidades. 
      
A continuación, imprímelo en la consola.Añade un método llamado importeEnStock() que devuelva el 
producto del precio por lasunidades en stock. Invócalo y muestra el resultado en la consola.
      
Ahora debes decrementar las unidades en stock tres veces y subirle el precio un 5%.
      
Vuelve a invocar al método importeEnStock() e imprime el resultado en la consola.   
*/

class Producto {
    nombre = "";
    precio = 0.0;
    stock = 0;

    constructor(nombre, precio, stock) {
        this.nombre = nombre;
        this.precio = precio;
        this.stock = stock;
    }

    importeEnStock() {
        let valorStock = this.stock * this.precio;

        alert(`El importe en stock es: ${valorStock}`)
    }


}

function iniciar() {
    let producto1 = new Producto("Auriculares BT", 23, 44);

    producto1.importeEnStock();
}