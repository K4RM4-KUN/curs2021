$(document).ready(function(){
    //Functions
    function removeAllOptions(select,blank){
        select.innerHTML = "";
        if(blank){
            let newOption = document.createElement("option");
            newOption.text = "";
            newOption.value = "blank";
            select.append(newOption);
        }
    }

    //Json's url's
    var provinceUrl = "https://exemple2021-c42ba-default-rtdb.europe-west1.firebasedatabase.app/Provincies.json";
    var poblationUrl = "https://exemple2021-c42ba-default-rtdb.europe-west1.firebasedatabase.app/Poblacions.json";
    var postalCodeUrl = "https://exemple2021-c42ba-default-rtdb.europe-west1.firebasedatabase.app/Codis_Postals.json";

    //Form's var's
    var name = document.getElementById("nameInput");
    var surname = document.getElementById("surnameInput");
    var address = document.getElementById("addressInput");
    var province = document.getElementById("provinceInput");
    var poblation = document.getElementById("poblationInput");
    var postalCode = document.getElementById("postalCodeInput");
    var sendButton = document.getElementById("send");

    //Send button build
    sendButton.addEventListener('click',function(){
        localStorage.setItem('name',name.value);
        localStorage.setItem('surname',surname.value);
        localStorage.setItem('address',address.value);
        localStorage.setItem('province',province.value);
        localStorage.setItem('poblation',poblation.value);
        localStorage.setItem('postalCode',postalCode.value);
    });

    //Province build
    fetch(provinceUrl)
    .then(response => response.json())
    .then(data => {
        provs = data;
        provs.map((one,i) => {
            let newOption = document.createElement("option");
            newOption.text = one.provincia;
            newOption.value = one.codi;
            province.append(newOption);
        }) 
    });

    //Poblation build
    province.addEventListener('change',function(){
        if(province.value != "blank"){
            removeAllOptions(poblation,false);
            fetch(poblationUrl)
            .then(response => response.json())
            .then(data => {
                pobls = data;
                pobls.map((one,i) => {
                    if(one.cod_prov == this.value){
                        let newOption = document.createElement("option");
                        newOption.text = one.poblacio;
                        newOption.value = one.codi;
                        poblation.append(newOption);
                    }
                }) 
            });
        } else {
            removeAllOptions(poblation,true);
            removeAllOptions(postalCode,true);
        }
    });
    
    //PostalCode build
    poblation.addEventListener('change',function(){
        if(poblation.value != "blank"){
            removeAllOptions(postalCode,false);
            fetch(postalCodeUrl)
            .then(response => response.json())
            .then(data => {
                post = data;
                post.map((one,i) => {
                    if(parseInt(one.codi_poble) == parseInt(this.value)){
                        let newOption = document.createElement("option");
                        if((one.codi_postal).toString().length == 4){
                            newOption.text = "0"+one.codi_postal;
                            newOption.value = "0"+one.codi_postal;
                        }else {
                            newOption.text = one.codi_postal;
                            newOption.value = "0"+one.codi_postal;
                        }
                        postalCode.append(newOption);
                    }
                }) 
            });
        } else {
            removeAllOptions(poblation,true);
        }
    });
});