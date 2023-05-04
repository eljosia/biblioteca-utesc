$(document).ready(function () {
    var prevScrollpos = window.pageYOffset;
    window.onscroll = function () {

        var currentScrollpos = window.pageYOffset;
        if (prevScrollpos > currentScrollpos) {
            document.getElementById("navbar").style.top = "0";
        } else {
            document.getElementById("navbar").style.top = "-160px";
        }

        prevScrollpos = currentScrollpos;

    }

    $('#btn-search').on('click', function (e) {
        e.preventDefault();
        let book = $('input[name="search"]').val();
        searchBook(book);
    })
});

async function searchBook(search) {
    h.loader_spinner('.response-books');
    await h.getPetition('/api/libros', { search: search }, 'GET').then(res => {
        var data = res.books;
        h.loader_spinner('.response-books', true);

        console.log(data)
        if (data.length > 0) {
            var book_col = '';
            $.each(data, function (i, book) {
                book_col += `<div class="col-6 col-md-3">
                                <div class="card mb-3 p-1">
                                    <img src="${book.cover_img}" class="img-fluid rounded" alt="...">
                                </div>
                            </div>`
            });

            $('.response-books').html(book_col);
        } else {
            console.log('no hay datos')
        }
    });
}
