<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class APIModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'UID';
    protected $allowedFields = ['FIRST_NAME','LAST_NAME','RID','EMAIL'];

    public function insertId($email,$zcpoid)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT UID FROM users WHERE EMAIL='$email';";
        $result = $this->db->query($sql);
        $result = $result->getRowArray();
        $uid = $result['UID'];
        $insertQuery = "INSERT INTO projects (UID,ZC_PO_ID) VALUES ('$uid','$zcpoid');";
        $status = $this->db->query($insertQuery);
    }
}