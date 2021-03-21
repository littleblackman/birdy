<?php

namespace Birdy\Controller;

use Etsik\Core\Controller;
use Birdy\Model\Entity\Cycle;
use Birdy\Model\Manager\CycleManager;

class CycleController extends Controller {

    private $cycleManager;

    public function __construct($request)
    {
        parent::__construct($request);
        $this->cycleManager = new CycleManager();
    }

    public function index() {

        $cycles = $this->cycleManager->findBy(['is_active' => 1, 'user_id' => $this->session->getUserId()]);

        return $this->render('cycle/index', ['cycles' => $cycles]);
    }

    public function edit() {

        $id = $this->request->get('id');

        $cycle = $this->cycleManager->find($id);

        ($id) ? $title = "Modifier" : $title = "Créer";

        return $this->render('cycle/edit', ['cycle' => $cycle, "title" => $title]);
    }

    public function update() {
        $cycle = new Cycle($this->request->get('data'));

        $cycle = $cycle->save();
    
        return $this->redirect('cycle');
    }

    public function delete() {
        $id = $this->request->get('id');
        $cycle = $this->cycleManager->find($id);
        $cycle->delete();

        return $this->redirect('cycle');
    }
}