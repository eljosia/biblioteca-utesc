$(document).ready(function () {
    var isbn = $('input[name="isbn"]').val();
    var url = 'https://www.googleapis.com/books/v1/volumes?q=isbn:' + isbn;
    var cover = `https://covers.openlibrary.org/b/isbn/${isbn}-L.jpg`;

    searchCover(url, cover);
    console.log("ready")
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
            $('input[name="cover_url"]').val(thumbnail);
        } else {
            h.toast("No se pudo cargar la imagen", "warning");
        }
    } catch (error) {
        console.log(error);
    }
}