<?php

namespace Birdy\Controller;

use Birdy\Model\Manager\SkillManager;
use Etsik\Core\Controller;
use Etsik\Model\Manager\UserManager;
use Etsik\Core\ImageService;

class StudentController extends Controller
{
    public function __construct($request)
    {
        parent::__construct($request);
        $this->userManager = new UserManager();

    }

    public function show() {
        $classroomId = $this->request->get('classroomid');
        $skillManager = new SkillManager();
        $student = $this->userManager->find($this->request->get('studentid'), 'Etsik');

        $skills = $skillManager->findByClassroomId($classroomId);

        return $this->renderHtml('student/show', ['student' => $student, 'classroomid' => $classroomId, 'skills' => $skills]);
    }

    public function edit() {
        $student = $this->userManager->find($this->request->get('studentid'), 'Etsik');
        return $this->render('student/edit', ['student' => $student, 'classroomid' => $this->request->get('classroomid')]);
    }

    public function fastUpdate() {
        $student = $this->userManager->find($this->request->get('studentid'), 'Etsik');
        $data = [$this->request->get('key') => $this->request->get('val')];
        $student->hydrate($data);
        $student->save();
        return $this->renderJson($student->toArray());

    }

    public function addImg() {
        $fileData = $_FILES['inputImg'];
        $imageService = new ImageService();

        $imageService->upload($fileData);

        $student = $this->userManager->find($this->request->get('studentid'), 'Etsik');
    
        $student->setAvatarFolder($imageService->getFolder());
        $student->setAvatarFilename($imageService->getImageName());

        $student->save();

        $imageService->resize();
        $imageService->crop();

        return $this->renderJson($student->toArray());

    }
}