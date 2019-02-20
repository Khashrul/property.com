/**
 * Report Form Submission (property-details)
 *
 * @param
 * @return
 */
$(document).ready(function(){
    $("#report-button").click(function(){
        console.log('clicked');
        var name = $("#report_name").val();
        var email = $("#report_email").val();
        var phone = $("#report_phone").val();
        var report = $("#report_reason").val();
        var property_id = $("#report_property_id").val();
        //var dataString = 'name='+ name + '&email='+ email + '&phone='+ phone + '&report='+ report+ '&property_id='+ property_id;
        var dataString = $("#report-form").serialize();
        if(name=='' || email=='' || phone=='' || report=='' || property_id==''){
            $("#report-result").html('<div class="alert alert-danger alert-dismissable fade in" id="error" style="padding: 2%;margin-top: -5px;"> <a href="#" class="close" data-dismiss="alert" aria-label="close" style="margin-right: 20px;">&times;</a>Please Fill The Necessary Fields!</div>');
            setTimeout(function(){$('#error').fadeOut('slow');}, 2500);
        }
        else{
            $("#report-button").html('<img src="'+SITE_URL+'images/ajax-loader.gif" /> &nbsp; Reporting ...');
            $.ajax({
                type: "POST",
                url: SITE_URL+"site/postreport",
                data: dataString,
                cache: false,
                dataType:"json",
                success: function(response){
                    if(response.status=="success"){
                        $("#report-result").html('<div class="alert alert-success alert-dismissable fade in" id="success" style="padding: 2%;margin-top: -5px;"> <a href="#" class="close" data-dismiss="alert" aria-label="close" style="margin-right: 20px;">&times;</a>'+response.message+'! </div>');
                        $("#report-form")[0].reset();
                        $("#report-button").html('<span>send</span><div class="button-triangle"></div><div class="button-triangle2"></div><div class="button-icon"><i class="fa fa-paper-plane"></i></div>');
                        setTimeout(function(){$('#success').fadeOut('slow');}, 4000);
                    }
                    else if(response.status=="empty"){
                        $("#report-result").html('<div class="alert alert-danger alert-dismissable fade in" id="empty" style="padding: 2%;margin-top: -5px;"> <a href="#" class="close" data-dismiss="alert" aria-label="close" style="margin-right: 20px;">&times;</a>'+response.message+'</div>');
                        $("#report-button").html('<span>send</span><div class="button-triangle"></div><div class="button-triangle2"></div><div class="button-icon"><i class="fa fa-paper-plane"></i></div>');
                        setTimeout(function(){$('#empty').fadeOut('slow');}, 2500);
                    }
                    else{
                        $("#report-result").html('<div class="alert alert-warning alert-dismissable fade in" id="wrong" style="padding: 2%;margin-top: -5px;"> <a href="#" class="close" data-dismiss="alert" aria-label="close" style="margin-right: 20px;">&times;</a>'+response.message+'</div>');
                        $("#report-form")[0].reset();
                        $("#report-button").html('<span>send</span><div class="button-triangle"></div><div class="button-triangle2"></div><div class="button-icon"><i class="fa fa-paper-plane"></i></div>');
                        setTimeout(function(){$('#wrong').fadeOut('slow');}, 2500);
                    }
                }
            });
        }
        return false;
    });
});

/**
 * Message Form Submission (property-details)
 *
 * @param
 * @return
 */
