$("#responsive-datatable").DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": baseUrl + 'barang/api-index-obat',
        "type": "POST"
    },
    "columnDefs": [
        {
            "width": "10px",
            "targets": 0
        },
        {
            "class": "text-center",
            "targets": [0, 1, 2, 3]
        },
        {
            "render": "id_satuan"
        }
    ],

    "order": [
        [0, "ASC"]
    ],
});


const click = data => {
    alert(data)
}