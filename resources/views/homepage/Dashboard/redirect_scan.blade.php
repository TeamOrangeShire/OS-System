<form id="scanQR" method="post">
    @csrf 
    <input type="hidden" name="cust_id" value="{{ $user_id }}"> 
    <input type="hidden" name="direction" value="{{ $direction }}">
</form>

<script>
    
  function GetQRCodeURL(url){
    var formData = $('form#scanQR').serialize();

    $.ajax({
        type: 'POST',
        url: "{{ route('updateQRLog') }}",
        data: formData,
        success: function(response) {
         
        }, 
        error: function (xhr) {

            console.log(xhr.responseText);
        }
    });
  }

</script>