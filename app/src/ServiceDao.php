<?php
declare(strict_types=1);

final class ServiceDao {
    public function __construct(private PDO $pdo) {}

    public function all(): array {
        return $this->pdo->query("SELECT * FROM Service ORDER BY id_Service DESC")->fetchAll();
    }

    public function find(int $id): ?array {
        $st = $this->pdo->prepare("SELECT * FROM Service WHERE id_Service=:id");
        $st->execute([':id'=>$id]);
        $r = $st->fetch();
        return $r ?: null;
    }

    public function create(array $d): void {
        $st = $this->pdo->prepare(
            "INSERT INTO Service(id_Service, name, price, description)
             VALUES(:id, :n, :p, :desc)"
        );
        $st->execute([
            ':id'=>(int)$d['id_Service'],
            ':n'=>$d['name'],
            ':p'=>(int)$d['price'],
            ':desc'=>$d['description'],
        ]);
    }

    public function update(int $id, array $d): void {
        $st = $this->pdo->prepare(
            "UPDATE Service SET name=:n, price=:p, description=:desc
             WHERE id_Service=:id"
        );
        $st->execute([
            ':id'=>$id,
            ':n'=>$d['name'],
            ':p'=>(int)$d['price'],
            ':desc'=>$d['description'],
        ]);
    }

    public function delete(int $id): void {
        $st = $this->pdo->prepare("DELETE FROM Service WHERE id_Service=:id");
        $st->execute([':id'=>$id]);
    }
}
