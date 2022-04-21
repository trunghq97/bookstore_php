$(document).ready(function () {
    let tableForm = $('#table-form');

    $('.btn-delete').click(function (e) {
        e.preventDefault();
        Swal.fire(createConfirmObject('Bạn chắc chắn muốn xóa dòng dữ liệu này?')).then((result) => {
            if (result.isConfirmed) {
                window.location.href = $(this).attr('href');
            }
        });
    });

    $('.btn-apply-bulk-action').click(function (e) {
        e.preventDefault();
        let url = $(this).attr('href');
        let action = $('.slb-bulk-action').val();

        if (action) {
            let countChecked = $('input[name="cid[]"]:checked').length;
            if (countChecked) {
                Swal.fire(createConfirmObject('Bạn có chắc chắn thực hiện hành động này?')).then((result) => {
                    if (result.isConfirmed) {
                        url = url.replace('value_new', action);
                        console.log(url);
                        tableForm.attr('action', url);
                        tableForm.submit();
                    }
                });
            } else {
                showToast('Vui lòng chọn ít nhất một dòng dữ liệu!');
            }
        } else {
            showToast('Vui lòng chọn action cần thực hiện!');
        }
    });

    $('#check-all-cid').change(function () {
        let checked = $(this).is(':checked');
        $('input[name="cid[]').prop('checked', checked);
    });


    // EVENT DELEGATE GROUP ACP
    $(document).on('click', '.btn-group-acp', function(){
        let ele     = $(this);
        let parent  = ele.parent();
        let url     = ele.data('url');
        $.ajax({
            url,
            success: function (res) {
                if(res.status == 'success'){
                    parent.html(res.data.html);
                    showNotify(parent.find('button'), res.data.message);
                }else{
                    showNotify(ele, res.data.message, 'error');
                }
            },
            dataType: 'json'
        });
    });

     // EVENT DELEGATE SHOW AT HOME
     $(document).on('click', '.btn-show-at-home', function(){
        let ele     = $(this);
        let parent  = ele.parent();
        let url     = ele.data('url');
        $.ajax({
            url,
            success: function (res) {
                if(res.status == 'success'){
                    parent.html(res.data.html);
                    showNotify(parent.find('button'), res.data.message);
                }else{
                    showNotify(ele, res.data.message, 'error');
                }
            },
            dataType: 'json'
        });
    });

    $('.slb-ajax-group').on('change', function(){
        let ele     = $(this);
        let value   = $(this).val();
        let url     = $(this).data('url');
        url         = url.replace('value_new', value);
        $.ajax({
            url,
            success: function (res) {
                if(res.status == 'success'){
                    showNotify(ele, res.data.message);
                }
            },
            dataType: 'json'
        });
    });

    $('.slb-ajax-category').on('change', function(){
        let ele     = $(this);
        let value   = $(this).val();
        let url     = $(this).data('url');
        url         = url.replace('value_new', value);
        $.ajax({
            url,
            success: function (res) {
                if(res.status == 'success'){
                    showNotify(ele, res.data.message);
                }
            },
            dataType: 'json'
        });
    });

    $('.input-ajax-ordering').on('change', function(){
        let ele     = $(this);
        let value   = $(this).val();
        let url     = $(this).data('url');
        url         = url.replace('value_new', value);
        console.log(url);
        $.ajax({
            url,
            success: function (res) {
                if(res.status == 'success'){
                    showNotify(ele, res.data.message);
                }
            },
            dataType: 'json'
        });
    });

    // EVENT DELEGATE
    $(document).on('click', '.btn-status', function(){
        let ele     = $(this);
        let parent  = ele.parent();
        let url     = ele.data('url');
        $.ajax({
            url,
            success: function (res) {
                if(res.status == 'success'){
                    parent.html(res.data.html);
                    showNotify(parent.find('button'), res.data.message);
                }else{
                    showNotify(ele, res.data.message, 'error');
                }
            },
            dataType: 'json'
        });
    });

    // EVENT DELEGATE
    $(document).on('click', '.btn-special', function(){
        let ele     = $(this);
        let parent  = ele.parent();
        let url     = ele.data('url');
        $.ajax({
            url,
            success: function (res) {
                if(res.status == 'success'){
                    parent.html(res.data.html);
                    showNotify(parent.find('button'), res.data.message);
                }else{
                    showNotify(ele, res.data.message, 'error');
                }
            },
            dataType: 'json'
        });
    });


    $('.filter-attribute').change(function(){
        $('#filter-form').submit();
    });

    // $('.filter-attribute select[name=group]').change(function(){
    //     $('#filter-form').submit();
    // });

    // $('.filter-attribute select[name=category]').change(function(){
    //     $('#filter-form').submit();
    // });

    // $('.btn-group-acp').click(function () {
    //     let ele = $(this);
    //     let url = ele.data('url');
    //     $.ajax({
    //         url,
    //         success: function (res) {
    //             if(res.status == 'success'){
    //                 let data = res.data;
    //                 ele.data('url', data.link);
    //                 ele.removeClass(data.removeClass);
    //                 ele.addClass(data.addClass);
    //                 ele.find('i').removeClass(data.removeIcon);
    //                 ele.find('i').addClass(data.addIcon);
    //             }
    //         },
    //         dataType: 'json'
    //     });
    // })

    function showNotify(element, message, type = 'success'){
        element.notify(message, { position: 'top-center', className: type, autoHideDelay: 2000 });
    }

    function showToast(title, icon = 'error') {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
        Toast.fire({ icon, title });
    }

    function createConfirmObject(text, icon = 'warning') {
        return {
            text,
            icon,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Đồng ý!',
            cancelButtonText: 'Hủy',
            position: 'top',
        }
    }


    $('.btn-random-password').click(function (e) {
        e.preventDefault();
        let newPassword = randomPassword(8);
        document.getElementById("password").value = newPassword;
    });

    //Preview image before upload
    function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];
 
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
                $("#previewImg").attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
        }
    }

    $("#imgAdd").change(function () {
        previewFile(this);
    });

    function randomPassword(length) {
        var result = '';
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@';
        var charactersLength = characters.length;
        for (var i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() *
                charactersLength));
        }
        return result;
    }

    CKEDITOR.replace('editorDesc');
});
