$(".side-menu li:eq(1)").addClass("active");
$(".side-menu li:eq(1) ul li:eq(1)").addClass("current-page");
$(".side-menu li:eq(1) ul").css("display","block");

UM.getEditor('myEditor');

$("#add_form").ajaxForm({
    dataType: "json",
    success : function(obj){
        if(obj.errno == 1){
            alert(obj.errdesc);
            window.location.href='/admin.php/Rescue/index';
        }else{
            alert(obj.errdesc);
        }
        return false;
    }
})

$("#add_btn").on("click", function(){
    
    var l = $('#name').val().length;
    if (l > 10) {
      alert('救援项目名称最多填写10个字');
      return false;
    }

    if (l == 0) {
      alert('救援项目名称不能为空');
      return false;
    }

    $("#add_form").submit();
    return false;
})

// initialize the validator function
validator.message.date = 'not a real date';

// validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
$('form')
    .on('blur', 'input[required], input.optional, select.required', validator.checkField)
    .on('change', 'select.required', validator.checkField)
    .on('keypress', 'input[required][pattern]', validator.keypress);

$('.multi.required').on('keyup blur', 'input', function() {
    validator.checkField.apply($(this).siblings().last()[0]);
});

$(".cancel-btn").on('click', function () {
    window.history.back(-1);
    return false;
});
