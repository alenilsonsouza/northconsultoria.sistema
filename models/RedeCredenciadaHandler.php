<?php
class RedeCredenciadaHandler extends model implements iRedeCredenciada
{
    public function insert(RedeCredenciada $rede)
    {
        $sql = "INSERT INTO rede_credenciada (nome, cidade, desconto, telefone, logo) VALUES (:nome, :cidade, :desconto, :telefone, :logo)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':nome', $rede->getNome());
        $sql->bindValue(':cidade', $rede->getCidade());
        $sql->bindValue(':desconto', $rede->getDesconto());
        $sql->bindValue(':telefone', $rede->getTelefone());
        $sql->bindValue(':logo', $rede->getLogo());
        $sql->execute();

    }
    public function update(RedeCredenciada $rede)
    {
        $sql = "UPDATE rede_credenciada SET nome = :nome, cidade = :cidade, desconto = :desconto, telefone = :telefone, logo = :logo WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':nome', $rede->getNome());
        $sql->bindValue(':cidade', $rede->getCidade());
        $sql->bindValue(':desconto', $rede->getDesconto());
        $sql->bindValue(':telefone', $rede->getTelefone());
        $sql->bindValue(':logo', $rede->getLogo());
        $sql->bindValue(':id', $rede->getId());
        $sql->execute();
    }
    public function getList($offset, $limit)
    {
        $array = [];
        $sql = "SELECT * FROM rede_credenciada ORDER BY destaque DESC LIMIT $offset, $limit";
        $sql = $this->db->query($sql);
        if($sql->rowCount()>0)
        {
            $list = $sql->fetchAll();
            foreach($list as $item)
            {
                $newRede = new RedeCredenciada();
                $arquivos = new Arquivos();
                $newRede->setId($item['id']);
                $newRede->setNome($item['nome']);
                $newRede->setCidade($item['cidade']);
                $newRede->setDesconto($item['desconto']);
                $newRede->setTelefone($item['telefone']);
                $newRede->setLogo($item['logo']);
                $newRede->setDestaque($item['destaque']);
                $newRede->setArquivo($arquivos->getArquivoById($item['logo']));
                $array[] = $newRede;
            }
        }
        return $array;
    }
    public function getTotal()
    {
        $sql = "SELECT COUNT(*) as t FROM rede_credenciada";
        $sql = $this->db->query($sql);
        $sql = $sql->fetch();
        return $sql['t'];
    }
    public function getById($id)
    {
        $array = [];
        $sql = "SELECT * FROM rede_credenciada WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql->execute();
        if($sql->rowCount()>0)
        {
            $item = $sql->fetch();
            $newRede = new RedeCredenciada();
            $arquivos = new Arquivos();
            $newRede->setId($item['id']);
            $newRede->setNome($item['nome']);
            $newRede->setCidade($item['cidade']);
            $newRede->setDesconto($item['desconto']);
            $newRede->setTelefone($item['telefone']);
            $newRede->setLogo($item['logo']);
            $newRede->setDestaque($item['destaque']);
            $newRede->setArquivo($arquivos->getArquivoById($item['logo']));
            $array = $newRede;
        }
        return $array;
    }
    public function getRedeByDestaque()
    {
        $array = [];
        $sql = "SELECT * FROM rede_credenciada WHERE destaque = 1";
        $sql = $this->db->query($sql);
        if($sql->rowCount()>0)
        {
            $list = $sql->fetchAll();
            foreach($list as $item)
            {
                $newRede = new RedeCredenciada();
                $arquivos = new Arquivos();
                $newRede->setId($item['id']);
                $newRede->setNome($item['nome']);
                $newRede->setCidade($item['cidade']);
                $newRede->setDesconto($item['desconto']);
                $newRede->setTelefone($item['telefone']);
                $newRede->setLogo($item['logo']);
                $newRede->setDestaque($item['destaque']);
                $newRede->setArquivo($arquivos->getArquivoById($item['logo']));
                $array[] = $newRede;
            }
        }
        return $array;
    }
    public function del($id)
    {
        $sql = "DELETE FROM rede_credenciada WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();
    }
    public function search($pesquisa)
    {
        $array = [];
        $sql = "SELECT * FROM rede_credenciada WHERE cidade LIKE :pesquisa";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':pesquisa', '%'.$pesquisa.'%');
        $sql->execute();
        if($sql->rowCount()>0)
        {
            $list = $sql->fetchAll();
            foreach($list as $item)
            {
                $newRede = new RedeCredenciada();
                $arquivos = new Arquivos();
                $newRede->setId($item['id']);
                $newRede->setNome($item['nome']);
                $newRede->setCidade($item['cidade']);
                $newRede->setDesconto($item['desconto']);
                $newRede->setTelefone($item['telefone']);
                $newRede->setLogo($item['logo']);
                $newRede->setDestaque($item['destaque']);
                $newRede->setArquivo($arquivos->getArquivoById($item['logo']));
                $array[] = $newRede;
            }
        }
        return $array;
    }

    public function updateDestaque($status , $id)
    {
        $sql = "UPDATE rede_credenciada SET destaque = :destaque WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':destaque', $status);
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    public function getListAll() {
        $array = [];
        $sql = "SELECT * FROM rede_credenciada ORDER BY cidade ASC";
        $sql = $this->db->query($sql);
        if($sql->rowCount()>0) {
            $list = $sql->fetchAll(PDO::FETCH_ASSOC);
            $arquivo = new Arquivos();
            foreach($list as $k => $v) {
                $array[$k] = $list[$k]; 
                $arq = $arquivo->getArquivoById($v['logo']);
                if(isset($arq['id'])){
                    $array[$k]['arquivo'] = BASE_URL.'assets/arquivos/'.$arq['url_arquivo'];
                }
            }
        }
        return $array;
    }
}

interface iRedeCredenciada
{
    
    public function insert(RedeCredenciada $rede);
    public function update(RedeCredenciada $rede);
    public function getList($offset, $limit);
    public function getTotal();
    public function getById($id);
    public function del($id);
    public function search($pesquisa);
    public function updateDestaque($status , $id);
}