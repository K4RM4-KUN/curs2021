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
                alert(" Id: "+one.id+
                "\n Name: "+one.name+
                "\n Username: "+one.username+
                "\n Email: "+one.email+
                "\n Adress:\n  -City: "+one.address.city+"\n  -ZipCode: "+one.address.zipcode+"\n  -Street: "+one.address.street+"\n  -Suite: "+one.address.suite+"\n  -Geo: \n    ·Lat: "+one.address.geo.lat+"\n    ·Lng: "+one.address.geo.lng+
                "\n Phone: "+one.phone+
                "\n Website: "+one.website+
                "\n Company: \n  -Name: "+one.company.name+"\n  -Catch phrase: "+one.company.catchPhrase+"\n  -Bs: "+one.company.bs

                );
            });

            let linkT = document.createElement("td");
            let buttonT = document.createElement("button");
            buttonT.innerHTML = "All";
            let tmpId = one.id;
            buttonT.addEventListener("click",function(){  
                let postsA = [];
                fetch("https://jsonplaceholder.typicode.com/posts")
                .then(data => data.json())
                .then(allPosts => {
                    posts = allPosts;
                    posts.map((post,i) => {
                        if(post.userId == tmpId){
                            postsA.push([one.id,one.title,one.body]);
                        }
                    })
                });
            });

            let linkP = document.createElement("td");
            let buttonP = document.createElement("button");
            buttonP.innerHTML = "Posts";
            buttonP.addEventListener("click",function(){
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