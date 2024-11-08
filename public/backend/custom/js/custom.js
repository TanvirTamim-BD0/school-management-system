//For sidebar logo...
function sidebarLogo() {
    var x = document.getElementById("firstLogo");
    var y = document.getElementById("secondLogo");
    if (x.style.display === "none") {
        x.style.display = "block";
        y.style.display = "none";
    } else {
        x.style.display = "none";
        y.style.display = "block";
    }
}