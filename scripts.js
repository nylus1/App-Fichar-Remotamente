// Mostrar Reloj en index 

function showTime() {
    var date = new Date();
    var h = date.getHours(); // 0 - 23
    var m = date.getMinutes(); // 0 - 59
    var s = date.getSeconds(); // 0 - 59
    var session = "AM";

    if (h == 0) {
        h = 12;
    }

    if (h > 12) {
        h = h - 12;
        session = "PM";
    }

    h = (h < 10) ? "0" + h : h;
    m = (m < 10) ? "0" + m : m;
    s = (s < 10) ? "0" + s : s;

    var time = h + ":" + m + ":" + s + " " + session;
    document.getElementById("ClockDisplay").innerText = time;
    document.getElementById("ClockDisplay").textContent = time;

    setTimeout(showTime, 1000);
}

showTime();


// Ubication/time script

function getLocation() {
    const successCallback = (position) => {
      console.log(position);
      const locationInput = document.getElementById("location");
      const timeInput = document.getElementById("time");
      locationInput.value = `${position.coords.latitude}, ${position.coords.longitude}`;
      timeInput.value = new Date().toLocaleTimeString();
    };
    
    const errorCallback = (error) => {
      console.log(error);
    };
    
    navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
}
  