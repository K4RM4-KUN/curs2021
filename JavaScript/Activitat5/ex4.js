let color = localStorage.getItem("ex4color");
document.querySelector("#ex4Blue").addEventListener("click", function() {color ="#080e57";});
document.querySelector("#ex4Red").addEventListener("click", function() {color ="#691519"});
document.querySelector("#ex4Green").addEventListener("click", function() {color ="#083b10"});
document.querySelector("#ex4White").addEventListener("click", function() {color = "white"});
document.querySelector("#ex4Save").addEventListener("click", function() {localStorage.setItem("ex4color",color); location.href="./ex1.html";});
