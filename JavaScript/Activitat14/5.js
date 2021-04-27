

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

//Functions
function removeAllOptions(select,blank){
    $(select).empty();
    if(blank){
        $(select).append("<option value='blank'></option>");
    }
}

async function provinces(){
    try{
        dates = await fetch(provinceUrl)
        data = await dates.json()
        let prov = data;
        prov.map((one) => {
            $(province).append("<option value='"+one.codi+"'>"+one.provincia+"</option>");
        }) 
    }catch{
        console.error("Error 0");
    }
}

async function poblations(code){
    try{
        dates = await fetch(poblationUrl)
        data = await dates.json()
        pobl = data;
        pobl.map((one) => {
            if(one.cod_prov == code){
                $(poblation).append("<option value='"+one.codi+"'>"+one.poblacio+"</option>");
            }
        })
    }catch{
        console.error("Error 1");
    }
}

async function postalCodes(code){
    try{
        dates = await fetch(postalCodeUrl)
        data = await dates.json()
        post = data;
        post.map((one) => {
            if(parseInt(one.codi_poble) == parseInt(code)){
                if((one.codi_postal).toString().length == 4){
                    $(postalCode).append("<option value='"+"0"+one.codi_postal+"'>"+"0"+one.codi_postal+"</option>");
                }else {
                    $(postalCode).append("<option value='"+one.codi_postal+"'>"+one.codi_postal+"</option>");
                }
            }
        })
    }catch{
        console.error("Error 2");
    }
}

$(document).ready(function(){

    provinces();

    //Send button build
    sendButton.click(function(){
        localStorage.setItem('name',$(name).val());
        localStorage.setItem('surname',$(surname).val());
        localStorage.setItem('address',$(address).val());
        localStorage.setItem('province',$(province).val());
        localStorage.setItem('poblation',$(poblation).val());
        localStorage.setItem('postalCode',$(postalCode).val());
    });


    //Poblation build
    province.change(function(){
        if(province.value != "blank"){
            removeAllOptions(poblation,false);
            poblations($(this).val());
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
            postalCodes($(this).val());
        } else {
            removeAllOptions(poblation,true);
        }
    });
});