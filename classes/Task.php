<?php

class Task {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function create(string $title, ?string $description = null) : bool {

        $query = "INSERT INTO tasks (title, description)
                  VALUES (:title, :description)";

        $statement = $this->db->prepare($query);
        
        return $statement->execute([
            ':title' => $title,
            ':description' => $description,
        ]);
    }

     public function getAll(): array {
        $sql = "SELECT * FROM tasks
                ORDER BY created_at DESC";

        $statement = $this->db->query($sql);
        return $statement->fetchAll();
    }

    public function find(int $id): ?array {
        $sql = "SELECT * FROM tasks
                WHERE id = :id";

        $statement = $this->db->prepare($sql);
        $statement->execute([':id' => $id]);

        $task = $statement->fetch();

        return $task ?: null;
    }

    public function update(
        int $id,
        string $title,
        ?string $description,
        string $status
    ): bool {
            $sql = "UPDATE tasks
                    SET
                        title = :title,
                        description = :description,
                        status = :status
                    WHERE id = :id";

        $statement = $this->db->prepare($sql);

        return $statement->execute([
            ':id' => $id,
            ':title' => $title,
            ':description' => $description,
            ':status' => $status,
        ]);
    }

    public function delete(int $id): bool {
        $sql = "DELETE FROM tasks
                WHERE id = :id";

        $statement = $this->db->prepare($sql);

        return $statement->execute([':id' => $id]);
    }
}