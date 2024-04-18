
function DetectScreenSize(route, update, toShire){
    if (/Mobi|Android/i.test(navigator.userAgent)) {
        StartScan(update, toShire);
    } else {
       window.location.href = route;
    }
}

function StartScan(urls, toShire){

    document.getElementById('qrScanner').style.display = 'block';
    const html5QrCode = new Html5Qrcode('qrScanner');

    // Start QR code scanning
    html5QrCode.start(
      { facingMode: "environment" }, 
      {
        fps: 10, // Set frames per second (optional)
        qrbox: 250 // Set size of QR code scanning box (optional)
      },
      qrCodeMessage => {
        
        const code = document.getElementById('code');
        code.value = qrCodeMessage;
        var formData = $('form#QRData').serialize(); 
        $.ajax({
          type: 'POST',
          url: urls,
          data: formData,
          success: function(response) {
           if(response.status === 'login'){
            window.location.href = toShire;
           }else{
            const query = toShire + '?status=success&log_id=' + response.log_data;
            window.location.href = query;
           }
          }, 
          error: function (xhr) {
 
              console.log(xhr.responseText);
          }
      });

        html5QrCode.stop().then(ignore => {
          document.getElementById('qrScanner').style.display = 'none';
        }).catch(err => console.error(err));
      },
      errorMessage => {
        console.error('Error scanning QR code:', errorMessage);
        
      }
    );
}