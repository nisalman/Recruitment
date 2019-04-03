$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

class Form {

    constructor(data) {
        this.method = "POST";
        this.data = data;
        return this;
    }

    submit(success, fail) {
        var data = new FormData(this.data);
        $.ajax({
            url: window.location.pathname,
            type: this.method,
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: success,
            error: fail,
            cache: false,
            contentType: false,
            processData: false
        });
    }

    reset() {
        this.data.reset();
        return this;
    }

}

function sConfirm(msg, yesCall, noCall = function () {
}) {
    swal({
        text: msg,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: yes,
        cancelButtonText: no
    }).then(function () {
        yesCall();
    }, function () {
        noCall();
    })
}

function formAlert(error) {
    $.each(error.responseJSON.errors, function (k, v) {
        $("[name=" + k + "]").addClass('error');
        var div = $("[name=" + k + "]").parents('div')[0];
        var alert = document.createElement("div");
        alert.innerHTML = v;
        alert.className += " se-error";
        div.append(alert);
    });
}

function editForm(id) {
    $('#edit-form').modal();
}

function showForm(id) {
    //alert(url);
    $.get(url + '/' + id, function (html) {
        $('.form-detail').html(html);
    });
    $('#show-form').modal();
}

function sendMessage(id) {
    $.get(url +'/application-pending-modal/'+id, function (html) {
        $('.form-detail').html(html);
    });
    $('#show-form').modal();
}
/*    aminur    */

function showForm1(id) {
    //alert(url);
    curl = "/admin/form-submissions";
    $.get(curl + '/' + id, function (html) {
        $('.form-detail').html(html);
    });
    $('#show-form').modal();
}

function showNID1(id) {
    $.get('/api/FormSubmission/' + id + '/NIDCopy', function (src) {
        $('img.NID').attr('src', src);
    });
    $('.nid-modal').modal();
}

/*    end aminur    */

function jsonToOption(data) {
    var html = "<option value='' >---</option>";
    $.each(data, function (k, v) {
        html += "<option value='" + v.id + "'>" + v.name + "</option>";
    });
    return html;
}

function updatePosition() {
    var data = {};
    var data1 = {};
    var id;
    $('#sortable tr').each(function (i) {
        id = $(this).data('id');
        data[id] = i + 1;
        data['_token'] = _token;
        $(this).find('td:eq( 2 )').html(i + 1);
    });

    $('#sortable2 tr').each(function (i) {
        id = $(this).data('id');
        data1[id] = i + 1;
        data1['_token'] = _token;
        $(this).find('td:eq( 2 )').html(i + 1);
    });
    $.post('/admin/form-submissions/reorder?to=ministry', data);
    $.post('/admin/form-submissions/reorder?to=bkkf', data1);
}

function removeFromList(id) {
    sConfirm(confirmMsg, function () {
        $.get('?removeFromList=' + id, function () {
            $('#tr_' + id).remove();
            updatePosition();
        });
    });

}
// bangla date picker
$(".datepicker").datepicker();
// $.bdatepicker.setDefaults();

/*$("").bnKb({
    //{"webkit":"k", "mozilla":"y", "safari":"k", "chrome":"m", "msie":"y"},
    'switchkey': {"mozilla": "m", "chrome": "m"},
    'driver': phonetic
});*/



/**
 * @description Convert bangla to english number
 * @param {string|number} bn_number
 * @returns {Number|String}
 */
function toEnglish(bn_number) {
    var bangNumber = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
    var eng_number = "";
    var bn_number = bn_number + "";
    for (var k = 0; k < bn_number.length; k++) {
        var chr = "";
        for (var i = 0; i < 10; i++) {
            if (bangNumber[i] === bn_number[k]) {
                chr = i;
                break;
            }
        }

        if (chr.length === 0) {
            eng_number = eng_number + bn_number[k];
        } else {
            eng_number = eng_number + chr;
        }
    }

    return eng_number;
}

/**
 * @description  Convert english to bangla number
 * @param {string|number} eng_number
 * @return {number|string} description
 */
