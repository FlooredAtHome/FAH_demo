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
    public function insertVendor()
    {
        if($this->session->has("email"))
        {
            if($this->request->getMethod() == 'post')
            {
                $FIRST_NAME = $this->request->getPost('firstname');
                $LAST_NAME = $this->request->getPost('lastname');
                $EMAIL = $this->request->getPost('email');
                $RID = '2';
                $result = $this->vendorModel->insertVendor($FIRST_NAME,$LAST_NAME,$EMAIL,$RID);
                if($result == true)
                {
                    $this->session->setTempdata('successvend','Vendor inserted successfully!',3);
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
            $EMAIL = $this->session->get('email');
            $userdata = $this->loginModel->verifyEmail($EMAIL);
            $UID = intval($_GET['id']);
            $details = $this->loginModel->getDetails($UID);
            $pid = $details['PID'];
            $model = new CommentModel();
            $comments = $model->get_comments($pid);
            echo view('Admin/customerView',["pid"=>$pid, "comments"=>$comments]);
        }
        else
        {
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