var login = false;
var connection = true;
var seeNotification = false;
$('.nav a').click(function(){
    $('.collapse').toggleClass("in");
});
$('body').click(function(event)
{
    hideLogin();
});
$('#connexion-zone').click(function (event) 
{
    event.stopPropagation();
});


/** Commit **/
$('#commit-box').click(function (event)
{
    event.stopPropagation();
});
/** Commit **/

$('#site-content').click(function(event)
{
    hideLogin();
});
$('#header').click(function(event)
{
    hideLogin();
});

$('.catalogue-item').click(function(event)
{
    var target = $(this).attr('data-access');
    if (target)
    {
        window.location = target;
    }

});

$('#livre').change(function () {
    if ($(this).val() ==0) {
        var obj = $('#livre');

        var url = obj.attr("api_url");
        $.ajax(({

            url: url,
            type: "post",
            data: {mod: obj.val()},
            dataType: "html",
            success: function (code_html) {

                if (code_html != "") {
                    $('#empty_confirmCommand').text(code_html);
                    $("#submitCommand").hide("slow", function () {
                        $('#choice_payment').hide("slow", function () {
                            $('#empty_confirmCommand').show("slow");
                        });

                    });
                }
                else {

                        $("#empty_confirmCommand").hide("slow", function () {

                            $('#choice_payment').hide("slow",function () {
                                
                                $('#adr').val("-1");
                                $('#choice_livre').show("slow");
                            });

                        });

                }
            }
        }));
    }
    else if($(this).val() == 1)
    {

        $("#empty_confirmCommand").hide("slow", function () {

            $('#choice_livre').hide("slow",function () {
                $('#choice_payment').show("slow");
            });

        });
    }
    else {

        $('#submitCommand').hide("slow", function () {
            $('#choice_payment').hide("slow", function () {

                $('#choice_livre').hide("slow", function () {
                    $('#adr_def').prop("selected",true);
                    $('#adrFac_def').prop("selected",true);
                    $('#empty_confirmCommand').show("slow");

                });

            });
        });

    }

});
$('#adr').change(function () {

    if ($(this).val() == -1)
    {
        $('#submitCommand').hide("slow",function () {
            $('#choice_payment').hide("slow",function () {


                $('#payment-def').prop("selected",true);
            });
        });
    }
    else
    {
        $('#choice_payment').show("slow");
    }

});
$('#payment').change(function () {

    if ($(this).val() == -1)
    {
        $('#submitCommand').hide("slow");
    }
    else
    {
        $('#submitCommand').show("slow");
    }
});
$('#typeAccount').change(function () {

    var typeAccount = $(this).val();
    var selectedEffect = "slide";
    var options ={ direction: "right" };
    if (typeAccount == 1) {
        $('#commerce-view').show(selectedEffect, options, 300, function () {
            options['direction'] = "left";
        });
    }
    else {
        $('#commerce-view').hide(selectedEffect, options, 300, function () {
            options['direction'] = "left";
        });
    }
});
$('#syncBasket').click(function () {

    $('#bask_qte').val($("#qte_"+$(this).val()).val());
    $('#bask_prod').val($(this).val());
    $('#bask_update').submit();
});

function more_text() {

    // Configure/customize these variables.
    var showChar = 100;  // How many characters are shown by default
    var ellipsestext = "...";
    var moretext = "Show more >";
    var lesstext = "Show less";
    $('.more').each(function () {
        var content = $(this).html();
        if (content.length > showChar) {
            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);
            var html = c + '<span class="moreellipses">' + ellipsestext + '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
            $(this).html(html);
        }
    });
    $(".morelink").click(function () {
        if ($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
}

function hideShowSubLog()
{

    var $formHide = $("#login-form");
    var $formShow = $("#subscription-form");

    if (!connection)
    {
        $formHide = $("#subscription-form");
        $formShow = $("#login-form");
        connection = true;
    }
    else
    {
        connection = false;
    }

    var selectedEffect = "slide";
    var options ={ direction: "right" };
    $formHide.hide(selectedEffect, options, 300, function () {
        options['direction']="left";
        $formShow.show(selectedEffect, options, 300);

    } );
}
function hideLogin()
{

    var $frmCo = $("#connexion-zone");
    if (login)
    {
        var selectedEffect = "drop";
        var options ={ direction: "up" };
        $frmCo.hide( selectedEffect, options, 1000 );
        login = false;
    }
}
function showLogin()
{    
    if(!login)
    {
        var selectedEffect = "drop";
        var options ={ direction: "up" };
        var $frmCo = $("#connexion-zone");
        $frmCo.show( selectedEffect, options, 1000, function () {
            login = true;
        } );


    }

}



