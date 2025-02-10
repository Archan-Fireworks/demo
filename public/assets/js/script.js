// Header cart
 var cartmodal = document.getElementById("cartmodal");
var cartbtn = document.getElementById("cartbtn");
var closeBtn = document.getElementsByClassName("closeBtn")[0];
cartbtn.onclick = function() {
    cartmodal.style.display = "block";
}
closeBtn.onclick = function() {
    cartmodal.style.display = "none";
}
window.onclick = function(event) {
if (event.target == cartmodal) {
    cartmodal.style.display = "none";
}
}