function toBangla(eng_number) {
    var bangNumber = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
    var eng = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    var bn_number = "";
    var eng_number = "" + eng_number + "";
    for (var k = 0; k < eng_number.length; k++) {
        var chr = "";
        for (var i = 0; i < 10; i++) {
            if (eng[i] === eng_number[k]) {
                chr = bangNumber[i];
                break;
            }
        }

        if (chr.length === 0) {
            bn_number = bn_number + "" + eng_number[k];
        } else {
            bn_number = bn_number + "" + chr;
        }
    }

    return bn_number;
}

function showNID(id) {
    $.get('/api/FormSubmission/' + id + '/NIDCopy', function (src) {
        $('img.NID').attr('src', src);
    });
    $('.nid-modal').modal();
}

/*
$('#loading-image').bind('ajaxStart', function(){
    $(this).show();
}).bind('ajaxStop', function(){
    $(this).hide();
});
*/
$(document).ready(function () {
    $('a[href="' + url + '"]').parents('li').addClass('active');
    $('.division').change(function () {
        var id = this.value
        $.get('/api/Division/' + id + '/districts', function (data) {
            var html = "<option value=''>---</option>";
            $.each(data, function (k, v) {
                html += "<option value='" + v.id + "'>" + v.name + "</option>"
            })
            $('.district').html(html);
        });
    })

    $('.district').change(function () {
        var id = this.value
        $.get('/api/District/' + id + '/upazilas', function (data) {
            var html = "<option value=''>---</option>";
            $.each(data, function (k, v) {
                html += "<option value='" + v.id + "'>" + v.name + "</option>"
            })
            $('.upazila').html(html);
        });
    })
    $('.division2').change(function () {
        var id = this.value
        $.get('/api/Division/' + id + '/districts', function (data) {
            var html = "<option value=''>---</option>";
            $.each(data, function (k, v) {
                html += "<option value='" + v.id + "'>" + v.name + "</option>"
            })
            $('.district2').html(html);
        });
    })

    $('.district2').change(function () {
        var id = this.value
        $.get('/api/District/' + id + '/upazilas', function (data) {
            var html = "<option>---</option>";
            $.each(data, function (k, v) {
                html += "<option value='" + v.id + "'>" + v.name + "</option>"
            })
            $('.upazila2').html(html);
        });
    })
});
/*
   Start Edit Form Divisions, districts
*/

