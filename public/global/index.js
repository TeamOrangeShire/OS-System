function timeDifference(startTime, endTime) {
    const start = parseTime(startTime);
    const end = parseTime(endTime);
  
    let diff = end - start;
    if (diff < 0) {
      diff += 24 * 60 * 60 * 1000;
    }
  
    const hours = Math.floor(diff / (60 * 60 * 1000));
    const minutes = Math.floor((diff % (60 * 60 * 1000)) / (60 * 1000));
  
    return { hours, minutes };
  }
  
  function parseTime(time) {
    const parts = time.split(':');
    const hour = parseInt(parts[0]);
    const minute = parseInt(parts[1]);
    const isPM = time.includes('PM');
  
    let totalMinutes = hour * 60 + minute;
  
    if (isPM && hour !== 12) {
      totalMinutes += 12 * 60;
    } else if (!isPM && hour === 12) {
      totalMinutes -= 12 * 60;
    }
  
    return totalMinutes * 60 * 1000;
  }
  
  
  function PaymentCalc(hours, minutes, type) {
    var payment = 0;
    if (type === "Student" || type === "Teacher" || type === "Reviewer") {
      switch (hours) {
        case 1:
          payment += 50;
          break;
        case 2:
          payment += 100
          break;
        case 3:
          payment += 140;
          break;
        case 4:
          payment += 185;
          break;
        case 5:
          payment += 220;
          break;
        case 6:
          payment += 240;
          break;
        case 7:
          payment += 280;
          break;
        case 8:
          payment += 320;
          break;
        case 0:
          payment += 0;
          break;
        default:
          payment += 320;
          break;
      }
      if (hours === 0 && minutes <= 15) {
        payment += 0;
      }
      if ((hours === 0 || hours === 1) && (minutes > 15 && minutes <= 45)) {
        payment += 25;
      }
      if ((hours === 0 || hours === 1) && (hours < 2 && minutes > 45)) {
        payment += 50;
      }
      if (hours === 2 && minutes < 15) {
        payment += 0;
      }
      if (hours === 2 && minutes > 15 && minutes <= 45) {
        payment += 20;
      }
      if (hours === 2 && hours < 3 && minutes > 45) {
        payment += 40;
      }
  
      if (hours === 3 && minutes < 15) {
        payment += 0;
      }
      if (hours === 3 && minutes > 15 && minutes <= 45) {
        payment += 20;
      }
      if (hours === 3 && hours < 4 && minutes > 45) {
        payment += 45;
      }
  
      if (hours === 4 && minutes < 15) {
        payment += 0;
      }
      if (hours === 4 && minutes > 15 && minutes <= 45) {
        payment += 25;
      }
      if (hours === 4 && hours < 5 && minutes > 45) {
        payment += 35;
      }
  
      if (hours === 5 && minutes < 15) {
        payment += 0;
      }
      if (hours === 5 && minutes > 15 && minutes <= 45) {
        payment += 10;
      }
      if (hours === 5 && hours < 6 && minutes > 45) {
        payment += 20;
      }
  
      if (hours === 6 && minutes < 15) {
        payment += 0;
      }
      if (hours === 6 && minutes > 15 && minutes <= 45) {
        payment += 20;
      }
      if (hours === 6 && hours < 7 && minutes > 45) {
        payment += 40;
      }
  
      if (hours === 7 && minutes < 15) {
        payment += 0;
      }
      if (hours === 7 && minutes > 15 && minutes <= 45) {
        payment += 20;
      }
      if (hours === 7 && hours < 8 && minutes > 45) {
        payment += 40;
      }
    } else {
      switch (hours) {
        case 1:
          payment += 80;
          break;
        case 2:
          payment += 160
          break;
        case 3:
          payment += 200;
          break;
        case 4:
          payment += 260;
          break;
        case 5:
          payment += 280;
          break;
        case 6:
          payment += 300;
          break;
        case 7:
          payment += 350;
          break;
        case 8:
          payment += 400;
          break;
        case 0:
          payment += 0;
          break;
        default:
          payment += 400;
          break;
      }
      if (hours === 0 && minutes <= 15) {
        payment += 0;
      }
      if ((hours === 0 || hours === 1) && (minutes > 15 && minutes <= 45)) {
        payment += 40;
      }
      if ((hours === 0 || hours === 1) && (hours < 2 && minutes > 45)) {
        payment += 80;
      }
      if (hours === 2 && minutes < 15) {
        payment += 0;
      }
      if (hours === 2 && minutes > 15 && minutes <= 45) {
        payment += 30;
      }
      if (hours === 2 && hours < 3 && minutes > 45) {
        payment += 40;
      }
  
      if (hours === 3 && minutes < 15) {
        payment += 0;
      }
      if (hours === 3 && minutes > 15 && minutes <= 45) {
        payment += 30;
      }
      if (hours === 3 && hours < 4 && minutes > 45) {
        payment += 60;
      }
  
      if (hours === 4 && minutes < 15) {
        payment += 0;
      }
      if (hours === 4 && minutes > 15 && minutes <= 45) {
        payment += 10;
      }
      if (hours === 4 && hours < 5 && minutes > 45) {
        payment += 20;
      }
  
      if (hours === 5 && minutes < 15) {
        payment += 0;
      }
      if (hours === 5 && minutes > 15 && minutes <= 45) {
        payment += 10;
      }
      if (hours === 5 && hours < 6 && minutes > 45) {
        payment += 20;
      }
  
      if (hours === 6 && minutes < 15) {
        payment += 0;
      }
      if (hours === 6 && minutes > 15 && minutes <= 45) {
        payment += 30;
      }
      if (hours === 6 && hours < 7 && minutes > 45) {
        payment += 50;
      }
  
      if (hours === 7 && minutes < 15) {
        payment += 0;
      }
      if (hours === 7 && minutes > 15 && minutes <= 45) {
        payment += 20;
      }
      if (hours === 7 && hours < 8 && minutes > 45) {
        payment += 50;
      }
    }
  
    return payment;
  }
  