<?php namespace App\Controllers;

use App\Models\UserModel;
use App\Models\AnswerTypeModel;
use App\Models\ActivityModel;

class TeacherController extends BaseController
{
	public function index() {
		if($this->session->has('u_id')) {
			return view('Teacher/Dashboard');
		}
		return view('index');
	}

	public function MyCalendar() {
		if($this->session->has('u_id')) {
			return view('Teacher/Dashboard');
		}
		return view('index');
	}

	public function Announcement() {
		if($this->session->has('u_id')) {
			return view('Teacher/Announcement');
		}
		return view('index');
	}

	public function Setting() {
		if($this->session->has('u_id')) {
			return view('Teacher/Setting');
		}
		return view('index');
	}

	public function ActivityLists() {
		if($this->session->has('u_id')) {
			return view('Teacher/ActivityLists');
		}
		return view('index');
	}

	public function CreateActivity() {
		if($this->session->has('u_id')) {
			return view('Teacher/CreateActivity');
		}
		return view('index');
	}

	public function Profile() {
		if($this->session->has('u_id')) {
			return view('Teacher/Profile');
		}
		return view('index');
	}

	public function VerifyAnswers($id) {
		if($this->session->has('u_id')) {

			$data['id'] = $id;

			return view('Teacher/VerifyAnswers', $data);
		}
		return view('index');
	}

	public function GetAnswerType() {
		$AnswerTypeModel = new AnswerTypeModel();

		return $this->response->setJSON($AnswerTypeModel->where('IsActive', 1)->findAll());
	}

	public function getStudents() {
		$user_model = new UserModel();

        return $this->response->setJSON($user_model->where('user_type','student')->findAll());
	}

	public function GetProfileData() {
		$u_id = $this->session->get('u_id');

		$str = "SELECT X.*,D.DeptName FROM user_access X 
		LEFT JOIN tbl_department D ON D.DeptID = X.Department
	   WHERE X.RecID = $u_id";
		
		$query = $this->db->query($str);

		if(!$query) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON($query->getResultArray());
	}

	public function getActivityName() {
		$id = $this->request->getVar('id');

		$str = "SELECT * FROM tbl_student_activities WHERE RecID = $id";
		
		$query = $this->db->query($str);

		if(!$query) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON($query->getResultArray());
	}

	public function getActivity() {

		$user = intval($this->session->get('u_id'));

		$str = "SELECT X.RecID,X.ActivityName,X.Description,X.StartDate,X.EndDate,X.Created_at,
					CONCAT(U.firtname, ' ',U.middlename, ' ',U.lastname) fullname,
					(SELECT COUNT(*) FROM tbl_student_activity_questions WHERE ActivityID = X.RecID) count_students
					FROM tbl_student_activities X
					INNER JOIN user_access U ON U.RecID = X.Create_by
					WHERE X.Create_by = $user";
		
		$query = $this->db->query($str);

		if(!$query) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON($query->getResultArray());
	}

	public function getDashboard() {
		
		$user = intval($this->session->get('u_id'));

		$str = "SELECT A.count_activity,B.count_student FROM(
			(SELECT COUNT(*) count_activity FROM tbl_student_activities WHERE Create_by = $user) A,
			(SELECT COUNT(*) count_student FROM user_access WHERE user_type = 'student')B);";
		
		$query = $this->db->query($str);

		if(!$query) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON($query->getResultArray());
	}

	public function getStudentActivities() {

		$id = $this->request->getVar('id');

		$str = "SELECT X.RecID,X.ActivityID,X.Status,X.Created_at,X.DateAnswered,X.StudentID StudentUserid,
					CONCAT(U.firtname, ' ',U.middlename, ' ',U.lastname) fullname,U.StudentID,D.DeptName,
					(SELECT COUNT(1) count_question FROM tbl_activity_question_answered 
					WHERE ActivityID = X.ActivityID AND AnsweredBy = X.StudentID) count_question,
					(SELECT COUNT(1) count_question FROM tbl_activity_question_answered 
					WHERE ActivityID = X.ActivityID AND AnsweredBy = X.StudentID AND IsCheck = 1) count_check
					FROM tbl_student_activity_questions X
				INNER JOIN user_access U ON U.RecID = X.StudentID
				LEFT JOIN tbl_department D ON D.DeptID = U.Department
				WHERE X.ActivityID = $id";
		
		$query = $this->db->query($str);

		if(!$query) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON($query->getResultArray());
	}

	public function getStudentActivityResult() {
		$ActivityID = $this->request->getVar('activity');
		$Student = $this->request->getVar('studentid');

		$str = "SELECT * FROM tbl_activity_question_answered WHERE ActivityID = $ActivityID AND AnsweredBy = $Student";
		
		$query = $this->db->query($str);

		if(!$query) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON($query->getResultArray());
	}

	public function SetIsCheck() {

		$id = $this->request->getVar('id');

		$this->db->table('tbl_activity_question_answered')
		->where(['RecID' => $id])
		->update([
			'IsCheck' => 1,
			'IsWrong' => 0
		]);

		return $this->response->setJSON(['msg' => 'success']);

	}

	public function SetIsWrong() {
		$id = $this->request->getVar('id');

		$this->db->table('tbl_activity_question_answered')
		->where(['RecID' => $id])
		->update([
			'IsWrong' => 1,
			'IsCheck' => 0
		]);

		return $this->response->setJSON(['msg' => 'success']);
	}

	public function UpdateStudentActivity() {
		$activityid = $this->request->getVar('activityid');
		$studentid = $this->request->getVar('studentid');

		$this->db->table('tbl_student_activity_questions')
		->where(['ActivityID' => $activityid, 'StudentID' => $studentid])
		->update([
			'Status' => 'Validated'
		]);

		return $this->response->setJSON(['msg' => 'success']);
	}

	public function SaveActivity() {
		$ActivityModel = new ActivityModel();

		$students = explode(',', $this->request->getVar('students'));
		$user = intval($this->session->get('u_id'));

		$res = $ActivityModel->insert([
			'ActivityName' => $this->request->getVar('activity_name'),
			'Description' => $this->request->getVar('description'),
			'StartDate' => $this->request->getVar('start_date'),
			'EndDate' => $this->request->getVar('end_date'),
			'Created_at' => date('Y-m-d H:i:s'),
			'Create_by' => $user
		]);

		$ActivityID = $ActivityModel->getInsertID();

		foreach($students as $student) {

			$this->db->table('tbl_student_activity_questions')->insert([
				'ActivityID' => $ActivityID,
				'StudentID' => $student,
				'Questions' => $this->request->getVar('questions'),
				'Created_at' => date('Y-m-d H:i:s')
			]);

		}

		return $this->response->setJSON(['msg' => 'success']);
	}

}
