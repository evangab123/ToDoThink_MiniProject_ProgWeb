function deleteevent(id, tanggal,selesai) {
    var hariskrg = new Date().getDate();
    var bulanskrg = new Date().getMonth() + 1;
    var tahunskrg = new Date().getFullYear();
    var tanggalskrg = new Date(tahunskrg, bulanskrg - 1, hariskrg);
    var tanggalObj = new Date(tanggal);
    var tanggalObj2 = new Date(tanggalskrg);
    var selesaii = new Date(selesai);
    console.log(selesaii,tanggalObj2);
    if (selesaii > tanggalObj2) {
        var result = confirm("Apakah Anda yakin ingin menghapus event ini?");
        if (result) {
          window.location.href = "./deleteevent.php?id=" + id;
        }
    }else {
      
      alert("Sudah tidak bisa di hapus");
    }
  }
  
function updateevent(id, tanggal,selesai){
    var hariskrg = new Date().getDate();
    var bulanskrg = new Date().getMonth() + 1;
    var tahunskrg = new Date().getFullYear();
    var tanggalskrg = new Date(tahunskrg, bulanskrg - 1, hariskrg);
    var tanggalObj = new Date(tanggal);
    var tanggalObj2 = new Date(tanggalskrg);
    var selesaii = new Date(selesai);
    console.log(selesai,tanggalObj);
    if (selesaii > tanggalObj2) {
        window.location.href = "../form/form.php?id=" + id;
    }else {
        alert("Sudah tidak bisa di update");
    }
}