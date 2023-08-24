var bulanskrg = new Date().getMonth(); 
var tahunskrg = new Date().getFullYear(); 
const days = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
const months = ["Januari", "Februari", "Maret", "April","Mei", "Juni","Juli",
"Agustus","September","Oktober","November","Desember"];
belumsudahlink = document.querySelectorAll(".menu li span");
const bulankalender = document.querySelector(".bulan");



function generateCalendar(month, year) {
  gantiwarna(month,year);
  const calendarBody = document.querySelector('#tabelkalender');
  const date = new Date(year, month);
  const hariini = new Date();
  const firstDayIndex = (date.getDay() + 6) % 7; // indeks hari pertama dalam array
  const lastDate = new Date(year, month + 1, 0).getDate(); // tanggal terakhir dalam bulan
  const prevlastDate = new Date(year,month,0).getDate();
  // const nextfirstDate = new Date(year,month+1,1).getDate();
  const rows = Math.ceil((lastDate + firstDayIndex) / 7); // jumlah baris dalam kalender

  let dateIndex = 1;
  let prevDateIndex = prevlastDate - firstDayIndex + 1;
  let nextDateIndex = 1;
  for (let i = 0; i < rows; i++) {
    const row = document.createElement('tr');

    for (let j = 0; j < 7; j++) {
      const cell = document.createElement('td');
      

      if (i === 0 && j < firstDayIndex) {
        // sel kosong di awal kalender
        const cellText = document.createTextNode(prevDateIndex);
        cell.classList.add('HariLuarBulan');
        cell.appendChild(cellText);
        prevDateIndex++;
      } else if (dateIndex > lastDate) {
        // sel kosong di akhir kalender
        const cellText = document.createTextNode(nextDateIndex);
        cell.classList.add('HariLuarBulan');
        cell.appendChild(cellText);
        nextDateIndex++;
      } else {
        // sel dengan tanggal
        const cellText = document.createTextNode(dateIndex);
        // const divv = document.createElement("div");
        // const dropdown =document.createElement("div"); 
        // const konten=document.createElement("div");
        // const link = document.createElement("a");
        // link.setAttribute("href","detail/detail.php?tanggal=")
        // divv.setAttribute("class","levelsangatpenting");
        // konten.setAttribute("class","dropdown-content");
        // dropdown.setAttribute("class","dropdown");
        if(hariini.getDate() == dateIndex && hariini.getMonth()== month){
          cell.classList.add('Hariini');
          cell.setAttribute("onmouseover","updateevent(event)");
        }else{
          cell.classList.add('Hari');
          // cell.setAttribute("onmouseover","updateevent(event)");
        }
        // konten.appendChild(link);
        // dropdown.appendChild(cellText);
        // dropdown.appendChild(konten);
        // divv.appendChild(dropdown);
        // cell.appendChild(divv);
        cell.appendChild(cellText);
        
        dateIndex++;       
      }
      
      row.appendChild(cell);
    }
    
    calendarBody.appendChild(row);
  }
  bulankalender.innerText= `${months[month]} ${year}`;
  
}
generateCalendar(bulanskrg,tahunskrg);

belumsudahlink.forEach(icon =>{
    icon.addEventListener("click", ()=>{
        if (icon.id === 'prev') {
            bulanskrg--;
          } else if(icon.id === 'next'){
            bulanskrg++;
          }else{{
            bulanskrg = new Date().getMonth();
            tahunskrg = new Date().getFullYear();
          }}
        if(bulanskrg<=12 && bulanskrg >=-1){
            // console.log(bulanskrg);
            if(bulanskrg<0){
              tahunskrg-=1;
              bulanskrg=11;
            }else if(bulanskrg>11){
              tahunskrg+=1;
              bulanskrg=0;
            }
            resetTable();
            generateCalendar(bulanskrg, tahunskrg);
        }
    });
});

function resetTable() {
    const tbody = document.querySelector('#tabelkalender');
    const children = tbody.children;
    for (let i = children.length - 1; i >= 1; i--) {
      tbody.removeChild(children[i]);
    }
  }

// var tds = document.getElementsByClassName("Hari");
// Array.from(tds).forEach(function(td) {
//   td.addEventListener('dblclick', function(event) {
//     var tdElement = event.target;
//     var selectedDate = tdElement.textContent;
//     var tanggal = tahunskrg + "-" + (bulanskrg + 1) + "-" + selectedDate;
//     window.location.href = 'detail/detail.php?tanggal=' + tanggal;
//   });
// });



