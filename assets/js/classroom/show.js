let submitButton = document.getElementById('addUserButton');
let studentsList = document.getElementById('studentsList');
let showItemDetailButtons = document.getElementsByClassName('showItemDetailButton');
let classroomid = document.getElementById('classroomid').textContent;

/*** listenner **/

// Show student detail
for(let i = 0; i < showItemDetailButtons.length; i++) {
    let item = showItemDetailButtons[i];
    item.addEventListener('click', function(e) {
      showStudentDetails(this);
  })
}

// Add student (submit)
submitButton.addEventListener('click', function(event) {
    event.preventDefault();
    
    let myForm = document.querySelector("form");
    let myFormData = new FormData(myForm);
    let targetUrl = `${urlHost}addStudent`;
    let bodyData   = myFormData;
    
    fetchAjaxJson(targetUrl, bodyData, addStudentLine);

})

/** functions **/
const addStudentLine = user => {
   let li = document.createElement('li');
   li.textContent = `${user.firstname} ${user.lastname}`;
   studentsList.append(li);
};

const showStudentDetails = item => {
    fullScreen.style.display = "block";
    let studentid = item.dataset.studentid;

   let targetUrl = `${urlHost}showStudent/${studentid}/${classroomid}`;
   let bodyData  =  ""; 

   fetchAjaxText(targetUrl, bodyData, showInFullScreen);
   
};

const showNextStudent = studentid => {
    let currentStudent = document.getElementById('student-row-'+studentid);
    let nextStudent = currentStudent.nextElementSibling;
    showStudentDetails(nextStudent);
}

const showPrevStudent = studentid => {
  let currentStudent = document.getElementById('student-row-'+studentid);
  let prevStudent = currentStudent.previousElementSibling;
  showStudentDetails(prevStudent);
}


const showInFullScreen = result => {
  fullScreenContent.innerHTML = result;
}