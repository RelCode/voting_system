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
        for(const input of inputs){
            input.addEventListener('keyup',function(){
                submitBtn.removeAttribute('disabled')
            })
        }
    }
}

function confirmDelete(e){
    let type = e.dataset.action;
    const url = e.previousElementSibling.getAttribute('href').split('=');//separate url string into array
    var id = url[url.length - 1];//get id from url array, which is the last element
    if(type == 'voter'){
        var identifier = e.parentElement.parentElement.querySelectorAll('td')[1].innerText;//
        var confirmText = 'Delete ID Number: '+identifier;
    }else if(type == 'candidate'){
        var identifier = e.parentElement.parentElement.querySelectorAll('td')[0].innerText;//
        var confirmText = 'Delete Candidate: '+identifier;
    }
    if(identifier != '' && /[0-9]/.test(id)){
        swal({
            title: "Are you sure?",
            text: confirmText,
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
                        swal(type + ' deleted',{icon:'success'})
                        .then((closed) => {
                            location.reload();
                        })
                    }else{
                        swal({title:'Error',text:'Server Could Not Fulfill Request'})
                    }
                }
                xmlHttp.open('POST',actionUrl);
                xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                xmlHttp.send('action=delete'+type+'&id='+id+'&identifier='+identifier)
            }
        });
    }else{
        swal({title:'Error',text:'Invalid Selection'})
    }
}
var prestine = true;
//used on create.candidate page for toggling radio button values and text styling
var radios = document.querySelectorAll('.selected-radio');
var runningFor = [];//hold an array of values candidate is running for
var runningIn = [];//hold an array of values candidate is running in
if(radios){
    for(const radio of radios){
        if(prestine == true && document.getElementById('for').value != ''){//when editing and nothing has been chenged yet
            runningFor = document.getElementById('for').value.split('%20');
            runningIn = document.getElementById('in').value.split('%20');
            prestine = false;
        }
        radio.addEventListener('click',function(){
            // radio.hasA
            if(document.querySelector('input[type=submit]').hasAttribute('disabled')){
                document.querySelector('input[type=submit]').removeAttribute('disabled')
            }
            let radioTxt = this.parentElement.innerText;
            let spanText = this.closest('.mb-3').querySelector('span').querySelector('i'); 
            if(radioTxt != ''){
                spanText.classList.remove('text-secondary')
                spanText.classList.add('text-success');
                spanText.innerText = radioTxt;
                candidacyValues(this.id)
            }
        })
    }
}

function candidacyValues(id){
    if(id != ''){
        let canFor = id.substr((id.indexOf('-') + 1));
        let canIn = id.split('-')[0];
        if(runningFor == ''){
            runningFor.push(canFor);
            runningIn.push(canIn);
        }else{
            let exists = false;//variable to be used to check if a value has already been selected
            for (let i = 0; i < runningFor.length; i++) {
                if(runningFor[i] == canFor){
                    exists = true;
                    runningFor[i] = canFor;
                    runningIn[i] = canIn;
                }
            }
            if(exists == false){ 
                runningFor.push(canFor);
                runningIn.push(canIn);
            }
        }
        document.querySelector('#for').value = runningFor.join('%20')
        document.querySelector('#in').value = runningIn.join('%20')
    }
}