$(document).ready(function () {

    $('.playerLevel').change(function () {
        var l = this.value;
        $('.partial').hide();
        $('#partial-' + l).show();
        $('.description').show();
        if (l == '6') {
            $('.description').removeClass('col-md-6');
            $('.description').addClass('col-md-12');
        } else {
            $('.description').removeClass('col-md-12');
            $('.description').addClass('col-md-6');
        }
    });

    $('.clone').click(function () {
        $('.' + $(this).data('place')).append("<div class='cloned-content'>" + $('.' + $(this).data('clone')).html() + "<i class='fa fa-close clone-remove'></i></div>");
        $(".bn").bnKb({
            'switchkey': {"mozilla": "m", "chrome": "m"},
            'driver': phonetic
        });
    });
    $('body').on('click', '.clone-remove', function () {
        $(this).parent().remove();
    });

    $('body').on('click', 'td .fa-pencil', function () {

    });

    /*   form submissions*/

    $('form:not(".original")').on('submit', function (e) {

        e.preventDefault();
        var form = new Form(this);

        switch ($(this).data('name')) {
            case "sports-setup":
                form.submit(function () {
                    form.reset();
                    $('#datatable').DataTable().ajax.reload();
                }, function (error) {
                    formAlert(error);
                });
                break;
            case "edit_user":
                form.submit(function (data) {
                    var formData = new FormData();
                    $('#datatable').DataTable().ajax.reload();
                    window.location.href = "/update_user/" + data;
                }, function (error) {
                    formAlert(error);
                });
                break;
            case "fwform":
                form.submit(function () {
                    id = $("#formid").val();
                    $(".add_" + id).attr('disabled', true);
                    form.reset();
                    $('#fwmodal').modal('hide');
                }, function (error) {

                    formAlert(error);
                });
                break;
            case "app-form":
                if ($(this).attr('confirmed') != "true") {
                    $('#name').text($('input[name="name"]').val());
                    $('#mobile').text($('input[name="mobile"]').val());
                    $('#email').text($('input[name="designation"]').val());
                    $('#LegalStatus').text($('input[name="fatherName"]').val());
                    $('#regOA').text($('input[name="motherName"]').val());
                    $('#fax').text($('input[name="profession"]').val());
                    $('#website').text($('input[name="annualIncome"]').val());
                    $('#NID').text($('input[name="NID"]').val());
                    $('#dob').text($('input[name="birth"]').val());
                    var to = $('input[name="to"]').val();
                    var office = $('input[name="office"]').val();
                    if (to == "DC") {
                        to = "জেলা প্রশাসক";
                    } else {
                        to = "জাতীয় ক্রীড়া পরিষদ (এন এস সি)";
                    }
                    if (office == "BKKF") {
                        office = "বঙ্গবন্ধু ক্রীড়াসেবী কল্যাণ ফাউন্ডেশন";
                    } else {
                        office = "যুব ও ক্রীড়া মন্ত্রণালয়";
                    }
                    $('#to').text(to);
                    $('#office').text(office);

                    var address = $('input[name="permenentAddress"]').val() + ", " + $('select[name="permenentAddressThana"]  option:selected').text() + ", " + $('.district  option:selected').text();
                    $('#address').text(address);

                    $('#formConfirm').modal();
                    return;
                }
                $('.submitForm').attr('disabled', true);
                form.submit(function (data) {
                    // form.reset();
                    //$('#gifform').css('visibility', 'visible');


                    window.location.href = "/application-form/" + data;
                }, function (error) {
                    $('.submitForm').attr('disabled', false);
                    formAlert(error);
                });
                break;

            case "profile":
                form.submit(function (msg) {
                    swal({
                        text: msg,
                        type: 'success'
                    });
                }, function (error) {

                    formAlert(error);
                });
                break;
        }

        return false;
    });

    $('input[name="currentStatus"]').on('change', function () {
        if ($(this).val() == 'dead') {
            $('.dethInfo').show();
        } else {
            $('.dethInfo').hide();

        }
    });

    $('.sport').change(function () {
        $.get('api/Sport/' + $(this).val() + '/federations', function (data) {
            $('select[name="federation"]').html(jsonToOption(data));
        });
    });

    $('#datatable').on('click', '.fa-trophy', function () {
        $('.trophy').attr('src', $(this).data('src'));
        $('.trophy-modal .modal-title').html($(this).attr('title'));
        $('.trophy-modal').modal();
    });


    $('form').on('keyup', '.error', function () {
        $(this).removeClass('error');
        $(this).next().remove();
    });

    $('.submitForm').click(function () {
        $('.app-form').attr('confirmed', 'true');
        $('.app-form').submit();
    });
    $('.updateForm').click(function () {
        $('.update-form').attr('confirmed', 'true');
        $('.update-form').submit();
    });
    $('.selected-forms-btn').click(function () {
        $.get('/admin/selected-forms', function (data) {
            var html = "";
            var html1 = "";
            $.each(data, function (k, v) {
                var content = "<tr data-id=" + v.id + " id='tr_" + v.id + "' class='ui-state-default'><td>" + v.trackingNumber + "</td><td>" + v.name + "</td><td>" + v.rating + "</td><td style='text-align:right'><span onclick='removeFromList(" + v.id + ")' class='fa fa-times btn btn-sm btn-danger'></span></td></tr>";
                if (v.status == 'bkkf') {
                    html1 += content;
                } else {
                    html += content;

                }
            });

            $("#myModal #sortable").html(html);
            $("#myModal #sortable2").html(html1);
            $("#myModal").modal();
        });
    });

    $('.fwbtn').click(function () {

        sConfirm(confirmMsg, function () {
            $.get('?forward=true', function () {
                swal(
                    'Sucess...',
                    'Form forward successfull',
                    'success'
                );
                $('#myModal').modal('hide');
            });
        });
    });

// end of onready
})