$(document).ready(function(){
    $("#msg-form-submit").click(function(){
        var name = $("#name").val();
        var email = $("#email").val();
        var phone = $("#phone").val();
        var msg = $("#message").val();
        var receiver = $("#receiver").val();
        var property_id = $("#property_id").val();
        var dataString = 'name='+ name + '&email='+ email + '&phone='+ phone + '&msg='+ msg+ '&receiver='+ receiver+ '&property_id='+ property_id;
        if(name=='' && email=='' && phone=='' && msg==''){
            $("#form-result").html('<div class="alert alert-danger alert-dismissable fade in" id="error" style="padding: 2%;margin-top: -5px;"> <a href="#" class="close" data-dismiss="alert" aria-label="close" style="margin-right: 20px;">&times;</a>Please Fill The Necessary Fields!</div>');
            setTimeout(function(){$('#error').fadeOut('slow');}, 2500);
        }
        else{
            $("#msg-form-submit").html('<img src="'+SITE_URL+'images/ajax-loader.gif" /> &nbsp; Sending ...');
            $.ajax({
                type: "POST",
                url: SITE_URL+"site/sendmessage",
                data: dataString,
                cache: false,
                dataType:"json",
                success: function(response){
                    if(response.status=="success"){
                        $("#form-result").html('<div class="alert alert-success alert-dismissable fade in" id="success" style="padding: 2%;margin-top: -5px;"> <a href="#" class="close" data-dismiss="alert" aria-label="close" style="margin-right: 20px;">&times;</a>'+response.message+'! </div>');
                        $("#contact-from")[0].reset();
                        $("#msg-form-submit").html('<span>send</span><div class="button-triangle"></div><div class="button-triangle2"></div><div class="button-icon"><i class="fa fa-paper-plane"></i></div>');
                        setTimeout(function(){$('#success').fadeOut('slow');}, 4000);
                    }
                    else if(response.status=="empty"){
                        $("#form-result").html('<div class="alert alert-danger alert-dismissable fade in" id="empty" style="padding: 2%;margin-top: -5px;"> <a href="#" class="close" data-dismiss="alert" aria-label="close" style="margin-right: 20px;">&times;</a>'+response.message+'</div>');
                        $("#msg-form-submit").html('<span>send</span><div class="button-triangle"></div><div class="button-triangle2"></div><div class="button-icon"><i class="fa fa-paper-plane"></i></div>');
                        setTimeout(function(){$('#empty').fadeOut('slow');}, 2500);
                    }
                    else{
                        $("#form-result").html('<div class="alert alert-warning alert-dismissable fade in" id="wrong" style="padding: 2%;margin-top: -5px;"> <a href="#" class="close" data-dismiss="alert" aria-label="close" style="margin-right: 20px;">&times;</a>'+response.message+'</div>');
                        $("#contact-from")[0].reset();
                        $("#msg-form-submit").html('<span>send</span><div class="button-triangle"></div><div class="button-triangle2"></div><div class="button-icon"><i class="fa fa-paper-plane"></i></div>');
                        setTimeout(function(){$('#wrong').fadeOut('slow');}, 2500);
                    }
                }
            });
        }
        return false;
    });
});

/**
 * Contact Form Submission (contact-us)
 *
 * @param
 * @return
 */
$(document).ready(function(){
    $("#form-submit").click(function(){
        var name = $("#name").val();
        var email = $("#email").val();
        var phone = $("#phone").val();
        var msg = $("#message").val();
        var dataString = 'name='+ name + '&email='+ email + '&phone='+ phone + '&msg='+ msg;
        if(name==''||email==''||phone==''||msg==''){
            $("#form-result").html('<div class="alert alert-danger alert-dismissable fade in" id="error" style="padding: 2%;margin-top: -5px;"> <a href="#" class="close" data-dismiss="alert" aria-label="close" style="margin-right: 20px;">&times;</a>Please Fill The Necessary Fields!</div>');
            setTimeout(function(){$('#error').fadeOut('slow');}, 2500);
        }
        else{
            $("#form-submit").html('<img src="'+SITE_URL+'images/ajax-loader.gif" /> &nbsp; Submitting Data ...');
            $.ajax({
                type: "POST",
                url: SITE_URL+"site/receivefeedback",
                data: dataString,
                cache: false,
                dataType:"json",
                success: function(response){
                    if(response.status=="success"){
                        $("#form-result").html('<div class="alert alert-success alert-dismissable fade in" id="success" style="padding: 2%;margin-top: -5px;"> <a href="#" class="close" data-dismiss="alert" aria-label="close" style="margin-right: 20px;">&times;</a>'+response.message+'! </div>');
                        $("#contact-from")[0].reset();
                        $("#form-submit").html('<span>send</span><div class="button-triangle"></div><div class="button-triangle2"></div><div class="button-icon"><i class="fa fa-paper-plane"></i></div>');
                        setTimeout(function(){$('#success').fadeOut('slow');}, 4000);
                    }
                    else if(response.status=="empty"){
                        $("#form-result").html('<div class="alert alert-danger alert-dismissable fade in" id="empty" style="padding: 2%;margin-top: -5px;"> <a href="#" class="close" data-dismiss="alert" aria-label="close" style="margin-right: 20px;">&times;</a>'+response.message+'</div>');
                        $("#form-submit").html('<span>send</span><div class="button-triangle"></div><div class="button-triangle2"></div><div class="button-icon"><i class="fa fa-paper-plane"></i></div>');
                        setTimeout(function(){$('#empty').fadeOut('slow');}, 2500);
                    }
                    else{
                        $("#form-result").html('<div class="alert alert-warning alert-dismissable fade in" id="wrong" style="padding: 2%;margin-top: -5px;"> <a href="#" class="close" data-dismiss="alert" aria-label="close" style="margin-right: 20px;">&times;</a>'+response.message+'</div>');
                        $("#contact-from")[0].reset();
                        $("#form-submit").html('<span>send</span><div class="button-triangle"></div><div class="button-triangle2"></div><div class="button-icon"><i class="fa fa-paper-plane"></i></div>');
                        setTimeout(function(){$('#wrong').fadeOut('slow');}, 2500);
                    }
                }
            });
        }
        return false;
    });
});

