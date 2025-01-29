// Defino una clase padre o super clase
class Vehiculo {
    //Atributos
    modelo = "";
    precio = 0.0;
    velocidad = 0;

    constructor(modelo, precio,) {
        this.modelo = modelo;
        this.precio = precio;
    }

    acelerar(aceleracion) {
        this.velocidad += aceleracion;
    }

    frenar(frenado) {
        this.velocidad -= frenado;
    }

    imprimir() {
        return JSON.stringify(this, null, 2);
    }
    
}

// Extends hace que la clase herede tanto los atributos como los metodos
class Moto extends Vehiculo {
    // Atributo propio
    Rudeas = 2;
}

let moto = new Vehiculo("GP", 360.0);

function iniciar() {
    moto.acelerar(100)
    alert(moto.imprimir());
}