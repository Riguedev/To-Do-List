<?php

class DataBaseConnection {

    public static function dbConnection() {
        try {
            $dsn = "mysql:host={$_ENV['DB_HOST']};port={$_ENV['DB_PORT']};dbname={$_ENV['DB_NAME']}";
            $dataBase = new PDO($dsn, $_ENV["DB_USER"] , $_ENV["DB_PASS"]);
            return $dataBase;
        }
        catch(PDOException $error) {
            print_r($error);
        }
    }

    public static function createUser($userData) {
        $dbConnection = self::dbConnection();
        try {
            $sql = "INSERT INTO Users (name, email, password) VALUES (:name, :email, :password)";
            $stmt = $dbConnection->prepare($sql);
            $stmt->bindParam(":name", $userData["name"]);
            $stmt->bindParam(":email", $userData["email"]);
            $stmt->bindParam(":password", $userData["pass"]);
            $stmt->execute();
            return true;
            
        }catch(PDOException $e) {
            echo $e;
        }
    }

    public static function loginUser($userData) {
        $dbConnection = self::dbConnection();
        try {
            $sql = "SELECT * FROM Users WHERE email = :email AND password = :pass";
            $stmt = $dbConnection->prepare($sql);
            $stmt->bindParam(":email", $userData["email"]);
            $stmt->bindParam(":pass", $userData["pass"]);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result[0];
        } catch(PDOException $e) {
            echo $e;
        }
    }

    public static function getUserTask($userId) {
        $dbConnection = self::dbConnection();
        try {
            $sql = "SELECT task_id, task, complete FROM Tasks WHERE creator_id = :creator_id";
            $stmt = $dbConnection->prepare($sql);
            $stmt->bindParam(":creator_id", $userId);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        } catch(PDOException $e) {
            echo $e;
        }
    }

    public static function createUserTask($taskData) {
        $dbConnection = self::dbConnection();
        try {
            $sql = "INSERT INTO Tasks (task, creator_id) VALUES (:task, :creator_id)";
            $stmt = $dbConnection->prepare($sql);
            $stmt->bindParam(":task", $taskData["task"]);
            $stmt->bindParam(":creator_id", $taskData["creator_id"]);
            $stmt->execute();
            
            $lastInsertId = $dbConnection->lastInsertId();

            $sql = "SELECT * FROM Tasks WHERE task_id = :task_id";
            $stmt = $dbConnection->prepare($sql);
            $stmt->bindParam(":task_id", $lastInsertId);
            $stmt->execute();

            $newTask = $stmt->fetch(PDO::FETCH_ASSOC);

            return $newTask;
        } catch(PDOException $e) {
            echo $e;
        }
    }

    public static function updateTaskState($taskData) {
        $dbConnection = DataBaseConnection::dbConnection();
        try {
            $state = 0;
            ($taskData["complete"] === 0) ? $state = 1 : $state = 0;

            $sql = "UPDATE Tasks SET complete = :complete WHERE task_id = :task_id";
            $stmt = $dbConnection->prepare($sql);
            $stmt->bindParam(":complete", $state);
            $stmt->bindParam(":task_id", $taskData["task_id"]);
            
            if($stmt->execute()) {
                $sql = "SELECT task_id, complete FROM Tasks WHERE task_id = :task_id";
                $stmt = $dbConnection->prepare($sql);
                $stmt->bindParam(":task_id", $taskData["task_id"]);
                $stmt->execute();

                $response = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $response[0];
            }
        } catch(PDOException $e) {
            echo $e;
        }
    }

    public static function deleteTask($taskId, $creatorId) {
        $dbConnection = DataBaseConnection::dbConnection();

        try {
            $sql = "DELETE FROM Tasks WHERE task_id = :task_id AND creator_id = :creator_id";
            $stmt = $dbConnection->prepare($sql);
            $stmt->bindParam(":task_id", $taskId);
            $stmt->bindParam(":creator_id", $creatorId);
            if($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e;
        }
    }
}