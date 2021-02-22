$('#show').click(function() {
    switch ($('#selectProvince').val()){
        case "coruna":
            $("#postalCode").val("50");
            $("#name").val("A Coruña");
            break;
        case "alava":
            $("#postalCode").val("01");
            $("#name").val("Àlava");
            break;
        case "zamora":
            $("#postalCode").val("49");
            $("#name").val("Zamora");
            break;
        case "zaragoza":
            $("#postalCode").val("50");
            $("#name").val("Zaragoza");
            break;
        case "albacete":
            $("#postalCode").val("02");
            $("#name").val("Albacete");
            break;
        default:
            $("#postalCode").val("???");
            $("#name").val("???");
            break;
    }
});