/**
 * Submit property
 */
$('#offer-form').on('submit',function(e){
        propertySubmit();
});

function propertySubmit(){
    var data=$('#offer-form').serialize();
    var property_type=$("#property_type").val();
    var transaction_type=$("#transaction_type").val();
    var price = $("#price").val();
    var area = $("#area").val();
    var bedrooms = $("#bedrooms").val();
    var bathrooms = $("#bathrooms").val();
    var rooms = $("#rooms").val();
    var commercial_type = $("#commercial_type").val();
    var land_type = $("#land_type").val();
    var description = $("#description").val();
    var location = $("#geocomplete").val();
    var lng = $("#lng").val();
    var lat = $("#lat").val();
    var featured = $("#featured").val();

    var air_condition = $('#c1').is(":checked");
    var internet = $('#c2').is(":checked");
    var cable_tv = $('#c3').is(":checked");
    var balcony = $('#c4').is(":checked");
    var roof_terrace = $('#c5').is(":checked");
    var terrace = $('#c6').is(":checked");
    var lift = $('#c7').is(":checked");
    var garage = $('#c8').is(":checked");
    var security = $('#c9').is(":checked");
    var high_standard = $('#c10').is(":checked");
    var city_center = $('#c11').is(":checked");
    var furniture = $('#c12').is(":checked");
    var another_option_1 = $('#c13').is(":checked");
    var another_option_2 = $('#c14').is(":checked");
    var another_option_3 = $('#c15').is(":checked");
    var another_option_4 = $('#c16').is(":checked");
    var another_option_5 = $('#c17').is(":checked");
    var another_option_6 = $('#c18').is(":checked");

        $.ajax({
            type:'POST',
            url:SITE_URL+"property/saveproperty",
            data:data,
            cache:false,
            dataType:"json",
            success:function(response){
                if(response.status=="success"){
                    $("#property-submit").html('<img src="'+SITE_URL+'images/ajax-loader.gif" /> &nbsp; Submitting Data ...');
                    function redirect(){
                        window.location = SITE_URL + 'success?property_id='+response.property_id;
                    }
                    window.setTimeout(redirect,4000);
                }
                else if(response.status=="false"){
                    $("#error_personal").fadeIn(1000,function(){
                        $("#error_ad_post").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response.message+' !</div>');
                    });
                }
            }
        });
    return false;
}

/**
 * Update property
 */
$('#update-property-form').on('submit',function(e){
    propertyUpdate();
});

