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

    // Add this constructor:
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
        $form = new AlbumForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if (! $request->isPost()) {
            return ['form' => $form];
        }

        $album = new Album();
        $form->setInputFilter($album->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return ['form' => $form];
        }

        $album->exchangeArray($form->getData());
        $this->table->saveAlbum($album);
        return $this->redirect()->toRoute('album');
    }
    }

    public function editAction()
    {
    }

    public function deleteAction()
    {
    }
}