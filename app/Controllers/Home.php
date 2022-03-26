<?php namespace App\Controllers;

use App\Models\UserModel;
use App\Models\Notifiers;

class Home extends BaseController
{
	public function index() {
		if($this->session->has('u_id')) {
			return view('User/Dashboard');
		}
		return view('index');
	}

	public function RegisterView() {
		if($this->session->has('u_id')) {
			return view('User/Dashboard');
		}
		return view('register');

	}

	public function VerificationCode() {

		return view('verification_code');

	}

	public function LoginView() {
		if($this->session->has('u_id')) {
			return view('User/Dashboard');
		}
		return view('index');

	}

	public function MyCalendar() {
		if($this->session->has('u_id')) {
			return view('User/Dashboard');
		}
		return view('index');
	}

	public function Announcement() {
		if($this->session->has('u_id')) {
			return view('User/Announcement');
		}
		return view('index');
	}

	public function MyActivity() {
		if($this->session->has('u_id')) {
			return view('User/MyActivity');
		}
		return view('index');
	}

	public function AnsweredActivity() {
		if($this->session->has('u_id')) {
			return view('User/AnsweredActivity');
		}
		return view('index');
	}

	public function Profile() {
		if($this->session->has('u_id')) {
			return view('User/Profile');
		}
		return view('index');
	}

	public function Setting() {
		if($this->session->has('u_id')) {
			return view('User/Setting');
		}
		return view('index');
	}

	public function StudentManual() {
		if($this->session->has('u_id')) {
			return view('User/StudentManual');
		}
		return view('index');
	}

	public function IsuMap() {
		if($this->session->has('u_id')) {
			return view('User/IsuMap');
		}
		return view('index');
	}

	public function ProfessorProfile() {
		if($this->session->has('u_id')) {
			return view('User/ProfessorProfile');
		}
		return view('index');
	}
	

	public function AnswerActivityView($id) {
		if($this->session->has('u_id')) {

			$data['id'] = $id;

			return view('User/AnswerActivity', $data);
		}
		return view('index');
	}

	public function GetProfile() {
		$user = $this->session->get('u_id');
		$user_model = new UserModel();

		return $this->response->setJSON($user_model->where('RecID', $user)->findAll());
	}

	public function UploadProfile() {

		$user = $this->session->get('u_id');

		$file = $this->request->getFile('file');

		if (!empty($file)) {

			$file_name = $file->getRandomName();
 
			$file->move('./public/uploads/', $file_name);

			$this->db->table('user_access')
				->where(['RecID' => $user])
				->update([
					'profile' => $file_name
			]);

			$this->session->set('profile', $file_name);

			return $this->response->setJSON(['msg' => 'success','image' => $file_name]);
		}

	}

	public function AnswerMyActivity() {
		$user = $this->session->get('u_id');

		$answers = json_decode($this->request->getVar('answers'), true);

		foreach($answers as $answer) {
			$this->db->table('tbl_activity_question_answered')->insert([
				'ActivityID' => intval($answer['ActivityID']),
				'QuestionName' => $answer['question_name'],
				'QuestionID' => intval($answer['question_id']),
				'Answer' => $answer['answer'],
				'AnsweredBy' => $user
			]);
		}

		$this->db->table('tbl_student_activity_questions')
		->where(['ActivityID' => $this->request->getVar('ActivityID'),'StudentID' => $user])
		->update([
			'Status' => 'Answered',
			'DateAnswered' => date('Y-m-d H:i:s')
		]);

		return $this->response->setJSON(['msg' => 'success']);
		
	}

	public function getMyActivity() {

		$user = intval($this->session->get('u_id'));

		$str = "SELECT X.RecID,X.ActivityName,X.Description,X.StartDate,X.EndDate,X.Created_at,
		CONCAT(U.firtname, ' ',U.middlename, ' ',U.lastname) teacher,S.Questions,S.Status
		FROM tbl_student_activities X
		INNER JOIN user_access U ON U.RecID = X.Create_by
		INNER JOIN tbl_student_activity_questions S ON S.ActivityID = X.RecID
		WHERE S.StudentID = $user AND S.Status = 'Pending'";
		
		$query = $this->db->query($str);

		if(!$query) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON($query->getResultArray());
	}

	public function getDashboard() {
		$user = intval($this->session->get('u_id'));

		$str = "SELECT A.count_all,B.count_pending,C.count_asnwered FROM (
			(SELECT COUNT(*) count_all FROM tbl_student_activity_questions WHERE StudentID = $user) A,
			(SELECT COUNT(*) count_pending FROM tbl_student_activity_questions WHERE StudentID = $user AND Status = 'Pending') B,
			(SELECT COUNT(*) count_asnwered FROM tbl_student_activity_questions WHERE StudentID = $user AND Status IN('Validated','Answered')) C)";
		
		$query = $this->db->query($str);

