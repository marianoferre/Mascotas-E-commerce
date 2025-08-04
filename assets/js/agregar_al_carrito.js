function agregarAlCarrito(productId) {
    // Realizar una solicitud AJAX
    fetch('../actions/agregar_al_carrito.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'id=' + encodeURIComponent(productId)
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert('Producto agregado al carrito');
        } else {
            alert('Error al agregar el producto');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error en la solicitud');
    });
}
