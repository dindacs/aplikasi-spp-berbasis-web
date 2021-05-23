// dropdown
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function () {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}

// 
// $(document).ready(function () {
//   // event ketika keyword diketik
//   $('#keyw').on('keyup', function () {
//     $('#container').load('ajax/?page=pembayaran?keyword=' + $('#keyw').val());
//   });
// });
// 

// UNTUK FILTER PENCARIAN DATA DARI 
// siswa_data, kelas_data, spp_data, petugas_data
$(document).ready(function () {
  $("#myInput").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function () {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
// 

// UNTUK MENAMPILKAN TANGGAL DARI
// laporan
$(function () {
  $(".datepicker").datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true,
    todayHighlight: false,
  });
  $("#tgl_mulai").on('changeDate', function (selected) {
    var startDate = new Date(selected.date.valueOf());
    $("#tgl_akhir").datepicker('setStartDate', startDate);
    if ($("#tgl_mulai").val() > $("#tgl_akhir").val()) {
      $("#tgl_akhir").val($("#tgl_mulai").val());
    }
  });
});
//

// UNTUK MENAMPILKAN TANGGAL DARI
// pembayaran
$(function () {
  $(".datepickeri").datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true,
    todayHighlight: true,
  });
});
//