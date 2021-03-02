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

            name.innerHTML = one.name;
            mail.innerHTML = one.email;

            table.appendChild(tr);
            tr.appendChild(name);
            tr.appendChild(mail);

            let linkF = document.createElement("td");
            let buttonF = document.createElement("button");
            buttonF.innerHTML = "More...";
            buttonF.addEventListener("click",function(){
                window.open("https://jsonplaceholder.typicode.com/users/"+one.id);
            });

            tr.appendChild(linkF);
            linkF.appendChild(buttonF);
            let linkT = document.createElement("td");
            let selectT = document.createElement("select");
            tr.appendChild(linkT);
            linkT.appendChild(selectT);
            selectT.setAttribute("id","todos"+one.id);
            selectT.append(new Option("","0"));

            fetch("https://jsonplaceholder.typicode.com/todos?userId="+one.id)
            .then(response => response.json())
            .then(todos => {
                todosT = todos;
                todosT.map((two,i) => {
                    selectT.append(new Option(two.title,two.id));
                    $("#todos"+one.id).change(function(){
                        window.open("https://jsonplaceholder.typicode.com/todos/"+two.id);
                    });
                }) 
            });


            let linkP = document.createElement("td");
            let selectP = document.createElement("select");
            tr.appendChild(linkP);
            linkP.appendChild(selectP);
            selectP.setAttribute("id","posts"+one.id);
            selectP.append(new Option("","0"));

            fetch("https://jsonplaceholder.typicode.com/posts?userId="+one.id)
            .then(response => response.json())
            .then(posts => {
                postsA = posts;
                postsA.map((three,i) => {
                    selectP.append(new Option(three.title,three.id));
                    let save = three.id;
                    $("#posts"+one.id).change(function(){
                        window.open("https://jsonplaceholder.typicode.com/posts/"+save);
                    });
                }) 
            });

        })
    });
});