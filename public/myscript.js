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
// added
var books = [];
function addRow() {

    let idField = $("#book_id");
    let quanlityField = $("#quanlity");
    let message = $("#error-message");

    let book_id = idField.val();
    let quanlity = quanlityField.val();

    if (book_id === "") {
        message.html( "Vui lòng điền mã sách" );
        idFielid.focus();
    } else if (quanlity === "") {
        message.html( "Vui lòng điền số lượng" );
        quanlityField.focus();
    } else {
        // thêm 1 book
        var book = undefined;
        if (books.every(book => book.id != book_id)) {
            book = {"id": book_id, "quanlity": quanlity};
            books.push(book);
        }
        else {
            let book = books.find(book => book.id == book_id);
            book.quanlity = parseInt(book.quanlity) + parseInt(quanlity);
        }
        
        var tr = $("<tr></tr>");
        var input_id = $(`<input name="book_id[]" style="border: none;"/>`);
        var input_quan = $(`<input name="quanlity[]" style="border: none;"/>`);
        var deleteButton = $(`<button class="btn btn-danger" onclick="deleteRow(this)">Xóa</button>`);
        var td = $("<td></td>");

        var tbody = $("#book-table > tbody");
        tbody.empty();
        for (let i = 0; i < books.length; i++) {
            let input_id_clone = input_id.clone();
            input_id_clone.val(books[i].id);

            let input_quan_clone = input_quan.clone();
            input_quan_clone.val(books[i].quanlity);

            let deleteButton_clone = deleteButton.clone();
            deleteButton_clone.attr("id", books[i].id);

            let td1_clone = td.clone();
            let td2_clone = td.clone();
            let td3_clone = td.clone();

            td1_clone.append(input_id_clone);
            td2_clone.append(input_quan_clone);
            td3_clone.append(deleteButton_clone);

            let tr_clone = tr.clone();
            tr_clone.append(td1_clone);
            tr_clone.append(td2_clone);
            tr_clone.append(td3_clone);

            tbody.append(tr_clone);
        }      
        return true;
    }
    return false;
}
function deleteRow(ele) {
    ele.parentNode.parentNode.remove(); 
    let id = ele.getAttribute("id");
    books.splice(id, 1);
}
// -----------end added------------------------------
// --------------------------------------------------
// function addRow() {
//     let idField = document.getElementById("book_id");
//     let quanlityField = document.getElementById("quanlity");
//     let message = document.getElementById("error-message");

//     let book_id = idField.value;
//     let quanlity = quanlityField.value;

//     if (book_id === "") {
//         message.innerHTML = "Vui lòng điền mã sách";
//         idField.focus();
//     } else if (quanlity === "") {
//         message.innerHTML = "Vui lòng điền số lượng";
//         quanlityField.focus();
//     } else {

//         var tr = document.createElement("tr");
//         var input_id = document.createElement("input");
//         var input_quan = document.createElement("input");
//         var deleteButton document.createElement()
//         var book_id_td = document.createElement("td");
//         var quanlity_td = document.createElement("td");
//         var table = document.getElementById("book-table");

//         input_id.value = book_id;
//         input_id.setAttribute("name", "book_id[]");
//         input_id.style.border = "none";
//         input_quan.value = quanlity;
//         input_quan.setAttribute("name", "quanlity[]");
//         input_quan.style.border = "none";

//         book_id_td.appendChild(input_id);
//         quanlity_td.appendChild(input_quan);

//         // book_id_td.setAttribute("name", "book_id[]");

//         tr.appendChild(book_id_td);
//         tr.appendChild(quanlity_td);

//         table.appendChild(tr);

//         message.innerHTML = "";

//         //san sang cho lan nhap tiep theo
//         idField.value = "";
//         quanlityField.value = "";

//         idField.focus();

//         return true;
//     }

//     return false;
// }