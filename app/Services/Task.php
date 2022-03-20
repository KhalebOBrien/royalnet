<?php
namespace App\Services;

use App\Middleware\DatabaseConnetion;

require_once 'app/Middleware/DatabaseConnetion.php';

class Task extends DatabaseConnetion
{
	public function __Construct()
	{
        parent::__construct();
	}

    /**
     * This function is used to fetch all task from the database
     * @return array
     */
    public function fetchAllTask()
    {
        $sql = "SELECT * FROM tasks";
        $q = $this->dbconn->query($sql);
        $result = $q->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * This function is used to fetch a task by id
     * @param int $id
     * @return array
     */
    public function fetchTaskById($id)
    {
        $sql = "SELECT * FROM tasks WHERE id = ".$id;
        $q = $this->dbconn->query($sql);
        $result = $q->fetch(\PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * This function is used to fetch a task by slug
     * @param string $slug
     * @return array
     */
    public function fetchTaskBySlug($slug)
    {
        $sql = "SELECT * FROM tasks WHERE slug = '".$slug."'";
        $q = $this->dbconn->query($sql);
        $result = $q->fetch(\PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * This function is used to add task to database
     * @param array $data
     * @return int
     */
    public function addTask($data)
    {
		try {
            $sql = "INSERT INTO tasks (created_by, slug, title, body, image, created_at, updated_at) VALUES (:created_by, :slug, :title, :body, :image, NOW(), NOW())";
            $q = $this->dbconn->prepare($sql);
            $q->execute(array(
                ':created_by' => $_SESSION['user']['id'],
                ':slug' => $data['slug'],
                ':title' => $data['txtTitle'],
                ':body' => htmlentities(trim($data['txtBody']), ENT_QUOTES, 'UTF-8'),
                ':image' => $data['flImage']
            ));

            return $this->dbconn->lastInsertId();
        }
        catch (\PDOException $ex)
        {
            echo ($ex->getMessage() . ' ' . $ex->getCode() . ' ' . $ex->getFile() . ' ' . $ex->getLine());
            exit();
        }
    }

    /**
     * This function is used to update a task
     * @param  int $id
     * @param  array $data
     * @return boolean
     */
    public function updateTask($id, $data)
    {
        try {
            $sql = "UPDATE tasks SET bank = :bank, acct_number = :acct_number, yt_link = :yt_link, updated_at = NOW() WHERE id = :id";
            $q = $this->dbconn->prepare($sql);
            $q->execute([
                ':bank' => $data['slBank'],
                ':acct_number' => $data['txtAcctNumber'],
                ':acct_name' => $data['txtAcctName'],
                ':id' => $id
            ]);

            return true;
        } 
        catch (\PDOException $ex)
        {
            echo ($ex->getMessage() . ' ' . $ex->getCode() . ' ' . $ex->getFile() . ' ' . $ex->getLine());
            exit();
        }
    }

    /**
     * This function is used to delete a task
     * @param  string $slug
     * @param  boolean
     */
    public function deleteTask($slug)
    {
        try {
            $sql = "DELETE FROM tasks WHERE slug = :slug";
            $q = $this->dbconn->prepare($sql);
            $q->execute([
                ':slug' => $slug
            ]);

            return true;
        } 
        catch (\PDOException $ex)
        {
            echo ($ex->getMessage() . ' ' . $ex->getCode() . ' ' . $ex->getFile() . ' ' . $ex->getLine());
            exit();
        }
    }

}

?>