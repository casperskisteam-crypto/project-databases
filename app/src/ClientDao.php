<?php
declare(strict_types=1);

final class ClientDao {
    public function __construct(private PDO $pdo) {}

    public function all(): array {
        return $this->pdo->query("SELECT * FROM Client ORDER BY id_client DESC")->fetchAll();
    }

    public function find(int $id): ?array {
        $st = $this->pdo->prepare("SELECT * FROM Client WHERE id_client=:id");
        $st->execute([':id'=>$id]);
        $r = $st->fetch();
        return $r ?: null;
    }

    public function create(array $d): void {
        $st = $this->pdo->prepare(
            "INSERT INTO Client(id_client, PIB, pasportni_dani, telephone, email1)
             VALUES(:id, :pib, :pass, :tel, :email)"
        );
        $st->execute([
            ':id'=>(int)$d['id_client'],
            ':pib'=>$d['PIB'],
            ':pass'=>$d['pasportni_dani'],
            ':tel'=>$d['telephone'],
            ':email'=>$d['email1'],
        ]);
    }

    public function update(int $id, array $d): void {
        $st = $this->pdo->prepare(
            "UPDATE Client SET PIB=:pib, pasportni_dani=:pass, telephone=:tel, email1=:email
             WHERE id_client=:id"
        );
        $st->execute([
            ':id'=>$id,
            ':pib'=>$d['PIB'],
            ':pass'=>$d['pasportni_dani'],
            ':tel'=>$d['telephone'],
            ':email'=>$d['email1'],
        ]);
    }

    public function delete(int $id): void {
        $st = $this->pdo->prepare("DELETE FROM Client WHERE id_client=:id");
        $st->execute([':id'=>$id]);
    }
}
