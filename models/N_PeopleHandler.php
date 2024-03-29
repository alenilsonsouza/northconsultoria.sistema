<?php
class N_PeopleHandler extends model
{
    private $table = 'n_people';

    public function insert(N_People $people)
    {
        $sql = "INSERT INTO {$this->table} 
        (id_people, id_plan, `name`, mother_name, email, tel_fix, tel_cel, birthdate, cpf, rg, `from`, sexo, marital_status, type_register, date_register, kinship) 
        VALUES (:id_people, :id_plan, :name, :mother_name, :email, :tel_fix, :tel_cel, :birthdate, :cpf, :rg, :from, :sexo, :marital_status, :type_register, :date_register, :kinship)";
        $sql = $this->db->prepare($sql);
        $sql->execute([
            'id_people' => $people->getIdPeople(),
            'id_plan' => $people->getIdPlan(),
            'name' => $people->getName(),
            'mother_name' => $people->getMotherName(),
            'email' => $people->getEmail(),
            'tel_fix' => $people->getTelFix(),
            'tel_cel' => $people->getTelCel(),
            'birthdate' => $people->getBirthDate(),
            'cpf' => $people->getCpf(),
            'rg' => $people->getRg(),
            'from' => $people->getFrom(),
            'sexo' => $people->getSexo(),
            'marital_status' => $people->getMaritalStatus(),
            'type_register' => $people->getTypeReister(),
            'date_register' => date('Y-m-d'),
            'kinship' => $people->getKinship()
        ]);

        $id = $this->db->lastInsertId();
        return $id;
    }

    public function update(N_People $people, $id, $RFUpdate = false)
    {
        if ($RFUpdate == false) {
            $sql = "UPDATE {$this->table} 
        SET `name` = :name, mother_name = :mother_name, 
        email = :email, tel_fix = :tel_fix, tel_cel = :tel_cel, 
        birthdate = :birthdate, cpf = :cpf, 
        rg = :rg, `from` = :from, sexo = :sexo, 
        marital_status = :marital_status WHERE id = :id";
            $sql = $this->db->prepare($sql);
            $sql->execute([
                'name' => $people->getName(),
                'mother_name' => $people->getMotherName(),
                'email' => $people->getEmail(),
                'tel_fix' => $people->getTelFix(),
                'tel_cel' => $people->getTelCel(),
                'birthdate' => $people->getBirthDate(),
                'cpf' => $people->getCPF(),
                'rg' => $people->getRg(),
                'from' => $people->getFrom(),
                'sexo' => $people->getSexo(),
                'marital_status' => $people->getMaritalStatus(),
                'id' => $id
            ]);
        } else {
            $sql = "UPDATE {$this->table} 
        SET `name` = :name, email = :email, tel_fix = :tel_fix, tel_cel = :tel_cel, 
        birthdate = :birthdate, cpf = :cpf, sexo = :sexo, 
        kinship = :kinship WHERE id = :id";
            $sql = $this->db->prepare($sql);
            $sql->execute([
                'name' => $people->getName(),
                'email' => $people->getEmail(),
                'tel_fix' => $people->getTelFix(),
                'tel_cel' => $people->getTelCel(),
                'birthdate' => $people->getBirthDate(),
                'cpf' => $people->getCPF(),
                'sexo' => $people->getSexo(),
                'kinship' => $people->getKinship(),
                'id' => $id
            ]);
        }
    }

