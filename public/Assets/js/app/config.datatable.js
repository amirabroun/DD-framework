$('#datatable_users').DataTable({
    responsive: true,
});

$('#datatable_categories').DataTable({
    responsive: true,
    columnDefs: [
        {
            targets: 3,
            render: function (data) {
                const status = {
                    'active': { 'title': 'فعال', 'class': ' label-light-success' },
                    'inactive': { 'title': 'غیر فعال', 'class': ' label-light-danger' }
                };
                if (typeof status[ data ] === 'undefined') {
                    return data;
                }
                return '<span class="label label-lg font-weight-bold' + status[ data ].class + ' label-inline">' + status[ data ].title + '</span>';
            }
        }
    ]
});

$('#datatable_products').DataTable({
    responsive: true,
    columnDefs: [
        {
            targets: 6,
            render: function (data) {
                const status = {
                    'active': { 'title': 'فعال', 'class': ' label-light-success' },
                    'inactive': { 'title': 'غیر فعال', 'class': ' label-light-danger' }
                };
                if (typeof status[ data ] === 'undefined') {
                    return data;
                }
                return '<span class="label label-lg font-weight-bold' + status[ data ].class + ' label-inline">' + status[ data ].title + '</span>';
            },
        },
    ],
});

$('#datatable_brands').DataTable({
    responsive: true,
    columnDefs: [
        {
            targets: 3,
            render: function (data) {
                const status = {
                    'active': { 'title': 'فعال', 'class': ' label-light-success' },
                    'inactive': { 'title': 'غیر فعال', 'class': ' label-light-danger' }
                };
                if (typeof status[ data ] === 'undefined') {
                    return data;
                }
                return '<span class="label label-lg font-weight-bold' + status[ data ].class + ' label-inline">' + status[ data ].title + '</span>';
            },
        },
    ],
});
