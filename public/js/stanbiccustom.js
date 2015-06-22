/**
 * Created by Amedora on 1/7/15.
 */
$(document).ready(function(){
    $("#oaccount").on("change",function(){


        if($(this).val()=="individual"){
            window.location = "./accounts/individual"
        }
        if($(this).val()=="joint"){
            window.location = "./accounts/joint"
        }
        if($(this).val()=="corporate"){
            window.location = "./accounts/corporate"
        }
    })
})