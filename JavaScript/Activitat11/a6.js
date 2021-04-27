$( document).ready(function(){
    $("#animate").animate({
        left: '+=200',
        opcaity: '20%',
        borderWidth: '+=5px',
        backgroundColor: 'yellow',
        width: '-=25%',
        fontSize: '25px'
    },1000,_color);

    function _color(){
        $("#animate").animate({
            color: 'red',
            width: '+=25%'
        },1000);
    }
});