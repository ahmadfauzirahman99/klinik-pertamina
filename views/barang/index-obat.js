$("#responsive-datatable").DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": baseUrl + 'barang/api-index-obat',
        "type": "POST"
    },
    "columnDefs": [
        {
            "width": "100px",
            "targets": 0
        },
        {
            "class": "text-center",
            "targets": [0, 1,2]
        }
    ],

    "order": [
        [0, "ASC"]
    ],
});