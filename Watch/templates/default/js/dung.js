/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*DANG KI*/
$(document).ready(function(){
    $("#hide").click(function(){
        $("#chatform").hide();
        $("#messenger").show();
    });
    $("#show").click(function(){
        $("#messenger").hide();
        $("#chatform").show();
    });
    $("#dangkiform input[type='button']").click(function(){
        validate();
    });
    function validate(){
        // GETTING INPUT OBJECT
        var acc = document.getElementById("acc");
        var email = document.getElementById("email");
        var reemail = document.getElementById("reemail");
        var pass = document.getElementById("pass");
        var repass = document.getElementById("repass");
        // GETTING ERROR OBJECT
        var acc_error = document.getElementById("acc_error");
        var email_error = document.getElementById("email_error");
        var reemail_error = document.getElementById("reemail_error");
        var pass_error = document.getElementById("pass_error");
        var repass_error = document.getElementById("repass_error");
        //REGULAR EXPRESSION PATTERN
        var acc_pat = /^[A-z_$&]{1}[A-z0-9]{9,31}$/;
        var pass_pat = /^[A-z0-9]{6,}$/;
        var ald = /[0-9]/;
        var alu = /[A-Z]/;
        var all = /[a-z]/;
        var email_pat = /^[A-z]{1}[A-z0-9!#$%^&*()_+-.]{8,30}[A-z0-9]{1}\@[A-z0-9]{3,10}\.[A-z0-9]{1,10}[.A-z0-9]*$/;
        //VALIDATE FUNCTION
        // ACC
        if( acc.value == "" ){
            acc.setAttribute("style","border: 1px solid red;");
            acc_error.innerHTML = "Tài khoản trống";
        }else{
            if(!acc_pat.test(acc.value)){
                acc.setAttribute("style","border: 1px solid red");
                acc_error.innerHTML = "Tên phải từ 10-32 kí tự, kí tự đầu là A-z,a-z,$,_,&";
            }else{
                acc.setAttribute("style","");
                acc_error.innerHTML = "";
            }
        }
        //EMAIL
        if( email.value == "" ){
            email.setAttribute("style","border: 1px solid red;");
            email_error.innerHTML = "Email trống";
        }else{
            if(!email_pat.test(email.value)){
                email.setAttribute("style","border: 1px solid red;");
                email_error.innerHTML = "Tên email phải từ 10-32 kí tự, kí tự đầu thuộc A-z và trước @ thuộc A-z0-9,";
            }else{
                email.setAttribute("style","");
                email_error.innerHTML = "";                
            }    
        }
        if( reemail.value == "" ){
            reemail.setAttribute("style","border: 1px solid red;");
            reemail_error.innerHTML = "Reemail trống";
        }else{

            if(!email_pat.test(reemail.value)){
                reemail.setAttribute("style","border: 1px solid red;");
                reemail_error.innerHTML = "Tên email phải từ 10-32 kí tự, kí tự đầu thuộc A-z và trước @ thuộc A-z0-9,";
            }else{
                if(email.value != reemail.value){
                    reemail.setAttribute("style","border: 1px solid red;");
                    reemail_error.innerHTML = "Phải trùng với email";                    
                }else{
                    reemail.setAttribute("style","");
                    reemail_error.innerHTML = "";                    
                }
            }
        }
        // PASS
        if( pass.value == "" ){
            pass.setAttribute("style","border: 1px solid red;");
            pass_error.innerHTML = "Password trống";
        }else{
            if(!pass_pat.test(pass.value)){
                pass.setAttribute("style","border: 1px solid red");
                pass_error.innerHTML = "Mật khẩu phải từ 6 kí tự trở lên, không có kí hiệu đặc biệt";
            }else{
                if((!alu.test(pass.value)) || (!all.test(pass.value)) || (!ald.test(pass.value))){
                    pass.setAttribute("style","border: 1px solid red");
                    pass_error.innerHTML = "Mật khẩu phải có ít nhất 1 chữ hoa, 1 chữ thường, 1 chữ số";
                }else{
                    pass.setAttribute("style","");
                    pass_error.innerHTML = "";
                }
            }            
        }
        if( repass.value == "" ){
            repass.setAttribute("style","border: 1px solid red;");
            repass_error.innerHTML = "Repassword trống";
        }else{
            if(!pass_pat.test(repass.value)){
                repass.setAttribute("style","border: 1px solid red");
                repass_error.innerHTML = "Mật khẩu phải từ 6 kí tự trở lên, không có kí hiệu đặc biệt";
            }else{
                if((!alu.test(repass.value)) || (!all.test(repass.value)) || (!ald.test(repass.value))){
                    repass.setAttribute("style","border: 1px solid red");
                    repass_error.innerHTML = "Mật khẩu phải có ít nhất 1 chữ hoa, 1 chữ thường, 1 chữ số";
                }else{
                    if(repass.value != pass.value){
                        repass.setAttribute("style","border: 1px solid red");
                        repass_error.innerHTML = "Phải trùng khớp với mật khẩu";                       
                    }else{
                        repass.setAttribute("style","");
                        repass_error.innerHTML = "";
                    }
                }
            }
        }
        /*
        if( error.length>=1 )
            $("legend").after("<p>"+ error + "</p>");
        else{
            document.getElementById("dangkiform").submit();
            alert("khong loi");
        }
        alert(error.length); */
    }
    
    
});    
/*CHI TIET SAN PHAM*/
function showAnhTo(n){
    var anhto = document.getElementsByClassName("anhto")[0];
    var anhnho = document.getElementsByClassName("anhnho"+n)[0];
    anhto.setAttribute("src", anhnho.getAttribute("src"));
}
function showAnhToModal(n){
    var anhto = document.getElementsByClassName("anhto")[1];
    var anhnho = document.getElementsByClassName("anhnho"+n)[1];
    anhto.setAttribute("src", anhnho.getAttribute("src"));
}
//MODAL
function modalbtn(){
    var modal = document.getElementById('myModal');
    modal.style.display = "block";

}

// When the user clicks on <span> (x), close the modal
function modalspan(){
    var modal = document.getElementById('myModal');
    modal.style.display = "none";
}
$(document).ready(function(){
    $("#zoomin").click(function(){
        $("#anhtomodal").animate({
            opacity: '2',
            height: '+=50px',
            width: '+=50px'
        });
    });
        $("#zoomout").click(function(){
        $("#anhtomodal").animate({
            opacity: '2',
            height: '-=50px',
            width: '-=50px'
        });
    });
});
function showSlides(n){
    showAnhToModal(n);
}
    var slideIndex = 1;
function plusSlides(n) {
    slideIndex += n;
    if(slideIndex > 4) {slideIndex = 1;}
    if(slideIndex < 1) {slideIndex = 4;}
    showSlides(slideIndex);
    /*activeSlide();*/
}
function activeSlide(){
    var active = document.getElementsByClassName('anhnho'+slideIndex)[1];
    active.style.border = "1px solid black";
    for(var i=0; i < 4; i++){
        if(i != slideIndex){
            var activei = document.getElementsByClassName('anhnho'+i)[1];
            activei.style.border = "1px solid red";
        }
        alert("test");
    }
}
//END MODAL

