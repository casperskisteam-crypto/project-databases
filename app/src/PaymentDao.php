<?php
declare(strict_types=1);

final class PaymentDao {
    public function __construct(private PDO $pdo) {}

    public function all(): array {
        return $this->pdo->query("SELECT * FROM Payment ORDER BY id_Payment DESC")->fetchAll();
    }

    public function find(int $id): ?array {
        $st = $this->pdo->prepare("SELECT * FROM Payment WHERE id_Payment=:id");
        $st->execute([':id'=>$id]);
        $r = $st->fetch();
        return $r ?: null;
    }

    public function create(array $d): void {
        $st = $this->pdo->prepare(
            "INSERT INTO Payment(id_Payment, id_Reservation, summa, method, data_payment)
             VALUES(:id, :res, :sum, :m, :dt)"
        );
        $st->execute([
            ':id'=>(int)$d['id_Payment'],
            ':res'=>(int)$d['id_Reservation'],
            ':sum'=>$d['summa'],
            ':m'=>$d['method'],
            ':dt'=>$d['data_payment'],
        ]);
    }

    public function update(int $id, array $d): void {
        $st = $this->pdo->prepare(
            "UPDATE Payment SET id_Reservation=:res, summa=:sum, method=:m, data_payment=:dt
             WHERE id_Payment=:id"
        );
        $st->execute([
            ':id'=>$id,
            ':res'=>(int)$d['id_Reservation'],
            ':sum'=>$d['summa'],
            ':m'=>$d['method'],
            ':dt'=>$d['data_payment'],
        ]);
    }

    public function delete(int $id): void {
        $st = $this->pdo->prepare("DELETE FROM Payment WHERE id_Payment=:id");
        $st->execute([':id'=>$id]);
    }
}
