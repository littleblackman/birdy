tinymce.init({
    selector: '#currentSessionAgenda',
    menubar: false,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table paste code help wordcount'
      ],
      toolbar: 'undo redo | formatselect | ' +
      'bold italic backcolor | alignleft aligncenter ' +
      'alignright alignjustify | bullist numlist outdent indent | ' +
      'removeformat | link',
      content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
});

let classrooms = document.getElementsByClassName('classrooms');

// current session selected
let currentClassroom;
let currentClassroomId;
let currentSessionId;

// add event event listener on classroom and start session
for(let i = 0; i < classrooms.length; i++) {
    classrooms[i].addEventListener('click', function() {
        currentClassroomId = (this).dataset.classroomid;
        currentClassroom   = (this).dataset.classroomname;

        selectClassroomView.style.display = "none";
        sessionForm.style.display = "block";

        let classroomidInput    = document.getElementById('classrommInputId');
        classroomidInput.value = currentClassroomId;

        showClassroomSelected.innerHTML = "- "+currentClassroom+" -";

        let targetUrl = `${urlHost}classroomStudentList/${currentClassroomId}`;
        let bodyData   = "";
        fetchAjaxText(targetUrl, bodyData, confirmSaveData);

    })
}

const confirmSaveData = (result) => {
    console.log(result)
}