<?php
class N_File extends model
{

    private $table = 'n_files';

    public function insert($file, $id_people, $typeDoc)
    {

        /**
         * @param $file
         * - Recebe o arquivo com o array
         * @param $id_people
         * - Recebeo id_people
         * @param $typeDoc
         * - Recebe o tipo de documento:
         * [RG,CPF,CR]         
         */


        $name = $file['name'];
        $type = $file['type'];
        $tmp_name = $file['tmp_name'];
        $size = $file['size'];
        $error = $file['error'];

        if ($error == 0) {
            // Sem erro na imagem

            // Verificar a extensão da imagem
            if ($this->verifyImageTypeHandeler($name)) {

                $newName = $this->getNewName($name);

                if (move_uploaded_file($tmp_name, BASE_API_UPDLOAD_FILE . $newName)) {
                    $sql = "INSERT INTO {$this->table} (id_people, `name`, `type`, date_register) VALUES (:id_people, :name, :type, :date_register)";
                    $sql = $this->db->prepare($sql);
                    $sql->execute([
                        'id_people' => $id_people,
                        'name' => $newName,
                        'type' => $typeDoc,
                        'date_register' => date('Y-m-d')
                    ]);

                    if($typeDoc == 'CO') {
                        $people = new N_PeopleHandler();
                        $people->aceitoTermo($id_people);
                    }
                }
            }
        } else {
            // Caso tenha erro na imagem
        }
    }

    public function listByPeople($id_people)
    {
        $array = [];
        $sql = "SELECT * FROM {$this->table} WHERE id_people = :id_people";
        $sql = $this->db->prepare($sql);
        $sql->execute([
            ':id_people' => $id_people
        ]);
        if ($sql->rowCount() > 0) {
            $list = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach ($list as $k => $v) {

                // Pegar a extensão
                $imArray = explode('.', $list[$k]['name']);
                $ext = end($imArray);

                $array[$k] = $list[$k];
                $array[$k]['url'] = BASE_API_FILE . $list[$k]['name'];
                $array[$k]['type'] = $this->typeHandler($list[$k]['type']);
                $array[$k]['type_image'] = $ext;
            }
        }
        return $array;
    }

    public function delete($id)
    {

        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->execute(['id' => $id]);
        if ($sql->rowCount() > 0) {
            $item = $sql->fetch();
            $url = BASE_API_UPDLOAD_FILE . $item['name'];
            if (file_exists($url)) {
                unlink($url);
                $sql = "DELETE FROM {$this->table} WHERE id = :id";
                $sql = $this->db->prepare($sql);
                $sql->execute(['id' => $id]);
            }
        }
    }

    public function deleteByIdPeople($id_people)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id_people = :id";
        $sql = $this->db->prepare($sql);
        $sql->execute(['id' => $id_people]);
        if ($sql->rowCount() > 0) {
            $list = $sql->fetchAll();
            foreach ($list as $item) {
                $url = BASE_API_UPDLOAD_FILE . $item['name'];
                if (file_exists($url)) {
                    unlink($url);
                    $sql = "DELETE FROM {$this->table} WHERE id = :id";
                    $sql = $this->db->prepare($sql);
                    $sql->execute(['id' => $item['id']]);
                }
            }
        }
    }

    public function typeHandler($type)
    {
        $res = '';
        switch ($type) {
            case 'RG':
                $res = 'Carteira de Identidade (RG)';
                break;
            case 'CPF':
                $res = 'Cadastro de Pessoa Física (CPF)';
                break;
            case 'CR':
                $res = 'Comprovante de Residência';
                break;
            case 'CO':
                $res = 'Contrato (PDF)';
                break;
            default:
                $res = 'Documento';
        }

        return $res;
    }

    public function listType()
    {

        return [
            ['type' => 'RG', 'type_text' => $this->typeHandler('RG')],
            ['type' => 'CPF', 'type_text' => $this->typeHandler('CPF')],
            ['type' => 'CR', 'type_text' => $this->typeHandler('CR')],
            ['type' => 'CO', 'type_text' => $this->typeHandler('CO')]
        ];
    }

    private function verifyImageTypeHandeler($name): bool
    {
        /**
         * @param $name
         * - recebe o nome da imagem com a extensão
         */

        // Extensões aceitas para updaload
        $type = ['jpg', 'png', 'gif', 'jpeg', 'pdf'];

        // Pega apenas a extensão da image
        $array = explode('.', $name);
        $ext = end($array);

        return (in_array($ext, $type)) ? true : false;
    }

    private function getNewName($name)
    {

        $array = explode('.', $name);
        $ext = end($array);

        $cript = md5(rand(0, 100) . time());

        $newName = $cript . '.' . $ext;
        return $newName;
    }
}
