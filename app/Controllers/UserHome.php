<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\LoginModel;
use App\Models\CommentModel;
use CodeIgniter\I18n\Time;

class UserHome extends Controller
{
    public $loginModel;
    
    public function __construct() {
        helper('form');
        $this->loginModel = new LoginModel();
        $this->commentModel = new CommentModel();
        $this->session = session();
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
                        $log_time = new Time('now');
                        $newdata = [
                            'email'  =>  $EMAIL,
                            'logged_in_time' => $log_time,
                        ];
                        
                        if($userdata['RID'] == '3')
                        {
                            echo $log_time;
                            $this->session->set($newdata);
                            if($this->session->get('email')!=''){
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

    public function user_home(){
        if($this->session->get('email')!=''){
            echo view("templates/header");

            // $pin="68137";
            // $date=array();
            // $maxtemp=array();
            // $mintemp=array();
            // $atum=array();
    
            // $content = file_get_contents("http://dataservice.accuweather.com/locations/v1/postalcodes/search?apikey=LdP2tFj700FeHm9aX2rEnAnioatQhF8l&q=".$pin."");
            // $result  = json_decode($content);
            // $locationid = $result[0]->Key;
    
            // $data = file_get_contents("http://dataservice.accuweather.com/forecasts/v1/daily/5day/location=".$locationid."?apikey=LdP2tFj700FeHm9aX2rEnAnioatQhF8l&details=true&metric=true");
            // $wdata  = json_decode($data);
            
            // $currentdate=date('D,M d 20y', strtotime($wdata->DailyForecasts[0]->Date));
            // $currenttemp=$wdata->DailyForecasts[0]->RealFeelTemperature->Maximum->Value;
            // $feeltemp=$wdata->DailyForecasts[0]->RealFeelTemperatureShade->Maximum->Value;
            // $wind=$wdata->DailyForecasts[0]->Day->Wind->Speed->Value;
            // $cweather=$wdata->DailyForecasts[0]->Day->IconPhrase;
            // $atum0=$wdata->DailyForecasts[0]->Day->IconPhrase;
            // $atum[0]="../public/assets/images/".$atum0.".png";
            
            // for($i=1;$i<5;$i++)
            // {
            //     $date[$i]=date('D,M d', strtotime($wdata->DailyForecasts[$i]->Date));
            //     $maxtemp[$i]=$wdata->DailyForecasts[$i]->Temperature->Maximum->Value;
            //     $mintemp[$i]=$wdata->DailyForecasts[$i]->Temperature->Minimum->Value;
            //     $iphrase=$wdata->DailyForecasts[$i]->Day->IconPhrase;
            //     $atmostype=preg_replace('/[^a-zA-Z ]/', '', $iphrase);
            //     $atum[$i]="../public/assets/images/".$atmostype.".png";
            // }
            // , ["currentdate"=>$currentdate, "currenttemp"=>$currenttemp, "feeltemp"=>$feeltemp, "wind"=>$wind, "cweather"=>$cweather, "date"=>$date, "maxtemp"=>$maxtemp, "mintemp"=>$mintemp, "atum"=>$atum ]
            $EMAIL = $this->session->get('email');
            $userdata = $this->loginModel->verifyEmail($EMAIL);
            $UID = $userdata['UID'];
            $pid = $userdata['PID'];
            $model = new CommentModel();
            $comments = $model->get_comments($pid);
            echo view("home/user_home", ["pid"=>$pid, "comments"=>$comments]);
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
            
            
			
			helper("custom");
			
            if ($resp != NULL) 
            {
                foreach ($resp as $row) 
                {
                    $date = mysql_to_php_date($row->comment_date);
                    echo "<li id=\"li_comment_{$row->comment_id}\">" .
                    "<div><span class=\"commenter\">{$commenter}</span></div>".
                    "<div><span class=\"comment_date\">{$date}</span></div>" .
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