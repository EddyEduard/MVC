
// Create some bubble object for error page.

let html = "";

for (let i = 0; i <= 5; i++){
    html += "<div class='bubble'></div>";
}

document.getElementById("bubble").innerHTML = html;

// Go back user to previous page.

document.getElementById("goBack").addEventListener("click", function () {
    window.history.back();
}, false);