function getSessionId(callback) {
  $.ajax({
    url: './getsession.php', 
    method: 'GET',
    dataType: 'json',
    success: function(response) {
      // Membaca nilai session dari respons JSON
      var sessionId = response.id;
      // Memanggil callback dengan nilai session sebagai argumen
      callback(sessionId);
    },
    error: function(xhr, status, error) {
      // Tanggapan error dari server
      console.error('Terjadi kesalahan:', error);
    }
  });
}

function gantiwarna(monthsss,yearsss){
  $.ajax({
    url: 'getdata.php', 
    method: 'GET',
    success: function(response) {
      var parsedResponse = JSON.parse(response);
      getSessionId(function(currentAccountId) {
        parsedResponse.forEach(function(item) {
          
          var mulai = item["mulai"]; // Mengambil nilai "mulai" dari setiap objek
          var selesai = item["selesai"];
          var idAkun = item["id_akun"]; 
          // var level = item["level"];
          // var namakegiatan = item['nama'];
          var tanggalHari = parseInt(mulai.split('-')[2],10); // Mengambil bagian tanggal dari tanggal lengkap
          var tanggalHariSelesai = parseInt(selesai.split('-')[2],10);
          var tds = document.getElementsByClassName("Hari");
          var bulanhelp = parseInt(mulai.split('-')[1], 10);
          var tahunhelp = mulai.split('-')[0];
          
          Array.from(tds).forEach(function(td){
            for(let i = tanggalHari; i<=tanggalHariSelesai;i++){
              const cellText = document.createTextNode(i);
              if (td.textContent.trim() == i && idAkun === currentAccountId && bulanhelp-1 === monthsss && tahunhelp==yearsss) {  
                  td.setAttribute("class", "harievent");
                  td.setAttribute("onmouseover","updateevent(event)");
                  
                }
              }
            });
          });
        });
      }});
    }    
               

function updateevent(event){
  var eventss = document.getElementsByClassName("events");
  const td = event.target;
  while(eventss[0].hasChildNodes()) {
    eventss[0].removeChild(eventss[0].firstChild);
  }
  
  $.ajax({
    url: 'getdata.php', 
    method: 'GET',
    success: function(response) {
      var parsedResponse = JSON.parse(response);
      const cellText = document.createTextNode(td.textContent);
      // if(eventss[0].hasChildNodes()) {
      //     eventss[0].removeChild(eventss[0].firstChild);
      // }
      getSessionId(function(currentAccountId) {
      parsedResponse.forEach(function(item) {
        var tanggalHari = parseInt(item["mulai"].split('-')[2],10); // Mengambil bagian tanggal dari tanggal lengkap
        var tanggalHariSelesai = parseInt(item["selesai"].split('-')[2],10);
        var bulanhelp = parseInt(item["mulai"].split('-')[1], 10);
        var tahunhelp = item["mulai"].split('-')[0];
        var bulanhelpselesai = parseInt(item["selesai"].split('-')[1], 10);
        var tahunhelpselesai = item["selesai"].split('-')[0];
        for (var i = tanggalHari; i <=tanggalHariSelesai;i++) {
          if (td.textContent.trim() == i && item["id_akun"] === currentAccountId && bulanhelp-1 === bulanskrg && tahunhelp==tahunskrg) {  
            // console.log(item);
              const textwaktu = document.createTextNode(item["durasi"]+"jam");
              const textjudul = document.createTextNode(item["nama"]);
              const divvevent = document.createElement('div');
              divvevent.setAttribute("class","event");
              const judul = document.createElement('div');
              judul.setAttribute("class","JudulEvent");
              judul.appendChild(textjudul);
              const divvwaktu = document.createElement('div');
              divvwaktu.setAttribute("class","Waktu");
              divvwaktu.appendChild(textwaktu);
              divvevent.appendChild(judul);
              divvevent.appendChild(divvwaktu);
              eventss[0].appendChild(divvevent);
              if(item["level"]==="sangat penting"){
                divvevent.setAttribute("id","levelsangatpenting");
              }else if(item["level"]==="penting"){
                divvevent.setAttribute("id","levelpenting");
              }else if(item["level"]==="biasa"){
                divvevent.setAttribute("id","levelbiasa");
              }
              divvevent.addEventListener('click', function(event) {
                  var tanggal = tahunskrg + "-" + (bulanskrg + 1) + "-" + tanggalHari;
                  var tanggalselesai = tahunskrg + "-" + (bulanskrg + 1) + "-" + tanggalHariSelesai;
                  window.location.href = 'detail/detail.php?tanggal=' + tanggal+"&&tanggalselesai="+tanggalselesai+"&&id="+item["id"];
                  //"&&nama="+namakegiatan+
    
              });
            }
        }
        
      });
    });
    }
  });
}


  





