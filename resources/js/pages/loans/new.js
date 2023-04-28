import autoComplete from '@tarekraafat/autocomplete.js';
const autoCompleteJS = new autoComplete(// API Basic Configuration Object
    {
        selector: "#book-title",
        data: {
            src: async () => {
                const response = await fetch('/api/libros?titulo=' + document.querySelector('#book-title').value);
                const data = await response.json();
                console.log(data.books.map(item => item.title))
                return data.books.map(item => item.title);
            },
            cache: true
        },
        resultsList: {
            element: (list, data) => {
                if (!data.results.length) {
                    // Create "No Results" message element
                    const message = document.createElement("div");
                    // Add class to the created element
                    message.setAttribute("class", "no_result");
                    // Add message text content
                    message.innerHTML = `<span>No se encuentra el libro de "${data.query}"</span>`;
                    // Append message element to the results list
                    list.prepend(message);
                }
            },
            noResults: true,
        },
        resultItem: {
            highlight: true,
        }
    }
);

autoCompleteJS.input.addEventListener("selection", function (event) {
    const feedback = event.detail;
    autoCompleteJS.input.blur();
    // // Prepare User's Selected Value
    const selection = feedback.selection.value;
    autoCompleteJS.input.value = selection;

    h.getPetition("/api/libros", {titulo:selection}, 'GET').then(response => {
        var book = response.books[0];
        $('input[name="autor"]').val(book.autor)
        $('input[name="classification"]').val(book.shelf)
        $('input[name="book_id"]').val(book.id)

    })
});

$(document).ready(function () {

    $('#form-new-loan').on('submit', function(e){
        e.preventDefault();
        var idform = this;
        var errors = document.querySelectorAll('.error');
        $('.error').text('');

        h.sendform(idform).then(data => {
            if (data.success == true) {
                h.toast(data.msg);
                // if (data.action == 'new') { $(idform)[0].reset(); $('#previewimg').html('')}
                // else {
                //     location.reload
                // }
    
                console.log(data);
            } else {
                h.toast("Ops...", 'error');
                console.log(data.errors)
                errors.forEach(function (span) {
                    var name = $(span).data('name');
                    $(`[data-name="${name}"]`).text(data.errors[name])
                })
            }
        })
    })

});