$(document).ready(function () {
    var isbn = $('input[name="isbn"]').val();
    var url = 'https://www.googleapis.com/books/v1/volumes?q=isbn:' + isbn;
    var cover = `https://covers.openlibrary.org/b/isbn/${isbn}-L.jpg`;

    searchCover(url, cover);
    console.log("ready")

    $('[data-action="deliver"]').on('click', function (e) {
        e.preventDefault();
        var url = $(this).data('url');
        var code = $(this).data('code');
        book_deliver(url, code);
    })
});

async function searchCover(url, cover) {
    try {
        const response = await fetch(url);
        const results = await response.json();

        if (results.totalItems == 1) {
            const book = results.items[0];
            let thumbnail;

            if (book.volumeInfo.imageLinks) {
                thumbnail = book.volumeInfo.imageLinks.thumbnail;
            } else {
                const img = new Image();
                img.src = cover;

                await new Promise((resolve, reject) => {
                    img.onload = function () {
                        if (img.naturalWidth === 1 && img.naturalHeight === 1) {
                            console.log('La imagen es de 1x1 píxeles');
                            thumbnail = '/images/default_book.gif';
                        } else {
                            console.log('La imagen no es de 1x1 píxeles', cover);
                            thumbnail = cover;
                        }
                        resolve();
                    };

                    img.onerror = function () {
                        console.log('Ha ocurrido un error al cargar la imagen');
                        reject();
                    };
                });
            }

            // MOSTRAMOS
            $('#previewimg').html(`<img src="${thumbnail}" style="width:100%">`);
        } else {
            h.toast("No se pudo cargar la imagen", "warning");
        }
    } catch (error) {
        console.log(error);
    }
}

function book_deliver(url, code) {
    Swal.fire({
        title: 'Aviso',
        text: "Por favor, verifica que el libro sea el mismo y se encuentre en condiciones antes de confirmar la entrega.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#f36',
        cancelButtonColor: '#cfd6df',
        confirmButtonText: 'Confirmar',
        input: 'text',
        inputPlaceholder: 'Ingrese el número de adquisición'
    }).then((result) => {
        if (result.isConfirmed) {
            if (result.value.length > 0)
                h.getPetition(url, { code: code, folio: result.value }, 'post', false).then(data => {
                    if (data.success == true) {
                        h.toast(data.msg);
                        if (data.action) {
                            location.href = data.action;
                        }
                    } else {
                        h.toast("Ops...", 'Ha ocurrido un error');
                        console.log(data)
                    }
                });
            else {
                toast("Ingrese el número de adquisición", 'warning');
            }
        }
    });
}
