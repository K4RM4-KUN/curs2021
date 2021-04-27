var intro = prompt("Di algo!");

if (intro.length < 15) {
    alert(intro.slice(4,intro.length));
} else {
    alert(intro.slice(4,15));
}