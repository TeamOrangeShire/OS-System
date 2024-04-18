<script>
    window.onload = function (){
        downloadFile('orange-shire.apk', "{{ asset('apk') }}");
    }

    function downloadFile(fileName, directoryPath) {
    var link = document.createElement('a');
    link.href = directoryPath + '/' + fileName;
    link.download = fileName;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);


    var link2 = document.createElement('a');
    link2.href = "{{ route('home') }}";
    link2.href = 'Go Back to Home Page <---'
    document.body.appendChild(link);
}
</script>


