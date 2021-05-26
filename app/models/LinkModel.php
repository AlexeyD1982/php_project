<?php
require_once 'DB.php';

class LinkModel
{
    private $fullLink;
    private $cutLink;

    private $_db = null;

    public function __construct()
    {
        $this->_db = DB::getInstance();
    }

    public function setData($fullLink, $cutLink)
    {
        $this->fullLink = $fullLink;
        $this->cutLink = $cutLink;
    }
//
    public function isCutLinkBusy($cutLink)
    {
        $user = $_COOKIE['login'];
        $result = $this->_db->query("SELECT * FROM `links` WHERE `userEmail` = '$user' AND `cutLink` = '$cutLink'");
        $link = $result->fetch(PDO::FETCH_ASSOC);
        if ($link['cutLink'] == '') {
            return false;
        }
        return true;
    }

    public function validForm()
    {
        if (strlen($this->cutLink) === 0) {
            return "Вы не ввели сокращение";
        } elseif (strlen($this->fullLink) === 0) {
            return 'Вы не ввели ссылку';
        } elseif ($this->isCutLinkBusy($this->cutLink)) {
            return 'Такое сокращение уже используется в базе';
        }

        return 'Верно';
    }
//
    public function addLink()
    {
        $sql = 'INSERT INTO links (fullLink, cutLink, userEmail) VALUES (:fullLink, :cutLink, :userEmail)';
        $query = $this->_db->prepare($sql);
        $query->execute(['fullLink' => $this->fullLink, 'cutLink' => $this->cutLink, 'userEmail' => $_COOKIE['login']]);
    }

    public function getAllUsersLinks($userEmail)
    {
        $result = $this->_db->query("SELECT * FROM `links` WHERE `userEmail` = '$userEmail' ORDER BY `id` ASC");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUsersLink($userEmail, $cutLink)
    {
        $result = $this->_db->query("SELECT * FROM `links` WHERE `userEmail` = '$userEmail' AND `cutLink` = '$cutLink'");
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function removeLink($linkId)
    {
        $sql = "DELETE FROM `links` WHERE `id` = :linkId";
        $query = $this->_db->prepare($sql);
        $query->execute(['linkId' => $linkId]);
    }
}