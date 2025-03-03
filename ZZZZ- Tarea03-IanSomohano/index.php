<?php
// Llamar a errores y funciones
require("errores.php");
require("funciones.php");

/* Recogemos datos del formulario */
$alerta = "Mensaje...";

// Solo si se envía el formulario, se definen las variables del alert
if (isset($_REQUEST['enviar'])) {
  // Llamamos a la BBDD
  $conexion = conectarBBDD();

  $nombre = $_REQUEST['Nombre'] ?? '';
  $clave = $_REQUEST['Clave'] ?? '';
  $correo = $_REQUEST['Correo'] ?? '';
  $nif_cif = $_REQUEST['Nif_cif'] ?? '';
  $autonomo = $_REQUEST['Autonomo'] ?? '';



  // Ahora introducimos lo de arriba en la BBDD
  // Defino una Sentencia preparada (? por cada campo!)
  $sentenciaSQL = "INSERT INTO usuarios 
                    (Nombre,Clave,Correo,Nif_cif,Autonomo) 
                    VALUES (?,?,?,?,?)";
  $sentenciaPreparada = $conexion->prepare($sentenciaSQL);
  // Encriptamos la sentencia (bind_param)
  $sentenciaPreparada->bind_param(
    "sssii",
    $nombre,
    $clave,
    $correo,
    $nif_cif,
    $autonomo
  );

  // ejecutaSQL es booleano; true (correcto), false (error)
  $ejecutaSQL = $sentenciaPreparada->execute();
  if ($ejecutaSQL) {
    $alerta .= "<br> Inserción correcta";
  } else {
    $alerta .= "<br> ERROR FATAL (explota!)";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>El Corte Inglés</title>
  <!-- <link rel="stylesheet" href="style.css" /> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    crossorigin="anonymous" referrerpolicy="no-referrer">

  <link rel="stylesheet" href="../Tarea03-IanSomohano/Bootstrap/bootstrap.min(1).css">

  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande",
        "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
      font-size: 16px;
      font-weight: 300;
    }

    /* Anuncio superior */
    span {
      display: block;
      background-color: #ccc;
      height: 45px;
      text-align: center;
      align-content: center;
      margin-bottom: 20px;
    }

    /* Header */

    header {
      height: 10vh;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: sticky;
      background-color: white;
      top: 0;
      z-index: 100;
    }

    .icon {
      width: 35px;
    }

    header section:nth-of-type(1) img:nth-of-type(2) {
      width: 110px;
    }

    header>*:not(form) {
      width: 20%;
      display: flex;
      align-content: center;
    }

    header section:nth-of-type(1) {
      margin-left: 20px;
    }

    header section:nth-of-type(2) {
      justify-content: right;
      margin-right: 20px;
      gap: 10px;
    }

    header form {
      display: flex;
      height: 50%;
      width: 40%;
      border: 1px solid gray;
      justify-content: center;
      align-items: center;
      border-radius: 40px;
      min-height: 40px;
    }

    header form input {
      border: none;
      width: 80%;
      height: 70%;
      margin-right: 5%;
      background-color: transparent;
    }

    header form input:focus {
      outline: none;
    }

    header form input:hover {
      cursor: pointer;
    }

    header form button {
      border: none;
      background-color: #008539;
      height: 70%;
      width: 30px;
      border-radius: 20px;
    }

    /* Barra de enlaces */
    nav {
      display: flex;
      justify-content: center;
    }

    nav ul {
      display: flex;
      justify-content: space-between;
      width: 50%;
      list-style: none;
    }

    nav ul a {
      text-decoration: none;
      color: black;
      font-size: 0.9em;
      font-weight: 400;
      font-family: Verdana, Geneva, Tahoma, sans-serif;
    }

    /* Tabla de categorías */
    h2:first-of-type {
      display: inline;
      font-size: 1em;
      color: #383838;
      position: relative;
      left: 8%;
    }

    main section:nth-of-type(1) {
      display: flex;
      justify-content: center;
      margin-top: 20px;
    }

    main table img {
      width: 170px;
    }

    main table {
      color: #575757;
      border-spacing: 10px;
    }

    main table td {
      text-align: center;
    }

    main hr {
      width: 30%;
      height: 3px;
      background-color: #ccc;
      border: none;
    }

    /* Enlaces útiles */
    main section:nth-of-type(2) {
      width: 100%;
      display: flex;
      justify-content: center;
    }

    main section:nth-of-type(2) ul {
      list-style: none;
      display: flex;
      justify-content: space-around;
      width: 80%;
    }

    main section:nth-of-type(2) ul li {
      border: 2px solid rgba(224, 224, 224, 0.479);
      padding: 5px;
      width: 20%;
      height: 30px;
      font-size: 0.75em;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    main section:nth-of-type(2) ul li img {
      width: 25px;
      color: #008539;
    }

    main section ul li a {
      text-decoration: none;
      color: black;
    }

    /* Formulario */
    main section:last-of-type {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-bottom: 80px;
    }

    figure {
      margin: 0;
      padding: 0;
      width: 100%;
      text-align: center;
    }

    figure img {
      margin-top: 50px;
      width: 300px;
    }

    main h2:last-of-type {
      font-size: 1.2em;
      text-align: center;
      margin-top: 40px;
    }

    main section:last-of-type form {
      width: 40%;
      margin-top: 20px;
    }

    main section:last-of-type form input {
      width: 100%;
      height: 40px;
      border: 1px solid #cccccc;
    }

    main section:last-of-type form input::placeholder {
      position: relative;
      left: 15px;
    }

    main section:last-of-type form h3 {
      font-size: 1.2em;
      width: 100%;
    }

    main section:last-of-type form>* {
      margin-bottom: 10px;
    }

    main section:last-of-type form button {
      background-color: #424242;
      color: white;
      width: 100%;
      height: 40px;
      border: none;
    }

    main section:last-of-type form button:hover {
      background-color: gray;
      cursor: pointer;
    }

    .form-check-input {
      width: 40px !important;
      height: 20px !important;
      border: 1px solid red;
      position: relative;
      left: 20rem;
    }

    #enlace::before {
      content: "CREAR CUENTA";
    }
  </style>
</head>

<body>
  <!-- Anuncio superior -->
  <span>Descárgate aquí nuestra <strong>App.</strong></span>

  <header>
    <!-- Menu hamburguesa + logo -->
    <section aria-label="menu">
      <img src="img/menu.png" alt="menu" class="icon" />
      <img src="img/logo.png" alt="">
    </section>

    <!-- Barra de busqueda + botón de envío -->
    <form action="#" method="get">
      <input id="buscar" name="buscar" type="text" placeholder="¿Qué estas buscando?" />

      <button>
        <i class="fa-solid fa-magnifying-glass" style="color: #ffffff"></i>
      </button>
    </form>

    <!-- Iconos con elaces -->
    <section aria-label="iconos">
      <a href="#">
        <img src="img/usuario.png" alt="menu" class="icon" />
      </a>
      <a href="#">
        <img src="img/corazon.png" alt="menu" class="icon" />
      </a>
      <a href="#"> <img src="img/bolsa.png" alt="menu" class="icon" /></a>
    </section>
  </header>

  <!-- Enlaces barra inferior del header -->
  <nav>
    <ul>
      <li>
        <a href="#">MODA MUJER</a>
      </li>
      <li>
        <a href="#">DEPORTES</a>
      </li>
      <li>
        <a href="#">ELECTRÓNICA</a>
      </li>
      <li>
        <a href="#">HOGAR</a>
      </li>
      <li>
        <a href="#">SUPERMERCADO</a>
      </li>
    </ul>
  </nav>

  <main>
    <!-- Tabla de categorias -->
    <h2>Categorías</h2>
    <section aria-label="tabla">
      <table>
        <tr>
          <td>
            <a href="https://www.elcorteingles.es/moda-mujer/">
              <img src="img/1.jpeg" alt="moda mujer" />
            </a>
          </td>

          <td>
            <a href="https://www.elcorteingles.es/moda-hombre/">
              <img src="img/2.jpeg" alt="moda hombre" />
            </a>
          </td>

          <td>
            <a href="https://www.elcorteingles.es/moda-infantil/">
              <img src="img/3.jpeg" alt="moda infantil" />
            </a>
          </td>

          <td>
            <a href="https://www.elcorteingles.es/hogar/">
              <img src="img/4.jpeg" alt="hogar" />
            </a>
          </td>

          <td>
            <a href="https://www.elcorteingles.es/deportes/">
              <img src="img/5.jpeg" alt="" />
            </a>
          </td>

          <td>
            <a href="https://www.elcorteingles.es/electronica/">
              <img src="img/6.jpeg" alt="" />
            </a>
          </td>
        </tr>
        <tr>
          <td>Moda mujer</td>

          <td>Moda Hombre</td>

          <td>Modo infantil</td>

          <td>Hogar</td>

          <td>Deportes</td>

          <td>Electrónica</td>
        </tr>
      </table>
    </section>

    <hr />

    <!-- Lista de enlaces a paginas útiles -->
    <section aria-label="paginas-utiles">
      <ul>
        <li>
          <img src="img/bolsas-de-compra.png" alt="bolsas de compra" />
          <a href="">Recogida en tienda</a>
        </li>
        <li>
          <img src="img/entrega.png" alt="coche de envio" />
          <a href="">Envio a domicilio</a>
        </li>
        <li>
          <img src="img/caja.png" alt="caja" />
          <a href="">Devolución gratis en tienda</a>
        </li>
        <li>
          <img src="img/maletero-abierto.png" alt="coche" />
          <a href="">Click & Car</a>
        </li>
      </ul>
    </section>

    <figure>
      <img src="img/logo-cuenta.svg" alt="" />
    </figure>

    <h2>Crea una cuenta para todo El Corte Inglés</h2>

    <section aria-label="crear-cuenta">
      <form action="#" method="post" class="form-check form-switch">
        <label for="correo">Añade tu correo electrónico</label><br />
        <input type="email" name="correo" id="correo" placeholder="usuario@example *" required /><br />

        <label for="clave">Crea una contraseña fuerte</label><br />
        <input type="password" name="clave" id="clave" placeholder="Nueva contraseña *" required><br>

        <h3>Datos personales</h3>

        <input type="text" name="Nombre" id="Nombre" placeholder="Nombre *" required><br>

        <h3>Datos fiscales</h3>

        <input type="text" name="Nif_cif" id="apellido" placeholder="CIF/NIF *" required><br>

        <label for="Autonomo">Soy autonomo o empresa</label>
        <input type="checkbox" name="Autonomo" id="Autonomo" value="1" class="form-check-input">

        <button id="enlace" type="submit" name="enviar"></button>


      </form>
    </section>
  </main>
</body>

</html>