function propertyUpdate(){
    var data=$('#update-property-form').serialize();
    var air_condition = $('#c1').is(":checked");
    var internet = $('#c2').is(":checked");
    var cable_tv = $('#c3').is(":checked");
    var balcony = $('#c4').is(":checked");
    var roof_terrace = $('#c5').is(":checked");
    var terrace = $('#c6').is(":checked");
    var lift = $('#c7').is(":checked");
    var garage = $('#c8').is(":checked");
    var security = $('#c9').is(":checked");
    var high_standard = $('#c10').is(":checked");
    var city_center = $('#c11').is(":checked");
    var furniture = $('#c12').is(":checked");
    var another_option_1 = $('#c13').is(":checked");
    var another_option_2 = $('#c14').is(":checked");
    var another_option_3 = $('#c15').is(":checked");
    var another_option_4 = $('#c16').is(":checked");
    var another_option_5 = $('#c17').is(":checked");
    var another_option_6 = $('#c18').is(":checked");

    $.ajax({
        type:'POST',
        url:SITE_URL+"property/editproperty",
        data:data,
        cache:false,
        dataType:"json",
        success:function(response){
            if(response.status=="success"){
                $("#property-update").html('<img src="'+SITE_URL+'images/ajax-loader.gif" /> &nbsp; Submitting Data ...');
                function redirect(){window.location=SITE_URL+'my-offer'}
                window.setTimeout(redirect,4000);
            }
            else if(response.status=="false"){
                $("#error_personal").fadeIn(1000,function(){
                    $("#error_ad_post").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response.message+' !</div>');
                });
            }
        }
    });
    return false;
}


/**
 * Show field according to type(Apartment,House,Commercial,land) for Update property page
 * @type {*|jQuery}
 */
var type = $("#property_type").val();
if(type ==1){
    $('#bedrooms_block').show('slow');
    $('#bathrooms_block').show('slow');
    $('#rooms_block').hide('slow');
    $('#commercial').hide('slow');
    $('#land').hide('slow');
    $('#property_meta').show('slow');
}
else if(type ==2){
    $('#bedrooms_block').show('slow');
    $('#bathrooms_block').show('slow');
    $('#rooms_block').hide('slow');
    $('#commercial').hide('slow');
    $('#land').hide('slow');
    $('#property_meta').show('slow');
}
else if(type == 3){
    $('#bedrooms_block').hide('slow');
    $('#bathrooms_block').hide('slow');
    $('#rooms_block').show('slow');
    $('#commercial').show('slow');
    $('#land').hide('slow');
    $('#property_meta').show('slow');
}
else if(type == 4){
    $('#bedrooms_block').hide('slow');
    $('#bathrooms_block').hide('slow');
    $('#rooms_block').hide('slow');
    $('#commercial').hide('slow');
    $('#land').show('slow');
    $('#property_meta').hide('slow');
}

/**
 * Show field according to type(Apartment,House,Commercial,land) for submit property page
 */
$("#property_type").change(function() {
    var type = $(this).val();
    if(type ==1){
        $('#area').attr('placeholder','Area(sq ft)');
        $('#bedrooms_block').show('slow');
        $('#bathrooms_block').show('slow');
        $('#rooms_block').hide('slow');
        $('#commercial').hide('slow');
        $('#land').hide('slow');
        $('#property_meta').show('slow');
    }
    else if(type ==2){
        $('#area').attr('placeholder','Area(sq ft)');
        $('#bedrooms_block').show('slow');
        $('#bathrooms_block').show('slow');
        $('#rooms_block').hide('slow');
        $('#commercial').hide('slow');
        $('#land').hide('slow');
        $('#property_meta').show('slow');
    }
    else if(type == 3){
        $('#area').attr('placeholder','Area(sq mt)');
        $('#bedrooms_block').hide('slow');
        $('#bathrooms_block').hide('slow');
        $('#rooms_block').show('slow');
        $('#commercial').show('slow');
        $('#land').hide('slow');
        $('#property_meta').show('slow');
    }
    else if(type == 4){
        $('#area').attr('placeholder','Area(ha.)');
        $('#bedrooms_block').hide('slow');
        $('#bathrooms_block').hide('slow');
        $('#rooms_block').hide('slow');
        $('#commercial').hide('slow');
        $('#land').show('slow');
        $('#property_meta').hide('slow');
    }
})

