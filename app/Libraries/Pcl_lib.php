<?php
namespace App\Libraries;
class Pcl_lib
{
   public $system_email 					= "phoenixlangaman05@gmail.com";
   public $system_email_name 				= "Hoteleers";


   public $signup_subject 					= "Welcome to Hoteleers! Verify your email";
   public $job_interview_subject 			= "Job Interview Schedule ";

   public $notification_employer_subject 	= "Welcome to Hoteleers! Let’s get you started";
   public $change_password_subject 			= "Change your Hoteleers password";
   public $forgot_password_subject 			= "Reset your Hoteleers password";
   public $change_email_subject 			= "Change your Hoteleers email";
   public $invitation_apply_subject 		= "You’ve been invited to apply";

   public $admin_email 						= "admin@hoteleers.com";
   
   public $gmail_redirect 					= 'https://mail.google.com/mail/u/0/?fs=1&to=admin@hoteleers.com&su=Report login&tf=cm';


   public function change_email_template($param){
        $html 	= '';
        $br 	= '<br/>';
        $html 	.= 'Hi '.$param["name"].',';
        $html 	.= $br.$br;
        $html 	.= 'To process your change email request please enter the below code!';
        $html 	.= $br.$br;
        $html 	.= $param["verification_code"];
        $html 	.= $br.$br;
   		$html 	.= 'With you on your journey,';
   		$html 	.= $br.$br;
   		$html 	.= 'Hoteleers Team';
   		$html 	.= $br;
   		$html 	.= $this->admin_email;

        return $html;
   }//end

   public function signup_email_template($param){
   		$br 	= '<br/>';
   		$html 	= '';
   		$html 	.= 'Hi there,';
   		$html 	.= $br.$br;
   		$html 	.= 'You’re almost ready to start enjoying Hoteleers!';
   		$html 	.= $br.$br;
   		$html 	.= 'Click the big blue button below to verify your email address.';
   		$html 	.= $br.$br;
   		$html 	.= '<a href="'.$param["url"].'">Verify Email</a>';
   		$html 	.= $br.$br;
   		$html 	.= 'Once logged in:';
   		$html 	.= $br;
   		$html 	.= '<ul>';
   			$html 	.= '<li>You can set your job preferences so we can recommend job posts for you</li>';
   			$html 	.= '<li>Update your profile with job descriptions so employers get to know you better</li>';
   		$html 	.= '</ul>';
   		$html 	.= $br.$br;
   		$html 	.= 'Great stuff begins with the first step!';
   		$html 	.= $br.$br;
   		$html 	.= 'To your success,';
   		$html 	.= $br.$br;
   		$html 	.= 'Hoteleers Team';
   		$html 	.= $br;
   		$html 	.= $this->admin_email;

   		return $html;
   }//end function


   public function job_interview_template($param){
   		$br 	= '<br/>';
   		$html 	= '';
   		$html 	.= 'Good day '.$param['name'].',';
   		$html 	.= $br.$br;
   		$html 	.= 'You have an interview scheduled with '.$param['company_name'].' with details below:';
   		$html 	.= $br.$br;

   		//content
   		$html 	.= '<table>';
   			$html 	.= '<tr>';
   				$html 	.= '<td><b>Interview Date</b></td>';
   				$html 	.= '<td>'.$param['interview_date'].'</td>';
   			$html 	.= '</tr>';
   			$html 	.= '<tr>';
   				$html 	.= '<td><b>Start Time</b></td>';
   				$html 	.= '<td>'.$param['start_time'].' - '.$param['end_time'].'</td>';
   			$html 	.= '</tr>';
   			$html 	.= '<tr>';
   				$html 	.= '<td><b>Applicant Name</b></td>';
   				$html 	.= '<td>'.$param['applicant_name'].'</td>';
   			$html 	.= '</tr>';
   			$html 	.= '<tr>';
   				$html 	.= '<td><b>Recruiter Email Address</b></td>';
   				$html 	.= '<td>'.$param['rec_email_address'].'</td>';
   			$html 	.= '</tr>';
   			$html 	.= '<tr>';
   				$html 	.= '<td><b>Applying for</b></td>';
   				$html 	.= '<td>'.$param['applying_for'].'</td>';
   			$html 	.= '</tr>';
   			$html 	.= '<tr>';
   				$html 	.= '<td><b>Interviewer Name / Position</b></td>';
   				$html 	.= '<td>'.$param['interviewer_name'].'</td>';
   			$html 	.= '</tr>';

   			
	   			
   			

   			if($param['interview_address'] == "virtual"){
   				$html 	.= '<tr>';
	   				$html 	.= '<td><b>Virtual Interview Link</b></td>';
	   				$html 	.= '<td>'.$param['virtual_link'].'</td>';
	   			$html 	.= '</tr>';
   			}else{
				if($param['interview_address'] == "face_to_face"){
					$html 	.= '<tr>';
						$html 	.= '<td><b>Interview Address</b></td>';
						$html 	.= '<td>'.$param['interview_location'].'</td>';
					$html 	.= '</tr>';
				}//end if
			}//end if
   			
   			if($param['notes_to_interviewee'] !== ""){
	   			$html 	.= '<tr>';
	   				$html 	.= '<td><b>Notes to Interviewee</b></td>';
	   				$html 	.= '<td>'.$param['notes_to_interviewee'].'</td>';
	   			$html 	.= '</tr>';
	   		}//end if
   		$html 	.= '</table>';
   		//end content
   		$html 	.= $br.$br;

   		$html 	.= 'Good luck!';
   		$html 	.= $br.$br;
   		$html 	.= 'Our Interview Tips:';
   		$html 	.= $br;
   		$html 	.= '<ul>';
   			$html 	.= '<li>Research the company and the job in advance</li>';
   			$html 	.= '<li>Practice telling your story</li>';
   			$html 	.= '<li>Read the headlines on the day of the interview</li>';
   			$html 	.= '<li>Dress for success and to impress</li>';
   			$html 	.= '<li>Dress for success and to impress</li>';
   			$html 	.= '<li>Arrive early but don’t check in until it’s time</li>';
			$html 	.= '<li>Be aware of your body language </li>';
			$html 	.= '<li>Ask questions that matter</li>';
			$html 	.= '<li>Only say good stuff about a former employer</li>';
			$html 	.= '<li>Mobile phone on silent mode and never visible</li>';
			$html 	.= '<li>Be authentic, connect with the interviewer as a person</li>';
			$html 	.= '<li>Know your Why’s</li>';

   		$html 	.= '</ul>';


   		$html 	.= $br.$br;
   		$html 	.= '<a href="'.$param["url"].'">[Log in]</a> to your Hoteleers account.';
   		$html 	.= $br.$br;
   		$html 	.= 'To your success,';
   		$html 	.= $br.$br;
   		$html 	.= 'Hoteleers Team';

   		return $html;
   }//end function


