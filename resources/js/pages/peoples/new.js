$(document).ready(function () {
    $('#form-add-people').on('submit',function (e) {
        e.preventDefault();
        var idform = this;
        var errors = document.querySelectorAll('.error');
        $('.error').text('');

        h.sendform(idform).then(data => {
            if (data.success == true) {
                h.toast(data.msg);
                location.href = data.action;
                console.log(data);
            }  else {
                h.toast(data.msg, 'error');
                console.log(data)
                errors.forEach(function (span) {
                    var name = $(span).data('name');
                    $(`[data-name="${name}"]`).text(data.errors[name])
                })
            }
        });

    })
});