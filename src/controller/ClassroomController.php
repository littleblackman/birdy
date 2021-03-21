<?php

namespace Birdy\Controller;

use Birdy\Model\Entity\Classroom;
use Birdy\Model\Manager\ClassroomManager;
use Birdy\Model\Manager\CycleManager;
use Etsik\Core\Controller;
use Etsik\Model\Entity\User;
use Etsik\Model\Manager\UserManager;
use Etsik\Service\StatService;

class ClassroomController extends Controller {

    private $classroomManager;

    public function __construct($request)
    {
        parent::__construct($request);
        $this->classroomManager = new ClassroomManager();
    }

    public function index() {
       $classrooms = $this->classroomManager->findByUserSession();
        return $this->render('classroom/index', ['classrooms' => $classrooms]);
    }

    public function edit() {
        $cycleManager = new CycleManager();
        ($this->request->get('id')) ? $classroom = $this->classroomManager->find($this->request->get('id')) : $classroom = new Classroom();
        $cycles = $cycleManager->findByUserSession();
        ($classroom->getId()) ? $title = "Modifier" : $title = "Créer";
        return $this->render('classroom/edit', ['cycles' => $cycles, 'classroom' => $classroom, 'title' => $title]);
    }


    public function update() {

        $datas = $this->request->get('data');
        $classroom = new Classroom($datas);
        $classroom = $classroom->save();
        $this->classroomManager->joinCycles($classroom, $datas['cyclesIdList']);
        return $this->redirect('showClassroom', $classroom->getId());
    }

    public function delete() {
        $id = $this->request->get('id');
        $classroom = $this->classroomManager->find($id);
        $this->classroomManager->deleteAll($classroom);

        return $this->redirect('classroom');
    }

    public function show() {
        $statService = new StatService();
        $id = $this->request->get('id');
        $classroom = $this->classroomManager->find($id);
        $studentPresenceList = $statService->getStudentPresenceList($id);
        return $this->render('classroom/show', ['classroom' => $classroom, 'studentPresenceList' => $studentPresenceList]);
    }

    public function addStudent(){

        $userManager = new UserManager();

        $classroom = $this->classroomManager->find($this->request->get('classroomId'));

        $data['firstname'] = $this->request->get('firstname');
        $data['lastname']  = $this->request->get('lastname');
        $data['email']     = $this->request->get('email');
        $data['role']      = 'student';
        $data['username']  = $userManager->generateSlug($data['firstname'].$data['lastname'], 'username');
        $data['password']  = null;

        $user = new User($data);

        $user = $user->save();

        $this->classroomManager->joinUser($classroom, $user);

        return $this->renderJson($user->toArray());

    }

    public function studentList() {
        $id = $this->request->get('classroomid');
        $classroom = $this->classroomManager->find($id);
        return $this->renderHtml('classroom/_studentList', ['classroom' => $classroom]);
    }
}