// $('form').on('submit', function (e) {
// 	e.preventDefault();
// 	$.post('/admin/setup/sports', $(this).serialize(), function (data) {
// 		console.log(data);
// 	})
// })

$(document).ajaxStart(function () {
    $('#loading').show();
}).ajaxStop(function () {
    $('#loading').hide();
});


$(document).on('click', '.new_post_office', function () {
    var post_office = $('#new_post_office').val();
    alert(post_office);
    var urls = url + "savePostOffice/" + post_office;
    alert(urls);

});

$(document).on('change', '.photoValidation', function () {

    var fileUpload = document.getElementById("fileUpload");
    var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.gif)$");
    if (regex.test(fileUpload.value.toLowerCase())) {
        if (typeof (fileUpload.files) != "undefined") {
            var reader = new FileReader();
            reader.readAsDataURL(fileUpload.files[0]);
            reader.onload = function (e) {
                var image = new Image();
                image.src = e.target.result;
                image.onload = function () {
                    var height = this.height;
                    var width = this.width;
                    if (height > 200 || width > 200) {
                        alert("Height and Width must not exceed 200px.");
                        fileUpload.value = fileUpload.defaultValue;
                        return false;
                    }
                    return true;
                };
            }
        }
    } else {
        alert("Please select a valid Image file.");
        fileUpload.value = fileUpload.defaultValue;
        return false;
    }
});


/*search panel       */

$(document).on('click', 'ul.pagination>li>a, #search', function (e) {
    if ($('.search_result').length) {
        e.preventDefault();
    }
    var $self = $(this),
        $form = $self.closest('form'),
        destinationObj = $self.closest('.search_result'),
        link = $self.attr('id') == 'search' ? $form.attr('action') : $self.attr('href'),

        url = link;

    if (url === '#') {
        return;
    }
    //console.log(url);
    searchList(url, $form, destinationObj);
});


function searchList(targetUrl, formObj, destinationObj) {

    // var inputData = formObj.serialize();
    var inputData = $('.common_form').serialize();

    if (typeof targetUrl === 'undefined') {
        targetUrl = window.location.href;
    }
    $.get(targetUrl, inputData, function (response) {
        // console.log(response);return;
        // destinationObj.html(response);
        $('.search_result').html(response);

    }).always(function () {
        //formObj.find('.loader-only').remove();
    }).fail(function () {
        //showErrorModal();
    })
}

//======= Start Print Function =======
// function printDiv(divName)
// {
//     var _script = '<link rel="stylesheet" href="http://'+host+'/bower_components/bootstrap/dist/css/bootstrap.min.css" type="text/css" media="print" />' +
//     	'<link rel="stylesheet" href="http://'+host+'/bower_components/font-awesome/css/font-awesome.min.css" />' +
//     	'<link rel="stylesheet" href="http://'+host+'/bower_components/Ionicons/css/ionicons.min.css" />' +
//     	'<link rel="stylesheet" href="http://'+host+'/dist/css/AdminLTE.min.css" />' +
//     	'<link rel="stylesheet" href="http://'+host+'/dist/css/skins/_all-skins.min.css" />' +
//     	'<link rel="stylesheet" href="http://'+host+'/css/admin.css"/>' +
//     	'<link rel="stylesheet" href="http://'+host+'/dist/css/se.css" />';

// 	var mywindow = window.open('', 'printArea', 'height=400,width=600');
// 	mywindow.document.open();
// 	mywindow.document.write('<html><head><title>Report Print</title>');
// 	mywindow.document.write('<link rel="stylesheet" type="text/css" href="http://'+host+'/bower_components/bootstrap/dist/css/bootstrap.min.css" media="print, screen" />');
// 	mywindow.document.write('<link rel="stylesheet" href="http://'+host+'/dist/css/AdminLTE.min.css" type="text/css" media="print, screen" />');
// 	mywindow.document.write('<link rel="stylesheet" href="http://'+host+'/dist/css/skins/_all-skins.min.css" type="text/css" media="print, screen" />');
// 	mywindow.document.write('<link rel="stylesheet" href="http://'+host+'/css/admin.css" type="text/css" media="print, screen" />');
// 	mywindow.document.write('<link rel="stylesheet" type="text/css" href="http://'+host+'/dist/css/se.css" type="text/css" media="print, screen" />');
// 	mywindow.document.write('</head><body>');
// 	mywindow.document.write(document.getElementById(divName).innerHTML);
// 	mywindow.document.write('</body></html>');

