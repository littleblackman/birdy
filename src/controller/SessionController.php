<?php

namespace Birdy\Controller;

use Birdy\Model\Entity\Session;
use Birdy\Model\Manager\ClassroomManager;
use Birdy\Model\Manager\CriteriasManager;
use Birdy\Model\Manager\CycleManager;
use Etsik\Core\Controller;
use Birdy\Model\Manager\SessionManager;

class SessionController extends Controller
{
    private $sessionManager;

    public function __construct($request)
    {
        parent::__construct($request);
        $this->sessionManager = new SessionManager();
    }

    public function index() {

        $cycleManager = new CycleManager();
        $manager = new ClassroomManager();

        if(!$this->request->get('direction')) {
            $direction = "none";
        } else {
            $direction = $this->request->get('direction');
        }

        if(!$this->request->get('page')) {
            $page = 1;
        } else {
            $page = $this->request->get('page');
            if($direction != "none") {
                ($direction == "next") ? $page = $page+1 : $page =$page-1;
            }
        }

        if(!$this->request->get('classroomId')) {
            $classroomId = "all";
        } else {
            $classroomId = $this->request->get('classroomId');
        }

        if(!$this->request->get('stepSession')) {
            $stepSession = "all";
        } else {
            $stepSession = $this->request->get('stepSession');
        }

        if(!$this->request->get('cycleId')) {
            if(!$cycleId = $cycleManager->findBy(['user_id' => $this->session->getUserId(), 'step' => 'open'])) {
                $cycleId = null;
            } else {
                $cycleId = $cycleId[0]->getId();
            }

        } else {
            $cycleId = $this->request->get('cycleId');
        }

        $result = $this->sessionManager->findByUser($page, $classroomId, $stepSession, $cycleId);
        $sessions = $result[0];
        $maxPage  = $result[1];
        if($page > $maxPage) $page = $maxPage;

        $classrooms = $manager->findByUserSession();

        $cycles = $cycleManager->findBy(['user_id' => $this->session->getUserId(), 'is_active' => 1] );

        return $this->render('session/index', [ 'sessions' => $sessions, 
                                                'classrooms' => $classrooms, 
                                                'page' => $page, 
                                                'maxPage' => $maxPage, 
                                                'classroomId' => $classroomId, 
                                                'stepSession' => $stepSession, 
                                                'cycles' => $cycles,
                                                'cycleId' => $cycleId
                                                ]);
    }

    public function start() {
        $classroomManager = new ClassroomManager();
        $cycleManager = new CycleManager();

        if(!$this->request->get('id')) $id = null;
        $session = $this->sessionManager->find($id);
        $classrooms = $classroomManager->findByUserSession();
        $cycles = $cycleManager->findBy(['user_id' => $this->session->getUserId(), 'step' => 'open'] );

        return $this->render('session/start', ['session' => $session, 'classrooms' => $classrooms, 'cycles' => $cycles]);
    }

    public function show() {
        $cycleManager = new CycleManager();
        $criteriasManager = new CriteriasManager();
        $cycles = $cycleManager->findBy(['user_id' => $this->session->getUserId(), 'step' => 'open'] );
        $session = $this->sessionManager->find($this->request->get('id'));
        $criteriass = $criteriasManager->findAll();
        return $this->render('session/show', ['session' => $session, 'cycles' => $cycles, 'criteriass' => $criteriass]);
    }

    public function close() {
        $id = $this->request->get('id');
        $this->sessionManager->close($id);
        return $this->redirect('showSession', $id);
    }


    public function openSessionAgain() {
        $id = $this->request->get('id');
        $this->sessionManager->openSessionAgain($id);
        return $this->redirect('showSession', $id);
    }

    public function updatePresence() {
        $sessionId = $this->request->get('sessionId');
        $studentId = $this->request->get('studentId');
        $status    = $this->request->get('status');

        $link = $this->sessionManager->updatePresence($sessionId, $studentId, $status);

        $session = $this->sessionManager->find($sessionId);
        $session->setStep('open');
        $session->save();

        return $this->renderJson($link);
    }

    public function update(){

        $data['name']         = $this->request->get('name');
        $data['description']  = $this->request->get('description');
        $data['date']         = $this->request->get('date');
        $data['start']        = $this->request->get('start');
        $data['end']          = $this->request->get('end');
        $data['cycleId']      = $this->request->get('cycle_id');
        $data['classroomId']  = $this->request->get('classroom_id');
        $data['step']         = "create";

        $session = new Session($data);

        $session = $session->save();

        return $this->redirect('showSession', $session->getId());
    }

    public function updateData() {
        $data[$this->request->get('type')]  = $this->request->get('tinyContent');
        $session = $this->sessionManager->find($this->request->get('sessionId'));
        $session->hydrate($data);
        $session = $session->save();
        return $this->renderJson($session->toArray());

    }

    public function delete() {
        $id = $this->request->get('id');
        $session = $this->sessionManager->find($id);

        $this->sessionManager->deleteAll($session);

        return $this->redirect('session');
    }


}