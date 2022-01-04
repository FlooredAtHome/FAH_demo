<?php

namespace App\Controllers;
use App\Models\CustomerModel;
use App\Models\VendorModel;
use App\Models\LoginModel;
use App\Models\CommentModel;


use CodeIgniter\Controller;

class Admin extends Controller
{
    function __construct() 
    {
        $this->loginModel = new LoginModel();
        $this->customerModel = new CustomerModel();
        $this->vendorModel = new VendorModel();
        $this->commentModel = new CommentModel();
        $this->session = session();
    }
    public function index()
    {
        if($this->session->has("email"))
        { 
            $EMAIL = $this->session->get('email');
            $customerdata = $this->customerModel->customerDetails($EMAIL);
            echo view("Admin/admin");
            echo view("Admin/customer", ["customerdata"=>$customerdata]);
        }
        else
        {
            return redirect()->to(base_url('FAH'));
        }
    }
    public function vendor()
    {
        if($this->session->has("email"))
        {
            $EMAIL = $this->session->get('email');
            $vendordata = $this->vendorModel->vendorDetails($EMAIL);
            echo view("Admin/admin");
            echo view("Admin/vendor", ["vendordata"=>$vendordata]);
        }
        else
        {
            return redirect()->to(base_url('FAH'));
        }

    }
    public function updateCustomer()
    {
        if($this->session->has("email"))
        {
            if($this->request->getMethod() == 'post')
            {
                $UID = $this->request->getPost('uid');
                $FIRST_NAME = $this->request->getPost('newfirstname');
                $LAST_NAME = $this->request->getPost('newlastname');
                $EMAIL = $this->request->getPost('newemail');
                $result = $this->customerModel->customerUpdates($UID,$FIRST_NAME,$LAST_NAME,$EMAIL);
                if($result == true)
                {
                    $this->session->setTempdata('successcust','Details updated successfully!',3);
                    return redirect()->to(base_url('FAH/Admin/index'));
                }
                else
                {
                    $this->session->setTempdata('errorcust','Sorry! Try again after some time.',3);
                    return redirect()->to(base_url('FAH/Admin/index'));
                }
            }
            else
            {
                $this->session->setTempdata('errorcust','Sorry! Try again after some time.',3);
                return redirect()->to(base_url('FAH/Admin/index'));
            }
        }
        else
        {
            return redirect()->to(base_url('FAH'));
        }
    }
    public function updateVendor()
    {
        if($this->session->has("email"))
        {
            if($this->request->getMethod() == 'post')
            {
                $UID = $this->request->getPost('uid');
                $FIRST_NAME = $this->request->getPost('newfirstname');
                $LAST_NAME = $this->request->getPost('newlastname');
                $EMAIL = $this->request->getPost('newemail');
                $result = $this->vendorModel->vendorUpdates($UID,$FIRST_NAME,$LAST_NAME,$EMAIL);
                if($result == true)
                {
                    $this->session->setTempdata('successvend','Details updated successfully!',3);
                    return redirect()->to(base_url('FAH/Admin/vendor'));
                }
                else
                {
                    $this->session->setTempdata('errorvend','Sorry! Try again after some time.',3);
                    return redirect()->to(base_url('FAH/Admin/vendor'));
                }
            }
            else
            {
                $this->session->setTempdata('errorvend','Sorry! Try again after some time.',3);
                return redirect()->to(base_url('FAH/Admin/vendor'));
            }
        }
        else
        {
            return redirect()->to(base_url('FAH'));
        }
    }
    public function resetpasswordcustomerLink()
    {
        if($this->session->has("email"))
        {
            if($this->request->getMethod() == 'post')
            {
                $data = [];
                $EMAIL = $this->request->getPost('EMAIL');
                $userdata = $this->loginModel->verifyEmail($EMAIL);
                if(!empty($userdata))
                {
                    if($this->loginModel->updatedAt($userdata['UID']))
                    {
                        $to = $EMAIL;
                        $subject = 'Reset Password Link';
                        $token = $userdata['UID'];
                        $message = 'Hi '.$userdata['FIRST_NAME'].' '.$userdata['LAST_NAME'].'<br><br>'
                                . 'Your reset password request has been  received. Please click'
                                . 'the below link to reset your password.<br><br>'
                                . '<a href="'.base_url('/login/reset_password()').''.$token.'">Click here to reset password</a><br><br>'
                                . 'Thanks<br>Floored At Home';
                        $EMAIL = \Config\Services::email();
                        $EMAIL->setTo($to);
                        $EMAIL->setFrom('maheksavanicoc1@gmail.com','Floored At Home');
                        $EMAIL->setSubject($subject);
                        $EMAIL->setMessage($message);
                        if($EMAIL->send())
                        {
                            session()->setTempdata('successcust','Reset password link sent to registered email.',3);
                            return redirect()->to(base_url('FAH/Admin/index'));
                        }
                    }
                    else
                    {
                        $this->session->setTempdata('errorcust','Unable to update. Please try again',3);
                        return redirect()->to(base_url('FAH/Admin/index'));
                    }
                }
                else
                {
                    $this->session->setTempdata('errorcust','Sorry! Email does not exists',3);
                    return redirect()->to(base_url('FAH/Admin/index'));
                }
            }
            else
            {
                $this->session->setTempdata('errorcust','Sorry! Try again after some time.',3);
                return redirect()->to(base_url('FAH/Admin/index'));
            }
        }
        else
        {
            return redirect()->to(base_url('FAH'));
        }
    }
    public function resetpasswordvendorLink()
    {
        if($this->session->has("email"))
        {
            if($this->request->getMethod() == 'post')
            {
                $data = [];
                $EMAIL = $this->request->getPost('EMAIL');
                $userdata = $this->loginModel->verifyEmail($EMAIL);
                if(!empty($userdata))
                {
                    if($this->loginModel->updatedAt($userdata['UID']))
                    {
                        $to = $EMAIL;
                        $subject = 'Reset Password Link';
                        $token = $userdata['UID'];
                        $message = 'Hi '.$userdata['FIRST_NAME'].' '.$userdata['LAST_NAME'].'<br><br>'
                                . 'Your reset password request has been  received. Please click'
                                . 'the below link to reset your password.<br><br>'
                                . '<a href="'.base_url('/login/reset_password()').''.$token.'">Click here to reset password</a><br><br>'
                                . 'Thanks<br>Floored At Home';
                        $EMAIL = \Config\Services::email();
                        $EMAIL->setTo($to);
                        $EMAIL->setFrom('maheksavanicoc1@gmail.com','Floored At Home');
                        $EMAIL->setSubject($subject);
                        $EMAIL->setMessage($message);
                        if($EMAIL->send())
                        {
                            session()->setTempdata('successvend','Reset password link sent to registered email.',3);
                            return redirect()->to(base_url('FAH/Admin/vendor'));
                        }
                    }
                    else
                    {
                        $this->session->setTempdata('errorvend','Unable to update. Please try again',3);
                        return redirect()->to(base_url('FAH/Admin/vendor'));
                    }
                }
                else
                {
                    $this->session->setTempdata('errorvend','Sorry! Email does not exists',3);
                    return redirect()->to(base_url('FAH/Admin/vendor'));
                }
            }
            else
            {
                $this->session->setTempdata('errorvend','Sorry! Try again after some time.',3);
                return redirect()->to(base_url('FAH/Admin/vendor'));
            }
        }
        else
        {
            return redirect()->to(base_url('FAH'));
        }
    }
    public function customerView()
    {
        if($this->session->has("email"))
        {
            $name=[];
            $time=[];
            $comment=[];
            $EMAIL = $this->session->get('email');
            $userdata = $this->loginModel->verifyEmail($EMAIL);
            $UID = $this->request->getPost('UID');
            $comments = $this->commentModel->getComment($UID);
            for($i=0;$i<count($comments);$i++)
            {
                $name[$i]=$comments[$i]->who;
                $time[$i]=$comments[$i]->when;
                $comment[$i]=$comments[$i]->comment;
            }
            echo view('Admin/customerView',["userid"=>$UID, "name"=>$name, "time"=>$time, "comment"=>$comment]);
        }
        else
        {
            return redirect()->to(base_url('FAH'));
        }
    }
    public function Comment()
    {
        if($this->request->getMethod() == 'post')
        {
            if($this->session->has("email"))
            {
                $EMAIL = $this->session->get('email');
                $userdata = $this->loginModel->verifyEmail($EMAIL);
                $uid=$this->request->getPost('userid');
                $data=null;
                $data = array(
                    'who' => $userdata['FIRST_NAME']." ".$userdata['LAST_NAME'],
                    'when' => date("d-m-Y h:i a"),
                    'comment' => $this->request->getPost('comment'),
                );
                if($data['comment'] == '')
                {
                    $name=[];
                    $time=[];
                    $comment=[];
                    $comments = $this->commentModel->getComment($uid);
                    for($i=0;$i<count($comments);$i++)
                    {
                        $name[$i]=$comments[$i]->who;
                        $time[$i]=$comments[$i]->when;
                        $comment[$i]=$comments[$i]->comment;
                    }
                    $this->session->setTempdata('errorcomment','Sorry! Your comment was not inserted. Please try again.',3);
                    echo view('Admin/customerView', ["userid"=>$uid, "name"=>$name, "time"=>$time, "comment"=>$comment]);
                }
                else
                {
                    $final_array = [];   
                    array_push($final_array,$data);
                    $json_data = json_encode($final_array);
                    $return = $this->commentModel->insert_comment($uid,$json_data,$final_array);
                    $name=[];
                    $time=[];
                    $comment=[];
                    $comments = $this->commentModel->getComment($uid);
                    for($i=0;$i<count($comments);$i++)
                    {
                        $name[$i]=$comments[$i]->who;
                        $time[$i]=$comments[$i]->when;
                        $comment[$i]=$comments[$i]->comment;
                    }
                    if($return == true)
                    {
                        $this->session->setTempdata('successcomment','Your comment is added successfully.',3);
                        echo view('Admin/customerView', ["userid"=>$uid, "name"=>$name, "time"=>$time, "comment"=>$comment]);
                    }
                    else
                    {
                        $this->session->setTempdata('errorcomment','Sorry! Your comment was not inserted. Please try again.',3);
                        return redirect()->to(base_url('FAH/Admin/customerView'));
                    }
                }
            }
        }
        else
        {
            return redirect()->to(base_url('FAH'));
        }
    }
}

?>