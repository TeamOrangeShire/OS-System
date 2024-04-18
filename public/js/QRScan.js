
function DetectScreenSize(route, update){
    if (/Mobi|Android/i.test(navigator.userAgent)) {
        StartScan(update);
    } else {
       window.location.href = route;
    }
}

function StartScan(urls){

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