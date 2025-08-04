<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Contacto</title>

    <link rel="stylesheet" href="../assets/css/contact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        
</head>

<body>
  
	
    <form class="contacto  animate__animated animate__fadeInDownBig" id="contactForm"  action="../actions/enviar.php" method="post">

		

        <label for="nombre">Nombre<span class="obligatorio">*</span></label>
        <input type="text" name="nombre" id="nombre" required placeholder="Escribe tu nombre">

        <label for="email">Email<span class="obligatorio">*</span></label>
        <input type="email" name="email" id="email" required placeholder="Escribe tu Email">

        <label for="telefono">Teléfono</label>
        <input type="tel" name="telefono" id="telefono" placeholder="Escribe tu teléfono">

        <label for="mensaje">Mensaje<span class="obligatorio">*</span></label>
        <textarea name="mensaje" id="mensaje" required placeholder="Deja aquí tu comentario..."></textarea>

        <button type="submit" id="enviar"><p>Enviar</p></button>

        <p class="aviso">
            <span class="obligatorio"> * </span>los campos son obligatorios.
        </p>
    </form>

 
</body>
</html>
