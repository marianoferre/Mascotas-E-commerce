// Esperar a que el DOM esté listo
document.addEventListener("DOMContentLoaded", () => {
    // Seleccionar todos los botones de eliminar
    document.querySelectorAll(".btn-eliminar").forEach(button => {
        button.addEventListener("click", () => {
            // Obtener el ID del producto desde el atributo data-id
            const productId = button.getAttribute("data-id");

            // Mostrar un cuadro de confirmación
            const confirmDelete = confirm("¿Estás seguro de que deseas eliminar este producto?");
            if (confirmDelete) {
                // Realizar una solicitud AJAX para eliminar el producto en la base de datos
                fetch("../actions/eliminar_producto_g.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ id: productId }) // Enviar el ID como JSON
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Eliminar la fila del producto del frontend
                        const row = document.getElementById(`product-${productId}`);
                        row.remove();

                        // Mostrar el mensaje de éxito
                        const messageBox = document.createElement("div");
                        messageBox.className = "message-box success";
                        messageBox.textContent = "Producto eliminado exitosamente.";
                        document.body.appendChild(messageBox);

                        // Eliminar el mensaje después de 3 segundos
                        setTimeout(() => {
                            messageBox.remove();
                        }, 3000);
                    } else {
                        alert("Hubo un error al eliminar el producto.");
                    }
                })
                .catch(error => console.error("Error:", error));
            }
        });
    });
});
