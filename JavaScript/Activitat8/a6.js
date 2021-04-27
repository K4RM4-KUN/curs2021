var numbers = [];

while(numbers.length != 10){
    numbers.push(Math.floor(Math.random() * 11));
}

numbers = numbers.map(function(num){
    num+=(Math.floor(Math.random() * 11));
    if((num%2) == 0){
        num = num/2;
    }
    return num;
});

console.log(numbers.join("-"));