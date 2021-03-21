let inputStudentImg = document.getElementById('inputStudentImg');
let studentid = document.getElementById('inputstudentid').value;
let inputdatas = document.getElementsByClassName('inputdatas');

for(let i = 0; i < inputdatas.length; i++) {
    inputdatas[i].addEventListener('focusout', function(e) {
        updateData(this);
    })
}

inputStudentImg.addEventListener('change', function() {
    
    let myForm = document.getElementById("formImg");
    let myFormData = new FormData(myForm);
    let targetUrl = `${urlHost}addImgStudent/${studentid}`;
    let bodyData   = myFormData;
    
    fetchAjaxJson(targetUrl, bodyData, showImg);


});

const showImg = (data) => {
    let img = new Image(); 
    let url = urlHost+'assets\\'+data.avatar;
    img.src = url;
    document.getElementById("showImg").innerHTML = "";
    document.getElementById('showImg').appendChild(img); 
}

const updateData = (item) => {
    let val = item.value;
    let key = item.getAttribute('name');
    let targetUrl = `${urlHost}fastUpdateStudent/${studentid}/${key}/${val}`;
    let bodyData = "";

    fetchAjaxJson(targetUrl, bodyData, showUpdate);
}

const showUpdate = (user) => {
    for(let i = 0; i < inputdatas.length; i++) {
        if(inputdatas[i].getAttribute('name') == "email") {
            inputdatas[i].value = user.email;
        }
        if(inputdatas[i].getAttribute('name') == "firstname") {
            inputdatas[i].value = user.firstname;
        }
        if(inputdatas[i].getAttribute('name') == "lastname") {
            inputdatas[i].value = user.lastname;
        }
        
    }
}

