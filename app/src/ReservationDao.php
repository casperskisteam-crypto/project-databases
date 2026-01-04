<?php
declare(strict_types=1);

final class ReservationDao {
    public function __construct(private PDO $pdo) {}

    public function all(): array {
        return $this->pdo->query("SELECT * FROM Reservation ORDER BY id_Reservation DESC")->fetchAll();
    }

    public function find(int $id): ?array {
        $st = $this->pdo->prepare("SELECT * FROM Reservation WHERE id_Reservation=:id");
        $st->execute([':id'=>$id]);
        $r = $st->fetch();
        return $r ?: null;
    }

    public function create(array $d): void {
        $st = $this->pdo->prepare(
            "INSERT INTO Reservation(id_Reservation, id_Client, data_zaizdu, data_vyizdu)
             VALUES(:id, :client, :in, :out)"
        );
        $st->execute([
            ':id'=>(int)$d['id_Reservation'],
            ':client'=>(int)$d['id_Client'],
            ':in'=>$d['data_zaizdu'],
            ':out'=>$d['data_vyizdu'],
        ]);
    }

    public function update(int $id, array $d): void {
        $st = $this->pdo->prepare(
            "UPDATE Reservation SET id_Client=:client, data_zaizdu=:in, data_vyizdu=:out
             WHERE id_Reservation=:id"
        );
        $st->execute([
            ':id'=>$id,
            ':client'=>(int)$d['id_Client'],
            ':in'=>$d['data_zaizdu'],
            ':out'=>$d['data_vyizdu'],
        ]);
    }

    public function delete(int $id): void {
        $st = $this->pdo->prepare("DELETE FROM Reservation WHERE id_Reservation=:id");
        $st->execute([':id'=>$id]);
    }
}
