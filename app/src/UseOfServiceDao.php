<?php
declare(strict_types=1);

final class UseOfServiceDao {
    public function __construct(private PDO $pdo) {}

    public function all(): array {
        return $this->pdo->query("SELECT * FROM UseOfService ORDER BY id_UseOfService DESC")->fetchAll();
    }

    public function find(int $id): ?array {
        $st = $this->pdo->prepare("SELECT * FROM UseOfService WHERE id_UseOfService=:id");
        $st->execute([':id'=>$id]);
        $r = $st->fetch();
        return $r ?: null;
    }

    public function create(array $d): void {
        $st = $this->pdo->prepare(
            "INSERT INTO UseOfService(id_UseOfService, id_Reservation, id_Service, amount, total_amount)
             VALUES(:id, :res, :srv, :a, :t)"
        );
        $st->execute([
            ':id'=>(int)$d['id_UseOfService'],
            ':res'=>(int)$d['id_Reservation'],
            ':srv'=>(int)$d['id_Service'],
            ':a'=>(int)$d['amount'],
            ':t'=>(int)$d['total_amount'],
        ]);
    }

    public function update(int $id, array $d): void {
        $st = $this->pdo->prepare(
            "UPDATE UseOfService SET id_Reservation=:res, id_Service=:srv, amount=:a, total_amount=:t
             WHERE id_UseOfService=:id"
        );
        $st->execute([
            ':id'=>$id,
            ':res'=>(int)$d['id_Reservation'],
            ':srv'=>(int)$d['id_Service'],
            ':a'=>(int)$d['amount'],
            ':t'=>(int)$d['total_amount'],
        ]);
    }

    public function delete(int $id): void {
        $st = $this->pdo->prepare("DELETE FROM UseOfService WHERE id_UseOfService=:id");
        $st->execute([':id'=>$id]);
    }
}
