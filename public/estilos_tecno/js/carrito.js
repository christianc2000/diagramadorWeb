function ejecutarCodigoBtnsDel(event) {
    event.stopPropagation();
    var imageId = event.currentTarget.dataset.image;
    var userId = event.currentTarget.dataset.user;
    console.log('Image ID: ', imageId);
    console.log('User ID: ', userId);
    var liParent = event.target.closest('li');
    var apiUrl = new URL('/api/cliente/del-cart', window.location.origin);
    console.log(apiUrl)
    var data = {
        image_orden_id: imageId,
        user_id: userId
    };
    fetch(apiUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        })
        .then(response => response.json())
        .then(data => {
            console.log('Success:', data.data);
            document.getElementById('cantidad-carrito').textContent = data
                .data.imagenes_orden
                .length;
            document.getElementById('btn-total').textContent = "Total " + data.data.total +
                "Bs";
            liParent.remove();
        })
        .catch((error) => {
            console.error('Error:', error);
        });
}

var btnsDel = document.querySelectorAll('.btn-del');
btnsDel.forEach(function(btnDel) {
    btnDel.addEventListener('click', ejecutarCodigoBtnsDel);
});

var btnsDelet = document.querySelectorAll('.btn-delete');
btnsDelet.forEach(function(btnDel) {
    btnDel.addEventListener('click', function(event) {
        console.log("click");
        btnsDel = document.querySelectorAll('.btn-del'); // Actualiza el valor de btnsDel
        btnsDel.forEach(function(btnDel) {
            ejecutarCodigoBtnsDel(event); // Ejecuta el código de btnsDel
        });
    });
});
