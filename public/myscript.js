$(document).ready(function(){
    $(".delete_invoice").click(function () {
        let id = $(this).attr('id');
        console.log(id);

        $('#deleteInvoice').modal('show');

        $('#sure').on('click', function () {
            window.location.replace("../../Home/DeleteInvoice/" + id);
        });
    });

    $(".delete_employer").click(function () {
        let id = $(this).attr('id');

        $('#deleteEmployer').modal('show');

        $('#sure').on('click', function () {
            window.location.replace("../../Home/DeleteEmployer/" + id);
        });
    });

    $(".delete_request_stock_in").click(function () {
        let id = $(this).attr('id');

        $('#deleteRequest').modal('show');

        $('#sure').on('click', function () {
            window.location.replace("../../Home/DeleteRequest/" + id);
        });
    });

    $('.table-row-invoice').click(function() {
        let id = $(this).attr('id');
        window.location.replace("../Home/DetailInvoice/" + id)
    });

    $('.table-row-employer').click(function() {
        let id = $(this).attr('id');
        window.location.replace("../Home/DetailEmployer/" + id)
    });

    $('.table-row-stock-in').click(function() {
        let id = $(this).attr('id');
        window.location.replace("../Home/DetailStockInRequest/" + id)
    });



    if ($(".change-permission-alert").length) {
        setTimeout(function () { $('.change-permission-alert').hide(); }, 5000);
    }
});

function addRow() {
    let idField = document.getElementById("book_id");
    let quanlityField = document.getElementById("quanlity");
    let message = document.getElementById("error-message");

    let book_id = idField.value;
    let quanlity = quanlityField.value;

    if (book_id === "") {
        message.innerHTML = "Vui lòng điền mã sách";
        idField.focus();
    } else if (quanlity === "") {
        message.innerHTML = "Vui lòng điền số lượng";
        quanlityField.focus();
    } else {
        var tr = document.createElement("tr");
        var input_id = document.createElement("input");
        var input_quan = document.createElement("input");
        var book_id_td = document.createElement("td");
        var quanlity_td = document.createElement("td");
        var table = document.getElementById("book-table");

        input_id.value = book_id;
        input_id.setAttribute("name", "book_id[]");
        input_id.style.border = "none";
        input_quan.value = quanlity;
        input_quan.setAttribute("name", "quanlity[]");
        input_quan.style.border = "none";

        book_id_td.appendChild(input_id);
        quanlity_td.appendChild(input_quan);

        // book_id_td.setAttribute("name", "book_id[]");

        tr.appendChild(book_id_td);
        tr.appendChild(quanlity_td);

        table.appendChild(tr);

        message.innerHTML = "";

        //san sang cho lan nhap tiep theo
        idField.value = "";
        quanlityField.value = "";

        idField.focus();

        return true;
    }

    return false;
}