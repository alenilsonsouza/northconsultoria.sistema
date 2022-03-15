<?php
class N_AddressHandler extends model
{

    private $table = 'n_addresses';

    public function listFromPeople($id_people)
    {
        $array = [];
        if ($id_people > 0) {
            $sql = "SELECT * FROM {$this->table} WHERE id_people = :id_people";
            $sql = $this->db->prepare($sql);
            $sql->execute(['id_people' => $id_people]);
            if ($sql->rowCount() > 0) {
                $array = $sql->fetch(PDO::FETCH_ASSOC);
            }
        }
        return $array;
    }

    public function insert(N_Address $address)
    {

        $sql = "INSERT INTO {$this->table} (id_people, cep, logradouro, numero, complemento, bairro, cidade, estado) VALUES (:id_people, :cep, :logradouro, :numero, :complemento, :bairro, :cidade, :estado)";
        $sql = $this->db->prepare($sql);
        $sql->execute([
            'id_people' => $address->getIdPeople(),
            'cep' => $address->getCep(),
            'logradouro' => $address->getLogradouro(),
            'numero' => $address->getNumero(),
            'complemento' => $address->getComplemento(),
            'bairro' => $address->getBairro(),
            'cidade' => $address->getCidade(),
            'estado' => $address->getEstado()
        ]);
    }

    public function update(N_Address $address, $id)
    {

        $sql = "UPDATE {$this->table} SET cep = :cep, logradouro = :logradouro, numero = :numero, complemento = :complemento, bairro = :bairro, cidade = :cidade, estado = :estado WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->execute([
            'cep' => $address->getCep(),
            'logradouro' => $address->getLogradouro(),
            'numero' => $address->getNumero(),
            'complemento' => $address->getComplemento(),
            'bairro' => $address->getBairro(),
            'cidade' => $address->getCidade(),
            'estado' => $address->getEstado(),
            'id' => $id
        ]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->execute(['id' => $id]);
    }

    public function deleteByIdPeople($id_people)
    {
        $sql = "DELETE FROM {$this->table} WHERE id_people = :id";
        $sql = $this->db->prepare($sql);
        $sql->execute(['id' => $id_people]);
    }
}