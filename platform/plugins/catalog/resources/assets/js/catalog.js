class Catalog {
    static changeZone($element) {
        let $branch = $(document).find('select[data-type=branch]');
        if ($element.data('related-branch')) {
            $branch = $(document).find('#' + $element.data('related-branch'));
        }
        let url = $element.data('change-zone-url');
        if (url !== null && url !== '' && $element.val() !== '') {
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    'zone_id': $element.val()
                },
                beforeSend: () => {
                    $element.closest('form').find('button[type=submit], input[type=submit]').prop('disabled', true);
                },
                success: (data) => {
                    let option = '<option value="">' + ($branch.data('placeholder')) + '</option>';
                    $.each(data.data, (index, item) => {
                        if (item.id === $branch.data('origin-value')) {
                            option += '<option value="' + item.id + '" selected="selected">' + item.code + ' - ' + item.name + '</option>';
                        } else {
                            option += '<option value="' + item.id + '">' + item.code + ' - ' + item.name + '</option>';
                        }

                    });
                    $branch.html(option);
                    $element.closest('form').find('button[type=submit], input[type=submit]').prop('disabled', false);
                }
            });
        }
    }
}

$(document).ready(() => {
    let $zone_fields = $(document).find('select[data-type=zone]');
    if ($zone_fields.length > 0) {
        $.each($zone_fields, (index, el) => {
            Catalog.changeZone($(el));
        });
        $(document).on('change', 'select[data-type=zone]', (event) => {
            Catalog.changeZone($(event.currentTarget));
        });
    }
});