<?php
class N_PlanHandler extends model
{

    private $table = 'n_plans';

    public function list($t = 'ALL')
    {

        /**
         * @param $t
         * ALL - Tudo
         * ACTIVE - Só os planos ativos
         * INACTIVE - Só os planos inativos
         */

        $array = [];

        $sql = "SELECT * FROM {$this->table} ";
        $sqlExtend = '';
        if ($t == 'ACTIVE') {
            $sqlExtend = "WHERE active = 'Y' ";
        } elseif ($t == 'INACTIVE') {
            $sqlExtend = "WHERE active = 'I' ";
        } else {
            $sqlExtend = " ";
        }

        $sql .= $sqlExtend . "ORDER BY product ASC";

        $sql = $this->db->prepare($sql);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $list = $sql->fetchAll(PDO::FETCH_ASSOC);
            $array = $this->listHandler('ALL', $list);
        }
        return $array;
    }

    public function listOne($id)
    {
        $array = [];
        if ($id > 0) {
            $sql = "SELECT * FROM {$this->table} WHERE id = :id";
            $sql = $this->db->prepare($sql);
            $sql->execute([
                ':id' => $id
            ]);
            if ($sql->rowCount() > 0) {
                $list = $sql->fetch(PDO::FETCH_ASSOC);
                $array = $this->listHandler('ONE', $list);
            }
        }

        return $array;
    }

    public function listHandler($type, $list)
    {
        /**
         * @param $type
         * 'ALL' => Lista toda
         * 'ONE' => Somente uma
         */
        $array = [];

        if ($type == 'ALL') {
            foreach ($list as $k => $v) {
                $array[$k] = $list[$k];
                $array[$k]['price_real'] = 'R$ ' . Moeda::converterParaBr($list[$k]['price']);
                $array[$k]['price_real_number'] = Moeda::converterParaBr($list[$k]['price']);
                $array[$k]['active_text'] = $list[$k]['active'] == 'Y' ? 'Ativo' : 'Inativo';
                $array[$k]['url'] = BASE_API_FILE . $list[$k]['image'];
                $array[$k]['cover'] = !empty($array[$k]['cover']) ? BASE_API_FILE . $list[$k]['cover'] : '';
                $array[$k]['total_people'] = $this->totalPeopleInPlan($list[$k]['id']);
            }
        } elseif ($type == 'ONE') {
            $array = $list;
            $array['price_real'] = 'R$ ' . Moeda::converterParaBr($list['price']);
            $array['price_real_number'] = Moeda::converterParaBr($list['price']);
            $array['active_text'] = $list['active'] == 'Y' ? 'Ativo' : 'Inativo';
            $array['url'] = BASE_API_FILE . $list['image'];
            $array['cover'] = !empty($array['cover']) ? BASE_API_FILE . $list['cover'] : '';
            $array['total_people'] = $this->totalPeopleInPlan($list['id']);
        }

        return $array;
    }

    private function totalPeopleInPlan($id)
    {
        /**
         * Retornar total de pessoas cadastradas no plano
         */
        $sql = "SELECT COUNT(*) as t FROM n_people WHERE id_plan = :id";
        $sql = $this->db->prepare($sql);
        $sql->execute([
            'id' => $id
        ]);
        $item = $sql->fetch();
        return $item['t'];
    }

    public function insert(N_Plan $plan)
    {
        /**
         * @param $plan->getImage() - Recebe um arquivo em array
         * --- Resposta possível do file quando updalod tiver sucesso ---
         * 
         * $array = [
         *           'message' => 'Arquivos enviado!',
         *          'fileName' => $newName,
         *           'error' => 0
         *      ]
         *
         * --- Resposta quando o arquivo não enviado ---
         * $array = [
         *           'message' => 'Arquivo não enviado',
         *           'error' => 1
         *       ];
         */

        // Pega um array com informações de nome do arquivo ou mensagem de erro quando houver erro
        $fileUpload = $this->uploadFile($plan->getImage());
        $fileUploadCover = $this->uploadFile($plan->getCover());

        if ($fileUpload['error'] == 0) {

            $fileName = $fileUpload['fileName'];
            $fileNameCover = NULL;
            if($fileUploadCover['error'] == 0) {
                $fileNameCover = $fileUploadCover['fileName'];
            }
            

            $sql = "INSERT INTO {$this->table} (product, price, `image`, `text`,`accredited_network`, `cover`, `due_day`, `effective_day`, `cutting_day`) 
            VALUES (:product, :price, :image, :text,:accredited_network, :cover, :due_day, :effective_day, :cutting_day)";
            $sql = $this->db->prepare($sql);
            $sql->execute([
                'product' => $plan->getProduct(),
                'price' => $plan->getPrice(),
                'image' => $fileName,
                'text' => $plan->getText(),
                'accredited_network' => $plan->getAccreditedNetwork(),
                'cover' => $fileNameCover,
                'due_day' => $plan->getDueDay(),
                'effective_day' => $plan->getEffectiveDay(),
                'cutting_day' => $plan->getCuttingDay()
            ]);
        }
    }

    public function update(N_Plan $plan, $id)
    {
        /**
         * @param $plan->getImage() - Recebe um arquivo em array
         * --- Resposta possível do file quando updalod tiver sucesso ---
         * $array = [
         *           'message' => 'Arquivos enviado!',
         *          'fileName' => $newName,
         *           'error' => 0
         *      ]
         *
         * --- Resposta quando o arquivo não enviado ---
         * $array = [
         *           'message' => 'Arquivo não enviado',
         *           'error' => 1
         *       ];
         */

        // Verifica se existe Imagem cadastra e se foi enviada pelo usuário
        $fileName = '';
        $sql = "SELECT `image` FROM {$this->table} WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->execute(['id' => $id]);
        if ($sql->rowCount() > 0) {
            $item = $sql->fetch();
            $fileName = $item['image'];
        }
        if (!empty($plan->getImage())) {
            $fileUpload = $this->uploadFile($plan->getImage());
            if ($fileUpload['error'] == 0) {
                $this->deleFileFromPlan($id);
                $fileName = $fileUpload['fileName'];
            }
        }

        // Verifica se o pdf foi enviado
        $fileNameCover = '';
        $sql = "SELECT `cover` FROM {$this->table} WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->execute(['id' => $id]);
        if ($sql->rowCount() > 0) {
            $item = $sql->fetch();
            $fileNameCover = $item['cover'];
        }
        if (!empty($plan->getCover())) {
            $fileCoverUpload = $this->uploadFile($plan->getCover());
            if ($fileCoverUpload['error'] == 0) {
                $this->deleFileCoverFromPlan($id);
                $fileNameCover = $fileCoverUpload['fileName'];
            }
        }

        $sql = "UPDATE {$this->table} 
        SET product = :product, price = :price, `image` = :image, `text` = :text, accredited_network = :accredited_network, cover = :cover, `due_day` = :due_day, `effective_day` = :effective_day, `cutting_day` = :cutting_day WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->execute([
            'product' => $plan->getProduct(),
            'price' => $plan->getPrice(),
            'image' => $fileName,
            'text' => $plan->getText(),
            'accredited_network' => $plan->getAccreditedNetwork(),
            'cover' => $fileNameCover,
            'due_day' => $plan->getDueDay(),
            'effective_day' => $plan->getEffectiveDay(),
            'cutting_day' => $plan->getCuttingDay(),
            'id' => $id
        ]);
    }

    public function active($id)
    {
        /**
         * @param $id
         * - Recebe o id do plan
         * Se estive ativo torna inativo, caso contrário torna ativo
         */
        $sql = "SELECT active FROM {$this->table} WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->execute(['id' => $id]);
        if ($sql->rowCount() > 0) {
            $item = $sql->fetch();

            $res = $item['active'] == 'Y' ? 'N' : 'Y';

            $sql = "UPDATE {$this->table} SET active = :active WHERE id = :id";
            $sql = $this->db->prepare($sql);
            $sql->execute([
                'active' => $res,
                'id' => $id
            ]);
        }
    }

    public function delete($id)
    {
        $totalPeople = $this->totalPeopleInPlan($id);

        if ($totalPeople == 0) {

            $this->deleFileFromPlan($id);
            $this->deleFileCoverFromPlan($id);
            $sql = "DELETE FROM {$this->table} WHERE id = :id";
            $sql = $this->db->prepare($sql);
            $sql->execute(['id' => $id]);
        }
    }

    private function deleFileFromPlan($id)
    {
        $sql = "SELECT `image` FROM {$this->table} WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->execute(['id' => $id]);
        if ($sql->rowCount() > 0) {
            $item = $sql->fetch();
            $file = BASE_API_UPDLOAD_FILE . $item['image'];
            if (file_exists($file)) {
                unlink($file);
            }
        }
    }

    private function deleFileCoverFromPlan($id)
    {
        $sql = "SELECT `cover` FROM {$this->table} WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->execute(['id' => $id]);
        if ($sql->rowCount() > 0) {
            $item = $sql->fetch();
            $file = BASE_API_UPDLOAD_FILE . $item['cover'];
            if (file_exists($file)) {
                unlink($file);
            }
        }
    }

    private function uploadFile($file)
    {
        /**
         * @param $file
         * - Recebe o arquivo como array vindo de formulário
         */

        $array = ['error' => 0];

        $name = $file['name'];
        $tmp_name = $file['tmp_name'];
        $size = $file['size'];
        $error = $file['error'];

        // Novo nome para o arquivo
        $arrayName = explode('.', $name);
        $ext = end($arrayName);
        $cript = md5(rand(0, 1000) . time());
        $newName = $cript . '.' . $ext;

        if ($error == 0) {
            if (move_uploaded_file($tmp_name, BASE_API_UPDLOAD_FILE . $newName)) {
                $array = [
                    'message' => 'Arquivos enviado!',
                    'fileName' => $newName,
                    'error' => 0
                ];
            } else {
                $array = [
                    'message' => 'Arquivo não enviado',
                    'error' => 1
                ];
            }
        } else {
            $array = [
                'message' => 'Há algum erro no arquivo.',
                'error' => 1
            ];
        }

        return $array;
    }
}
