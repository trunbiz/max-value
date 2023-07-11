$(document).ready(function(){
    $('.user__info').hover(function(){
        $(this).removeClass('hidden__event');
    }, function(){
        $(this).addClass('hidden__event');
    })
    //toggle sidebar
    $('.header-wrapper__toggle').click(function(){
       if($('body').hasClass('active')){
            $('body').removeClass('active');
            $('.sidebar__menu--main .content').show();
            $('.fav_logo').hide();
            $('.all_logo').show();
            $(this).html('<svg width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.65225 6.62647L1.62728 4.50027H12.065C12.328 4.50027 12.5412 4.2764 12.5412 4.00027C12.5412 3.72413 12.328 3.50027 12.065 3.50027H1.62728L3.65225 1.37406C3.83821 1.1788 3.83821 0.862213 3.65225 0.666953C3.46628 0.471693 3.16478 0.471693 2.97882 0.666953L0.140936 3.64673C-0.0450256 3.842 -0.0450256 4.1586 0.140936 4.35387L2.97882 7.3336C3.16478 7.52887 3.46628 7.52887 3.65225 7.3336C3.83821 7.13833 3.83821 6.82173 3.65225 6.62647Z" fill="#093651"></path></svg>');
            $('.sidebar__menu--info').show();
       }else{
            $('body').addClass('active');
            $('.sidebar__menu--main .content').hide();
            $('.fav_logo').show();
            $('.all_logo').hide();
            $(this).html('<svg width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.73213 1.37357L11.7571 3.4998H1.31945C1.05646 3.4998 0.843262 3.72367 0.843262 3.9998C0.843262 4.27593 1.05646 4.4998 1.31945 4.4998H11.7571L9.73213 6.626C9.54623 6.82127 9.54623 7.13787 9.73213 7.33313C9.9181 7.5284 10.2196 7.5284 10.4056 7.33313L13.2435 4.35333C13.4295 4.15807 13.4295 3.84153 13.2435 3.64627L10.4056 0.666467C10.2893 0.544427 10.128 0.498661 9.97791 0.529174C9.88788 0.547481 9.80191 0.593241 9.73213 0.666467C9.72927 0.669521 9.72642 0.672601 9.72356 0.675707C9.54623 0.871594 9.54908 1.18136 9.73213 1.37357Z" fill="#093651"></path></svg>')
           $('.sidebar__menu--info').hide();
       }
    })

    //toggle notify
    $('.notice__info').click(function(){
        $('.all_notice').toggle();
    })


    //mobile table
    $('.toggle_e').click(function(){
        var id = $(this).data('id');
        if($(this).hasClass('fa-caret-down')){
            $(this).removeClass('fa-caret-down').addClass('fa-caret-up');
            $('.item'+id).find('td:not(.column-primary)').css('display', 'block')
        }else{
            $(this).removeClass('fa-caret-up').addClass('fa-caret-down');
            $('.item'+id).find('td:not(.column-primary)').css('display', 'none')
        }
    })

})

function activeTab(obj){
    $('#settings ul li').removeClass('active');
    $(obj).addClass('active');
    var id = $(obj).find('a').attr('href');
    $('.tab-pane').hide();
    $(id).show();
}

$('#settings ul li').click(function(){
    activeTab(this);
    return false;
})
activeTab($('#settings ul li:first-child'));

 //required
 var requiredFields = ["surname", "name", "phone", "email", "city", "verifyCode", "question"];

 var validate = function(){
     $("#submit").prop("disabled", false)
     $.each( requiredFields, function( i, l ) {
         $(".formInput[name*='form[" + l + "]']").removeClass('redBorder');
         if ($(".formInput[name*='form[" + l + "]']").val() == ""){
             $("#submit").prop("disabled", true);
             $(".formInput[name*='form[" + l + "]']").addClass('redBorder');
         }
     });
 };

 $(document).on('keyup', validate);
 $('input').focus(validate);

 function chooseSite(){
    var value = $('#chooseSite').val();
    if(value == ''){
        $('.alert-content > .alert-message').html('Please select a site');
        $('.left__txt--content > textarea').empty();
        $('.right__txt--content > textarea').empty();
        $('.right__txt--content > textarea').attr('disabled', true);
        $('.alert-action').hide();
        $('.adv__txt a').hide();
    }else{
        $('.alert-content > .alert-message').html('123');
        $('.left__txt--content > textarea').html('123');
        $('.right__txt--content > textarea').attr('disabled', false);
        $('.alert-action').show();
        $('.adv__txt a').show();
    }
 }


function empty(val) {
    // test results
    //---------------
    // []        true, empty array
    // {}        true, empty object
    // null      true
    // undefined true
    // ""        true, empty string
    // ''        true, empty string
    // 0         false, number
    // true      false, boolean
    // false     false, boolean
    // Date      false
    // function  false

    if (val === undefined) return true

    if (typeof val == "function" || typeof val == "number" || typeof val == "boolean" || Object.prototype.toString.call(val) === "[object Date]") return false

    if (val == null || val.length === 0)
        // null or 0 length array
        return true

    if (typeof val == "object") {
        // empty object

        var r = true

        for (var f in val) r = false

        return r
    }

    return false
}

function addUrlParameter(name, value) {
    const searchParams = new URLSearchParams(window.location.search)
    searchParams.set(name, value)
    window.location.search = searchParams.toString()
}

function addUrlParameterObjects($params) {
    const searchParams = new URLSearchParams(window.location.search)

    for (let i = 0; i < $params.length; i++) {
        if (!empty($params[i].name) && !empty($params[i].value)){
            searchParams.set($params[i].name, $params[i].value)
        }else{
            searchParams.delete($params[i].name)
        }
    }

    window.location.search = searchParams.toString()
}
