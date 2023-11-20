$('document').ready(function () { 
    display_time();
});

setInterval(function(){
    display_time()
}, 1000);

function display_time() {
    var x = new Date();
    const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    if (x.getHours() > 12) { hours = x.getHours() - 12; z = "PM" } else { hours = x.getHours(); z = "AM" }
    if (x.getMinutes() < 10) { minutes = "0" + x.getMinutes(); } else { minutes = x.getMinutes() }
    if (x.getSeconds() < 10) { seconds = "0" + x.getSeconds(); } else { seconds = x.getSeconds() }

    dtnow = days[x.getDay()] + ", " + months[x.getMonth()] + " " + x.getDate() + ", " + x.getFullYear() + ", " + hours + ":" + minutes + ":" + seconds + " " + z;

   $("#dateTime").html(dtnow)
}



