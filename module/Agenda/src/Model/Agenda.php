<?php
namespace Agenda\Model;

use DomainException;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\StringLength;

class Agenda
{
    public $id;
    public $nome;
    public $sobrenome;
    public $endereco;
    public $bairro;
    public $cidade;
    public $fone_residencial;
    public $fone_comercial;
    public $celular;
    public function exchangeArray(array $data)
    {
    	$this->id     = !empty($data['id']) ? $data['id'] : null;
    	$this->nome = !empty($data['nome']) ? $data['nome'] : null;
    	$this->sobrenome  = !empty($data['sobrenome']) ? $data['sobrenome'] : null;
    	$this->endereco = !empty($data['endereco']) ? $data['endereco'] : null;
    	$this->bairro  = !empty($data['bairro']) ? $data['bairro'] : null;
    	$this->cidade = !empty($data['cidade']) ? $data['cidade'] : null;
    	$this->fone_residencial  = !empty($data['fone_residencial']) ? $data['fone_residencial'] : null;
    	$this->fone_comercial = !empty($data['fone_comercial']) ? $data['fone_comercial'] : null;
    	$this->celular  = !empty($data['celular']) ? $data['celular'] : null;
    }

     public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new DomainException(sprintf(
            '%s não permite a inserção de mais um campo',
            __CLASS__
        ));
    }

    public function getInputFilter()
    {
        // if ($this->inputFilter) {
        //     return $this->inputFilter;
        // }

        $inputFilter = new InputFilter();

        $inputFilter->add([
            'name' => 'id',
            'required' => true,
            'filters' => [
                ['name' => ToInt::class],
            ],
        ]);

        $inputFilter->add([
            'name' => 'nome',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
            ],
        ]);
        $inputFilter->add([
            'name' => 'sobrenome',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'endereco',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
            ],
        ]);
        $inputFilter->add([
            'name' => 'bairro',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
            ],
        ]);
        $inputFilter->add([
            'name' => 'cidade',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
            ],
        ]);
        $inputFilter->add([
            'name' => 'telefone_residencial',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 20,
                    ],
                ],
            ],
        ]);
        $inputFilter->add([
            'name' => 'telefone_comercial',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 20,
                    ],
                ],
            ],
        ]);
        $this->inputFilter = $inputFilter;
        return $this->inputFilter;
    }
}