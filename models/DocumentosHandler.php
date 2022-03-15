<?php
class DocumentosHandler extends model implements iDocumentos
{
    public function insert(Documentos $doc)
    {
        $sql = "INSERT INTO documentos (id_cliente, id_arquivo, nome, data, tipo) VALUES (:id_cliente, :id_arquivo, :nome, :data, :tipo)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_cliente', $doc->getIdCliente());
        $sql->bindValue(':id_arquivo', $doc->getIdArquivo());
        $sql->bindValue(':nome', $doc->getNome());
        $sql->bindValue(':tipo', $doc->getTipo());
        $sql->bindValue(':data', date('Y-m-d H:i:s'));
        $sql->execute();
    }
    public function getByIdCliente($id_cliente)
    {
        $array = [];
        $sql = "SELECT * FROM documentos WHERE id_cliente = :id_cliente ORDER BY tipo ASC";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_cliente', $id_cliente);
        $sql->execute();
        if($sql->rowCount()>0)
        {
            $list = $sql->fetchAll();
            foreach($list as $item)
            {
                $newDoc = new Documentos();
                $arquivos = new Arquivos();
                $newDoc->setId($item['id']);
                $newDoc->setIdCliente($item['id_cliente']);
                $newDoc->setIdArquivo($item['id_arquivo']);
                $newDoc->setNome($item['nome']);
                $newDoc->setData($item['data']);
                $newDoc->setTipo($item['tipo']);
                $newDoc->setArquivo($arquivos->getArquivoById($item['id_arquivo']));
                $array[] = $newDoc;
            }
            
        }
        return $array;
    }
    public function getById($id)
    {
        $array = [];
        $sql = "SELECT * FROM documentos WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql->execute();
        if($sql->rowCount()>0)
        {
            $item = $sql->fetch();
            $newDoc = new Documentos();
            $arquivos = new Arquivos();
            $newDoc->setId($item['id']);
            $newDoc->setIdCliente($item['id_cliente']);
            $newDoc->setIdArquivo($item['id_arquivo']);
            $newDoc->setNome($item['nome']);
            $newDoc->setData($item['data']);
            $newDoc->setTipo($item['tipo']);
            $newDoc->setArquivo($arquivos->getArquivoById($item['id_arquivo']));
            $array = $newDoc;  
        }
        return $array;
    }
    public function delById($id)
    {
        $sql = "DELETE FROM documentos WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql->execute();
    }
    public function delByIdCliente($id_cliente)
    {
        $sql = "DELETE FROM documentos WHERE id_cliente = :id_cliente";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_cliente', $id_cliente);
        $sql->execute();
    }

    public function getNomeDoc($tipo)
    {
        switch($tipo)
        {
            case 1:
                return ucwords('Documento de Identificação (Frente)');
            break;
            case 2:
                return ucwords('Documento de Idenficação (Verso)');
            break;
            case 3:
                return ucwords('Carteirinha SUS (Verso)');
            break;
            case 4:
                return ucwords('Comprovante de Residência');
            break;
            default;
                return ucwords('Documento de Identificação');
        }
    }
}

interface iDocumentos
{
    public function insert(Documentos $doc);
    public function getByIdCliente($id_cliente);
    public function getById($id);
    public function delById($id);
    public function delByIdCliente($id_cliente);
}