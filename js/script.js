// LIVE SEARCH jQUERY

// $ == jQuery

$(document).ready(function() { 
    // Buat event ketika keyword ditulis
    $('#keyword').on('keyup', function() {
        // Munculkan icon loading
        $('.loader').show();

        const input = $('#keyword').val();
        // Ajax dengan $.get()
        $.get('ajax/cerita.php?keyword=' + input, function(data) {
            $('#list-tabel').html(data);
            $('.loader').hide();
        });
    })
});