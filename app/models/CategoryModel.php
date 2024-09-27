<?php

class CategoryModel
{
  private $__conn;

  public function __construct($conn)
  {
    $this->__conn = $conn;
  }

  public function getAllCategories($limit = 100, $offset = 0)
  {
    try {
      if (isset($this->__conn)) {
        $sql = "SELECT * FROM categories ORDER BY id DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->__conn->prepare($sql);
        $stmt->bindParam("limit", $limit, PDO::PARAM_INT);
        $stmt->bindParam("offset", $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
      }
      echo "no connection";
      return null;
    } catch (PDOException $ex) {
      echo $ex->getMessage();
    }
  }


  public function getCategoryById($id)
  {
    try {
      if (isset($this->__conn)) {
        $sql = "SELECT * FROM categories WHERE id = :id";
        $stmt = $this->__conn->prepare($sql);
        $stmt->bindParam("id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
      }
      echo "no connection";
      return null;
    } catch (PDOException $ex) {
      echo $ex->getMessage();
    }
  }


  public function saveCategoryToDB($name)
  {
    try {
      if (isset($this->__conn)) {
        $sql = "INSERT INTO categories (name) VALUES (:name)";
        $stmt = $this->__conn->prepare($sql);
        $stmt->bindParam("name", $name, PDO::PARAM_STR);
        $stmt->execute();
      }
      return null;
    } catch (PDOException $ex) {
      echo $ex->getMessage();
    }
  }


  public function updateCategoryById($id, $name)
  {
    try {
      if (isset($this->__conn)) {
        $sql = "UPDATE categories SET name = :name WHERE id = :id";
        $stmt = $this->__conn->prepare($sql);
        $stmt->bindParam("name", $name, PDO::PARAM_STR);
        $stmt->bindParam("id", $id, PDO::PARAM_INT);
        $stmt->execute();
      }
      return null;
    } catch (PDOException $ex) {
      echo $ex->getMessage();
    }
  }


  public function deleteCategoryById($id)
  {
    try {
      if (isset($this->__conn)) {
        $sql = "DELETE FROM categories WHERE id = :id";
        $stmt = $this->__conn->prepare($sql);
        $stmt->bindParam('id', $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
          echo "Category with ID $id has been deleted successfully.";
        } else {
          echo "No Category found with ID $id";
        }
      }
      return null;
    } catch (PDOException $ex) {
      echo $ex->getMessage();
    }
  }
}
