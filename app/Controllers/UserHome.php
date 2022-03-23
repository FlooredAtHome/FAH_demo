<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\LoginModel;
use App\Models\ProjectModel;
use App\Models\CommentModel;
use App\Models\TimingModel;
use CodeIgniter\I18n\Time;

class UserHome extends Controller
{
    public $loginModel;
    
    public function __construct() {
        $this->timingModel = new TimingModel();
        helper('form');
        $this->loginModel = new LoginModel();
        $this->projectModel = new ProjectModel();
        $this->commentModel = new CommentModel();
        $this->session = session();
    }
    public function proptime(){
        $EMAIL=$this->session->get('email');
        $userdata = $this->loginModel->verifyEmail($EMAIL);
        $uid=$userdata['UID'];
        $model = new TimingModel();
        $this->timingModel->timeclick($uid);
        exit;
    }
    public function JSONhandler(){
        $temp1_1 = file_get_contents('php://input',true);
        $temp1 = json_decode($temp1_1,true);
        $EMAIL= $temp1[0]["email"];
        $proptime = $temp1[0]["proptime"];
        $clicked = $temp1[0]["clicked"];
        $userdata = $this->loginModel->verifyEmail($EMAIL);
        $uid=$userdata['UID'];
        $this->timingModel->timeclick($uid,$EMAIL,$proptime,$clicked);
        exit;
    }
    public function verify()
    {
        $data = [];
        if($this->request->getMethod() == 'post')
        {
            $rules = [
                'EMAIL' => 'required|valid_email',
                'PASSWORD' => 'required',
            ];
            if($this->validate($rules))
            {
                $EMAIL = $this->request->getPost('EMAIL');
                $PASSWORD = $this->request->getPost('PASSWORD');
                $userdata = $this->loginModel->verifyEmail($EMAIL);
                if($userdata)
                {
                    if($PASSWORD == $userdata['PASSWORD'])
                    {
                        $log_time = time();
                        $newdata = [
                            'email'  =>  $EMAIL,
                            'logged_in_time' => $log_time,
                        ];
                        
                        if($userdata['RID'] == '3')
                        {
                            $this->session->set($newdata);
                            if($this->session->get('email')!=''){
                                $EMAIL = $this->session->get('email');
                                $userdata = $this->loginModel->verifyEmail($EMAIL);
                                $data['email'] = $this->session->get('email');
                                $data['logged_in_time']= $this->session->get('logged_in_time');
                                $email=$data['email'];
                                $UID = $userdata['UID'];
                                $logged_in_time=$data['logged_in_time'];
                                $result = $this->timingModel->timeclick($UID,$email,$logged_in_time,$clicked='login');
                                return redirect()->to(base_url('FAH/UserHome/user_home'));
                            }
                        }
                        else if($userdata['RID'] == '2')
                        {
                            echo "Welcome Vendor";
                        }
                        else if($userdata['RID'] == '1')
                        {
                            //$this->session->destroy();
                            echo $log_time;
                            $this->session->set($newdata);
                            if($this->session->get('email')!='')
                            {
                                return redirect()->to(base_url('FAH/Admin/index'));
                            }
                        }
                     
                    }
                    else
                    {
                        $this->session->setTempdata('error','Sorry! Wrong password entered for that email',3);
                        return redirect()->to(base_url('FAH'));
                    }
                }
                else
                {
                    $this->session->setTempdata('error','Sorry! Email does not exists',3);
                    return redirect()->to(base_url('FAH'));
                }
            }
            else
            {
                $data['validation'] = $this->validator;
            }
        }        
    }
    public function getRecordById($module,$pid,$token)
    {
        $headers = array('Authorization: Zoho-oauthtoken '.$token);
	    $ch = curl_init('https://www.zohoapis.com/crm/v2/'.$module.'/'.$pid);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	    curl_setopt($ch, CURLOPT_VERBOSE, 1);//standard i/o streams
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);// Turn off the server and peer verification
    	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//Set to return data to string ($response)
    	$response = curl_exec($ch);
    // 	error_log($response);
    	curl_close($ch);
    	$json_for_get_record = json_decode($response, true);
        $record_data = $json_for_get_record["data"][0] ;
    	return $record_data;
            
    }

    public function searchRecords($module,$criteria,$token)
    {

        //print_r($criteria);
        $headers = array('Authorization: Zoho-oauthtoken '.$token);
        $ch = curl_init('https://www.zohoapis.com/crm/v2/'.$module.'/search?criteria='.urlencode($criteria));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);//standard i/o streams
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);// Turn off the server and peer verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//Set to return data to string ($response)
        $response = curl_exec($ch);
        curl_close($ch);
        $json_for_search_response = json_decode($response, true);

	return $json_for_search_response;
    }
    public function user_home()
    {
        if($this->session->get('email')!=''){
            $EMAIL = $this->session->get('email');
            $userdata = $this->loginModel->verifyEmail($EMAIL);
            $data['email'] = $this->session->get('email');
            $data['logged_in_time']= $this->session->get('logged_in_time');
            $email=$data['email'];
            $UID = $userdata['UID'];
            $projectdata = $this->projectModel->projectDetails($UID);
            $ZC_PO_ID = $projectdata['ZC_PO_ID'];
            $pid = $userdata['PID'];
            $model = new CommentModel();
            $comments = $model->get_comments($pid);
            $token = file_get_contents("https://fahbacksym.com/FAH/get_token.php?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9");
            $po_data = $this->getRecordById("Deals",$ZC_PO_ID,$token);
            $mp_images = $this->searchRecords("Magicplan_Images","((Potential:equals:".$ZC_PO_ID.")and(Type:equals:Outside Picture))",$token) ;
            $proposals = $this->searchRecords("Quotes","(Deal_Name:equals:".$ZC_PO_ID.")",$token);
            $proposal = [];
            $url = [];
            foreach($proposals['data'] as $proposal)
            {
                if($proposal['Ready_To_Send']!=NULL)
                {
                    $url[$proposal['id']] = $proposal['PandaDoc_PDF'];
                }
            }
            if(count($mp_images) > 0 )
            {
                if(strlen($mp_images["data"][0]["Image_URL"])>0)
                {
                    $mp_image_url = $mp_images["data"][0]["Image_URL"];
                }
            }
            $email = $po_data["Owner"]["email"];
			$mname = $po_data["Owner"]["name"];
            echo view("home/user_home", ["pid"=>$pid, "comments"=>$comments,"po_data"=>$po_data,"mp_image_url"=>$mp_image_url,"email"=>$email,"name"=>$mname,"urls"=>$url]);
        }
        else{
            return redirect()->to(base_url('FAH'));
        }
    }
    public function add_comment() 
    {
		if('post' === $this->request->getMethod() && $this->request->getPost('comment_text')) 
        {
            $EMAIL = $this->session->get('email');
            $userdata = $this->loginModel->verifyEmail($EMAIL);
            $pid = $this->request->getPost('content_id');
            $parent_id = $this->request->getPost('reply_id');
            $comment_text = $this->request->getPost('comment_text');
            $data = array(
                'comment_text' => $comment_text,
                'commenter' => $userdata['FIRST_NAME']." ".$userdata['LAST_NAME'],
                'parent_id' => $parent_id,
                'comment_date' => date('Y-m-d h:i:sa'),
                'pid' => $pid
            );
			
			$model = new CommentModel();
            $resp = $model->add_comment($data);
			
			var_dump($resp);
            if ($resp != NULL) 
            {
                foreach ($resp as $row) 
                {
                   // $date = mysql_to_php_date($row->comment_date);
                    echo "<li id=\"li_comment_{$row->comment_id}\">" .
                    "<div><span class=\"commenter\">{$commenter}</span></div>".
                    "<div><span class=\"comment_date\">{$row->comment_date}</span></div>" .
                    "<div style=\"margin-top:4px;\">{$row->comment_text}</div>" .
                    "<a href=\"#\" class=\"reply_button\" id=\"{$row->comment_id}\">reply</a>" .
                    "</li>";
                }
            } else {
                echo 'Error in adding comment';
            }
        } else {
            echo 'Error: Please enter your comment';
        }
    }
}
?>