function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min)) + min;
  }
var randomnum = getRandomInt(1,11);
var intro;

while((intro != randomnum)){
    intro = prompt("Advina el numero.")*1;
}
alert("Bien "+randomnum+" era el numero")