// 	setTimeout(function () {
// 		mywindow.document.close();
//         mywindow.focus(); // necessary for IE >= 10*/
//         mywindow.print();
//         mywindow.close();
//     }, 1000);

//     return true;
// }
//====== End Print Function =========

var myarray = [];

$(document).on('keyup', 'input[name="app_rating[]"]', function () {
    var app_limit = $('input[name="app_limit"]').val();
    //alert(toEnglish($(this).val()));return;

    if (!$('input[name="m_b"]:checked').length > 0) {
        swal("Please, Select the Super admin", " ", "error");
        $(this).val('০');
        return false;
    }
    /*var added=false;
    for (i = 0; i < myarray.length; i++ )
    {
        if (myarray[i] == toEnglish($(this).val())){
               added = true;
        }
    }
    if (added == true)
    {
        swal ( "আগে থেকেই আছে!" , " " , "error" );
        $(this).val('০');
    }
    if (!added) {
          myarray.push(toEnglish($(this).val()));
      }
      */
    /*	if (myarray.length > app_limit)
        {
            swal ( "বেশি দেওয়া যাবে না("+app_limit+")" , " " , "error" );
            $(this).val('0');
        }*/
});


$(document).on('click', '#app_send', function (e) {
    if (!$('input[name="m_b"]:checked').length > 0) {
        swal("Please check Send Super Admin", " ", "error");
        return false;
    }
    var priority = $('input[name="app_rating[]"]')
        .map(function () {
            return $(this).val();
        }).get();
    var app_id = $('input[name="app_id[]"]')
        .map(function () {
            return $(this).val();
        }).get();
    var m_b_id = $('input[name="m_b"]:checked').val();
    var _token = $("input[name='_token']").val();

    var sendData = {
        m_b_id: m_b_id,
        priority: priority,
        app_id: app_id,
        _token: _token
    }

    var targetUrl = "/admin/dc-application-forward";
    var swalTitle = getSwalTitle();
    swal(swalTitle).then(function () {
        $.ajax({
            url: targetUrl,
            type: "POST",
            data: sendData,
            dataType: "json",
            success: function (response) {
                console.log(response);
                if (response.success == 3) {
                    swal("", "" + response.message + "", "error");
                    return false;
                }
                if (response.success == true) {
                    location.reload();
                }
                if (response.success == 2) {
                    swal("Max Length(" + toBangla(response.limit) + ")", "" + response.message + "", "error");
                    return false;
                }
                if (response.success == false && !response.limit) {
                    swal("Server Error", " ", "error");
                    return false;
                }

            }, error: function (jqXHR) {
                console.log(jqXHR);
            }
        });
    }, function (dismiss) {
        swalCancelConfirm(dismiss);
    });

});

/*      approve         */

$(document).on('click', "#bm-approve", function () {

    //var app_id = $('input[name="checked[]:checked"]')
    //.map(function(){return $(this).val();}).get();
    var app_id = $('input[name="checked[]"]:checked')
        .map(function () {
            return $(this).val();
        }).get();
    var _token = $("input[name='_token']").val();
    if (!app_id.length > 0) {
        swal("PLease Check Again", " ", "error");
        return false;
    }
    var sendData = {
        app_id: app_id,
        _token: _token
    }
    var targetUrl = "/admin/mb-application-forward";
    var swalTitle = getSwalTitle();
    swal(swalTitle).then(function () {
        $.ajax({
            url: targetUrl,
            type: "POST",
            data: sendData,
            success: function (response) {
                console.log(response);
                location.reload();

            }, error: function (jqXHR) {
                console.log(jqXHR);
            }
        });
    }, function (dismiss) {
        swalCancelConfirm(dismiss);
    });

});

