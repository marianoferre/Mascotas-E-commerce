document.addEventListener("DOMContentLoaded", () => {
    // Seleccionamos todos los botones de eliminar
    document.querySelectorAll(".btn-eliminar").forEach(button => {
        button.addEventListener("click", () => {
            const userId = button.getAttribute("data-id"); // Obtenemos el ID del usuario a eliminar

            // Confirmar la eliminación del usuario
            const confirmDelete = confirm("¿Estás seguro de que deseas eliminar este usuario?");
            if (confirmDelete) {
                fetch("../actions/eliminar_usuario.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ id: userId }) // Enviamos el ID del usuario al servidor
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const row = document.getElementById(`user-${userId}`); // Seleccionamos la fila del usuario

                        // Verificamos si la fila existe antes de intentar eliminarla
                        if (row) {
                            row.remove();  // Elimina la fila del DOM
                            console.log("Usuario eliminado del frontend.");
                        } else {
                            console.error("No se encontró la fila del usuario en el DOM.");
                        }

                        // Mostrar mensaje de éxito
                        const messageBox = document.createElement("div");
                        messageBox.className = "message-box success";
                        messageBox.textContent = "Usuario eliminado exitosamente.";
                        document.body.appendChild(messageBox);

                        setTimeout(() => {
                            messageBox.remove();
                        }, 3000);
                    } else {
                        alert("Hubo un error al eliminar el usuario.");
                    }
                })
                .catch(error => console.error("Error:", error));
            }
        });
    });
});
