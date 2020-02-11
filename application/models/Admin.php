<?php

namespace application\models;

use application\core\Model;
use http\Params;
use PDO;

class Admin extends Model
{

    public function getBanners()
    {
        return $this->db->row('SELECT * FROM banners order by pos ASC ');
    }

    public function bannerAdd($title, $image, $link, $status, $position)
    {

        $params = [
            'title' => $title,
            'image' => $image,
            'link' => $link,
            'status' => $status,
            'pos' => $position,

        ];
        $this->db->query(
            'INSERT INTO banners VALUES (NULL ,:title, :image,:link,:status,:pos, current_timestamp ,current_timestamp )',
            $params
        );
    }

    public function bannerUpd($id, $title, $image, $link, $status, $position)
    {
        $params = [
            'id' => $id,
            'title' => $title,
            'image' => $image,
            'link' => $link,
            'status' => $status,
            'pos' => $position,
        ];
        $this->db->query(
            'UPDATE banners SET id = :id,name = :title,img = :image,link = :link,status = :status,pos =:pos, updated_at = current_timestamp WHERE id = :id',
            $params
        );
    }

    public function bannerDelete($id)
    {
        $params = [
            'id' => $id,
        ];
        $this->db->query('DELETE FROM banners WHERE id = :id', $params);
    }

    public function getItembyId($id)
    {
        $params = [
            'id' => $id,
        ];

        return $this->db->row('SELECT * FROM banners WHERE id = :id', $params);
    }

    public function uploadImage($image)
    {

        if (isset($_FILES['image']) && !empty($_FILES['image'])) {
            $image = strtolower($_FILES['image']['name']);
            $fileTmpName = $_FILES['image']['tmp_name'];
            $fi = finfo_open(FILEINFO_MIME_TYPE);
            $mime = (string)finfo_file($fi, $fileTmpName);
            if (strpos($mime, 'image') === false) {
                die('Only Image');
            }
            $name = $image; //name image
            $tmp_name = $_FILES['image']['tmp_name']; // get tmp name
            move_uploaded_file($tmp_name, ROOT . UPLOAD_IMG . $name);
            $new_path =  UPLOAD_IMG . $name;//запись пути в базу
            return $new_path;
        }
        return false;
    }

}