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
    }, CheckMonth: month => {
        switch(month) {
            case 'January':
                return 1;
            case 'February':
                return 2;
            case 'March':
                return 3;
            case 'April':
                return 4;
            case 'May':
                return 5;
            case 'June':
                return 6;
            case 'July':
                return 7;
            case 'August':
                return 8;
            case 'September':
                return 9;
            case 'October':
                return 10;
            case 'November':
                return 11;
            case 'December':
                return 12;
            default:
                throw new Error('Invalid month name');
        }
    }, convertTo24Hour: time12h => {
        const [time, modifier] = time12h.split(' ');
        let [hours, minutes] = time.split(':');
    
        if (modifier === 'PM' && hours !== '12') {
            hours = parseInt(hours, 10) + 12;
        }
        if (modifier === 'AM' && hours === '12') {
            hours = 0;
        }
    
        return `${String(hours).padStart(2, '0')}:${minutes}`;
    }
}
