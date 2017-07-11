/**
 * Created by antoi on 23/05/2016.
 */
var boxAdr = false;
var box = false;

$(document).ready(function () { 
    
    var onlyTake = $("#onlyTake");
    var onlyDelivery = $("#onlyDelivery");
    var allDelivery = $("#allDelivery");
    var valDelivery = -1;
    if (onlyTake !== "undefined")
    {
        if (onlyDelivery.is(':checked'))
        {
            valDelivery =0;
        }
        else if (onlyTake.is(':checked'))
        {
            valDelivery = 1;
        }
        else{
            valDelivery = 2;
        }

        livreTypeRadio(valDelivery);
    }
    /**
     * @inheritDoc : Listen the livraison type for updated the template
     */
    $("#typeLivre").change(function () {

        livreTypeRadio($(this).val());
    });


    /**
     * @inheritDoc : Ajuste the template in function of value selected
     * @param String val
     */
    function livreTypeRadio(val) {

        if (val == 1)
        {
            $("#price_delivery").attr("disabled","");
            $("#min_delivery").attr("disabled","");
            $("#min_take").removeAttr("disabled");


        }
        else if (val == 0)
        {
            $("#min_take").attr("disabled","");
            $("#price_delivery").removeAttr("disabled");
            $("#min_delivery").removeAttr("disabled");
        }
        else
        {

            $("#price_delivery").removeAttr("disabled");
            $("#min_take").removeAttr("disabled");
            $("#min_delivery").removeAttr("disabled");
        }
    }


});
$('#uploading-product-pictures').change(function (e) {


    var files = $(this)[0].files;
    var result = $("#preview-uploading-product-pictures");
    var target_clear = $("#"+result.attr("target_clear"));
    var render = "";

    if (files.length > 0) {


        for (var i =0;i< files.length;i++) {
            var file = files[i];
            var typeFile = file.type;
            var sizePicture = file.size / 1000000;
            if (typeFile.indexOf("images")) {

                //TODO : Getting param's max size of AppConfig ?
                if (sizePicture <= 2) {
                    var picture =
                        '<div  class="col-lg-4"><img width="100%" src="' + window.URL.createObjectURL(file) + '" ></div>';
                    render += picture;
                }
                else{

                    $(this).val("");
                    picture = "";
                    alert("Sorry but your picture " + file.name + " is too big (2MB Max)");
                    break;

                }




            }
            else
            {
                this.val("");
                picture = "";
                alert("Please transferred only pictures file :)");
                break;
            }
        }
        result.html(render);
        result.removeClass("hidden");
        target_clear.removeClass("hidden");
    }
    else
    {
        result.addClass("hidden");
    }
});





/**
 * @inheritDoc Box popup Treatment
 *
 **/
$('body').click(function(event){


   // hideBoxAdr();
    //hideBoxCatProd();
    hideBox();
});

//Click show Event
$('#update-store-adr').click(function (event) {
    showBoxAdr();
})
$('#show_new_cat_prod').click(function (event) {

    //show
    // Box(this);
});

//Stop stopPropagation
$('.popup-box').click(function (event)  {

    event.stopPropagation();
});
$('#add-adress-box').click(function (event) {

    event.stopPropagation();
});
$("#adress-default").change(function () {


    var choice = $("#adress-default option:selected").val();
    if (choice == -1)
    {
        $("#new-adress-from").show("clip");
        $("#new-adr-select").val("1");
    }
    else
    {
        $("#new-adress-from").hide("clip");
        $("#new-adr-select").val("0");
    }
});
$("#cat_order").change(function () {

    var choice = $("#cat_order option:selected").val();
    var url = $("#contain_products").attr("api_url");
    var content_zone = $('#contain_products');


    callbacking["ajaxGetGeneric"](url,{"category_s":choice},content_zone);

});






function changeAttr(obj,attr,val) {

    $(obj).attr(attr,val);
}


function showing(object) {

   showBox(object);
}
function showBox(object) {


    var boxname  = $(object).attr('id').replace("show_","");
    var _box = $("#"+boxname);

    var scroll = $("#"+boxname).attr("scroll");
    if (!scroll)
        scroll = "body";
    else
        scroll = "#"+scroll;

    if(!box) {
                var selectedEffect = "fade";
                _box.show(selectedEffect, [], 500, function () {
                    box = true;
                    $(scroll).animatescroll(boxname);


                });


    }

}   
function hideBox() {

    //var boxname  = object.id.replace("show_","");
   // var _box = $("#"+boxname);

    if (box)
    {
        var selectedEffect = "fade";
        $(".popup-box").each(function () {


            if (this.hasAttribute("style") && box)
            {

                $(this).hide(selectedEffect, [], 500, function () {

                    this.removeAttribute("style");
                });
            }

        });
        box = false;
        boxAdr = false;


    }
}
function hideBoxAdr(){
    if (boxAdr)
    {
        var boxAdresse = $("#add-adress-box");
        var selectedEffect = "clip";

        boxAdresse.hide( selectedEffect, [], 1000 );
        boxAdr = false;
        box = false;
    }
}
function showBoxAdr(){
    if(!boxAdr) {
        var selectedEffect = "clip";
        var boxAdresse = $("#add-adress-box");
        boxAdresse.show(selectedEffect, [], 1000, function () {
            boxAdr = true;
            box = true;
            window.location= "#add-adress-box";


        });
    }
}

function openfiledialog(inputFile,resultFile) {
    $(inputFile).click()
    $(inputFile).change(function () {


        $(resultFile).val($(inputFile).val());
    });

}

/**********************
    * AJAX REQUEST *
 *********************/


function ajxRemoveCategory(id) {

    var url = removeCatProdUrl;
    var data = {"id_c":id};
    var error_box = $('#notification_remove_cat');
    error_box.hide("slide",{direction:"left"},500);
    $.ajax(({

        url: url,
        type: "post",
        data: data,
        dataType: "json",
        success: function (code_html, status) {


            checkingRemvoveCatProd(code_html);
        },
        error:function (resultat,error) {

        }





    }));
}
function remSyncAddress(id) {


    $("#rem_adr").val(id);
}







/**********************
    * AJAX RESPONSE *
 *********************/


function checkingRemvoveCatProd(code_html) {


    if (!jQuery.isEmptyObject(code_html))
    {
        var error_box = $('#notification_remove_cat');
        var end = false;


        if (code_html.success)
        {

            error = getHtmlToArray(code_html.info,"bg-success");


        }
        else
        {
            error = getHtmlToArray(code_html.error,"bg-danger");

        }


        error_box.html(error);
        error_box.show("slide",{direction:"left"},500,function () {

            if (code_html.success && !end)
            {
                end = true;
                ajaxGetCategories();

            }
        });

    }
}
function gettingCategories(code_html) {

    $('#contain_categories_product').html("");
    if (!jQuery.isEmptyObject(code_html))
    {
        $('#empty_cat_prod').addClass("hidden");
        $('#contain_categories_product').html(code_html);
    }
    else
    {
        $('#empty_cat_prod').removeClass("hidden");
    }

}
function gettingResult(code_html,content_zone) {

    var emptyZone = $("#empty_"+$(content_zone).attr("id"));
    content_zone = $(content_zone);


    if (!jQuery.isEmptyObject(code_html))
    {
        emptyZone.addClass("hidden");
        content_zone.hide("fade", 500, function () {

            content_zone.html(code_html);
            content_zone.show("fade",500,function () {
                hideBox();
            });


        });

    }
    else
    {
        emptyZone.removeClass("hidden");
    }


}


