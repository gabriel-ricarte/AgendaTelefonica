<?php
namespace Agenda\Controller;

use Agenda\Model\AgendaTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Agenda\Form\AgendaForm;
use Agenda\Model\Agenda;

class AgendaController extends AbstractActionController
{
	private $table;

    //controller da agenda com as funções do crud de listar, salvar, editar e excluir 
    //pela documentação escassa não foi possivel fazer o projeto em zend 1
    //maior parte das paginas de documentação estavam desativadas
    public function __construct(AgendaTable $table)
    {
        $this->table = $table;
    }
    public function indexAction()
    {
    	//dd($this->table->fetchAll());
    	return new ViewModel([
            'contatos' => $this->table->fetchAll(),
        ]);
    }

    public function addAction()
    {
        $form = new AgendaForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if (! $request->isPost()) {
            return ['form' => $form];
        }
        //dd($request);
        $agenda = new Agenda();
        //$form->setInputFilter($agenda->getInputFilter());
        $form->setData($request->getPost());
        //dd($request);
        if (! $form->isValid()) {
            return ['form' => $form];
        }

        $agenda->exchangeArray($form->getData());
        $this->table->saveAgenda($agenda);
        return $this->redirect()->toRoute('agenda');
    
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if (0 === $id) {
            return $this->redirect()->toRoute('agenda', ['action' => 'add']);
        }

        try {
            $agenda = $this->table->getAgenda($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('agenda', ['action' => 'index']);
        }

        $form = new AgendaForm();
        $form->bind($agenda);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form];

        if (! $request->isPost()) {
            return $viewData;
        }

        //$form->setInputFilter($agenda->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return $viewData;
        }
        $this->table->saveAgenda($agenda);

        return $this->redirect()->toRoute('agenda', ['action' => 'index']);
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('agenda');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Não');

            if ($del == 'Sim') {
                $id = (int) $request->getPost('id');
                $this->table->deleteAgenda($id);
            }

            // Redirect to list of albums
            return $this->redirect()->toRoute('agenda');
        }

        return [
            'id'    => $id,
            'agenda' => $this->table->getAgenda($id),
        ];
    }
}