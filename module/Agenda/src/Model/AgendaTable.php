<?php
namespace Agenda\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class AgendaTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function getAgenda($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Linha não encontrada %d',
                $id
            ));
        }

        return $row;
    }

    public function saveAgenda(Agenda $agenda)
    {
        $data = [
            'nome' => $agenda->nome,
            'sobrenome'  => $agenda->sobrenome,
            'endereco'  => $agenda->endereco,
            'bairro'  => $agenda->bairro,
            'cidade'  => $agenda->cidade,
            'fone_residencial'  => $agenda->fone_residencial,
            'fone_comercial'  => $agenda->fone_comercial,
            'celular'  => $agenda->celular
        ];

        $id = (int) $agenda->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        try {
            $this->getAgenda($id);
        } catch (RuntimeException $e) {
            throw new RuntimeException(sprintf(
                'Id  %d; inexistente',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deleteAgenda($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}