/**
 * For make property Featured
 */
$('input[name="featured"]').on('change',function(){
    if($(this).is(':checked')){
        $('#featured').val('1');
    } else {
        $('#featured').val('0');
    }
});

/**
 * My profile update
 */
$('#my-profile-form').on('submit',function(e){
    ProfileUpdate();
});

function ProfileUpdate(){
    var data=$('#my-profile-form').serialize();
    $.ajax({
        type:'POST',
        url:SITE_URL+"profile/updateprofile",
        data:data,
        cache:false,
        dataType:"json",
        success:function(response){
            if(response.status=="success"){
                $("#profile-update").html('<img src="'+SITE_URL+'images/ajax-loader.gif" /> &nbsp; Submitting Data ...');
                function redirect(){window.location=SITE_URL+'my-offer'}
                window.setTimeout(redirect,4000);
            }
            else if(response.status=="false"){
                $("#error_personal").fadeIn(1000,function(){
                    $("#error_ad_post").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response.message+' !</div>');
                });
            }
        }
    });
    return false;
}

$('.forget-password-link').on('click',function(){
    var email = $('#forget-email-id').val();
    $.ajax({
        type: 'POST',
        async: false,
        url: SITE_URL + "site/resetpasswordmail",
        data:{email:email},
        cache: false,
        success:function(data){
            $("#reset_password_sent_status").html('<div><font style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:green;">Reset password link has been sent to your mail. Please login to your mail.</font></div><br clear="all">');
        },
    })
});

$('#agent-photo').on('change',function(){
    $('#my-profile-form-image').submit();
});

$('#company-logo').on('change',function(){
    $('#company-form-image').submit();
});

$('#bank_deposit').on('click',function(){
    $('#bank_receipt').attr('required', 'required');
    $('#seller_id').removeAttr('required');
    $('#bank_details_block').show('slow');
    $('#direct_payment_block').hide('slow');
    $('#payment-confirmation-form').prop('action', '/transaction-status');
});
$('#credit_card').on('click',function(){
    $('#bank_receipt').removeAttr('required');
    $('#seller_id').removeAttr('required');
    $('#bank_details_block').hide('slow');
    $('#direct_payment_block').hide('slow');
    $('#payment-confirmation-form').prop('action', '/payment-processor');
});
$('#marketing_representative').on('click',function(){
    $('#bank_receipt').removeAttr('required');
    $('#seller_id').attr('required', 'required');
    $('#bank_details_block').hide('slow');
    $('#direct_payment_block').show('slow');
    $('#payment-confirmation-form').prop('action', '/transaction-status');
});

$('#payment-confirmation-form').on('submit',function(){
    if($('input[name="payment"]:checked').val()){
        return true;
    } else {
        alert('Please select a payment method');
        return false;
    }
});

/**
 * check new password and confirm password for reset password page
 * @returns {boolean}
 */
function validatePassword() {
    var new_password,confirm_password,output = true;

    new_password = document.frmChange.new_password;
    confirm_password = document.frmChange.confirm_password;

    if(!new_password.value) {
        new_password.focus();
        document.getElementById("new_password").innerHTML = "required";
        output = false;
    }
    else if(!confirm_password.value) {
        confirm_password.focus();
        document.getElementById("confirm_password").innerHTML = "required";
        output = false;
    }
    if(new_password.value != confirm_password.value) {
        new_password.value="";
        confirm_password.value="";
        new_password.focus();
        document.getElementById("confirm_password").innerHTML = "not same";
        output = false;
    }
    return output;
}


/**
 * Reset password
 */
$('#change-password-form').on('submit',function(e){
    RegisterChangePassword();
});

