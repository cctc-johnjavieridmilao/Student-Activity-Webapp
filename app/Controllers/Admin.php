<?php namespace App\Controllers;

use App\Models\UserModel;
use App\Models\DepartmentModel;

class Admin extends BaseController
{
	public function index() {
		if($this->session->has('u_id')) {
			return view('Admin/DashBoard');
		}
		return view('index');
	}

	public function Dashboard() {
		if($this->session->has('u_id')) {
			return view('Admin/DashBoard');
		}
		return view('index');
	}
	
	public function Setting() {
		if($this->session->has('u_id')) {
			return view('Admin/Setting');
		}
		return view('index');
	}

	public function Announcement() {
		if($this->session->has('u_id')) {
			return view('Admin/Announcement');
		}
		return view('index');
	}

	public function UserManagement() {
		if($this->session->has('u_id')) {
			return view('Admin/UserManagement');
		}
		return view('index');
	}

	public function DepartmentManagement() {
		if($this->session->has('u_id')) {
			return view('Admin/DepartmentManagement');
		}
		return view('index');
	}

	public function Profile() {
		if($this->session->has('u_id')) {
			return view('Admin/Profile');
		}
		return view('index');
	}

	public function GetProfile() {
		$user = $this->session->get('u_id');
		$user_model = new UserModel();

		return $this->response->setJSON($user_model->where('RecID', $user)->findAll());
	}

	public function GetUsers() {
        $user_model = new UserModel();

        return $this->response->setJSON($user_model->findAll());
    }

	public function GetDepartment() {
		$DepartmentModel = new DepartmentModel();

		return $this->response->setJSON($DepartmentModel->where('IsActive', 1)->findAll());
	}

	public function getDashboard() {

		$str = "SELECT A.count_activity,B.count_student,C.count_teacher,D.count_user FROM(
			(SELECT COUNT(*) count_activity FROM tbl_student_activities) A,
			(SELECT COUNT(*) count_student FROM user_access WHERE user_type = 'student') B,
			(SELECT COUNT(*) count_teacher FROM user_access WHERE user_type = 'teacher') C,
			(SELECT COUNT(*) count_user FROM user_access) D )";
		
		$query = $this->db->query($str);

		if(!$query) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON($query->getResultArray());
	}

	public function DeleteUser() {
        $user_model = new UserModel();

		$res = $user_model->delete($this->request->getVar('id'));

		if(!$res) {
			return $this->response->setJSON(['msg' => $res]);
		}
		return $this->response->setJSON(['msg' => 'success']);
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

	public function ApprovedAccount() {

		$user = intval($this->request->getVar('u_id'));
		$user_model = new UserModel();

		$user = $user_model->find($user);

		$res = $user_model->update($user, [
			'Status' => 1
		]);

		if(!$res) {
			return $this->response->setJSON(['msg' => $res]);
		}
		return $this->response->setJSON(['msg' => 'success']);

	}

	public function DisApprovedAccount() {

		$user = intval($this->request->getVar('u_id'));
		$user_model = new UserModel();

		$user = $user_model->find($user);

		$res = $user_model->update($user, [
			'Status' => 2
		]);

		if(!$res) {
			return $this->response->setJSON(['msg' => $res]);
		}
		return $this->response->setJSON(['msg' => 'success']);

	}

	public function RegisterAccount() {
		$user_model = new UserModel();

		$data = [
			'firtname'   => $this->request->getVar('fname'),
			'lastname'   => $this->request->getVar('lname'),
			'username'   => $this->request->getVar('username'),
			'email'      => $this->request->getVar('email'),
			'phone_number'  => $this->request->getVar('phone_number'),
			'middlename' => $this->request->getVar('mname'),
			'password'   => hashPassword($this->request->getVar('password')),
			'user_type'  =>  $this->request->getVar('role'),
			'lat'        => $this->request->getVar('lat'),
			'lang'       => $this->request->getVar('lang'),
			'Department'       => $this->request->getVar('department'),
			'StudentID'       => $this->request->getVar('studentid'),
			'Status'     => 1,
			'created_at' => date('Y-m-d H:i:s')
		];

		$res = $user_model->insert($data);

		$name = $this->request->getVar('fname') . ' ' . $this->request->getVar('mname') . ' ' . $this->request->getVar('lname');
		$user_id = $user_model->getInsertID();

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

	public function SaveDepartment() {
		$DepartmentModel = new DepartmentModel();

		$res = $DepartmentModel->insert([
			'DeptName'    => $this->request->getVar('DeptName'),
			'IsActive'    => 1,
			'Created_at'  => date('Y-m-d H:i:s')
		]);

		if($res) {
			return $this->response->setJSON([
				'msg' => 'success'
			]);
		}

		return $this->response->setJSON(['msg' => $res]);
	}

	public function SaveAnnouncement() {
		$user = $this->session->get('u_id');
		$now = date('Y-m-d H:i:s');

		$res = $this->db->table('tbl_announcement')->insert([
			'subject' => $this->request->getVar('subject'),
			'description' => $this->request->getVar('description'),
			'created_by' => $user,
			'created_at' => $now,
		]);

		if(!$res) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON(['msg' => 'success']);
	}

	public function GetAnnouncement() {

		//$user = intval($this->session->get('u_id'));

		$str = "SELECT * FROM tbl_announcement ORDER BY RecID DESC";
		
		$query = $this->db->query($str);

		if(!$query) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON($query->getResultArray());
	}

	public function GetAnnouncementByID() {

		//$user = intval($this->session->get('u_id'));

		$id = $this->request->getVar('id');

		$str = "SELECT * FROM tbl_announcement WHERE RecID = $id";
		
		$query = $this->db->query($str);

		if(!$query) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON($query->getResultArray());
	}

	public function UpdatedAnnouncement() {
		$id = $this->request->getVar('id');

		$res = $this->db->table('tbl_announcement')->where(['RecID' => $id])->update([
			'subject' => $this->request->getVar('subject'),
			'description' => $this->request->getVar('description'),
		]);

		if(!$res) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON(['msg' => 'success']);
	}

	public function DeleteAnnouncement() {
		$id = $this->request->getVar('id');

		$str = "DELETE FROM tbl_announcement WHERE RecID = $id";
		
		$query = $this->db->query($str);

		if(!$query) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON(['msg' => 'success']);
	}

	public function UpdateDepartment() {

		$dept_id = $this->request->getVar('dept_id');

		$res = $this->db->table('tbl_department')->where(['DeptID' => $dept_id])->update([
			'DeptName' => $this->request->getVar('DeptName')
		]);

		if(!$res) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON(['msg' => 'success']);

	}

	public function DeleteDepartment() {
		$id = $this->request->getVar('id');

		$str = "DELETE FROM tbl_department WHERE DeptID = $id";
		
		$query = $this->db->query($str);

		if(!$query) {
			return $this->response->setJSON(['msg' => $this->db->error()]);
		}

		return $this->response->setJSON(['msg' => 'success']);
	}

}
