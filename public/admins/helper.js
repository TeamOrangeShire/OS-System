const Supp =
{
    check: (inp, mess) => {
       const input = document.getElementById(inp);
       const message = document.getElementById(mess);

       if(input.value === '' || input.value == 0){
        message.style.display = '';
        input.classList.add('border', 'border-danger');
        return 0;
       }else{
        message.style.display = 'none';
        input.classList.remove('border', 'border-danger');
        return 1;
       }
    }
}
