var navHeight = document.getElementsByTagName('nav')[0].clientHeight;
document.getElementById('main-container').style.height = 'calc(100% - '+navHeight+'px)'
var xmlHttp = new XMLHttpRequest();
var actionUrl = './library/Actions.php';

var form = document.getElementById('form');
if(form){
    form.addEventListener('submit',function(e) {
        const inputFields = document.querySelectorAll('.must-fill')
        let valid = true;
        for (let i = 0; i < inputFields.length; i++) {
            if(inputFields[i].value == ''){
                if(valid) valid = !valid; e.preventDefault(); //valid == true, make it false first
                if(inputFields[i].id == 'categories'){
                    document.getElementsByClassName('cat-header')[0].classList.add('no-text')
                    setTimeout(() => {
                        document.getElementsByClassName('cat-header')[0].classList.remove('no-text')
                    }, 2500);
                }else{
                    inputFields[i].classList.add('no-value')
                    setTimeout(() => {
                        inputFields[i].classList.remove('no-value')
                    }, 2500);
                }
            }
        }
    })
    var inputs = document.querySelectorAll('.must-fill');
    if(inputs){
        var submitBtn = document.querySelector('input[type=submit]');
    }
    for(const input of inputs){
        input.addEventListener('change',function(){
            submitBtn.removeAttribute('disabled')
        })
    }
}

function confirmDelete(e){
    const url = e.previousElementSibling.getAttribute('href').split('=');
    var id = url[url.length - 1];
    var id_number = e.parentElement.parentElement.querySelectorAll('td')[1].innerText;
    if(/[0-9]/.test(id_number) && /[0-9]/.test(id)){
        swal({
            title: "Are you sure?",
            text: "Delete ID Number: "+id_number,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                xmlHttp.onreadystatechange = function(){
                    if(xmlHttp.responseText == '404'){
                        swal({title:'Error',text:'Invalid Selection'})
                    }else if(xmlHttp.responseText == '200'){
                        swal('voter deleted',{icon:'success'})
                        .then((closed) => {
                            location.reload();
                        })
                    }else{
                        swal({title:'Error',text:'Server Could Not Fulfill Request'})
                    }
                }
                xmlHttp.open('POST',actionUrl);
                xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                xmlHttp.send('action=deleteVoter&id='+id+'&id_number='+id_number)
            }
        });
    }else{
        swal({title:'Error',text:'Invalid Selection'})
    }
}

function getUrlId(e){
    // let url = new URL(e.parentElement)
}