   public function edited_job_interview_template($param){
   		$br 	= '<br/>';
   		$html 	= '';
   		$html 	.= 'Good day '.$param['name'].',';
   		$html 	.= $br.$br;
   		$html 	.= 'Your interview scheduled with '.$param['company_name'].' has been changed with new details below:';
   		$html 	.= $br.$br;

   		//content
   		$html 	.= '<table>';
   			$html 	.= '<tr>';
   				$html 	.= '<td><b>Interview Date</b></td>';
   				$html 	.= '<td>'.$param['interview_date'].'</td>';
   			$html 	.= '</tr>';
   			$html 	.= '<tr>';
   				$html 	.= '<td><b>Start Time</b></td>';
   				$html 	.= '<td>'.$param['start_time'].' - '.$param['end_time'].'</td>';
   			$html 	.= '</tr>';
   			$html 	.= '<tr>';
   				$html 	.= '<td><b>Applicant Name</b></td>';
   				$html 	.= '<td>'.$param['applicant_name'].'</td>';
   			$html 	.= '</tr>';
   			$html 	.= '<tr>';
   				$html 	.= '<td><b>Recruiter Email Address</b></td>';
   				$html 	.= '<td>'.$param['rec_email_address'].'</td>';
   			$html 	.= '</tr>';
   			$html 	.= '<tr>';
   				$html 	.= '<td><b>Applying for</b></td>';
   				$html 	.= '<td>'.$param['applying_for'].'</td>';
   			$html 	.= '</tr>';
   			$html 	.= '<tr>';
   				$html 	.= '<td><b>Interviewer Name / Position</b></td>';
   				$html 	.= '<td>'.$param['interviewer_name'].'</td>';
   			$html 	.= '</tr>';

   			
	   			$html 	.= '<tr>';
	   				$html 	.= '<td><b>Interview Address</b></td>';
	   				if($param['interview_address'] == "face_to_face"){
	   					$html 	.= '<td>'.$param['interview_location'].'</td>';
	   				}else{
	   					$html 	.= '<td>'.$param['interview_address'].'</td>';
	   				}//end if
	   			$html 	.= '</tr>';
   			

   			if($param['interview_address'] == "virtual"){
   				$html 	.= '<tr>';
	   				$html 	.= '<td><b>Virtual Interview Link</b></td>';
	   				$html 	.= '<td>'.$param['virtual_link'].'</td>';
	   			$html 	.= '</tr>';
   			}//end if
   			
   			if($param['notes_to_interviewee'] !== ""){
	   			$html 	.= '<tr>';
	   				$html 	.= '<td><b>Notes to Interviewee</b></td>';
	   				$html 	.= '<td>'.$param['notes_to_interviewee'].'</td>';
	   			$html 	.= '</tr>';
	   		}//end if
   		$html 	.= '</table>';
   		//end content
   		$html 	.= $br.$br;

   		$html 	.= 'Good luck!';
   		$html 	.= $br.$br;
   		$html 	.= 'Our Interview Tips:';
   		$html 	.= $br;
   		$html 	.= '<ul>';
   			$html 	.= '<li>Research the company and the job in advance</li>';
   			$html 	.= '<li>Practice telling your story</li>';
   			$html 	.= '<li>Read the headlines on the day of the interview</li>';
   			$html 	.= '<li>Dress for success and to impress</li>';
   			$html 	.= '<li>Dress for success and to impress</li>';
   			$html 	.= '<li>Arrive early but don’t check in until it’s time</li>';
			$html 	.= '<li>Be aware of your body language </li>';
			$html 	.= '<li>Ask questions that matter</li>';
			$html 	.= '<li>Only say good stuff about a former employer</li>';
			$html 	.= '<li>Mobile phone on silent mode and never visible</li>';
			$html 	.= '<li>Be authentic, connect with the interviewer as a person</li>';
			$html 	.= '<li>Know your Why’s</li>';

   		$html 	.= '</ul>';


   		$html 	.= $br.$br;
   		$html 	.= '<a href="'.$param["url"].'">[Log in]</a> to your Hoteleers account.';
   		$html 	.= $br.$br;
   		$html 	.= 'To your success,';
   		$html 	.= $br.$br;
   		$html 	.= 'Hoteleers Team';
   		return $html;
   }//end function



   public function notification_employer_template($param){
   		$br 	= '<br/>';
   		$html 	= '';
   		$html 	.= 'Congratulations!';
   		$html 	.= $br.$br;
   		$html 	.= '<b>'.$param['name'].'</b> is almost ready to start enjoying Hoteleers!';
   		$html 	.= $br.$br;
   		$html 	.= 'Let’s help you get set up.';
   		$html 	.= $br.$br;
   		$html 	.= 'Please fill out the list of users and we’ll create an account for each of them.';
   		$html 	.= $br.$br;
   		$html 	.= 'Note that there is no limit on the number of users that we can create for you.';
   		$html 	.= $br.$br;


   		//content
   		$html 	.= '<table>';
   			$html 	.= '<tr>';
   				$html 	.= '<td>Prefix (Mr/Ms)</td>';
   				$html 	.= '<td>Last Name</td>';
   				$html 	.= '<td>First Name</td>';
   				$html 	.= '<td>Title/ Designation</td>';
   				$html 	.= '<td>Email Address</td>';
   				$html 	.= '<td>Tel #</td>';
   			$html 	.= '</tr>';
   			$html 	.= '<tr>';
   				$html 	.= '<td></td>';
   				$html 	.= '<td></td>';
   				$html 	.= '<td></td>';
   				$html 	.= '<td></td>';
   				$html 	.= '<td></td>';
   				$html 	.= '<td></td>';
   			$html 	.= '</tr>';
   			$html 	.= '<tr>';
   				$html 	.= '<td></td>';
   				$html 	.= '<td></td>';
   				$html 	.= '<td></td>';
   				$html 	.= '<td></td>';
   				$html 	.= '<td></td>';
   				$html 	.= '<td></td>';
   			$html 	.= '</tr>';
   			$html 	.= '<tr>';
   				$html 	.= '<td></td>';
   				$html 	.= '<td></td>';
   				$html 	.= '<td></td>';
   				$html 	.= '<td></td>';
   				$html 	.= '<td></td>';
   				$html 	.= '<td></td>';
   			$html 	.= '</tr>';
   			
   		$html 	.= '</table>';
   		//end content
   		$html 	.= $br.$br;

   		$html 	.= 'Email list to sales@hoteleers.com';
   		$html 	.= $br.$br;
   		$html 	.= 'Once you receive your access, you can immediately:';
   		$html 	.= $br;
   		$html 	.= '<ul>';
   			$html 	.= '<li>Update your company profile </li>';
   			$html 	.= '<li>Feature your awesome photos for applicants to see</li>';
   		$html 	.= '</ul>';
   		$html 	.= $br.$br;
   		$html 	.= 'To your success,';
   		$html 	.= $br.$br;
   		$html 	.= 'Hoteleers Team';
   		$html 	.= $br;
   		$html 	.= 'sales@hoteleers.com';
   		return $html;
   }//end function


