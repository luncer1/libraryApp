var cb = document.getElementById("show_done");
var returned = document.querySelectorAll(".returned");
cb.addEventListener("change", () => {
    if (cb.checked) {
        returned.forEach((element) => {
            element.style.display = "none";
        });
    } else {
        returned.forEach((element) => {
            element.style.display = "table-row";
        });
    }
});
if (cb.checked) {
    returned.forEach((element) => {
        element.style.display = "none";
    });
} else {
    returned.forEach((element) => {
        element.style.display = "table-row";
    });
}
