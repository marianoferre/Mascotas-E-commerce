const form = document.getElementById('registrarme');
      const contraseña = document.getElementById('contraseña');
      const confirm_contraseña = document.getElementById('confirm_contraseña');

      form.addEventListener('submit', function(event) {
          if (contraseña.value !== confirm_contraseña.value) {
              event.preventDefault(); // Evita el envío del formulario
              confirm_contraseña.placeholder = "Las contraseñas no coinciden"; 
              confirm_contraseña.classList.add('input-error'); // Añade clase de error al campo
              confirm_contraseña.value = ""; 
          } else {
              confirm_contraseña.placeholder = "Reingrese contraseña"; // Restablece el placeholder
              confirm_contraseña.classList.remove('input-error'); // Quita la clase de error
          }
      });