   public function change_password_template($param){
   		$br 	= '<br/>';
   		$html 	= '';
   		
   		$html 	.= 'Hi <b>'.$param['name'].'</b>';
   		$html 	.= $br.$br.$br;
   		$html 	.= 'Congratulations!';
   		$html 	.= $br.$br;
   		$html 	.= 'Your temporary password is '.$param["new_password"].'';
   		$html 	.= $br.$br;
   		$html 	.= '<a href="'.$param["url"].'">[Log in]</a> to your Hoteleers account.';
   		$html 	.= $br.$br.$br;
   		$html 	.= 'Once you receive your access, you can immediately:';
   		$html 	.= $br;
   		$html 	.= '<ul>';
   			$html 	.= '<li>Update your company profile </li>';
   			$html 	.= '<li>Feature your awesome photos for applicants to see</li>';
   		$html 	.= '</ul>';
   		$html 	.= $br.$br.$br;
   		$html 	.= 'To your success,';
   		$html 	.= $br.$br;
   		$html 	.= 'Hoteleers Team';
   		$html 	.= $br;
   		$html 	.= 'sales@hoteleers.com';
   		return $html;
   }//end function


   public function change_password_applicant_template($param){
   		$br 	= '<br/>';
   		$html 	= '';
   		
   		$html 	.= 'Hi <b>'.$param['name'].'</b>';
   		$html 	.= $br.$br;
   		$html 	.= 'You’re receiving this email because you recently requested to change in the password for your Hoteleers account.';
   		$html 	.= $br.$br;
   		$html 	.= 'Click the link below to proceed.';
   		$html 	.= $br.$br;
   		$html 	.= '<a href="'.$param["url_change_password"].'">[Change Password]</a>';
   		$html 	.= $br.$br.$br;
   		$html 	.= 'Wasn\'t you? Please report this as a suspicious login and change your password immediately!';
   		$html 	.= $br.$br;
   		$html 	.= '<a href="'.$this->gmail_redirect.'">[Report login]</a>';

   		$html 	.= $br.$br.$br;
   		$html 	.= 'Thanks for helping us keep your account secure.';
   		$html 	.= $br.$br;
		$html 	.= 'To your success,';
   		$html 	.= $br.$br;
   		$html 	.= 'Hoteleers Team';
   		return $html;
   }//end function


   public function forgot_password_template($param){
   		$br 	= '<br/>';
   		$html 	= '';
   		
   		$html 	.= 'Hi <b>'.$param['name'].'</b>';
   		$html 	.= $br.$br;
   		$html 	.= 'You’re receiving this email because you recently requested to reset the password for your Hoteleers account.';
   		$html 	.= $br.$br;
   		$html 	.= 'Click the link below to proceed.';
   		$html 	.= $br.$br;
   		$html 	.= '<a href="'.$param["url_reset"].'">[Reset Password]</a>';
   		$html 	.= $br.$br.$br;
   		$html 	.= 'Wasn\'t you? Please report this as a suspicious login and change your password immediately!';
   		$html 	.= $br.$br;
   		$html 	.= '<a href="'.$this->gmail_redirect.'">[Report login]</a>';

   		$html 	.= $br.$br.$br;
   		$html 	.= 'Thanks for helping us keep your account secure.';
   		$html 	.= $br.$br;
		$html 	.= 'To your success,';
   		$html 	.= $br.$br;
   		$html 	.= 'Hoteleers Team';
   		return $html;
   }//end function





   public function cancelled_job_interview_template($param){
   		$br 	= '<br/>';
   		$html 	= '';
   		$html 	.= 'Good day '.$param['name'].',';
   		$html 	.= $br.$br;
   		$html 	.= 'Your interview scheduled with '.$param['company_name'].' has been cancelled';
   		$html 	.= $br.$br;
   		$html 	.= 'We recommend you send the interviewer a short email if you haven’t communicated yet';
   		$html 	.= $br.$br;
   		$html 	.= 'If the application moves forward, then all is great!';
   		$html 	.= $br.$br;
   		$html 	.= 'Otherwise, we have lots of good stuff you may want to check out <a href="'.$param['job_board_url'].'">here</a>';
   		$html 	.= $br.$br;
   		$html 	.= 'You only need one good offer, so let’s find it!';
   		$html 	.= $br.$br;
   		$html 	.= '<a href="'.$param["url"].'">[Log in]</a> to your Hoteleers account.';
   		$html 	.= $br.$br;
   		$html 	.= 'To your success,';
   		$html 	.= $br.$br;
   		$html 	.= 'Hoteleers Team';
   		return $html;
   }//end function


   public function invitation_apply($param){
		$html 	= '';
		$br 	= '<br/>';
		$html 	.= 'Good day '.$param["name"].',';
		$html 	.= $br.$br;
		$html 	.= 'You have been invited to apply for the '.$param["job_title"].' position with '.$param["company_name"].'';
		$html 	.= $br.$br;
		$html 	.= '<a href="'.$param["url"].'">[Log in]</a> to your Hoteleers account to apply';
		$html 	.= $br.$br;
		$html 	.= 'Good luck!';
		$html 	.= $br.$br;
		$html 	.= 'To your success,';
		$html 	.= $br.$br;
		$html 	.= 'Hoteleers Team';

		return $html;
	}//end

   public function random_password() {
	    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	    $pass = array(); //remember to declare $pass as an array
	    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	    for ($i = 0; $i < 8; $i++) {
	        $n = rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	    }
	    return implode($pass); //turn the array into a string
	}//end function 

    public function email_verification_code() {
	    $alphabet = '1234567890';
	    $pass = array(); //remember to declare $pass as an array
	    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	    for ($i = 0; $i < 5; $i++) {
	        $n = rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	    }
	    return implode($pass); //turn the array into a string
	}//end function 

