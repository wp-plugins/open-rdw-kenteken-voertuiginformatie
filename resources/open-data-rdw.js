jQuery(document).ready(function($) {

    $(document).on('click', '.open-rdw-header a', function(e) {
        e.preventDefault();
        $tr = $(this).closest('tr');
        $tr.nextUntil('.open-rdw-header').toggle();
    });

    $(document).on('change', '#open-data-rdw', function() {
        $('#open_rdw-loading').show();
        $('#open_rdw-error').hide();
        $('#open_rdw-accepted').hide();

        var val = $(this).val();
        var kenteken = val.replace(/[^a-z0-9]/gi, '').toLowerCase();

        var data = {
            action: 'get_open_rdw_data',
            kenteken: kenteken
        }

        $.post(ajax.url, data, function(res) {
            $('#open_rdw-loading').hide();
            if (res.errors) {
                $('#open_rdw-error').show();
            } else {
                $('#open_rdw-accepted').show();
            }

            $.each(res.result, function(name, value) {
                if (name !== 'Kenteken') {
                    $('input[name="' + name + '"').val(value);
                }
            });
        });

    });

});