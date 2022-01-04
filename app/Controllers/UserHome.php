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
            $name=[];
            $time=[];
            $comment=[];
            $EMAIL = $this->session->get('email');
            $userdata = $this->loginModel->verifyEmail($EMAIL);
            $UID = $userdata['UID'];
            $comments = $this->commentModel->getComment($UID);
            for($i=0;$i<count($comments);$i++)
            {
                $name[$i]=$comments[$i]->who;
                $time[$i]=$comments[$i]->when;
                $comment[$i]=$comments[$i]->comment;
            }
            echo view("home/user_home", ["name"=>$name, "time"=>$time, "comment"=>$comment]);
        }
        else{
            return redirect()->to(base_url('FAH'));
        }
    }
    public function comment()
    {
        $EMAIL = $this->session->get('email');
        $userdata = $this->loginModel->verifyEmail($EMAIL);
        $UID = $userdata['UID'];
        $data = array(
            'who' => $userdata['FIRST_NAME']." ".$userdata['LAST_NAME'],
            'when' => date("d-m-Y h:i a"),
            'comment' => $this->request->getPost('comment'),
        );
        $final_array = [];   
        array_push($final_array,$data);
        $json_data = json_encode($final_array);
        
        $return = $this->commentModel->insert_comment($UID,$json_data,$final_array);
        if($return == true)
        {
            $this->session->setTempdata('successcomment','Your comment is added successfully.',3);
            return redirect()->to(base_url('FAH/UserHome/user_home'));
        }
        else
        {
            $this->session->setTempdata('errorcomment','Sorry! Your comment was not inserted. Please try again.',3);
            return redirect()->to(base_url('FAH/UserHome/user_home'));
        }
    }
}
?>