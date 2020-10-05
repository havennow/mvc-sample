document.addEventListener("DOMContentLoaded", function(event) {
    var objects = document.querySelectorAll(".js-date-format");
        for (var i = 0, len = objects.length; i < len -1 ; i++) {
            var date =  new Date(objects[i].innerHTML);
            if (i === 0 ) {
                objects[i].innerHTML = date.getSeconds() + " Seconds ago";
            }

            if (i === 1 ) {
                objects[i].innerHTML = date.getMinutes() + " Minutes ago";
            }

            if (i === 2 ) {
                objects[i].innerHTML = date.getHours() + " Hours ago";
            }

            if (i === 3 ) {
                objects[i].innerHTML = date.getHours() + " Hours ago";
            }

            if (i === 4 ) {
                objects[i].innerHTML = date.getHours() + " Hours ago";
            }

            if (i === 5 ) {
                objects[i].innerHTML = date.getHours() + " Hours ago";
            }
        }
});
