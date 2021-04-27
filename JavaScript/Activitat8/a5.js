var numbers = [];

while(numbers.length != 30){
    numbers.push(Math.floor(Math.random() * 11));
}

numbers = numbers.filter(number => ((number%2) == 0));

console.log(numbers.join("-"));