    public function updateIdAsaas($idAsaas, $id)
    {
        $sql = "UPDATE {$this->table} SET id_asaas = :id_asaas WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->execute([
            'id_asaas' => $idAsaas,
            'id' => $id
        ]);
    }

    public function delete($id)
    {
        $address = new N_AddressHandler();
        $file = new N_File();
        $address->deleteByIdPeople($id);
        $file->deleteByIdPeople($id);
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->execute([
            'id' => $id
        ]);
    }

    public function deleteRF($idRF) {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->execute([
            ':id' => $idRF
        ]);
    }

    public function list($type = '', $id = '', $offset = '', $limit = '')
    {
        /**
         * @param $type
         * - 'T' -> Titular,
         * - 'D' -> Dependente,
         * - 'C' -> Corretor,
         * - 'RF' -> Responsável Financeiro
         * @param $id
         * 
         */
        $array = [];
        $sql = "SELECT * FROM {$this->table} ";
        $sqlExtend = '';
        if ($type == 'T') {
            $sqlExtend = "WHERE type_register = 'T' ";
        } elseif ($type == 'D') {
            $sqlExtend = "WHERE type_register = 'D' AND id_people = {$id} ";
        } elseif ($type == 'C') {
            $sqlExtend = "WHERE type_register = 'C' ";
        } else {
            $sqlExtend = "";
        }
        $sql .= $sqlExtend . "ORDER BY date_register DESC";
        if ($limit) {
            $sql .= " LIMIT {$offset}, {$limit}";
        }
        $sql = $this->db->prepare($sql);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $list = $sql->fetchAll(PDO::FETCH_ASSOC);
            $array = $this->listHandler('ALL', $list);
        }
        return $array;
    }

    public function search($type = '', $search)
    {
        /**
         * @param $type
         * - 'T' -> Titular,
         * - 'D' -> Dependente,
         * - 'C' -> Corretor
         * @param $id
         * 
         */
        $array = [];

        $sql = "SELECT * FROM {$this->table} ";

        if ($type == 'T') {
            $sql .= "WHERE type_register = 'T' ";
        } else if ($type == 'C') {
            $sql .= "WHERE type_register = 'C' ";
        }
        $sql .= "AND name LIKE :name OR cpf LIKE :cpf ORDER BY name ASC";
        $sql = $this->db->prepare($sql);
        $sql->execute([
            ':name' => '%' . $search . '%',
            ':cpf' => '%' . $search . '%'
        ]);
        if ($sql->rowCount() > 0) {
            $list = $sql->fetchAll(PDO::FETCH_ASSOC);
            $array = $this->listHandler('ALL', $list);
        }
        return $array;
    }

    public function listOne($id, $md5 = false)
    {

        $array = [];
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        if ($md5) {
            $sql = "SELECT * FROM {$this->table} WHERE MD5(id) = :id";
        }
        $sql = $this->db->prepare($sql);
        $sql->execute([
            ':id' => $id
        ]);
        if ($sql->rowCount() > 0) {
            $list = $sql->fetch(PDO::FETCH_ASSOC);
            $array = $this->listHandler('ONE', $list);
        }
        return $array;
    }

    public function listOneByCPFTitular($cpf)
    {

        $array = [];
        $sql = "SELECT * FROM {$this->table} WHERE `cpf` = :cpf AND `type_register` = 'T'";
        $sql = $this->db->prepare($sql);
        $sql->execute([':cpf' => $cpf]);
        if ($sql->rowCount() > 0) {
            $list = $sql->fetch(PDO::FETCH_ASSOC);
            $array = $this->listHandler('ONE', $list);
        }
        return $array;
    }

    public function listDependentsFromTitular($id)
    {

        $array = [];
        $sql = "SELECT * FROM {$this->table} WHERE `id_people` = :id AND `type_register` = 'D'";
        $sql = $this->db->prepare($sql);
        $sql->execute([':id' => $id]);
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return $array;
    }

    public function listIndicateds($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id_people = :id ORDER BY id DESC";
        $sql = $this->db->prepare($sql);
        $sql->execute([
            ':id' => $id
        ]);
        if ($sql->rowCount() > 0) {
            $list = $sql->fetchAll(PDO::FETCH_ASSOC);
            $array = $this->listHandler('ALL', $list);
        }
        return $array;
    }

    public function listCostumers()
    {
        $array = [];
        $sql = "SELECT * FROM {$this->table} WHERE `type_register` = 'C' ORDER BY `name` ASC";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $list = $sql->fetchAll(PDO::FETCH_ASSOC);
            $array = $this->listHandler('ALL', $list);
        }
        return $array;
    }

    public function listHolderNotArchived($offset, $limit)
    {
        $array = [];
        $sql = "SELECT * FROM {$this->table} WHERE `type_register` = 'T' AND `arquivado` = 'N' ORDER BY `id` DESC LIMIT {$offset}, {$limit}";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $list = $sql->fetchAll(PDO::FETCH_ASSOC);
            $array = $this->listHandler('ALL', $list);
        }
        return $array;
    }

    public function totalHolderNotArchived() {
        $sql = "SELECT COUNT(*) AS t FROM {$this->table} WHERE `type_register` = 'T' AND `arquivado` = 'N'";
        $sql = $this->db->query($sql);
        $res = $sql->fetch();

        return $res['t'];
    }

    public function archiveHolder($id) {
        $sql = "UPDATE {$this->table} SET `arquivado` = 'S' WHERE `id` = :id";
        $sql = $this->db->prepare($sql);
        $sql->execute([
            ':id' => $id
        ]);
    }

    public function listClientByConstumer($id_costumer, $start_date, $final_date)
    {
        $array = [];
        $sql = "SELECT * FROM {$this->table} WHERE id_people = :id_costumer AND date_register BETWEEN :start_date AND :final_date;";
        $sql = $this->db->prepare($sql);
        $sql->execute([
            ':id_costumer' => $id_costumer,
            ':start_date' => $start_date,
            ':final_date' => $final_date
        ]);
        if ($sql->rowCount() > 0) {
            $list = $sql->fetchAll(PDO::FETCH_ASSOC);
            $array = $this->listHandler('ALL', $list);
        }
        return $array;
    }

    public function verifyCheckedTerm($id)
    {

        $res = false;
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->execute([
            ':id' => $id
        ]);
        if ($sql->rowCount() > 0) {
            $item = $sql->fetch(PDO::FETCH_ASSOC);
            if ($item['termo'] == 'S') {
                $res = true;
            }
        }
        return $res;
    }

    public function aceitoTermo($id)
    {
        $sql = "UPDATE {$this->table} SET termo = :termo WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->execute([
            ':termo' => 'S',
            ':id' => $id
        ]);
    }

    public function listHoldersByIdPeople($id_people)
    {
        $array = [];
        $sql = "SELECT * FROM {$this->table} WHERE id_people = :id";
        $sql = $this->db->prepare($sql);
        $sql->execute([':id' => $id_people]);
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return $array;
    }

    public function totalPeople($type = '', $id = '')
    {

        $sql = "SELECT COUNT(*) as t FROM {$this->table}";
        if ($type == "T") {
            $sql .= " WHERE type_register = 'T'";
        } elseif ($type == "C") {
            $sql .= " WHERE type_register = 'C'";
        } elseif ($type == "D") {
            $sql .= " WHERE type_register = 'D' AND id_people = {$id}";
        } else {
        }
        $sql = $this->db->prepare($sql);
        $sql->execute();
        $item = $sql->fetch();
        return $item['t'];
    }

    public function totalMes($mes, $ano)
    {

        $sql = "SELECT COUNT(*) as t FROM {$this->table} WHERE MONTH(date_register) = :mes AND YEAR(date_register) = :ano";
        $sql = $this->db->prepare($sql);
        $sql->execute([
            ':mes' => $mes,
            ':ano' => $ano
        ]);

        $item = $sql->fetch();
        return $item['t'];
    }

    public function verifySenderExists($id)
    {
        $array = [];
        $sql = "SELECT id, name FROM {$this->table} WHERE id = :id AND type_register = 'C'";
        $sql = $this->db->prepare($sql);
        $sql->execute([
            'id' => $id
        ]);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    private function verifyFinancialResponsibleExists($id_people)
    {
        $array = false;
        $sql = "SELECT id, name, email, tel_cel, birthdate, cpf, type_register, kinship, sexo 
        FROM {$this->table} 
        WHERE id_people = :id AND type_register = 'RF'";
        $sql = $this->db->prepare($sql);
        $sql->execute([
            'id' => $id_people
        ]);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }
        return $array;
    }


    private function listHandler($type, $list)
    {
        /**
         * @param $type string
         * 'ALL' => gerar list
         * 'ONE' => pegar um item
         */
        $array = [];
        $plan = new N_PlanHandler();
        $address = new N_AddressHandler();
        $file = new N_File();

        if ($type == 'ALL') {
            foreach ($list as $k => $v) {
                $array[$k] = $list[$k];
                $array[$k]['plan'] = $plan->listOne($list[$k]['id_plan']);
                $array[$k]['address'] = $address->listFromPeople($list[$k]['id']);
                if ($list[$k]['type_register'] == 'T') {
                    $array[$k]['sender'] = $this->listOne($list[$k]['id_people']);
                    $array[$k]['dependents'] = $this->totalPeople('D', $list[$k]['id']);;
                } elseif ($list[$k]['type_register'] == 'D') {
                    $array[$k]['holder'] = $this->listOne($list[$k]['id_people']);
                } elseif ($list[$k]['type_register'] == "C") {
                    $listHolder = $this->listHoldersByIdPeople($list[$k]['id']);
                    $array[$k]['holders'] = $listHolder;
                    $array[$k]['holders_total'] =  count($listHolder);
                }
                $array[$k]['files'] = $file->listByPeople($list[$k]['id']);
                $array[$k]['type_register_text'] = $this->typeRegisterHandler($list[$k]['type_register']);
                $array[$k]['termo_aceito'] = $array[$k]['termo'] == 'S' ? 'SIM' : 'NÃO';
                $array[$k]['responsavel_financeiro'] = $this->verifyFinancialResponsibleExists($list[$k]['id']); // false || array
            }
        } elseif ($type == 'ONE') {
            $array = $list;
            $array['plan'] = $plan->listOne($list['id_plan']);
            $array['address'] = $address->listFromPeople($list['id']);
            if ($list['type_register'] == 'T') {
                $array['sender'] = $this->listOne($list['id_people']);
                $array['dependents'] = $this->totalPeople('D', $list['id']);
            } elseif ($list['type_register'] == 'D') {
                $array['holder'] = $this->listOne($list['id_people']);
            } elseif ($list['type_register'] == "C") {
                $listHolder = $this->listHoldersByIdPeople($list['id']);
                $array['holders'] = $listHolder;
                $array['holders_total'] =  count($listHolder);
            }
            $array['files'] = $file->listByPeople($list['id']);
            $array['type_register_text'] = $this->typeRegisterHandler($list['type_register']);
            $array['termo_aceito'] = $array['termo'] == 'S' ? 'SIM' : 'NÃO';
            $array['responsavel_financeiro'] = $this->verifyFinancialResponsibleExists($list['id']); // false || array
        }

        return $array;
    }

    private function typeRegisterHandler($type)
    {
        $res = '';
        switch ($type) {
            case 'T':
                $res = 'Titular';
                break;
            case 'D':
                $res = 'Dependente';
                break;
            case 'C':
                $res = 'Vendedor';
                break;
        }
        return $res;
    }
}
