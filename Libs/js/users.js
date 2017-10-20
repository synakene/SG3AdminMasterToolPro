jQuery(document).ready( function () {
    jQuery('#users-table').dataTable({
        "language": { "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/French.json" }
    });

    jQuery('[data-toggle="tooltip"]').tooltip({
        animated: 'fade',
        placement: 'left',
    });
} );