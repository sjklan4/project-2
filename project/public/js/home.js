$(document).ready(function(){
    var carbVal = $('#carbPro').val();
    var carbMax = $('#carbPro').attr("max");
    var proVal = $('#proteinPro').val();
    var proMax = $('#proteinPro').attr("max");
    var fatVal = $('#fatPro').val();
    var fatMax = $('#fatPro').attr("max");

    fcRed();
    function fcRed(){
        if(carbVal >= carbMax){
            $('span.carbSpan').addClass('fc-red');
        }
        if(proVal >= proMax){
            $('span.proteinSpan').addClass('fc-red');
        }
        if(fatVal >= fatMax){
            $('span.fatSpan').addClass('fc-red');
        }
    }


    $("button.toggle").on("click",function(){
        $(this).children("span.upbtn").css("display","block");
        $(this).children("span.downbtn").css("display","none");
    });
    $("span.upbtn").on("click",function(){
        $("span.upbtn").css("display","none");
        $("span.downbtn").css("display","block");
    });

});
