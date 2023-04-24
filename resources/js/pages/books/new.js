$('#searchbook').on('click', function (e) {
    e.preventDefault();
    var isbn = $('input[name="isbn"]').val();
    var searchbtn = $(this);
    var url = 'https://www.googleapis.com/books/v1/volumes?q=isbn:' + isbn;
    var cover = `https://covers.openlibrary.org/b/isbn/${isbn}-L.jpg`;

    searchBook(url, cover, searchbtn, isbn)
})

async function searchBook(url, cover, searchbtn, isbn) {
    try {
        const response = await fetch(url);
        const results = await response.json();
        searchbtn.html(`<i class="fa-solid fa-magnifying-glass"></i>`);

        if (results.totalItems == 1) {
            const book = results.items[0];
            let thumbnail;

            const title = book['volumeInfo']['title'];
            const desc = book['volumeInfo']['description'];
            const authors = book['volumeInfo']['authors'];
            const printType = book['volumeInfo']['printType'];
            const pageCount = book['volumeInfo']['pageCount'];
            const publisher = book['volumeInfo']['publisher'];
            const publishedDate = book['volumeInfo']['publishedDate'];
            const webReaderLink = book['accessInfo']['webReaderLink'];

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

            const countryResponse = await fetch('/country.json');
            const country = await countryResponse.json();
            if (book['accessInfo']['country']) {
                var av = book['accessInfo']['country'];
                $('input[name="pais"]').val(country[av]);
            }

            // MOSTRAMOS
            $('#previewimg').html(`<img src="${thumbnail}" style="width:100%">`);
            $('input[name="title"]').val(title);
            $('input[name="autor"]').val(authors);
            $('input[name="description"]').val(desc);
            $('input[name="editorial"]').val(publisher);
            $('input[name="pages"]').val(pageCount);
            $('input[name="date_of_pub"]').val(publishedDate);
        } else {
            h.toast("No encontramos el libro, agregalo manualmente", "warning");
        }
    } catch (error) {
        console.log(error);
    }
}