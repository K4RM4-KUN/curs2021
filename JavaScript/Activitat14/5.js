$(document).ready(function(){
    //Functions
    function removeAllOptions(select,blank){
        $(select).empty();
        if(blank){
            $(select).append("<option value='blank'></option>");
        }
    }

    //Json's url's
    var provinceUrl = "https://exemple2021-c42ba-default-rtdb.europe-west1.firebasedatabase.app/Provincies.json";
    var poblationUrl = "https://exemple2021-c42ba-default-rtdb.europe-west1.firebasedatabase.app/Poblacions.json";
    var postalCodeUrl = "https://exemple2021-c42ba-default-rtdb.europe-west1.firebasedatabase.app/Codis_Postals.json";

    //Form's var's
    var name = $('#nameInput');
    var surname = $('#surnameInput');
    var address = $('#addressInput');
    var province = $('#provinceInput');
    var poblation = $('#poblationInput');
    var postalCode = $('#postalCodeInput');
    var sendButton = $("#send");

    //Send button build
    sendButton.click(function(){
        localStorage.setItem('name',$(name).val());
        localStorage.setItem('surname',$(surname).val());
        localStorage.setItem('address',$(address).val());
        localStorage.setItem('province',$(province).val());
        localStorage.setItem('poblation',$(poblation).val());
        localStorage.setItem('postalCode',$(postalCode).val());
    });

    //Province build
    fetch(provinceUrl)
    .then(response => response.json())
    .then(data => {
        provs = data;
        provs.map((one,i) => {
            $(province).append("<option value='"+one.codi+"'>"+one.provincia+"</option>");
        }) 
    });

    //Poblation build
    province.change(function(){
        if(province.value != "blank"){
            removeAllOptions(poblation,false);
            fetch(poblationUrl)
            .then(response => response.json())
            .then(data => {
                pobls = data;
                pobls.map((one,i) => {
                    if(one.cod_prov == this.value){
                        $(poblation).append("<option value='"+one.codi+"'>"+one.poblacio+"</option>");
                    }
                }) 
            });
        } else {
            removeAllOptions(poblation,true);
            //This have to remove all options of postal code field when you select blank on province field, but for any reason it isn't working...//
            removeAllOptions(postalCode,true);
        }
    });
    
    //PostalCode build
    poblation.change(function(){
        if(poblation.value != "blank"){
            removeAllOptions(postalCode,false);
            fetch(postalCodeUrl)
            .then(response => response.json())
            .then(data => {
                post = data;
                post.map((one,i) => {
                    if(parseInt(one.codi_poble) == parseInt(this.value)){
                        if((one.codi_postal).toString().length == 4){
                            $(postalCode).append("<option value='"+"0"+one.codi_postal+"'>"+"0"+one.codi_postal+"</option>");
                        }else {
                            $(postalCode).append("<option value='"+one.codi_postal+"'>"+one.codi_postal+"</option>");
                        }
                    }
                }) 
            });
        } else {
            removeAllOptions(poblation,true);
        }
    });
});