//select to Super admin Start
$(document).on('click', "#bm-send", function () {

    //var app_id = $('input[name="checked[]:checked"]')
    //.map(function(){return $(this).val();}).get();
    var app_id = $('input[name="sendchecked[]"]:checked')
        .map(function () {
            return $(this).val();
        }).get();

    var _token = $("input[name='_token']").val();
    if (!app_id.length > 0) {
        swal("PLease Check Again", " ", "error");
        return false;
    }
    if (!$('input[name="m_b"]:checked').length > 0) {
        swal("Please check Send Super Admin", " ", "error");
        return false;
    }
    var m_b_id = $('input[name="m_b"]:checked').val();

    var sendData = {
        m_b_id: m_b_id,
        app_id: app_id,
        _token: _token
    }
    var targetUrl = "/admin/send-to-sa";
    var swalTitle = getSwalTitle();
    swal(swalTitle).then(function () {
        $.ajax({
            url: targetUrl,
            type: "POST",
            data: sendData,
            success: function (response) {
                console.log(response);
                location.reload();

            }, error: function (jqXHR) {
                console.log(jqXHR);
            }
        });
    }, function (dismiss) {
        swalCancelConfirm(dismiss);
    });

});

//select to Super admin End




/*
	Check All Feature
*/
$(document).on('click', ".check-all", function () {
    if (!$(this).is(':checked')) {
        $("table input[type=checkbox]").prop('checked', false);
        // $("#bm-approve").prop('disabled', true);
    } else {
        $("table input[type=checkbox]").prop('checked', true);
        //$("#bm-approve").prop('disabled', false);
    }

});


/*    applicatin delete */
$(document).on('click', '.dc-app-delete', function (e) {

    e.preventDefault();
    var app_id = $(this).attr('idd');
    var _token = $("input[name='_token']").val();
    var _this = $(this).closest('tr');

    var sendData = {
        app_id: app_id,
        _token: _token
    }
    var targetUrl = "/admin/dc-app-delete";

    var swalTitle = getSwalTitle();

    swal(swalTitle).then(function () {
        $.ajax({
            url: targetUrl,
            type: "POST",
            data: sendData,
            success: function (response) {
                _this.fadeOut(1000, function () {
                    $(this).remove();
                });
            }, error: function (jqXHR) {
                console.log("Error=" + jqXHR);
            }
        });
    }, function (dismiss) {

        swalCancelConfirm(dismiss);

    });
});

function getSwalTitle() {
    var swalTitle =
        {
            title: 'Are you sure?',
            text: "",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!',
            cancelButtonText: 'No!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false
        }
    return swalTitle;
}

function swalCancelConfirm(dismiss) {
    if (dismiss === 'cancel') {
        swal(
            'Rejected',
            'This application is safe :)',
            'error'
        )
    }
}

$('.sameAddress').on('change', function () {
    var _selector = $('.division2, .district2, .upazila2, input[name="currentAddress"], input[name="currentAddressPostOffice"]');
    if ($(this).prop('checked')) {
        $('.permenentAddress').hide();
        _selector.prop('required', false);

    } else {
        $('.permenentAddress').show();
        _selector.prop('required', true);
    }

});

/*     form ded man      */

$(document).on('click', 'input[name="for_app"]', function () {
    var _selector = $('input[name="death_person_name"], select[name="died_man_relation"], input[name="death"], input[name="death"], input[name="deathCertificate"]');
    if (!$(this).is(':checked')) {
        $('.sport_relation').html('৪. ক্রীড়া প্রতিযোগিতা/ ক্রীড়া সম্পর্কিত কার্যক্রমে সম্পৃক্ততার বিবরণ');
        $('.dead_man_info').hide();
        $('.sport_achevement').html('৫. অর্জন সমূহ (পুরষ্কার/পদক/সনদ)');
        _selector.prop('required', false);
    } else {
        $('.sport_relation').html('৫. ক্রীড়া প্রতিযোগিতা/ ক্রীড়া সম্পর্কিত কার্যক্রমে সম্পৃক্ততার বিবরণ');
        $('.dead_man_info').show();
        $('.sport_achevement').html('৬. অর্জন সমূহ (পুরষ্কার/পদক/সনদ)');
        _selector.prop('required', true);
    }
});
