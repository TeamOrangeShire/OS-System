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

    window.location.href = "{{ route('home') }}";
}
</script>