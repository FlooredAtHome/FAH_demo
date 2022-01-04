<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table      = 'projects';
    protected $primaryKey = 'PID';
    protected $allowedFields = ['UID','PID','COMMENTS'];
    
    public function insert_comment($UID,$json_data,$final_array)
    {
        $db = \Config\Database::connect();
        $alruser = "SELECT * FROM projects WHERE UID='$UID';";
        $rcount = $this->db->query($alruser);
        $rcount = $rcount->getRowArray();
        if($rcount === NULL)
        {
            $sql = "INSERT INTO projects (UID,COMMENTS) VALUES ('$UID','$json_data');";
            $results = $this->db->query($sql);
            if($results == false)
            {
                return false;
            }
            else
            {
                return true;
            }
        }
        else
        {
            $oldcomq = "SELECT COMMENTS FROM projects WHERE UID='$UID';";
            $oldcoma = $this->db->query($oldcomq);
            $oldcoma = $oldcoma->getRowArray();
            $old_comms = json_decode($oldcoma["COMMENTS"]);
            if($old_comms != NULL)
            {
                $newcom = array_merge($old_comms, $final_array);
                $newcom = json_encode($newcom);
                $newsql = "UPDATE projects SET COMMENTS='$newcom' WHERE UID='$UID';";
                $nresults = $this->db->query($newsql);
                if($nresults == false)
                {
                    return false;
                }
                else
                {
                    return true;
                }
            }
            else
            {
                $newcom = json_encode($final_array);
                $newsql = "UPDATE projects SET COMMENTS='$newcom' WHERE UID='$UID';";
                $nresults = $this->db->query($newsql);
                if($nresults == false)
                {
                    return false;
                }
                else
                {
                    return true;
                }
            }
        }
    }
    public function getComment($UID)
    {
        $db = \Config\Database::connect();
        $comments = "SELECT COMMENTS FROM projects WHERE UID='$UID';";
        $results = $this->db->query($comments);  
        if(count($results->getResultArray()) > 0)
        {
            $results = $results->getRowArray();
            if($results['COMMENTS'] != NULL)
            {
                $results = json_decode($results['COMMENTS']);
                return $results;
        
            }
            else
            {
                $results = [];
                return $results;
            }
        }
        else
        {
            $results = $results->getResultArray();
            return $results;            
        }
    }

}

?>
