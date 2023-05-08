$(document).ready(function () {
    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        if (scroll >= 30) {
            document.getElementById("navbar").style.top = "-115px"; //160px oculta Buscar Libros
        } else if (scroll <= 30) {
            document.getElementById("navbar").style.top = "0";
        }
    });

    $('#form-search-book').on('submit', function (e) {
        e.preventDefault();
        let book = $('input[name="search"]').val();
        if (book.length > 3) {
            searchBook(book);
        } else {
            $('.response-books')
                .html('<div class="alert-msg text-sm text-center alert alert-info" style="display:none">Ingresa por lo menos 3 letras para buscar un libro</div');
                $('.alert-msg.alert').fadeIn();
        }
    })
});

async function searchBook(search) {
    $(window).scrollTop(0);
    h.loader_spinner('.response-books');
    await h.getPetition('/api/libros', { search: search }, 'GET').then(res => {
        var data = res.books;
        h.loader_spinner('.response-books', true);

        if (data.length > 0) {
            var book_col = '';
            $.each(data, function (i, book) {

                book_col += `<div class="col-md-6 px-2 pb-2 mt-12">
                                <div class="card shadow-3" style="height:100% !important;">
                                    <div class="row">
                                        <div class="col-4">
                                        <img src="${(book.cover_img) ? book.cover_img : '/images/default_book.gif'}" style="margin-top: -35px" class="card-img-top img-fluid rounded mx-auto border" width="319px" height="500px">
                                        </div>
                                        <div class="col-8">
                                            <div class="px-2 mb-3">
                                                <span class="text-sm font-bold"><i class="fa-solid fa-bookmark me-1"></i>${book.title}</span> <br>
                                                <span class="text-xs text-muted"><i class="fa-solid fa-circle-user"></i> ${book.autor}</span>
                                            </div>
                                            <div class="px-2">
                                                <div class="text-xs">
                                                    Estante: ${book.shelf} <br>
                                                </div>
                                            </div>
                                            <div class="px-2 text-xs text-end">
                                                <span class="badge bg-secondary">${book.status}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>`
            });

            $('.response-books').html(book_col);
        } else {
            console.log('no hay datos')
            $('.response-books').html('<div class="text-2xl text-center">No hay resultados de búsqueda</div');

        }
    });
}