	public function random_password2() {
		$digits    = array_flip(range('0', '9'));
		$lowercase = array_flip(range('a', 'z'));
		$uppercase = array_flip(range('A', 'Z')); 
		//$special   = array_flip(str_split('!@#$%^&*()_+=-}{[}]\|;:<>?/'));
		$combined  = array_merge($digits, $lowercase, $uppercase);

		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	    $pass = array(); //remember to declare $pass as an array
	    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	    for ($i = 0; $i < 5; $i++) {
	        $n = rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	    }//end for

		$password  = str_shuffle(substr(array_rand($digits), 0,1) .
		                         substr(array_rand($lowercase), 0,1) .
		                         substr(array_rand($uppercase), 0,1) . 
		                         implode($pass));

		return $password;
	}//end function

	public	function date_diff($date1,$date2){
		$response 			= array();
		$date1				= date_create($date1);
		$date2				= date_create($date2);
		$diff 				= date_diff($date1,$date2);

		$response["month"]  = (int) $diff->format("%m");
		$response["day"]    = (int) $diff->format("%d");
	    return $response;
	    

	    /*
	    $diff 		= abs(strtotime($date2) - strtotime($date1));

		$years 		= floor($diff / (365*60*60*24));
		$months 	= floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
		$days 		= floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

		return $days;
		*/
	}//end function

