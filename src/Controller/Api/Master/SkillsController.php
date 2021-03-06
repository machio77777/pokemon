<?php
namespace App\Controller\Api\Master;

use App\Controller\Api\ApiController;
use App\Model\Master\SkillsModel;

/**
 * SkillsController
 */
class SkillsController extends ApiController
{
    /**
     * 技一覧取得
     * @return JSONレスポンス
     */
    public function getList()
    {
        $skills = $this->createSkillsModel()->getList($this->request->getQuery('typeId'));
        if ($skills === false) {
            return $this->response503();
        }
        return $this->response200($skills);
    }
    
    /**
     * 技取得
     * @param  string $skillId 技ID
     * @return JSONレスポンス
     */
    public function get($skillId)
    {
        $skill = $this->createSkillsModel()->get($skillId);
        if ($skill === false) {
            return $this->response503();
        }
        return $this->response200($skill);
    }

    /**
     * 技に紐づくポケモン一覧取得
     * @param  string $skillId 技ID
     * @return JSONレスポンス
     */
    public function getPokemons($skillId)
    {
        $pokemons = $this->createSkillsModel()->getPokemons($skillId);
        if ($pokemons === false) {
            return $this->response503();
        }
        return $this->response200($pokemons);
    }
    
    /**
     * SkillsModel生成
     * @return SkillsModel
     */
    private function createSkillsModel()
    {
        return new SkillsModel($this->logger);
    }
    
}
