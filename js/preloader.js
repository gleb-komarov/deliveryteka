var myVar;

function myFunction() {
    myVar = setTimeout(showPage, 300);
}

function showPage() {
    document.getElementById("loader").style.display = "none";
    document.getElementById("content").style.display = "block";
}