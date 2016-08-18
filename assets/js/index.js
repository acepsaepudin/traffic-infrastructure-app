$(function(){
  setInterval(function(){
  getKerusakan();
  // getSewaToAdmin();
  },5000); //set 10 detik
});

function getKerusakan() {
    $.ajax({
        url: "http://tia.local/ajaxnotif/get_kerusakan",
        async: true,            // by default, it's async, but...
        dataType: 'json',       // or the dataType you are working with
        timeout: 5000,          // IMPORTANT! this is a 10 seconds timeout
        cache: false

    }).done(function (eventListdua) {  
      console.log('heheh');
      if(eventListdua.total != 0) {
        $('.kerusakan-notif').html(eventListdua.total);
        // alert(eventListdua.total);
      } else {
        $('.kerusakan-notif').html('');
      }
        // $('.operasionaltotal').html('ganteng');
    });
}