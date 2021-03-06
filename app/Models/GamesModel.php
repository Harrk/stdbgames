<?php
  namespace App\Models;
  use CodeIgniter\Model;

  class GamesModel extends Model{
    public function getGameBySlug($slug){
      $db = \Config\Database::connect();
      $builder = $db->table('games')
                    ->where('slug', $slug);
      return $builder->get()->getRowArray();
    }
    public function getGameByName($name){
      $db = \Config\Database::connect();
      $builder = $db->table('games')
                    ->where('name', $name);
      return $builder->get()->getRowArray();
    }
    public function getGameById($id){
      $db = \Config\Database::connect();
      $builder = $db->table('games')
                    ->where('id', $id);
      return $builder->get()->getRowArray();
    }
    public function gameOverview($slug){
      $db = \Config\Database::connect();
      $builder = $db->table('games')
                    ->select('games.id,
                              games.name,
                              games.slug,
                              games.release,
                              games.about,
                              games.pro,
                              games.pro_from,
                              games.pro_till,
                              games.image,
                              games.genre,
                              games.sku,
                              games.appid,
                              games.price,
                              games.first_on_stadia,
                              games.stadia_exclusive,
                              games.early_access,
                              games.updated_at,
                              games.rumor,
                              games.crowd_choice,
                              games.cross_progression,
                              games.cross_play,
                              games.stream_connect,
                              games.crowd_play,
                              games.state_share,
                              games.is_pxc,
                              games.fps,
                              games.hdr_sdr,
                              games.max_resolution,
                              games.is_f2p,
                              developers.name AS developer_name,
                              developers.slug AS developer_slug,
                              publishers.name AS publisher_name,
                              publishers.slug AS publisher_slug')
                    ->join('developers', 'developers.id = games.developer_id')
                    ->join('publishers', 'publishers.id = games.publisher_id')
                    ->where('games.slug', $slug);
      return $builder->get()->getRowArray();
    }
    public function getProGames(){
      $db = \Config\Database::connect();
      $builder = $db->table('games')
                    ->select('games.name,
                              games.slug,
                              games.image,
                              games.release,
                              games.pro_till,
                              developers.name AS developer_name,
                              developers.slug AS developer_slug,
                              publishers.name AS publisher_name,
                              publishers.slug AS publisher_slug')
                    ->join('developers', 'developers.id = games.developer_id')
                    ->join('publishers', 'publishers.id = games.publisher_id')
                    ->where('games.pro', 1)
                    ->where('games.release !=', '2099-01-01')
                    ->where('games.pro_from <=', date('Y-m-d'))
                    ->orderBy('games.pro_from', 'ASC');
      return $builder->get()->getResultArray();
    }
    public function getSoonGames(){
      $db = \Config\Database::connect();
      $builder = $db->table('games')
                    ->select('games.name,
                              games.slug,
                              games.image,
                              games.release,
                              games.rumor,
                              developers.name AS developer_name,
                              publishers.name AS publisher_name')
                    ->join('developers', 'developers.id = games.developer_id')
                    ->join('publishers', 'publishers.id = games.publisher_id')
                    ->where('strftime("%Y-%m", release) >', date('Y-m'))
                    ->orderBy('release', 'ASC');
      return $builder->get(12)->getResultArray();
    }
    public function getLastsGames(){
      $db = \Config\Database::connect();
      $builder = $db->table('games')
                    ->select('games.name,
                              games.slug,
                              games.image,
                              games.release,
                              games.rumor,
                              games.created_at,
                              developers.name AS developer_name,
                              publishers.name AS publisher_name')
                    ->join('developers', 'developers.id = games.developer_id')
                    ->join('publishers', 'publishers.id = games.publisher_id')
                    ->orderBy('games.created_at', 'DESC');
      return $builder->get(4)->getResultArray();
    }
    public function getLastsUpdatedGames(){
      $db = \Config\Database::connect();
      $builder = $db->table('games')
                    ->select('games.name,
                              games.slug,
                              games.image,
                              games.release,
                              games.rumor,
                              games.updated_at,
                              developers.name AS developer_name,
                              publishers.name AS publisher_name')
                    ->join('developers', 'developers.id = games.developer_id')
                    ->join('publishers', 'publishers.id = games.publisher_id')
                    ->orderBy('games.updated_at', 'DESC');
      return $builder->get(4)->getResultArray();
    }
    public function getMonthRelease(){
      $db = \Config\Database::connect();
      $builder = $db->table('games')
                    ->select('games.name,
                              games.slug,
                              games.image,
                              games.release,
                              developers.name AS developer_name,
                              developers.slug AS developer_slug,
                              publishers.name AS publisher_name,
                              publishers.slug AS publisher_slug')
                    ->join('developers', 'developers.id = games.developer_id')
                    ->join('publishers', 'publishers.id = games.publisher_id')
                    ->where('strftime("%Y-%m", release)', date('Y-m'))
                    ->orderBy('games.release', 'ASC');
      return $builder->get()->getResultArray();
    }
    public function listAllGames($type){
      $db = \Config\Database::connect();
      if($type == 'soon'){
        $builder = $db->table('games')
                      ->select('games.name,
                                games.slug,
                                games.image,
                                games.release,
                                games.rumor,
                                developers.name AS developer_name,
                                publishers.name AS publisher_name')
                      ->join('developers', 'developers.id = games.developer_id')
                      ->join('publishers', 'publishers.id = games.publisher_id')
                      ->where('games.release >', date('Y-m-d'))
                      ->orderBy('games.release', 'ASC');
      } elseif($type == 'launched'){
        $builder = $db->table('games')
                      ->select('games.name,
                                games.slug,
                                games.image,
                                games.release,
                                games.rumor,
                                developers.name AS developer_name,
                                publishers.name AS publisher_name')
                      ->join('developers', 'developers.id = games.developer_id')
                      ->join('publishers', 'publishers.id = games.publisher_id')
                      ->where('games.release <=', date('Y-m-d'))
                      ->orderBy('games.release', 'DESC');
      } elseif($type == 'firstonstadia'){
        $builder = $db->table('games')
                      ->select('games.name,
                                games.slug,
                                games.image,
                                games.release,
                                games.rumor,
                                developers.name AS developer_name,
                                publishers.name AS publisher_name')
                      ->join('developers', 'developers.id = games.developer_id')
                      ->join('publishers', 'publishers.id = games.publisher_id')
                      ->where('games.first_on_stadia', 1)
                      ->orderBy('games.release', 'ASC');
      } elseif($type == 'stadiaexclusive'){
        $builder = $db->table('games')
                      ->select('games.name,
                                games.slug,
                                games.image,
                                games.release,
                                games.rumor,
                                developers.name AS developer_name,
                                publishers.name AS publisher_name')
                      ->join('developers', 'developers.id = games.developer_id')
                      ->join('publishers', 'publishers.id = games.publisher_id')
                      ->where('games.stadia_exclusive', 1)
                      ->orderBy('games.release', 'ASC');
      } elseif($type == 'earlyaccess'){
        $builder = $db->table('games')
                      ->select('games.name,
                                games.slug,
                                games.image,
                                games.release,
                                games.rumor,
                                developers.name AS developer_name,
                                publishers.name AS publisher_name')
                      ->join('developers', 'developers.id = games.developer_id')
                      ->join('publishers', 'publishers.id = games.publisher_id')
                      ->where('games.early_access', 1)
                      ->orderBy('games.release', 'ASC');
      } elseif($type == 'pro'){
        $builder = $db->table('games')
                      ->select('games.name,
                                games.slug,
                                games.image,
                                games.release,
                                games.pro_from,
                                games.rumor,
                                developers.name AS developer_name,
                                publishers.name AS publisher_name')
                      ->join('developers', 'developers.id = games.developer_id')
                      ->join('publishers', 'publishers.id = games.publisher_id')
                      ->where('games.pro_from !=', '')
                      ->where('games.pro_from <=', date('Y-m-d'))
                      ->orderBy('games.pro_from', 'ASC');
      } elseif($type == 'rumors'){
        $builder = $db->table('games')
                      ->select('games.name,
                                games.slug,
                                games.image,
                                games.release,
                                games.rumor,
                                developers.name AS developer_name,
                                publishers.name AS publisher_name')
                      ->join('developers', 'developers.id = games.developer_id')
                      ->join('publishers', 'publishers.id = games.publisher_id')
                      ->where('games.rumor', 1);
      } elseif($type == 'crossplay'){
        $builder = $db->table('games')
                      ->select('games.name,
                                games.slug,
                                games.image,
                                games.release,
                                games.rumor,
                                developers.name AS developer_name,
                                publishers.name AS publisher_name')
                      ->join('developers', 'developers.id = games.developer_id')
                      ->join('publishers', 'publishers.id = games.publisher_id')
                      ->where('games.cross_play', 1)
                      ->orderBy('games.release', 'ASC');
      } elseif($type == 'crowdchoice'){
        $builder = $db->table('games')
                      ->select('games.name,
                                games.slug,
                                games.image,
                                games.release,
                                games.rumor,
                                developers.name AS developer_name,
                                publishers.name AS publisher_name')
                      ->join('developers', 'developers.id = games.developer_id')
                      ->join('publishers', 'publishers.id = games.publisher_id')
                      ->where('games.crowd_choice', 1)
                      ->orderBy('games.release', 'ASC');
      } elseif($type == 'crowdplay'){
        $builder = $db->table('games')
                      ->select('games.name,
                                games.slug,
                                games.image,
                                games.release,
                                games.rumor,
                                developers.name AS developer_name,
                                publishers.name AS publisher_name')
                      ->join('developers', 'developers.id = games.developer_id')
                      ->join('publishers', 'publishers.id = games.publisher_id')
                      ->where('games.crowd_play', 1)
                      ->orderBy('games.release', 'ASC');
      } elseif($type == 'streamconnect'){
        $builder = $db->table('games')
                      ->select('games.name,
                                games.slug,
                                games.image,
                                games.release,
                                games.rumor,
                                developers.name AS developer_name,
                                publishers.name AS publisher_name')
                      ->join('developers', 'developers.id = games.developer_id')
                      ->join('publishers', 'publishers.id = games.publisher_id')
                      ->where('games.stream_connect', 1)
                      ->orderBy('games.release', 'ASC');
      } elseif($type == 'crossprogression'){
        $builder = $db->table('games')
                      ->select('games.name,
                                games.slug,
                                games.image,
                                games.release,
                                games.rumor,
                                developers.name AS developer_name,
                                publishers.name AS publisher_name')
                      ->join('developers', 'developers.id = games.developer_id')
                      ->join('publishers', 'publishers.id = games.publisher_id')
                      ->where('games.cross_progression', 1)
                      ->orderBy('games.release', 'ASC');
      } elseif($type == 'stateshare'){
        $builder = $db->table('games')
                      ->select('games.name,
                                games.slug,
                                games.image,
                                games.release,
                                games.rumor,
                                developers.name AS developer_name,
                                publishers.name AS publisher_name')
                      ->join('developers', 'developers.id = games.developer_id')
                      ->join('publishers', 'publishers.id = games.publisher_id')
                      ->where('games.state_share', 1)
                      ->orderBy('games.release', 'ASC');
      } elseif($type == 'f2p'){
        $builder = $db->table('games')
                      ->select('games.name,
                                games.slug,
                                games.image,
                                games.release,
                                games.rumor,
                                developers.name AS developer_name,
                                publishers.name AS publisher_name')
                      ->join('developers', 'developers.id = games.developer_id')
                      ->join('publishers', 'publishers.id = games.publisher_id')
                      ->where('games.is_f2p', 1)
                      ->orderBy('games.release', 'ASC');
      } else {
        $builder = $db->table('games')
                      ->select('games.name,
                                games.slug,
                                games.image,
                                games.release,
                                games.rumor,
                                developers.name AS developer_name,
                                publishers.name AS publisher_name')
                      ->join('developers', 'developers.id = games.developer_id')
                      ->join('publishers', 'publishers.id = games.publisher_id')
                      ->orderBy('games.release', 'ASC');
      }
      return $builder->get()->getResultArray();
    }
    public function createGameDb($data){
      $db = \Config\Database::connect();
      $builder = $db->table('games');
      return $builder->insert($data);
    }
    public function updateGameDb($data){
      $db = \Config\Database::connect();
      $builder = $db->table('games')
                    ->where('id', $data['id']);
      return $builder->update($data);
    }
    public function releaseByDate($id, $date){
      $db = \Config\Database::connect();
      $builder = $db->table('games')
                    ->where('id !=', $id)
                    ->where('release !=', 'TBA')
                    ->where('release !=', '2099-01-01')
                    ->where('release', $date)
                    ->orderBy('Name', 'ASC');
      return $builder->get()->getResultArray();
    }
    public function getAllGames(){
      $db = \Config\Database::connect();
      $builder = $db->table('games')
                    ->select('id,
                              name')
                    ->orderBy('name', 'ASC');
      return $builder->get()->getResultArray();
    }
    public function deleteGame($id){
      $db = \Config\Database::connect();
      $builder = $db->table('games')
                    ->where('id', $id);
      return $builder->delete();
    }
  }
?>
