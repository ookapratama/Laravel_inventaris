/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

// swal btn hapus
const setStatus = (id, tabel, status) => {
    console.log(id, tabel, status);
    let token = $("meta[name='csrf-token']").attr("content");
    swal({
        title: "Perbarui Status Barang?",
        text: "",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        console.log(willDelete);
        if (willDelete) {
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": token,
                },
                type: "PUT",
                url: `/dashboard/${tabel}/status/${id}`,
                data: {
                  status: status
                },
                success: function (response) {
                    if (response) {
                        swal(
                            "Status barang diperbarui",
                            "Aktif : data akan tampil disemua table\n Tidak aktif : data tidak akan tampil di table manapun",
                            "success"
                        ).then(() => {
                            location.reload();
                        });
                    } else {
                        swal("Error", "Failed to update data.", response);
                    }
                },
                error: function (error) {
                    console.error("AJAX Error:", error);
                    swal("Error", "Ajax Error.", error);
                },
            });
        }
    });
};
