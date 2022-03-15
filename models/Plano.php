<?php
class Plano extends model
{

    private $id;
    private $id_logo;
    private $nome;
    private $subtitulo;
    private $valor;
    private $comissao;
    private $tipo_comissao;
    private $tipo = 'P';


    public function setIdLogo($id)
    {
        $this->id_logo = $id;
    }
    public function setNome($nome)
    {
        $this->nome = trim($nome);
    }
    public function setSubtitulo($valor)
    {
        $this->subtitulo = trim($valor);
    }
    public function setValor($valor)
    {
        $this->valor = trim($valor);
    }
    public function setTipo($tipo)
    {
        $this->tipo = strtoupper($tipo);
    }
    public function setComissao($valor)
    {
        $this->comissao = $valor;
    }
    public function setTipoComissao($tipo = 'P')
    {
        $this->tipo_comissao = $tipo;
    }


    public function salvar()
    {
        $sql = "INSERT INTO plano (id_logo, nome, subtitulo, valor, tipo, comissao, tipo_comissao) VALUES (:id_logo, :nome, :subtitulo, :valor, :tipo, :comissao, :tipo_comissao)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_logo', $this->id_logo);
        $sql->bindValue(':nome', $this->nome);
        $sql->bindValue(':subtitulo', $this->subtitulo);
        $sql->bindValue(':valor', $this->valor);
        $sql->bindValue(':tipo', $this->tipo);
        $sql->bindValue(':comissao', $this->comissao);
        $sql->bindValue(':tipo_comissao', $this->tipo_comissao);
        $sql->execute();
    }

    public function getPlano()
    {
        $array = array();
        $sql = "SELECT * FROM plano WHERE tipo = 'P' ORDER BY habilitado DESC, nome ASC";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            $list = $sql->fetchAll();
            $array = $this->montarListaMultipla($list);
        }
        return $array;
    }


    public function getPlanoPrimario()
    {
        $array = array();
        $sql = "SELECT * FROM plano WHERE tipo = 'P' AND habilitado = 1 ORDER BY habilitado DESC, nome ASC";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            $list = $sql->fetchAll();
            $array = $this->montarListaMultipla($list);
        }
        return $array;
    }

    public function getSomaPlanoSecundario()
    {
        $sql = "SELECT SUM(valor) as total FROM plano WHERE tipo = 'S'";
        $sql = $this->db->query($sql);
        $sql = $sql->fetch();
        return $sql['total'];
    }

    public function getPlanoSecundario()
    {
        $array = array();
        $sql = "SELECT * FROM plano WHERE tipo = 'S'";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            $item = $sql->fetch();
            $array = $this->montarListaUnica($item);
        }
        return $array;
    }

    public function getPlanoById($id)
    {
        $array = array();
        $sql = "SELECT * FROM plano WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $item = $sql->fetch();
            $array = $this->montarListaUnica($item);
        }
        return $array;
    }

    public function updateStatus($id)
    {
        $item = $this->getPlanoById($id);
        $status = 0;

        if (isset($item['habilitado'])) {
            if ($item['habilitado'] == 1) {
                $status = 0;
            } else {
                $status = 1;
            }
        }

        $sql = "UPDATE plano SET habilitado = :status WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":status", $status);
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function update($id)
    {
        $sql = "UPDATE plano SET id_logo = :id_logo, nome = :nome, subtitulo = :subtitulo, valor = :valor, comissao = :comissao, tipo_comissao = :tipo_comissao WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_logo", $this->id_logo);
        $sql->bindValue(":nome", $this->nome);
        $sql->bindValue(":subtitulo", $this->subtitulo);
        $sql->bindValue(":valor", $this->valor);
        $sql->bindValue(":comissao", $this->comissao);
        $sql->bindValue(":tipo_comissao", $this->tipo_comissao);
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    public function getTotal()
    {
        $sql = "SELECT COUNT(*) AS t FROM plano";
        $sql = $this->db->query($sql);
        $sql = $sql->fetch();
        return $sql['t'];
    }

    private function montarListaMultipla($list)
    {
        $array = [];
        foreach ($list as $key => $item) {
            $arquivos = new Arquivos();
            $planoB = new PlanoBeneficiosHandler();
            $array[] = $item;
            $array[$key]['arquivo'] = $arquivos->getArquivoById($item['id_logo']);
            $array[$key]['beneficios'] = $planoB->pegarPorIdPlano($item['id']);
        }

        return $array;
    }

    private function montarListaUnica($item)
    {
        $arquivos  = new Arquivos();
        $planoB = new PlanoBeneficiosHandler();
        $array = $item;
        $array['arquivo'] = $arquivos->getArquivoById($item['id_logo']);
        $array['beneficios'] = $planoB->pegarPorIdPlano($item['id']);
        return $array;
    }
}
