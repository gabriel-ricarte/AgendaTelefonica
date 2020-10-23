<?php
namespace Agenda\Form;

use Zend\Form\Form;

class AgendaForm extends Form
{
	public function __construct($name = null)
	{
        // We will ignore the name provided to the constructor
		parent::__construct('agenda');

		$this->add([
			'name' => 'id',
			'type' => 'hidden',
		]);
		$this->add([
			'name' => 'nome',
			'type' => 'text',
			'options' => [
				'label' => 'Nome',
			],
		]);
		$this->add([
			'name' => 'sobrenome',
			'type' => 'text',
			'options' => [
				'label' => 'Sobrenome',
			],
		]);
		$this->add([
			'name' => 'endereco',
			'type' => 'text',
			'options' => [
				'label' => 'Endereco',
			],
		]);
		$this->add([
			'name' => 'bairro',
			'type' => 'text',
			'options' => [
				'label' => 'Bairro',
			],
		]);
		$this->add([
			'name' => 'cidade',
			'type' => 'text',
			'options' => [
				'label' => 'Cidade',
			],
		]);
		$this->add([
			'name' => 'celular',
			'type' => 'text',
			'options' => [
				'label' => 'Celular',
			],
		]);
		$this->add([
			'name' => 'submit',
			'type' => 'submit',
			'attributes' => [
				'value' => 'Go',
				'id'    => 'submitbutton',
			],
		]);
	}
}