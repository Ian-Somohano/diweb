
        // ----------------------------

        class EntradaFutbol {
            partido = "";
            liga = true;
            #precio = 100.00;

            constructor(partido, liga, precio) {
                this.partido = partido;
                this.liga = liga;
                this.precio = precio;
            }

            set precio(unPrecio) {
                if (unPrecio > 0) {
                    this.#precio = unPrecio;
                }
            }

            get precio() {
                return this.#precio;
            
            }

            // Si los metodos son static, no hay que crear un objeto de la clase para USARLOS
            static leerEntrada() {
                let partido = prompt("¿A qué partido quieres ir?");
                let liga = confirm("¿Es de liga?");
                let precio = parseFloat(prompt("¿Dime Precio?"));

                // Usamos el constructor
                return new EntradaFutbol(partido, liga, precio);
            }

            static mostrarEnt(entrada) {

                alert(JSON.stringify({
                    Partido: entrada.partido,
                    Liga: entrada.liga,
                    Precio: entrada.precio
                }, null, 2));
            }

            partidoUEFA() {
                if (!this.liga) {
                    this.#precio *= 1.15;
                }
            }

            partidoEspecial() {
                this.#precio *= 1.25;
            }
        }
        function entFutbol() {
            let entrada1 = EntradaFutbol.leerEntrada();
            entrada1.partidoUEFA();
            EntradaFutbol.mostrarEnt(entrada1);
        }
        // ----------------------------
        class Reservas {
            cliente = "";
            entrada = "2024-03-04";
            #dias = 3;

            constructor(cliente) {
                this.cliente = cliente;
            }

            set dias(diasReserv) {
                if (diasReserv > 1) {
                    this.#dias = diasReserv;
                }
            }

            get dias() {
                return this.#dias;
            }

            static leerReserva() {
                // Usamos el constructor
                let cliente = prompt("¿Como te llamas?");
                let reserva = new Reservas(cliente);

                return reserva;
            }

            static imprimeReserva(reserva) {
                return (JSON.stringify({
                    Cliente: this.cliente,
                    Entrada: this.entrada,
                    Dias: `${this.dias} dias`
                }, null, 2));
            }
        }

        class Facturas extends Reservas {
            importe = 100.00;
            spa = false;

            constructor(cliente, importe, spa) {
                super(cliente);
                this.importe = importe;
                this.spa = spa;

                if (spa == true) {
                    importe += 40;
                }
            }

            static descuento(porcentaje) {
                this.importe -= this.importe * porcentaje / 100;
            }

            static leerFactura() {
                let cliente = prompt("Dime tu nombre")
                let importe = parseFloat(prompt("Dime importe"))
                let spa = confirm("¿Quieres spa?");

                let factura = new Facturas(cliente, importe, spa)

                return factura;
            }

            static imprimeFactura(factura) {
                // Creo un JSON propio, empezando por el de mi padre
                let miJSON = JSON.parse(super.imprimeReserva());

                // Meto en ese JSON mis campos...
                miJSON.importe = this.importe;
                miJSON.spa = this.spa;

                // Devuelvo el JSON personalizado
                return (JSON.stringify(miJSON, null, 2));
            }
        }

        function reserva(cliente) {
            // Parámetro de entrada: Cliente
            let importe = parseFloat(prompt("Dame importe"))
            let spa = confirm("Desea SPA?");

            let factura1 = new Facturas(cliente, importe,spa)

            // Salida: Factura
            return factura1.imprimeFactura();
        }
        // ----------------------------

        function verPi() {
            let veoveo = confirm("¿Deseas ver de verdad el valor de PI?")

            if (veoveo) { // En caso de  veoveo  === true
                alert(`El valor de PI es : ${Math.PI}`)
            } else {
                alert("Tu te lo pierdes")
            }

            let pi = Math.PI(1, 7);
            alert(Math.PI(2));
        }

        function volumenPrisma() {
            let areaBase = parseFloat(prompt("Dame base"));
            let altura = parseInt(prompt("Dame altura"));

            return (areaBase * altura);
        }

        function verPrimo() {
            // Pedir a JS que genere aleatorio del 1 al 100
            // La maquina me dira si ese numero es primo o no

            let semilla = Math.random();
            let max = 100;
            let min = 1;

            // Math.floor -> Trunca decimales ej: 45.68 = 45
            // Math.round -> este si redondea
            let aleatorio = Math.floor(semilla * (max - min + 1) + min);
            alert(aleatorio);

            // if (aleatorio == 3 || aleatorio == 5 ) {
            //     alert("Si es primo");
            // } else if (aleatorio % 3 == 0 || aleatorio % 2 == 0 || aleatorio % 5 == 0 || aleatorio == 1) {
            //     alert("No es primo");
            // } else {
            //     alert("Si es primo");
            // }

            let divisores = 1;

            for (let i = 1; i <= aleatorio; i++) {
                let resto = aleatorio % i;
                if (resto == 0) {
                    divisores++;
                }
            }

            if (divisores < 3) {
                alert("Si es primo");
            } else {
                alert("No es primo");
            }

        }

        // funcion menu
        function menu() {
            let menu = `Elige una opción:
            1.Futbol
            2.Reserva
            3.Ver PI
            4.Volumen Prisma
            5.Ver primo
            6.Salir`

            let opcion = 0;

            while (opcion < 6) {
                opcion = parseInt(prompt(menu));

                switch (opcion) {
                    case 1:
                        entFutbol();
                        break
                    case 2:
                        alert(reserva());
                        break
                    case 3:
                        verPi();
                        break
                    case 4:
                        alert(`El volumen del primas = ${volumenPrisma()}`);
                        break
                    case 5:
                        verPrimo();
                        break
                        alert("Fin del programa");
                        break
                }
            }


        }