<?php

use App\Services\Task;
use App\Services\Helpers;

require_once 'app/Services/Helpers.php';
require_once 'app/Services/Task.php';

class TaskController
{
	public $task;
	public function __construct()
	{
		$this->task = new Task();
	}

	/**
	 * This function is used to fetch all task from the database
	 * @return array
	 */
	public function getAll()
	{
		return $this->task->fetchAllTask();
	}

	/**
	 * This function returns a single task by id
	 * @return array
	 */
    public function getTaskById($id)
    {
		if (!empty($id)) {
			return $this->task->fetchTaskById($id);
		}
		return false;
    }

	/**
	 * This function returns a single task by slug
	 * @return array
	 */
    public function getTaskBySlug($slug)
    {
		if (!empty($slug)) {
			return $this->task->fetchTaskBySlug($slug);
		}
		return false;
    }

	/**
	 * This function is used to create task
	 */
	public function createTask($data)
	{
		if(isset($data['btnAddTask'])){
			$this->validateSession($data['csrfToken']);

			$data['slug'] = Helpers::randomString(10);

			// perform file upload
			$data['flImage'] = Helpers::uploadImage($_FILES['flImage']);

			if ($this->task->addTask($data)) {
				header('location: manage-task');
			}
		}
	}

	/**
	 * This function is used to delete a task
	 */
	public function deleteTask($data)
	{
		if (isset($data['delete']) && !empty($data['delete'])) {
			$this->task->deleteTask($data['delete']);
			header('location: manage-task');
		}
		return null;
	}

	/**
	 * This function is used to validate user session token
	 * @param string $token
	 */
	private function validateSession($token)
	{
		if ($_SESSION['CSRF'] !== $token) {
			session_unset();
			session_destroy();
			header('Location: 419');
		}
	}
}

?>