function RegisterChangePassword(){
    var data=$('#change-password-form').serialize();
    var reg=/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    var change_password=$("#new_password").val();
    if(change_password=="") {
        $("#change_password_status").html('<div class="info" style="color: red">Password does not match!</div>');$("#new_password").focus();
    }
    else{
        $.ajax({
            type:'POST',
            async:false,
            url:SITE_URL+"site/changepassword",
            data:data,
            cache:false,
            dataType:"json",
            beforeSend:function() {
                $("#change_password_status").html('<br clear="all"><div style="padding-left:100px;"><font style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:black;">Please wait...</font></div><br clear="all">');},
            success:function(data) {
                if(data.status==='success'){$("#change_password_status").hide().fadeIn('slow').html(data.message);
                }
                else if(data.status==='incorrect'){
                    $("#change_password_status").hide().fadeIn('slow').html(data.message);}
                else if(data.status==='error'){
                    $("#change_password_status").hide().fadeIn('slow').html(data.message);}
            },
            error:function(){
                alert('Error!')
            }
        });
        return false;
    }
}


/**
 * sent reset password link to mail
 */
$('.reset-password-link').on('click',function(e){
    $.ajax({
        type: 'POST',
        async: false,
        url: SITE_URL + "site/resetpasswordmail",
        cache: false,
        success:function(data){
            $("#reset_password_sent_status").html('<div><font style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:green;">Reset password link has been sent to your mail. Please login to your mail.</font></div><br clear="all">');
        },
    })
});

/**
 * Delete property from my offer
 * @param id
 */
function deleteItem(id) {
    var delete_confirm = confirm("Are you sure to delete this item?");

    if (delete_confirm == true) {
        $.ajax({
            type: 'GET',
            async: false,
            url: SITE_URL + "property/deleteproperty",
            data: {id: id},
            cache: false,
            dataType: "json",
            success: function (data) {
                if (data.status === "success") {
                    $('#list-offer'+id).hide('slow');
                }
            },
            error: function () {
                alert('Error!')
            }
        })
    }
}

$('.property-featured').on('click',function(){
    var current_element = $(this);
    var property_id = $(this).attr('data-item');
    $.ajax({
        type: 'GET',
        async: false,
        url: SITE_URL + "property/makefeaturedproperty",
        data: {id: property_id},
        cache: false,
        dataType: "json",
        success: function (data) {
            if (data.status === "success") {
                alert(data.message);
                if(data.featured_status == '1'){
                    current_element.addClass('selected');
                    current_element.attr('title','Remove from featured list');
                } else {
                    current_element.removeClass('selected');
                    current_element.attr('title','Mark as featured');
                }
            } else if(data.status === "error"){
                alert(data.message);
            }
        },
        error: function () {
            alert('Error!')
        }
    });
});

/**
 * Allow Only for numeric number input field
 */
$(".number_input").keydown(function(e) {
    if($.inArray(e.keyCode,[46,8,9,27,13,110,190])!==-1||(e.keyCode===65&&(e.ctrlKey===true||e.metaKey===true))||(e.keyCode>=35&&e.keyCode<=40)){
    return;
    }
    if((e.shiftKey||(e.keyCode<48||e.keyCode>57))&&(e.keyCode<96||e.keyCode>105)){
        e.preventDefault();
    }
});

/**
 * Launch Welcome Modal
 */
/*
$(window).load(function(){
    $('#onload').modal('show');
});
*/
/**
 * Phone number default not editable in input field
 * @type {number|jQuery}
 */
//var readOnlyLength1 = $('#phone_number_personal').val().length;
//
//
//$('#phone_number_personal').on('keypress, keydown', function(event) {
//    var $field = $(this);
//    if ((event.which != 37 && (event.which != 39))
//        && ((this.selectionStart < readOnlyLength1)
//        || ((this.selectionStart == readOnlyLength1) && (event.which == 8)))) {
//        return false;
//    }
//});

/**
 * Identify property_type for narrow_search
 */
