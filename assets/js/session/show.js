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

let saveCurrentSessionAgenda = document.getElementById('saveCurrentSessionAgenda');
let currentSessionId         = document.getElementById('currentSessionId').value;
let showItemDetailButtons    = document.getElementsByClassName('showItemDetailButton');
let currentSessionStep       = document.getElementById('currentSessionStep');
let inputSkill               = document.getElementById('inputSkill');
let currentSessionSkill      = document.getElementById('currentSessionSkill');
let validCriteria            = document.getElementById('validCriteria');
let selectCriterias          = document.getElementsByClassName('selectCriteria');
let skillSelecteds           = document.getElementsByClassName('skillSelected');          
let status = currentSessionStep.textContent;

let currentSkillId, currentCriteriaId;

// Show student detail
for(let i = 0; i < showItemDetailButtons.length; i++) {
  let item = showItemDetailButtons[i];
  item.addEventListener('click', function(e) {
    changeStudentStatus(this);
  })
}

// update currentCriteria selected by click on criteria
for(let i = 0; i< selectCriterias.length; i++) {
  let element = selectCriterias[i];
  element.addEventListener('click', function(e) {
    changeSelectCriteria(this);
  })
}


// update currentSkill selected by click on skill
for(let i = 0; i< skillSelecteds.length; i++) {
  let element = skillSelecteds[i];
  element.addEventListener('click', function(e) {
    currentSkillId = this.dataset.skillid;
  })
}

inputSkill.addEventListener('keyup', function(e) {
  if(e.key == 'Enter') {
    let skillName = inputSkill.value;
    let myFormData = new FormData();
    myFormData.append('skillName', skillName);
    let targetUrl = `${urlHost}addSkillSession/${currentSessionId}`;
    let bodyData   = myFormData;
    fetchAjaxJson(targetUrl, bodyData, updateListSkill);
  }
})


validCriteria.addEventListener('click', function() {

  let myFormData = new FormData();
  myFormData.append('currentCriteriaId', currentCriteriaId);
  myFormData.append('currentSkillId', currentSkillId);
  let targetUrl = `${urlHost}addCriteriaSkill`;
  let bodyData   = myFormData;
  fetchAjaxJson(targetUrl, bodyData, showSkillCheck);

})

if(currentSessionStep.textContent != "close") {
    saveCurrentSessionAgenda.addEventListener('click', function() {
      let agendaContent = tinymce.activeEditor.getContent();
      let myFormData = new FormData();
      myFormData.append('tinyContent', agendaContent);
      let targetUrl = `${urlHost}updateDataSession/${currentSessionId}/agenda`;
      let bodyData   = myFormData;
      fetchAjaxJson(targetUrl, bodyData, confirmSaveData);
    });
}


const showSkillCheck = (result) => {
  document.getElementById('checkIconSkill'+currentSkillId).style.display = "inline-block";
}

const changeSelectCriteria = selectCriteria => {

  currentCriteriaId = selectCriteria.dataset.criteriaid;

  if(selectCriteria.classList.contains("unactive")) {
    for(let i = 0; i< selectCriterias.length; i++) {
      let element = selectCriterias[i];
      if(element.classList.contains('present')) {
        element.classList.remove('present');
        element.classList.add('unactive');
      }
    }
    selectCriteria.classList.add('present');
    selectCriteria.classList.remove('unactive');
  } else {
    selectCriteria.classList.add('unactive');
    selectCriteria.classList.remove('present');
  }

}

const updateListSkill = skill => {

  inputSkill.value = "";
  let li = document.createElement('li');
  li.classList.add('collection-item');
  li.id = "itemSkill"+skill.id;
  let a = '<a href="#" class="secondary-content" onclick="deleteClick('+skill.id+')"><i class="fa fa-trash" aria-hidden="true"></i></a>';
  li.innerHTML = skill.name+a;
  currentSessionSkill.appendChild(li);
}

const deleteClick = skillId => {

  let myFormData = new FormData();
  myFormData.append('skillId', skillId);
  let targetUrl = `${urlHost}deleteSkill`;
  let bodyData   = myFormData;
  fetchAjaxJson(targetUrl, bodyData, removeSkill);
}


const removeSkill = id => {
  let li = document.getElementById('itemSkill'+id);
  li.style.display = "none";
}

const confirmSaveData = result => {
}

const changeStudentStatus = item => {
    let studentid = item.dataset.studentid;

    if(status == "create") {
      currentSessionStep.innerHTML = 'open';
      status = "open";
      document.getElementById('showCommand').style.display = "inline-block";
    }

    if(item.classList.contains("present")) {
      item.classList.remove('present');
      item.classList.add('absent');
      status = 'absent';
    } else if( item.classList.contains("absent")) {
      item.classList.remove('absent');
      status = null;
    } else {
      item.classList.add('present');
      status = 'present';
    }

    let targetUrl = `${urlHost}updateSessionPresence/${currentSessionId}/${studentid}/${status}`;
    let bodyData   = "";
    fetchAjaxJson(targetUrl, bodyData, confirmSaveData);
}
