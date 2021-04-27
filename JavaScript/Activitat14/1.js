var allT = [];
$(document).ready(function(){
    fetch("https://jsonplaceholder.typicode.com/users")
    .then(data => data.json())
    .then(allT => {
        all = allT;
        all.map((one,i) => {
            let table = document.querySelector("#mainTable tbody");
            let tr = document.createElement("tr");
            let name = document.createElement("td");
            let mail = document.createElement("td");
            let linkF = document.createElement("td");
            let buttonF = document.createElement("button");
            buttonF.innerHTML = "More...";
            buttonF.addEventListener("click",function(){
                window.open("https://jsonplaceholder.typicode.com/users/"+one.id);
            });

            let linkT = document.createElement("td");
            let buttonT = document.createElement("button");
            buttonT.innerHTML = "All";
            buttonT.addEventListener("click",function(){  
                window.open("https://jsonplaceholder.typicode.com/todos?userId="+one.id);
            });

            let linkP = document.createElement("td");
            let buttonP = document.createElement("button");
            buttonP.innerHTML = "Posts";
            buttonP.addEventListener("click",function(){
                window.open("https://jsonplaceholder.typicode.com/posts?userId="+one.id);
            });

            name.innerHTML = one.name;
            mail.innerHTML = one.email;
            table.appendChild(tr);
            tr.appendChild(name);
            tr.appendChild(mail);
            tr.appendChild(linkF);
            linkF.appendChild(buttonF);
            tr.appendChild(linkT);
            linkT.appendChild(buttonT);
            tr.appendChild(linkP);
            linkP.appendChild(buttonP);
        })
    });
});