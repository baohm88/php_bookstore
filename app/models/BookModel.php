<?php

class BookModel
{
    private $__conn;

    public function __construct($conn)
    {
        $this->__conn = $conn;
    }

    public function getAllBooks($limit = 10, $offset = 0)
    {
        try {
            if (isset($this->__conn)) {
                $sql = "SELECT * FROM books ORDER BY id DESC LIMIT :limit OFFSET :offset";
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

    public function getAllActiveBooks($limit = 10, $offset = 0)
    {
        try {
            if (isset($this->__conn)) {
                $sql = "SELECT * FROM books WHERE status = 'active' ORDER BY id DESC LIMIT :limit OFFSET :offset";
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


    public function countAllBooks()
    {
        try {
            if (isset($this->__conn)) {
                $sql = "SELECT COUNT(*) FROM books";
                $stmt = $this->__conn->prepare($sql);
                $stmt->execute();
                return $stmt->fetchColumn();
            }
            echo "no connection";
            return null;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function countAllActiveBooks()
    {
        try {
            if (isset($this->__conn)) {
                $sql = "SELECT COUNT(*) FROM books WHERE status = 'active'";
                $stmt = $this->__conn->prepare($sql);
                $stmt->execute();
                return $stmt->fetchColumn();
            }
            echo "no connection";
            return null;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }



    public function getBookById($id)
    {
        try {
            if (isset($this->__conn)) {
                $sql = "SELECT b.*, c.name AS category_name FROM books b
                        JOIN categories c ON c.id = b.category_id
                        WHERE b.id = :id";
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

    public function getActiveBookById($id)
    {
        try {
            if (isset($this->__conn)) {
                $sql = "SELECT b.*, c.name AS category_name FROM books b
                        JOIN categories c ON c.id = b.category_id
                        WHERE b.id = :id AND b.status = 'active'";
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


    public function saveBookToDB($title, $author, $description, $category_id, $price_in, $price_out, $stock_qty, $image_url, $status)
    {
        try {
            if (isset($this->__conn)) {
                $sql = "INSERT INTO books (title, author, description, category_id, price_in, price_out, stock_qty, image_url, status) 
                VALUES (:title, :author, :description, :category_id, :price_in, :price_out, :stock_qty, :image_url, :status)";
                // show_data($sql);
                // die();
                $stmt = $this->__conn->prepare($sql);
                $stmt->bindParam("title", $title, PDO::PARAM_STR);
                $stmt->bindParam("author", $author, PDO::PARAM_STR);
                $stmt->bindParam("description", $description, PDO::PARAM_STR);
                $stmt->bindParam("category_id", $category_id, PDO::PARAM_INT);
                $stmt->bindParam("price_in", $price_in, PDO::PARAM_INT);
                $stmt->bindParam("price_out", $price_out, PDO::PARAM_INT);
                $stmt->bindParam("stock_qty", $stock_qty, PDO::PARAM_INT);
                $stmt->bindParam("image_url", $image_url, PDO::PARAM_STR);
                $stmt->bindParam("status", $status, PDO::PARAM_STR);
                $stmt->execute();
            }
            return null;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }


    public function updateBookById($id, $title, $author, $description, $category_id, $price_in, $price_out, $stock_qty, $image_url, $status)
    {
        try {
            if (isset($this->__conn)) {
                $sql = "UPDATE books
                SET title = :title, author = :author, description = :description, category_id = :category_id, price_in = :price_in, price_out = :price_out, stock_qty = :stock_qty, image_url = :image_url, status = :status
                WHERE id = :id";
                $stmt = $this->__conn->prepare($sql);
                $stmt->bindParam("title", $title, PDO::PARAM_STR);
                $stmt->bindParam("author", $author, PDO::PARAM_STR);
                $stmt->bindParam("description", $description, PDO::PARAM_STR);
                $stmt->bindParam("category_id", $category_id, PDO::PARAM_INT);
                $stmt->bindParam("price_in", $price_in, PDO::PARAM_INT);
                $stmt->bindParam("price_out", $price_out, PDO::PARAM_INT);
                $stmt->bindParam("stock_qty", $stock_qty, PDO::PARAM_INT);
                $stmt->bindParam("image_url", $image_url, PDO::PARAM_STR);
                $stmt->bindParam("status", $status, PDO::PARAM_STR);
                $stmt->bindParam("id", $id, PDO::PARAM_INT);
                $stmt->execute();
            }
            return null;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function updateBookStatusById($id, $status)
    {
        try {
            if (isset($this->__conn)) {
                $sql = "UPDATE books 
                SET status = :status
                WHERE id = :id";
                $stmt = $this->__conn->prepare($sql);
                $stmt->bindParam("status", $status, PDO::PARAM_STR);
                $stmt->bindParam("id", $id, PDO::PARAM_INT);
                $stmt->execute();
            }
            return null;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }


    public function deleteBookById($id)
    {
        try {
            if (isset($this->__conn)) {
                $sql = "DELETE FROM books WHERE id = :id";
                $stmt = $this->__conn->prepare($sql);
                $stmt->bindParam('id', $id, PDO::PARAM_INT);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    echo "Book with ID $id has been deleted successfully.";
                } else {
                    echo "No Book found with ID $id";
                }
            }
            return null;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }


    public function filterBooks($title = '', $stock_qty = '', $price_in = '', $price_out = '', $limit = 10, $offset = 0)
    {
        try {
            if (isset($this->__conn)) {
                $sql = "SELECT * FROM books WHERE 1=1";
                $params = [];

                // add filters if provided
                if (!empty($title)) {
                    $sql .= " AND title LIKE :title";
                }

                if (!empty($stock_qty)) {
                    $sql .= " AND stock_qty = :stock_qty";
                    $params[':stock_qty'] = $stock_qty;
                }

                if (!empty($price_in)) {
                    $sql .= " AND price_in = :price_in";
                    $params[':price_in'] = $price_in;
                }

                if (!empty($price_out)) {
                    $sql .= " AND price_out = :price_out";
                    $params[':price_out'] = $price_out;
                }

                // sort books by id DESC and limit results
                $sql .= " ORDER BY id DESC LIMIT :limit OFFSET :offset";

                // prepare sql stmt
                $stmt = $this->__conn->prepare($sql);


                if (!empty($title)) {
                    $inputTitle = "%$title%";
                    $stmt->bindParam(':title', $inputTitle);
                }

                foreach ($params as $key => $value) {
                    $stmt->bindParam($key, $value, PDO::PARAM_INT);
                }

                $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
                $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                // execute sql stmt
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_OBJ);
            }
            echo "no connection";
            return null;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function filterActiveBooks($title = '', $stock_qty = '', $price_in = '', $price_out = '', $limit = 10, $offset = 0)
    {
        try {
            if (isset($this->__conn)) {
                $sql = "SELECT * FROM books WHERE 1=1";
                $params = [];

                // add filters if provided
                if (!empty($title)) {
                    $sql .= " AND title LIKE :title";
                }

                if (!empty($stock_qty)) {
                    $sql .= " AND stock_qty = :stock_qty";
                    $params[':stock_qty'] = $stock_qty;
                }

                if (!empty($price_in)) {
                    $sql .= " AND price_in = :price_in";
                    $params[':price_in'] = $price_in;
                }

                if (!empty($price_out)) {
                    $sql .= " AND price_out = :price_out";
                    $params[':price_out'] = $price_out;
                }

                // sort books by id DESC and limit results
                $sql .= " AND status = 'active' ORDER BY id DESC LIMIT :limit OFFSET :offset";

                // prepare sql stmt
                $stmt = $this->__conn->prepare($sql);


                if (!empty($title)) {
                    $inputTitle = "%$title%";
                    $stmt->bindParam(':title', $inputTitle);
                }

                foreach ($params as $key => $value) {
                    $stmt->bindParam($key, $value, PDO::PARAM_INT);
                }

                $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
                $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                // execute sql stmt
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_OBJ);
            }
            echo "no connection";
            return null;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function countFilteredBooks($title = '', $stock_qty = '', $price_in = '', $price_out = '')
    {
        try {
            if (isset($this->__conn)) {
                $sql = "SELECT COUNT(*) FROM books WHERE 1=1";
                $params = [];

                // add filters if provided
                if (!empty($title)) {
                    $sql .= " AND title LIKE :title";
                }

                if (!empty($stock_qty)) {
                    $sql .= " AND stock_qty = :stock_qty";
                    $params[':stock_qty'] = $stock_qty;
                }

                if (!empty($price_in)) {
                    $sql .= " AND price_in = :price_in";
                    $params[':price_in'] = $price_in;
                }

                if (!empty($price_out)) {
                    $sql .= " AND price_out = :price_out";
                    $params[':price_out'] = $price_out;
                }

                // prepare sql stmt
                $stmt = $this->__conn->prepare($sql);


                if (!empty($title)) {
                    $inputTitle = "%$title%";
                    $stmt->bindParam(':title', $inputTitle);
                }

                foreach ($params as $key => $value) {
                    $stmt->bindParam($key, $value, PDO::PARAM_INT);
                }

                $stmt->execute();
                return $stmt->fetchColumn();
            }
            echo "no connection";
            return null;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }



    public function countFilteredActiveBooks($title = '', $stock_qty = '', $price_in = '', $price_out = '')
    {
        try {
            if (isset($this->__conn)) {
                $sql = "SELECT COUNT(*) FROM books WHERE 1=1";
                $params = [];

                // add filters if provided
                if (!empty($title)) {
                    $sql .= " AND title LIKE :title";
                }

                if (!empty($stock_qty)) {
                    $sql .= " AND stock_qty = :stock_qty";
                    $params[':stock_qty'] = $stock_qty;
                }

                if (!empty($price_in)) {
                    $sql .= " AND price_in = :price_in";
                    $params[':price_in'] = $price_in;
                }

                if (!empty($price_out)) {
                    $sql .= " AND price_out = :price_out";
                    $params[':price_out'] = $price_out;
                }

                // sort books by id DESC and limit results
                $sql .= " AND status = 'active'";

                // prepare sql stmt
                $stmt = $this->__conn->prepare($sql);


                if (!empty($title)) {
                    $inputTitle = "%$title%";
                    $stmt->bindParam(':title', $inputTitle);
                }

                foreach ($params as $key => $value) {
                    $stmt->bindParam($key, $value, PDO::PARAM_INT);
                }

                $stmt->execute();
                return $stmt->fetchColumn();
            }
            echo "no connection";
            return null;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
}
