<?php namespace App\Models;
use CodeIgniter\Model;

class GamesModel extends Model
{
  public function getGame($slug)
  {
    $db = \Config\Database::connect();
    $builder = $db->table('games')
                  ->select('games.Gameid AS gId,
                            games.Name AS gName,
                            games.Slug AS gSlug,
                            Image AS gImage,
                            games.Developerid AS gdId,
                            games.Publisherid AS gpId,
                            games.About AS gAbout,
                            Release AS gRelease,
                            Pro AS gPro,
                            Profrom AS gProfrom,
                            Protill AS gProtill,
                            developers.Name AS gdName,
                            developers.Slug AS gdSlug,
                            publishers.Name AS gpName,
                            publishers.Slug AS gpSlug')
                  ->join('developers', 'games.Developerid = developers.Developerid')
                  ->join('publishers', 'games.Publisherid = publishers.Publisherid')
                  ->where('gSlug', $slug);
    return $builder->get()
                   ->getRowArray();
  }

  public function getDevelopers(){
    $db = \Config\Database::connect();
    $builder = $db->table('developers')
                  ->select('Developerid AS dId,
                            Name AS dName')
                  ->orderBy('Name', 'ASC');
    return $builder->get()
                   ->getResultArray();
  }

  public function getPublishers(){
    $db = \Config\Database::connect();
    $builder = $db->table('publishers')
                  ->select('Publisherid AS pId,
                            Name AS pName')
                  ->orderBy('pName', 'ASC');
    return $builder->get()
                   ->getResultArray();
  }

  public function insertDeveloper($data)
  {
    $db = \Config\Database::connect();
    $builder = $db->table('developers');
    return $builder->insert($data);
  }

  public function insertPublisher($data)
  {
    $db = \Config\Database::connect();
    $builder = $db->table('publishers');
    return $builder->insert($data);
  }

  public function insertGame($data)
  {
    $db = \Config\Database::connect();
    $builder = $db->table('games');
    return $builder->insert($data);
  }

  public function updateGame($data)
  {
    $db = \Config\Database::connect();
    $builder = $db->table('games')
                  ->where('Gameid', $data['Gameid']);
    return $builder->update($data);
  }

  public function developerOverview($slug)
  {
    $db = \Config\Database::connect();
    $builder = $db->table('developers')
                  ->select('developers.Developerid AS dId,
                            developers.Name AS dName,
                            developers.Website AS dWebsite,
                            developers.Slug AS dSlug,
                            games.Name AS dgName,
                            games.Image AS dgImage,
                            games.Slug AS dgSlug,
                            games.Release AS dgRelease,
                            publishers.Name AS dpName,
                            publishers.Website AS dpWebsite,
                            publishers.Slug AS dpSlug')
                  ->join('games', 'developers.Developerid = games.Developerid')
                  ->join('publishers', 'games.Publisherid = publishers.Publisherid')
                  ->where('dSlug', $slug);
    return $builder->get()
                   ->getResultArray();
  }

  public function publisherOverview($slug)
  {
    $db = \Config\Database::connect();
    $builder = $db->table('publishers')
                  ->select('publishers.Publisherid AS pId,
                            publishers.Name AS pName,
                            publishers.Website AS pWebsite,
                            publishers.Slug AS pSlug,
                            games.Name AS pgName,
                            games.Image AS pgImage,
                            games.Slug AS pgSlug,
                            games.Release AS pgRelease,
                            developers.Name AS pdName,
                            developers.Slug AS pdSlug')
                  ->join('games', 'publishers.Publisherid = games.Publisherid')
                  ->join('developers', 'games.Developerid = developers.Developerid')
                  ->where('pSlug', $slug);
    return $builder->get()
                   ->getResultArray();
  }
  public function getDeveloper($slug)
  {
    $db = \Config\Database::connect();
    $builder = $db->table('developers')
                  ->select('Developerid AS dId,
                            Name AS dName,
                            Slug AS dSlug,
                            Website AS dWebsite,
                            About AS dAbout')
                  ->where('dSlug', $slug);
    return $builder->get()
                   ->getRowArray();
  }

  public function updateDeveloper($data)
  {
    $db = \Config\Database::connect();
    $builder = $db->table('developers')
                  ->where('Developerid', $data['Developerid']);

    return $builder->update($data);
  }

  public function getPublisher($slug)
  {
    $db = \Config\Database::connect();
    $builder = $db->table('publishers')
                  ->select('Publisherid AS pId,
                            Name AS pName,
                            Website AS pWebsite,
                            Slug AS pSlug')
                  ->where('pSlug', $slug);
    return $builder->get()
                   ->getRowArray();
  }

  public function updatePublisher($data)
  {
    $db = \Config\Database::connect();
    $builder = $db->table('publishers')
                  ->where('Publisherid', $data['Publisherid']);
    return $builder->update($data);
  }

  public function getGames($type){
    $db = \Config\Database::connect();
    if ($type == 'soon'){
      $builder = $db->table('games')
                    ->select('Gameid AS gId,
                              games.Name AS gName,
                              games.Slug AS gSlug,
                              games.Image AS gImage,
                              games.Developerid AS gdId,
                              games.Publisherid AS gpId,
                              Release AS gRelease,
                              games.About AS gAbout,
                              developers.Name AS gdName,
                              developers.Slug AS gdSlug,
                              publishers.Name AS gpName,
                              publishers.Slug AS gpSlug')
                    ->join('developers', 'developers.Developerid = games.Developerid')
                    ->join('publishers', 'publishers.Publisherid = games.Publisherid')
                    ->where('gRelease >', date('Y-m-d'))
                    ->orderBy('gRelease', 'ASC');
      return $builder->get()
                     ->getResultArray();
    } if ($type == 'launched') {
      $builder = $db->table('games')
                    ->select('Gameid AS gId,
                              games.Name AS gName,
                              games.Slug AS gSlug,
                              games.Image AS gImage,
                              games.Developerid AS gdId,
                              games.Publisherid AS gpId,
                              Release AS gRelease,
                              games.About AS gAbout,
                              developers.Name AS gdName,
                              developers.Slug AS gdSlug,
                              publishers.Name AS gpName,
                              publishers.Slug AS gpSlug')
                    ->join('developers', 'games.Developerid = developers.Developerid')
                    ->join('publishers', 'games.Publisherid = publishers.Publisherid')
                    ->where('gRelease <=', date('Y-m-d'))
                    ->orderBy('gRelease', 'DESC');
      return $builder->get()
                     ->getResultArray();
    }
  }

	public function getGamesVotedBy($gameid){
		$db = \Config\Database::connect();
		$builder = $db->table('votes')
                                ->select('Gameid AS vgId,
                                                users.Image AS vuImage')
                                ->join('users', 'users.Userid = votes.Userid')
											->where('vgId', $gameid);
		return $builder->get()
											 ->getResultArray();
	}

  public function getGamesInLibraries($gameid){
    $db = \Config\Database::connect();
    $builder = $db->table('libraries')
                                ->select('Gameid AS vgId,
                                    users.Image AS vuImage')
                                ->join('users', 'users.Userid = libraries.Userid')
                                ->where('vgId', $gameid);
    return $builder->get()
                              ->getResultArray();
  }

  public function getGamesWished($gameid){
    $db = \Config\Database::connect();
    $builder = $db->table('wishes')
                                ->select('Gameid AS vgId,
                                    users.Image AS vuImage')
                                ->join('users', 'users.Userid = wishes.Userid')
                                ->where('vgId', $gameid);
    return $builder->get()
                              ->getResultArray();
  }

  public function getTotalScore($gameid){
    $db = \Config\Database::connect();
    $builder = $db->table('votes')
                              ->selectAVG('Score')
                              ->where('Gameid', $gameid);
    return $builder->get()
                              ->getRowArray();
  }

  public function countGames(){
    $db = \Config\Database::connect();
    $builder = $db->table('games');
    return $builder->get()->getResultArray();
  }

  public function countGamesLaunched(){
    $db = \Config\Database::connect();
    $builder = $db->table('games')
                              ->where('Release <=', date('Y-m-d'));
    return $builder->get()->getResultArray();
  }

  public function countGamesComing(){
    $db = \Config\Database::connect();
    $builder = $db->table('games')
                              ->where('Release >=', date('Y-m-d'));
    return $builder->get()->getResultArray();
  }
}
?>