$(document).ready(function(){
    $("#commercial_room").hide();
    $("#narrow_commercial_type").hide();
    $("#narrow_land_type").hide();
    $("#prop_id").change(function(){
        var x = document.getElementById("prop_id").value;
        if(x==1){
            $("#narrow_transaction").attr("name", "transaction"+x);
            $("#narrow_country").attr("name", "country"+x);
            $("#narrow_city").attr("name", "city"+x);
            $("#narrow_location").attr("name", "location"+x);

            $("#slider-range-price-sidebar-value").attr("name", "price"+x);
            $("#slider-range-area-sidebar-value").attr("name", "area"+x);

            $("#slider-range-bedrooms-sidebar-value").attr("name", "bed"+x);
            $("#slider-range-bathrooms-sidebar-value").attr("name", "bath"+x);

            $("#unit").text('sft');

            $("#apartment_house_bed").show('slow');
            $("#apartment_house_bath").show('slow');
            $("#commercial_room").hide('slow');
            $("#narrow_land_type").hide('slow');
            $("#narrow_commercial_type").hide('slow');
        }
        else if(x==2){
            $("#narrow_transaction").attr("name", "transaction"+x);
            $("#narrow_country").attr("name", "country"+x);
            $("#narrow_city").attr("name", "city"+x);
            $("#narrow_location").attr("name", "location"+x);

            $("#slider-range-price-sidebar-value").attr("name", "price"+x);
            $("#slider-range-area-sidebar-value").attr("name", "area"+x);

            $("#slider-range-bedrooms-sidebar-value").attr("name", "bed"+x);
            $("#slider-range-bathrooms-sidebar-value").attr("name", "bath"+x);

            $("#unit").text('sft');

            $("#apartment_house_bed").show('slow');
            $("#apartment_house_bath").show('slow');
            $("#commercial_room").hide('slow');
            $("#narrow_land_type").hide('slow');
            $("#narrow_commercial_type").hide('slow');
        }
        else if(x==3){
            $("#narrow_transaction").attr("name", "transaction"+x);
            $("#narrow_country").attr("name", "country"+x);
            $("#narrow_city").attr("name", "city"+x);
            $("#narrow_location").attr("name", "location"+x);

            $("#slider-range-price-sidebar-value").attr("name", "price"+x);
            $("#slider-range-area-sidebar-value").attr("name", "area"+x);

            $("#unit").html('m<sup>2</sup>');

            $("#apartment_house_bed").hide('slow');
            $("#apartment_house_bath").hide('slow');
            $("#commercial_room").show('slow');
            $("#narrow_land_type").hide('slow');
            $("#narrow_commercial_type").show('slow');
        }
        else{
            $("#narrow_transaction").attr("name", "transaction"+x);
            $("#narrow_country").attr("name", "country"+x);
            $("#narrow_city").attr("name", "city"+x);
            $("#narrow_location").attr("name", "location"+x);

            $("#slider-range-price-sidebar-value").attr("name", "price"+x);
            $("#slider-range-area-sidebar-value").attr("name", "area"+x);

            $("#unit").text('ha');

            $("#apartment_house_bed").hide('slow');
            $("#apartment_house_bath").hide('slow');
            $("#commercial_room").hide('slow');
            $("#narrow_commercial_type").hide('slow');
            $("#narrow_land_type").show('slow');
        }

    });
});

/**
 * Identify property_type for main_search
 */
function prop_identify(identifier) {
    $("#property_identifier").val(identifier);
}

/**
 * Geolocate for main and narrow search
 */
function geolocate() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
                center: geolocation,
                radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
            autocomplete1.setBounds(circle.getBounds());
            autocomplete2.setBounds(circle.getBounds());
            autocomplete3.setBounds(circle.getBounds());
            autocomplete4.setBounds(circle.getBounds());
        });
    }
}
$('#date_of_birth').datepicker({ dateFormat: 'yy-mm-dd' }).val();

$('span.icon-jfi-trash').on('click',function(){
    var confirmation = confirm("Do you want to delete this image");
    if(confirmation) {
        data_property = $(this).attr('data-icon');
        file_name = data_property.replace('http://ad-dwit-a.s3.amazonaws.com/','');
        $('#delete_image_file').val($('#delete_image_file').val()+","+file_name);
        image_file_string = $('#image_file').val();
        $('#image_file').val(image_file_string.replace(',' + data_property,''));
        $(this).parent().remove();
    }
});