		if(!$query) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON($query->getResultArray());
	}

	public function getMyAnsweredActivity() {

		$user = intval($this->session->get('u_id'));

		$str = "SELECT X.RecID,X.ActivityID,X.Status,X.Created_at,X.DateAnswered,X.StudentID StudentUserid,
					CONCAT(U.firtname, ' ',U.middlename, ' ',U.lastname) student_fullname,U.StudentID,D.DeptName,
					(SELECT COUNT(1) count_question FROM tbl_activity_question_answered 
					WHERE ActivityID = X.ActivityID AND AnsweredBy = X.StudentID) count_question,
					(SELECT COUNT(1) count_question FROM tbl_activity_question_answered 
					WHERE ActivityID = X.ActivityID AND AnsweredBy = X.StudentID AND IsCheck = 1) count_check,
					T.ActivityName,T.Description,T.StartDate,T.EndDate,
					CONCAT(UU.firtname, ' ',UU.middlename, ' ',UU.lastname) teacher_fullname
					FROM tbl_student_activity_questions X
				INNER JOIN user_access U ON U.RecID = X.StudentID
				INNER JOIN tbl_student_activities T ON T.RecID = X.ActivityID
				INNER JOIN user_access UU ON UU.RecID = T.Create_by
				LEFT JOIN tbl_department D ON D.DeptID = U.Department
				WHERE X.Status IN('Validated','Answered') AND X.StudentID = $user";
		
		$query = $this->db->query($str);

		if(!$query) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON($query->getResultArray());
	}

	public function getActivityQuestion() {
		$user = intval($this->session->get('u_id'));
		$id = $this->request->getVar('id');

		$str = "SELECT X.Questions,S.ActivityName,S.Description FROM tbl_student_activity_questions X 
		INNER JOIN tbl_student_activities S ON S.RecID = X.ActivityID
	   WHERE X.StudentID = $user AND X.ActivityID = $id";
		
		$query = $this->db->query($str);

		if(!$query) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON($query->getResultArray());
	}

	public function RegisterAccount() {
		$user_model = new UserModel();

		$notif = new Notifiers();

		$str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$shuffle = str_shuffle($str);
		$code = substr($shuffle, 1, 6);

		$data = [
			'firtname'   => $this->request->getVar('fname'),
			'lastname'   => $this->request->getVar('lname'),
			'username'   => $this->request->getVar('username'),
			'email'      => $this->request->getVar('email'),
			'phone_number'  => $this->request->getVar('phone_number'),
			'middlename' => $this->request->getVar('mname'),
			'password'   => hashPassword($this->request->getVar('password')),
			'user_type'  => 'student',
			'Department'        => $this->request->getVar('department'),
			'StudentID'        => $this->request->getVar('studentid'),
			'lat'        => $this->request->getVar('lat'),
			'lang'       => $this->request->getVar('lang'),
			'created_at' => date('Y-m-d H:i:s'),
			'Status' => 0,
		];

		$res = $user_model->insert($data);

		$name = $this->request->getVar('fname') . ' ' . $this->request->getVar('mname') . ' ' . $this->request->getVar('lname');
		$user_id = $user_model->getInsertID();

		$this->session->set('user_id', $user_id);

		$notif->SendEmailNotification($this->request->getVar('email'), 'Verification Code', 'Hi '.$this->request->getVar('email').', this is yor verification code: '.$code);

		if($res) {
			return $this->response->setJSON([
				'msg' => 'success',
				'user_type' => 'user',
				'email' => $this->request->getVar('email'),
				'username' => $this->request->getVar('username'),
				'phone_number' => $this->request->getVar('phone_number'),
				'name' => $name,
				'user_id' => $user_id
			]);
		}

		return $this->response->setJSON(['msg' => $res]);
	}

	public function VerifyCode() {

		$code = $this->request->getVar('code');

		$user_id = $this->session->get('user_id');

		$str = 'SELECT * FROM user_access WHERE RecID = :id: AND verification_code = :code:';

		$query = $this->db->query($str, ['id' => $user_id,'code' => $code ]);

		if(!$query) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		if($query->getNumRows() == 0) {
			return $this->response->setJSON(['msg' => 'Invalid Verification Code']);
		} 

		$res = $this->db->table('user_access')->where(['RecID' => $user_id])->update([
			'Status' => 1
		]);

		if($res) {

			$this->session->remove('user_id');

			return $this->response->setJSON([
				'msg' => 'success'
			]);
		}

		return $this->response->setJSON(['msg' => $res]);

	}

	public function ResendCode() {

		$user_id = $this->session->get('user_id');

		$notif = new Notifiers();

		$str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$shuffle = str_shuffle($str);
		$code = substr($shuffle, 1, 6);

		$str = 'SELECT * FROM user_access WHERE RecID = :id:';
		$query = $this->db->query($str, ['id' => $user_id]);
		$row = $query->getRow();

		$email = $row->email;

		$this->db->table('user_access')->where(['RecID' => $user_id])->update([
			'verification_code' => $code
		]);

		$notif->SendEmailNotification($email, 'New Verification Code', 'Hi '.$email.', this is yor verification code: '.$code);

		return $this->response->setJSON(['msg' => 'success']);

	}
 
	public function Login() {
		$u_username = $this->request->getVar('u_username');
		$u_pass = hashPassword($this->request->getVar('u_pass'));
		$str = 'SELECT * FROM user_access WHERE username = :username: AND password = :password: AND Status = 1';

		$query = $this->db->query($str, [
			'username' => $u_username,
			'password' => $u_pass
		]);

		if(!$query) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		if($query->getNumRows() == 0) {
			return $this->response->setJSON(['msg' => 'Invalid username and password or Account not yet activated!']);
		} 

		$row = $query->getRow();

		$this->session->set('u_id', $row->RecID);
		$this->session->set('user_type', $row->user_type);
		$this->session->set('profile', $row->profile);
		$this->session->set('fname', strtoupper($row->firtname));
		$this->session->set('lastname', strtoupper($row->lastname));
		$this->session->set('middlename', strtoupper($row->middlename));

		$this->db->table('user_access')->where(['RecID' => $row->RecID])->update([
			'lat' => $this->request->getVar('lat'),
			'lang' => $this->request->getVar('lang')
		]);

		return $this->response->setJSON(['msg' => 'success','fname' => $row->firtname, 'user_type' => $row->user_type, 'user_id' => $row->RecID]);
	}

	public function UpdateProfile() {
		$user = $this->session->get('u_id');
		$user_model = new UserModel();

		$res = $user_model->update($user, [
			'firtname' => $this->request->getVar('firstname'),
			'lastname' => $this->request->getVar('lastname'),
			'middlename' => $this->request->getVar('middlename'),
			'email' => $this->request->getVar('email'),
			'username' => $this->request->getVar('username'),
			'phone_number' => $this->request->getVar('phone_number'),
		]);

		if(!$res) {
			return $this->response->setJSON(['msg' => $res]);
		}
		return $this->response->setJSON(['msg' => 'success']);
	}

	public function UpdatePassword() {
		$user = $this->session->get('u_id');
		$user_model = new UserModel();
		$current_pass = hashPassword($this->request->getVar('current_pass'));

		$user = $user_model->find($user);

		if($user['password'] != $current_pass) {
			return $this->response->setJSON(['msg' => 'Current password not found!']);
		}

		$res = $user_model->update($user, [
			'password' => hashPassword($this->request->getVar('new_pass'))
		]);

		if(!$res) {
			return $this->response->setJSON(['msg' => $res]);
		}
		return $this->response->setJSON(['msg' => 'success']);
		
	}

	public function sedmail() {
		$notif = new Notifiers();

		$notif->SendEmailNotification('johnjavieridmilao12@gmail.com', 'TASK', 'Hi johnjavieridmilao12@gmail.com, You created a  today, please check your calendar.');
	}

	public function CreateTask() {
		$user = $this->session->get('u_id');
		$now = date('Y-m-d H:i:s');
		$notif = new Notifiers();
		$user_model = new UserModel();

		$user_find = $user_model->find($user);

		$res = $this->db->table('tbl_task')->insert([
			'type' => $this->request->getVar('task_type'),
			'title' => $this->request->getVar('title'),
			'color' => $this->request->getVar('task_color'),
			'start_date' => $this->request->getVar('date_start'),
			'end_date' => $this->request->getVar('end_start'),
			'description' => $this->request->getVar('description'),
			'created_by' => $user,
			'created_at' => $now,
		]);

		if(!$res) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		$notif->SendEmailNotification($user_find['email'], 'TASK', 'Hi '.$user_find['email'].', You created a '.$this->request->getVar('task_type').' today, please check your calendar.');

		return $this->response->setJSON(['msg' => 'success']);
	}

	public function GetTask() {

		$user = intval($this->session->get('u_id'));

		$str = "SELECT * FROM tbl_task WHERE created_by = $user";
		
		$query = $this->db->query($str);

		if(!$query) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON($query->getResultArray());
	}

	public function GetTaskByID() {
		
		$user = intval($this->session->get('u_id'));
		$id = $this->request->getVar('id');

		$str = "SELECT * FROM tbl_task WHERE RecID = $id";
		
		$query = $this->db->query($str);

		if(!$query) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON($query->getResultArray());
	}

	public function DeleteTask() {
		$id = $this->request->getVar('id');

		$str = "DELETE FROM tbl_task WHERE RecID = $id";
		
		$query = $this->db->query($str);

		if(!$query) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON(['msg' => 'success']);
	}

	public function UpdateTask() {

		$id = $this->request->getVar('id');

		$res = $this->db->table('tbl_task')->where(['RecID' => $id])->update([
			'type' => $this->request->getVar('task_type'),
			'title' => $this->request->getVar('title'),
			'color' => $this->request->getVar('task_color'),
			'start_date' => $this->request->getVar('date_start'),
			'end_date' => $this->request->getVar('end_start'),
			'description' => $this->request->getVar('description')
		]);

		if(!$res) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON(['msg' => 'success']);

	}


	public function Logout() {
		$this->session->remove('u_id');
		$this->session->remove('user_type');
		$this->session->remove('fname');
		$this->session->remove('lastname');
		$this->session->remove('middlename');
		$this->session->destroy();

		return view('index');
	}

}
