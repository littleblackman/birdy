let selectItems     = document.getElementsByClassName('selecCriteria');
let stepSelect      = document.getElementById('stepSelect');
let classroomSelect = document.getElementById('classroomSelect');
let currentPage     = document.getElementById('currentPage');
let cycleSelect     = document.getElementById('cycleSelect');

for(let i = 0; i < selectItems.length; i++) {
    selectItem = selectItems[i];
    selectItem.addEventListener('click', function() {
        reloadSession(this);
    })
}


const reloadSession = (item) => {
   let url         = item.dataset.url;
   let classroomId = classroomSelect.value;
   let stepSession = stepSelect.value;
   let page        = currentPage.dataset.page; 
   let cycleId     = cycleSelect.value;
   let redirection = url+'/'+page+'/'+classroomId+'/'+stepSession+'/'+cycleId;


   console.log(redirection);

   window.location.href = redirection;
}