	public function get_country_code(){
		$response 			= array();
		$response["data"] 	= array(
								  array(
								    "name"=> "Afghanistan",
								    "dial_code"=> "+93",
								    "code"=> "AF"
								  ),
								  array(
								    "name"=> "Aland Islands",
								    "dial_code"=> "+358",
								    "code"=> "AX"
								  ),
								  array(
								    "name"=> "Albania",
								    "dial_code"=> "+355",
								    "code"=> "AL"
								  ),
								  array(
								    "name"=> "Algeria",
								    "dial_code"=> "+213",
								    "code"=> "DZ"
								  ),
								  array(
								    "name"=> "AmericanSamoa",
								    "dial_code"=> "+1684",
								    "code"=> "AS"
								  ),
								  array(
								    "name"=> "Andorra",
								    "dial_code"=> "+376",
								    "code"=> "AD"
								  ),
								  array(
								    "name"=> "Angola",
								    "dial_code"=> "+244",
								    "code"=> "AO"
								  ),
								  array(
								    "name"=> "Anguilla",
								    "dial_code"=> "+1264",
								    "code"=> "AI"
								  ),
								  array(
								    "name"=> "Antarctica",
								    "dial_code"=> "+672",
								    "code"=> "AQ"
								  ),
								  array(
								    "name"=> "Antigua and Barbuda",
								    "dial_code"=> "+1268",
								    "code"=> "AG"
								  ),
								  array(
								    "name"=> "Argentina",
								    "dial_code"=> "+54",
								    "code"=> "AR"
								  ),
								  array(
								    "name"=> "Armenia",
								    "dial_code"=> "+374",
								    "code"=> "AM"
								  ),
								  array(
								    "name"=> "Aruba",
								    "dial_code"=> "+297",
								    "code"=> "AW"
								  ),
								  array(
								    "name"=> "Australia",
								    "dial_code"=> "+61",
								    "code"=> "AU"
								  ),
								  array(
								    "name"=> "Austria",
								    "dial_code"=> "+43",
								    "code"=> "AT"
								  ),
								  array(
								    "name"=> "Azerbaijan",
								    "dial_code"=> "+994",
								    "code"=> "AZ"
								  ),
								  array(
								    "name"=> "Bahamas",
								    "dial_code"=> "+1242",
								    "code"=> "BS"
								  ),
								  array(
								    "name"=> "Bahrain",
								    "dial_code"=> "+973",
								    "code"=> "BH"
								  ),
								  array(
								    "name"=> "Bangladesh",
								    "dial_code"=> "+880",
								    "code"=> "BD"
								  ),
								  array(
								    "name"=> "Barbados",
								    "dial_code"=> "+1246",
								    "code"=> "BB"
								  ),
								  array(
								    "name"=> "Belarus",
								    "dial_code"=> "+375",
								    "code"=> "BY"
								  ),
								  array(
								    "name"=> "Belgium",
								    "dial_code"=> "+32",
								    "code"=> "BE"
								  ),
								  array(
								    "name"=> "Belize",
								    "dial_code"=> "+501",
								    "code"=> "BZ"
								  ),
								  array(
								    "name"=> "Benin",
								    "dial_code"=> "+229",
								    "code"=> "BJ"
								  ),
								  array(
								    "name"=> "Bermuda",
								    "dial_code"=> "+1441",
								    "code"=> "BM"
								  ),
								  array(
								    "name"=> "Bhutan",
								    "dial_code"=> "+975",
								    "code"=> "BT"
								  ),
								  array(
								    "name"=> "Bolivia, Plurinational State of",
								    "dial_code"=> "+591",
								    "code"=> "BO"
								  ),
								  array(
								    "name"=> "Bosnia and Herzegovina",
								    "dial_code"=> "+387",
								    "code"=> "BA"
								  ),
								  array(
								    "name"=> "Botswana",
								    "dial_code"=> "+267",
								    "code"=> "BW"
								  ),
								  array(
								    "name"=> "Brazil",
								    "dial_code"=> "+55",
								    "code"=> "BR"
								  ),
								  array(
								    "name"=> "British Indian Ocean Territory",
								    "dial_code"=> "+246",
								    "code"=> "IO"
								  ),
								  array(
								    "name"=> "Brunei Darussalam",
								    "dial_code"=> "+673",
								    "code"=> "BN"
								  ),
								  array(
								    "name"=> "Bulgaria",
								    "dial_code"=> "+359",
								    "code"=> "BG"
								  ),
								  array(
								    "name"=> "Burkina Faso",
								    "dial_code"=> "+226",
								    "code"=> "BF"
								  ),
								  array(
								    "name"=> "Burundi",
								    "dial_code"=> "+257",
								    "code"=> "BI"
								  ),
								  array(
								    "name"=> "Cambodia",
								    "dial_code"=> "+855",
								    "code"=> "KH"
								  ),
								  array(
								    "name"=> "Cameroon",
								    "dial_code"=> "+237",
								    "code"=> "CM"
								  ),
								  array(
								    "name"=> "Canada",
								    "dial_code"=> "+1",
								    "code"=> "US/CA"
								  ),
								  array(
								    "name"=> "Cape Verde",
								    "dial_code"=> "+238",
								    "code"=> "CV"
								  ),
								  array(
								    "name"=> "Cayman Islands",
								    "dial_code"=> "+ 345",
								    "code"=> "KY"
								  ),
								  array(
								    "name"=> "Central African Republic",
								    "dial_code"=> "+236",
								    "code"=> "CF"
								  ),
								  array(
								    "name"=> "Chad",
								    "dial_code"=> "+235",
								    "code"=> "TD"
								  ),
								  array(
								    "name"=> "Chile",
								    "dial_code"=> "+56",
								    "code"=> "CL"
								  ),
								  array(
								    "name"=> "China",
								    "dial_code"=> "+86",
								    "code"=> "CN"
								  ),
								  array(
								    "name"=> "Christmas Island",
								    "dial_code"=> "+61",
								    "code"=> "CX"
								  ),
								  array(
								    "name"=> "Cocos (Keeling) Islands",
								    "dial_code"=> "+61",
								    "code"=> "CC"
								  ),
								  array(
								    "name"=> "Colombia",
								    "dial_code"=> "+57",
								    "code"=> "CO"
								  ),
								  array(
								    "name"=> "Comoros",
								    "dial_code"=> "+269",
								    "code"=> "KM"
								  ),
								  array(
								    "name"=> "Congo",
								    "dial_code"=> "+242",
								    "code"=> "CG"
								  ),
								  array(
								    "name"=> "Congo, The Democratic Republic of the Congo",
								    "dial_code"=> "+243",
								    "code"=> "CD"
								  ),
								  array(
								    "name"=> "Cook Islands",
								    "dial_code"=> "+682",
								    "code"=> "CK"
								  ),
								  array(
								    "name"=> "Costa Rica",
								    "dial_code"=> "+506",
								    "code"=> "CR"
								  ),
								  array(
								    "name"=> "Cote d'Ivoire",
								    "dial_code"=> "+225",
								    "code"=> "CI"
								  ),
								  array(
								    "name"=> "Croatia",
								    "dial_code"=> "+385",
								    "code"=> "HR"
								  ),
								  array(
								    "name"=> "Cuba",
								    "dial_code"=> "+53",
								    "code"=> "CU"
								  ),
								  array(
								    "name"=> "Cyprus",
								    "dial_code"=> "+357",
								    "code"=> "CY"
								  ),
								  array(
								    "name"=> "Czech Republic",
								    "dial_code"=> "+420",
								    "code"=> "CZ"
								  ),
								  array(
								    "name"=> "Denmark",
								    "dial_code"=> "+45",
								    "code"=> "DK"
								  ),
								  array(
								    "name"=> "Djibouti",
								    "dial_code"=> "+253",
								    "code"=> "DJ"
								  ),
								  array(
								    "name"=> "Dominica",
								    "dial_code"=> "+1767",
								    "code"=> "DM"
								  ),
								  array(
								    "name"=> "Dominican Republic",
								    "dial_code"=> "+1849",
								    "code"=> "DO"
								  ),
								  array(
								    "name"=> "Ecuador",
								    "dial_code"=> "+593",
								    "code"=> "EC"
								  ),
								  array(
								    "name"=> "Egypt",
								    "dial_code"=> "+20",
								    "code"=> "EG"
								  ),
								  array(
								    "name"=> "El Salvador",
								    "dial_code"=> "+503",
								    "code"=> "SV"
								  ),
								  array(
								    "name"=> "Equatorial Guinea",
								    "dial_code"=> "+240",
								    "code"=> "GQ"
								  ),
								  array(
								    "name"=> "Eritrea",
								    "dial_code"=> "+291",
								    "code"=> "ER"
								  ),
								  array(
								    "name"=> "Estonia",
								    "dial_code"=> "+372",
								    "code"=> "EE"
								  ),
								  array(
								    "name"=> "Ethiopia",
								    "dial_code"=> "+251",
								    "code"=> "ET"
								  ),
								  array(
								    "name"=> "Falkland Islands (Malvinas)",
								    "dial_code"=> "+500",
								    "code"=> "FK"
								  ),
								  array(
								    "name"=> "Faroe Islands",
								    "dial_code"=> "+298",
								    "code"=> "FO"
								  ),
								  array(
								    "name"=> "Fiji",
								    "dial_code"=> "+679",
								    "code"=> "FJ"
								  ),
								  array(
								    "name"=> "Finland",
								    "dial_code"=> "+358",
								    "code"=> "FI"
								  ),
								  array(
								    "name"=> "France",
								    "dial_code"=> "+33",
								    "code"=> "FR"
								  ),
								  array(
								    "name"=> "French Guiana",
								    "dial_code"=> "+594",
								    "code"=> "GF"
								  ),
								  array(
								    "name"=> "French Polynesia",
								    "dial_code"=> "+689",
								    "code"=> "PF"
								  ),
								  array(
								    "name"=> "Gabon",
								    "dial_code"=> "+241",
								    "code"=> "GA"
								  ),
								  array(
								    "name"=> "Gambia",
								    "dial_code"=> "+220",
								    "code"=> "GM"
								  ),
								  array(
								    "name"=> "Georgia",
								    "dial_code"=> "+995",
								    "code"=> "GE"
								  ),
								  array(
								    "name"=> "Germany",
								    "dial_code"=> "+49",
								    "code"=> "DE"
								  ),
								  array(
								    "name"=> "Ghana",
								    "dial_code"=> "+233",
								    "code"=> "GH"
								  ),
								  array(
								    "name"=> "Gibraltar",
								    "dial_code"=> "+350",
								    "code"=> "GI"
								  ),
								  array(
								    "name"=> "Greece",
								    "dial_code"=> "+30",
								    "code"=> "GR"
								  ),
								  array(
								    "name"=> "Greenland",
								    "dial_code"=> "+299",
								    "code"=> "GL"
								  ),
								  array(
								    "name"=> "Grenada",
								    "dial_code"=> "+1473",
								    "code"=> "GD"
								  ),
								  array(
								    "name"=> "Guadeloupe",
								    "dial_code"=> "+590",
								    "code"=> "GP"
								  ),
								  array(
								    "name"=> "Guam",
								    "dial_code"=> "+1671",
								    "code"=> "GU"
								  ),
								  array(
								    "name"=> "Guatemala",
								    "dial_code"=> "+502",
								    "code"=> "GT"
								  ),
								  array(
								    "name"=> "Guernsey",
								    "dial_code"=> "+44",
								    "code"=> "GG"
								  ),
								  array(
								    "name"=> "Guinea",
								    "dial_code"=> "+224",
								    "code"=> "GN"
								  ),
								  array(
								    "name"=> "Guinea-Bissau",
								    "dial_code"=> "+245",
								    "code"=> "GW"
								  ),
								  array(
								    "name"=> "Guyana",
								    "dial_code"=> "+595",
								    "code"=> "GY"
								  ),
								  array(
								    "name"=> "Haiti",
								    "dial_code"=> "+509",
								    "code"=> "HT"
								  ),
								  array(
								    "name"=> "Holy See (Vatican City State)",
								    "dial_code"=> "+379",
								    "code"=> "VA"
								  ),
								  array(
								    "name"=> "Honduras",
								    "dial_code"=> "+504",
								    "code"=> "HN"
								  ),
								  array(
								    "name"=> "Hong Kong",
								    "dial_code"=> "+852",
								    "code"=> "HK"
								  ),
								  array(
								    "name"=> "Hungary",
								    "dial_code"=> "+36",
								    "code"=> "HU"
								  ),
								  array(
								    "name"=> "Iceland",
								    "dial_code"=> "+354",
								    "code"=> "IS"
								  ),
								  array(
								    "name"=> "India",
								    "dial_code"=> "+91",
								    "code"=> "IN"
								  ),
								  array(
								    "name"=> "Indonesia",
								    "dial_code"=> "+62",
								    "code"=> "ID"
								  ),
								  array(
								    "name"=> "Iran, Islamic Republic of Persian Gulf",
								    "dial_code"=> "+98",
								    "code"=> "IR"
								  ),
								  array(
								    "name"=> "Iraq",
								    "dial_code"=> "+964",
								    "code"=> "IQ"
								  ),
								  array(
								    "name"=> "Ireland",
								    "dial_code"=> "+353",
								    "code"=> "IE"
								  ),
								  array(
								    "name"=> "Isle of Man",
								    "dial_code"=> "+44",
								    "code"=> "IM"
								  ),
								  array(
								    "name"=> "Israel",
								    "dial_code"=> "+972",
								    "code"=> "IL"
								  ),
								  array(
								    "name"=> "Italy",
								    "dial_code"=> "+39",
								    "code"=> "IT"
								  ),
								  array(
								    "name"=> "Jamaica",
								    "dial_code"=> "+1876",
								    "code"=> "JM"
								  ),
								  array(
								    "name"=> "Japan",
								    "dial_code"=> "+81",
								    "code"=> "JP"
								  ),
								  array(
								    "name"=> "Jersey",
								    "dial_code"=> "+44",
								    "code"=> "JE"
								  ),
								  array(
								    "name"=> "Jordan",
								    "dial_code"=> "+962",
								    "code"=> "JO"
								  ),
								  array(
								    "name"=> "Kazakhstan",
								    "dial_code"=> "+77",
								    "code"=> "KZ"
								  ),
								  array(
								    "name"=> "Kenya",
								    "dial_code"=> "+254",
								    "code"=> "KE"
								  ),
								  array(
								    "name"=> "Kiribati",
								    "dial_code"=> "+686",
								    "code"=> "KI"
								  ),
								  array(
								    "name"=> "Korea, Democratic People's Republic of Korea",
								    "dial_code"=> "+850",
								    "code"=> "KP"
								  ),
								  array(
								    "name"=> "Korea, Republic of South Korea",
								    "dial_code"=> "+82",
								    "code"=> "KR"
								  ),
								  array(
								    "name"=> "Kuwait",
								    "dial_code"=> "+965",
								    "code"=> "KW"
								  ),
								  array(
								    "name"=> "Kyrgyzstan",
								    "dial_code"=> "+996",
								    "code"=> "KG"
								  ),
								  array(
								    "name"=> "Laos",
								    "dial_code"=> "+856",
								    "code"=> "LA"
								  ),
								  array(
								    "name"=> "Latvia",
								    "dial_code"=> "+371",
								    "code"=> "LV"
								  ),
								  array(
								    "name"=> "Lebanon",
								    "dial_code"=> "+961",
								    "code"=> "LB"
								  ),
								  array(
								    "name"=> "Lesotho",
								    "dial_code"=> "+266",
								    "code"=> "LS"
								  ),
								  array(
								    "name"=> "Liberia",
								    "dial_code"=> "+231",
								    "code"=> "LR"
								  ),
								  array(
								    "name"=> "Libyan Arab Jamahiriya",
								    "dial_code"=> "+218",
								    "code"=> "LY"
								  ),
								  array(
								    "name"=> "Liechtenstein",
								    "dial_code"=> "+423",
								    "code"=> "LI"
								  ),
								  array(
								    "name"=> "Lithuania",
								    "dial_code"=> "+370",
								    "code"=> "LT"
								  ),
								  array(
								    "name"=> "Luxembourg",
								    "dial_code"=> "+352",
								    "code"=> "LU"
								  ),
								  array(
								    "name"=> "Macao",
								    "dial_code"=> "+853",
								    "code"=> "MO"
								  ),
								  array(
								    "name"=> "Macedonia",
								    "dial_code"=> "+389",
								    "code"=> "MK"
								  ),
								  array(
								    "name"=> "Madagascar",
								    "dial_code"=> "+261",
								    "code"=> "MG"
								  ),
								  array(
								    "name"=> "Malawi",
								    "dial_code"=> "+265",
								    "code"=> "MW"
								  ),
								  array(
								    "name"=> "Malaysia",
								    "dial_code"=> "+60",
								    "code"=> "MY"
								  ),
								  array(
								    "name"=> "Maldives",
								    "dial_code"=> "+960",
								    "code"=> "MV"
								  ),
								  array(
								    "name"=> "Mali",
								    "dial_code"=> "+223",
								    "code"=> "ML"
								  ),
								  array(
								    "name"=> "Malta",
								    "dial_code"=> "+356",
								    "code"=> "MT"
								  ),
								  array(
								    "name"=> "Marshall Islands",
								    "dial_code"=> "+692",
								    "code"=> "MH"
								  ),
								  array(
								    "name"=> "Martinique",
								    "dial_code"=> "+596",
								    "code"=> "MQ"
								  ),
								  array(
								    "name"=> "Mauritania",
								    "dial_code"=> "+222",
								    "code"=> "MR"
								  ),
								  array(
								    "name"=> "Mauritius",
								    "dial_code"=> "+230",
								    "code"=> "MU"
								  ),
								  array(
								    "name"=> "Mayotte",
								    "dial_code"=> "+262",
								    "code"=> "YT"
								  ),
								  array(
								    "name"=> "Mexico",
								    "dial_code"=> "+52",
								    "code"=> "MX"
								  ),
								  array(
								    "name"=> "Micronesia, Federated States of Micronesia",
								    "dial_code"=> "+691",
								    "code"=> "FM"
								  ),
								  array(
								    "name"=> "Moldova",
								    "dial_code"=> "+373",
								    "code"=> "MD"
								  ),
								  array(
								    "name"=> "Monaco",
								    "dial_code"=> "+377",
								    "code"=> "MC"
								  ),
								  array(
								    "name"=> "Mongolia",
								    "dial_code"=> "+976",
								    "code"=> "MN"
								  ),
								  array(
								    "name"=> "Montenegro",
								    "dial_code"=> "+382",
								    "code"=> "ME"
								  ),
								  array(
								    "name"=> "Montserrat",
								    "dial_code"=> "+1664",
								    "code"=> "MS"
								  ),
								  array(
								    "name"=> "Morocco",
								    "dial_code"=> "+212",
								    "code"=> "MA"
								  ),
								  array(
								    "name"=> "Mozambique",
								    "dial_code"=> "+258",
								    "code"=> "MZ"
								  ),
								  array(
								    "name"=> "Myanmar",
								    "dial_code"=> "+95",
								    "code"=> "MM"
								  ),
								  array(
								    "name"=> "Namibia",
								    "dial_code"=> "+264",
								    "code"=> "NA"
								  ),
								  array(
								    "name"=> "Nauru",
								    "dial_code"=> "+674",
								    "code"=> "NR"
								  ),
								  array(
								    "name"=> "Nepal",
								    "dial_code"=> "+977",
								    "code"=> "NP"
								  ),
								  array(
								    "name"=> "Netherlands",
								    "dial_code"=> "+31",
								    "code"=> "NL"
								  ),
								  array(
								    "name"=> "Netherlands Antilles",
								    "dial_code"=> "+599",
								    "code"=> "AN"
								  ),
								  array(
								    "name"=> "New Caledonia",
								    "dial_code"=> "+687",
								    "code"=> "NC"
								  ),
								  array(
								    "name"=> "New Zealand",
								    "dial_code"=> "+64",
								    "code"=> "NZ"
								  ),
								  array(
								    "name"=> "Nicaragua",
								    "dial_code"=> "+505",
								    "code"=> "NI"
								  ),
								  array(
								    "name"=> "Niger",
								    "dial_code"=> "+227",
								    "code"=> "NE"
								  ),
								  array(
								    "name"=> "Nigeria",
								    "dial_code"=> "+234",
								    "code"=> "NG"
								  ),
								  array(
								    "name"=> "Niue",
								    "dial_code"=> "+683",
								    "code"=> "NU"
								  ),
								  array(
								    "name"=> "Norfolk Island",
								    "dial_code"=> "+672",
								    "code"=> "NF"
								  ),
								  array(
								    "name"=> "Northern Mariana Islands",
								    "dial_code"=> "+1670",
								    "code"=> "MP"
								  ),
								  array(
								    "name"=> "Norway",
								    "dial_code"=> "+47",
								    "code"=> "NO"
								  ),
								  array(
								    "name"=> "Oman",
								    "dial_code"=> "+968",
								    "code"=> "OM"
								  ),
								  array(
								    "name"=> "Pakistan",
								    "dial_code"=> "+92",
								    "code"=> "PK"
								  ),
								  array(
								    "name"=> "Palau",
								    "dial_code"=> "+680",
								    "code"=> "PW"
								  ),
								  array(
								    "name"=> "Palestinian Territory, Occupied",
								    "dial_code"=> "+970",
								    "code"=> "PS"
								  ),
								  array(
								    "name"=> "Panama",
								    "dial_code"=> "+507",
								    "code"=> "PA"
								  ),
								  array(
								    "name"=> "Papua New Guinea",
								    "dial_code"=> "+675",
								    "code"=> "PG"
								  ),
								  array(
								    "name"=> "Paraguay",
								    "dial_code"=> "+595",
								    "code"=> "PY"
								  ),
								  array(
								    "name"=> "Peru",
								    "dial_code"=> "+51",
								    "code"=> "PE"
								  ),
								  array(
								    "name"=> "Philippines",
								    "dial_code"=> "+63",
								    "code"=> "PH"
								  ),
								  array(
								    "name"=> "Pitcairn",
								    "dial_code"=> "+872",
								    "code"=> "PN"
								  ),
								  array(
								    "name"=> "Poland",
								    "dial_code"=> "+48",
								    "code"=> "PL"
								  ),
								  array(
								    "name"=> "Portugal",
								    "dial_code"=> "+351",
								    "code"=> "PT"
								  ),
								  array(
								    "name"=> "Puerto Rico",
								    "dial_code"=> "+1939",
								    "code"=> "PR"
								  ),
								  array(
								    "name"=> "Qatar",
								    "dial_code"=> "+974",
								    "code"=> "QA"
								  ),
								  array(
								    "name"=> "Romania",
								    "dial_code"=> "+40",
								    "code"=> "RO"
								  ),
								  array(
								    "name"=> "Russia",
								    "dial_code"=> "+7",
								    "code"=> "RU"
								  ),
								  array(
								    "name"=> "Rwanda",
								    "dial_code"=> "+250",
								    "code"=> "RW"
								  ),
								  array(
								    "name"=> "Reunion",
								    "dial_code"=> "+262",
								    "code"=> "RE"
								  ),
								  array(
								    "name"=> "Saint Barthelemy",
								    "dial_code"=> "+590",
								    "code"=> "BL"
								  ),
								  array(
								    "name"=> "Saint Helena, Ascension and Tristan Da Cunha",
								    "dial_code"=> "+290",
								    "code"=> "SH"
								  ),
								  array(
								    "name"=> "Saint Kitts and Nevis",
								    "dial_code"=> "+1869",
								    "code"=> "KN"
								  ),
								  array(
								    "name"=> "Saint Lucia",
								    "dial_code"=> "+1758",
								    "code"=> "LC"
								  ),
								  array(
								    "name"=> "Saint Martin",
								    "dial_code"=> "+590",
								    "code"=> "MF"
								  ),
								  array(
								    "name"=> "Saint Pierre and Miquelon",
								    "dial_code"=> "+508",
								    "code"=> "PM"
								  ),
								  array(
								    "name"=> "Saint Vincent and the Grenadines",
								    "dial_code"=> "+1784",
								    "code"=> "VC"
								  ),
								  array(
								    "name"=> "Samoa",
								    "dial_code"=> "+685",
								    "code"=> "WS"
								  ),
								  array(
								    "name"=> "San Marino",
								    "dial_code"=> "+378",
								    "code"=> "SM"
								  ),
								  array(
								    "name"=> "Sao Tome and Principe",
								    "dial_code"=> "+239",
								    "code"=> "ST"
								  ),
								  array(
								    "name"=> "Saudi Arabia",
								    "dial_code"=> "+966",
								    "code"=> "SA"
								  ),
								  array(
								    "name"=> "Senegal",
								    "dial_code"=> "+221",
								    "code"=> "SN"
								  ),
								  array(
								    "name"=> "Serbia",
								    "dial_code"=> "+381",
								    "code"=> "RS"
								  ),
								  array(
								    "name"=> "Seychelles",
								    "dial_code"=> "+248",
								    "code"=> "SC"
								  ),
								  array(
								    "name"=> "Sierra Leone",
								    "dial_code"=> "+232",
								    "code"=> "SL"
								  ),
								  array(
								    "name"=> "Singapore",
								    "dial_code"=> "+65",
								    "code"=> "SG"
								  ),
								  array(
								    "name"=> "Slovakia",
								    "dial_code"=> "+421",
								    "code"=> "SK"
								  ),
								  array(
								    "name"=> "Slovenia",
								    "dial_code"=> "+386",
								    "code"=> "SI"
								  ),
								  array(
								    "name"=> "Solomon Islands",
								    "dial_code"=> "+677",
								    "code"=> "SB"
								  ),
								  array(
								    "name"=> "Somalia",
								    "dial_code"=> "+252",
								    "code"=> "SO"
								  ),
								  array(
								    "name"=> "South Africa",
								    "dial_code"=> "+27",
								    "code"=> "ZA"
								  ),
								  array(
								    "name"=> "South Sudan",
								    "dial_code"=> "+211",
								    "code"=> "SS"
								  ),
								  array(
								    "name"=> "South Georgia and the South Sandwich Islands",
								    "dial_code"=> "+500",
								    "code"=> "GS"
								  ),
								  array(
								    "name"=> "Spain",
								    "dial_code"=> "+34",
								    "code"=> "ES"
								  ),
								  array(
								    "name"=> "Sri Lanka",
								    "dial_code"=> "+94",
								    "code"=> "LK"
								  ),
								  array(
								    "name"=> "Sudan",
								    "dial_code"=> "+249",
								    "code"=> "SD"
								  ),
								  array(
								    "name"=> "Suriname",
								    "dial_code"=> "+597",
								    "code"=> "SR"
								  ),
								  array(
								    "name"=> "Svalbard and Jan Mayen",
								    "dial_code"=> "+47",
								    "code"=> "SJ"
								  ),
								  array(
								    "name"=> "Swaziland",
								    "dial_code"=> "+268",
								    "code"=> "SZ"
								  ),
								  array(
								    "name"=> "Sweden",
								    "dial_code"=> "+46",
								    "code"=> "SE"
								  ),
								  array(
								    "name"=> "Switzerland",
								    "dial_code"=> "+41",
								    "code"=> "CH"
								  ),
								  array(
								    "name"=> "Syrian Arab Republic",
								    "dial_code"=> "+963",
								    "code"=> "SY"
								  ),
								  array(
								    "name"=> "Taiwan",
								    "dial_code"=> "+886",
								    "code"=> "TW"
								  ),
								  array(
								    "name"=> "Tajikistan",
								    "dial_code"=> "+992",
								    "code"=> "TJ"
								  ),
								  array(
								    "name"=> "Tanzania, United Republic of Tanzania",
								    "dial_code"=> "+255",
								    "code"=> "TZ"
								  ),
								  array(
								    "name"=> "Thailand",
								    "dial_code"=> "+66",
								    "code"=> "TH"
								  ),
								  array(
								    "name"=> "Timor-Leste",
								    "dial_code"=> "+670",
								    "code"=> "TL"
								  ),
								  array(
								    "name"=> "Togo",
								    "dial_code"=> "+228",
								    "code"=> "TG"
								  ),
								  array(
								    "name"=> "Tokelau",
								    "dial_code"=> "+690",
								    "code"=> "TK"
								  ),
								  array(
								    "name"=> "Tonga",
								    "dial_code"=> "+676",
								    "code"=> "TO"
								  ),
								  array(
								    "name"=> "Trinidad and Tobago",
								    "dial_code"=> "+1868",
								    "code"=> "TT"
								  ),
								  array(
								    "name"=> "Tunisia",
								    "dial_code"=> "+216",
								    "code"=> "TN"
								  ),
								  array(
								    "name"=> "Turkey",
								    "dial_code"=> "+90",
								    "code"=> "TR"
								  ),
								  array(
								    "name"=> "Turkmenistan",
								    "dial_code"=> "+993",
								    "code"=> "TM"
								  ),
								  array(
								    "name"=> "Turks and Caicos Islands",
								    "dial_code"=> "+1649",
								    "code"=> "TC"
								  ),
								  array(
								    "name"=> "Tuvalu",
								    "dial_code"=> "+688",
								    "code"=> "TV"
								  ),
								  array(
								    "name"=> "Uganda",
								    "dial_code"=> "+256",
								    "code"=> "UG"
								  ),
								  array(
								    "name"=> "Ukraine",
								    "dial_code"=> "+380",
								    "code"=> "UA"
								  ),
								  array(
								    "name"=> "United Arab Emirates",
								    "dial_code"=> "+971",
								    "code"=> "AE"
								  ),
								  array(
								    "name"=> "United Kingdom",
								    "dial_code"=> "+44",
								    "code"=> "GB"
								  ),
								  /*
								  array(
								    "name"=> "United States",
								    "dial_code"=> "+1",
								    "code"=> "US"
								  ),*/
								  array(
								    "name"=> "Uruguay",
								    "dial_code"=> "+598",
								    "code"=> "UY"
								  ),
								  array(
								    "name"=> "Uzbekistan",
								    "dial_code"=> "+998",
								    "code"=> "UZ"
								  ),
								  array(
								    "name"=> "Vanuatu",
								    "dial_code"=> "+678",
								    "code"=> "VU"
								  ),
								  array(
								    "name"=> "Venezuela, Bolivarian Republic of Venezuela",
								    "dial_code"=> "+58",
								    "code"=> "VE"
								  ),
								  array(
								    "name"=> "Vietnam",
								    "dial_code"=> "+84",
								    "code"=> "VN"
								  ),
								  array(
								    "name"=> "Virgin Islands, British",
								    "dial_code"=> "+1284",
								    "code"=> "VG"
								  ),
								  array(
								    "name"=> "Virgin Islands, U.S.",
								    "dial_code"=> "+1340",
								    "code"=> "VI"
								  ),
								  array(
								    "name"=> "Wallis and Futuna",
								    "dial_code"=> "+681",
								    "code"=> "WF"
								  ),
								  array(
								    "name"=> "Yemen",
								    "dial_code"=> "+967",
								    "code"=> "YE"
								  ),
								  array(
								    "name"=> "Zambia",
								    "dial_code"=> "+260",
								    "code"=> "ZM"
								  ),
								  array(
								    "name"=> "Zimbabwe",
								    "dial_code"=> "+263",
								    "code"=> "ZW"
								  )
								);
		return $response;
	}//end function




	


}





?>