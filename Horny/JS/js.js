class timer {
    // set enddate
    constructor(year, month, day, hour, minute, second) {
        this.year = year;
        this.month = month;
        this.day = day;
        this.hour = hour;
        this.minute = minute;
        this.second = second;
    }


    // get remianing time in hours, minutes , seconds
    get_remainingtime() {
        var endate = new Date();
        endate.setFullYear(this.year);
        endate.setMonth(this.month);
        endate.setDate(this.day);
        endate.setHours(this.hour);
        endate.setMinutes(this.minute);
        endate.setSeconds(this.second);

        var t = endate.getTime() - Date.now();
        if (t <= 0) {
            this.remaininghour = 0;
            this.remainingminute = 0;
            this.remainingsecond = 0;
        } else {
            this.remaininghour = Math.floor((t % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            this.remainingminute = Math.floor((t % ((60 * 60 * 1000))) / (60 * 1000));
            this.remainingsecond = Math.floor((t % (60 * 1000)) / 1000);
        }
    }


}

// show timer 
function showtimer() {
    var endate = new timer(2020, 3, 25, 16, 0, 0);
    setInterval(() => {
        endate.get_remainingtime();
        document.getElementById("hour").innerText = endate.remaininghour;
        document.getElementById("minute").innerText = endate.remainingminute;
        document.getElementById("second").innerText = endate.remainingsecond;
    }, 1000)

}

showtimer();