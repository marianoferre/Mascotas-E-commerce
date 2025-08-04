    // Ocultar automáticamente el mensaje después de 3 segundos
    setTimeout(() => {
        const messageBox = document.getElementById('message-box');
        if (messageBox) {
            messageBox.style.transition = 'opacity 0.5s';
            messageBox.style.opacity = '0';
            setTimeout(() => messageBox.remove(), 500); // Eliminar del DOM
        }
    }, 3000); // 3 segundos