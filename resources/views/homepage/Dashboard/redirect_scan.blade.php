<!DOCTYPE html>
<html lang="en">
<head>
    @include('homepage.Dashboard.Components.header', ['title'=>'QR Code Scan - Orange Shire'])
</head>
<body>
    
<form id="scanQR" method="post">
    @csrf 
    <input type="hidden" name="cust_id" value="{{ $user_id }}"> 
    <input type="hidden" name="direction" value="{{ $direction }}">
</form>

<script>
    
  function GetQRCodeURL(){
    var formData = $('form#scanQR').serialize();

    $.ajax({
        type: 'POST',
        url: "{{ route('updateQRLog') }}",
        data: formData,
        success: function(response) {
         if(response.status === 'success'){
            window.location.href = "{{ route('logintoshire') }}";
         }
        }, 
        error: function (xhr) {

            console.log(xhr.responseText);
        }
    });
  }
  window.onload = function() {
    GetQRCodeURL();
};
</script>
</body>
</html>