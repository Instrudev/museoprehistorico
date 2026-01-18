<?php

require_once __DIR__ . '/../config/database.php';

class Reserva
{
    private ?array $columnsCache = null;

    public static function allowedPeople(): array
    {
        return [
            '1 persona',
            '2-4 personas',
            '5-10 personas',
            'Más de 10 personas',
        ];
    }

    public static function allowedTours(): array
    {
        return [
            'Recorrido Guiado',
            'Recorrido Libre',
            'Recorrido Nocturno',
            'Experiencia Premium',
        ];
    }

    public static function allowedPayments(): array
    {
        return ['pse', 'card', 'onsite'];
    }

    public function create(array $data): bool
    {
        $pdo = getDatabaseConnection();

        $sql = 'INSERT INTO reservations (
            full_name,
            phone,
            visit_date,
            num_people,
            tour_type,
            payment_method,
            accessibility_wheelchair,
            accessibility_sign_language,
            accessibility_visual_impairment,
            accessibility_autism,
            accessibility_senior,
            accessibility_cognitive,
            special_notes
        ) VALUES (
            :full_name,
            :phone,
            :visit_date,
            :num_people,
            :tour_type,
            :payment_method,
            :accessibility_wheelchair,
            :accessibility_sign_language,
            :accessibility_visual_impairment,
            :accessibility_autism,
            :accessibility_senior,
            :accessibility_cognitive,
            :special_notes
        )';

        $statement = $pdo->prepare($sql);

        return $statement->execute([
            ':full_name' => $data['full_name'],
            ':phone' => $data['phone'],
            ':visit_date' => $data['visit_date'],
            ':num_people' => $data['num_people'],
            ':tour_type' => $data['tour_type'],
            ':payment_method' => $data['payment_method'],
            ':accessibility_wheelchair' => $data['accessibility_wheelchair'],
            ':accessibility_sign_language' => $data['accessibility_sign_language'],
            ':accessibility_visual_impairment' => $data['accessibility_visual_impairment'],
            ':accessibility_autism' => $data['accessibility_autism'],
            ':accessibility_senior' => $data['accessibility_senior'],
            ':accessibility_cognitive' => $data['accessibility_cognitive'],
            ':special_notes' => $data['special_notes'],
        ]);
    }

    public function all(): array
    {
        $pdo = getDatabaseConnection();
        $sql = 'SELECT * FROM reservations ORDER BY created_at DESC';
        $statement = $pdo->query($sql);

        return $statement->fetchAll();
    }

    public function find(int $id): ?array
    {
        $pdo = getDatabaseConnection();
        $sql = 'SELECT * FROM reservations WHERE id = :id LIMIT 1';
        $statement = $pdo->prepare($sql);
        $statement->execute([':id' => $id]);
        $reservation = $statement->fetch();

        return $reservation ?: null;
    }

    public function update(int $id, array $data): bool
    {
        $pdo = getDatabaseConnection();
        $sql = 'UPDATE reservations SET
            full_name = :full_name,
            phone = :phone,
            visit_date = :visit_date,
            num_people = :num_people,
            tour_type = :tour_type,
            payment_method = :payment_method,
            accessibility_wheelchair = :accessibility_wheelchair,
            accessibility_sign_language = :accessibility_sign_language,
            accessibility_visual_impairment = :accessibility_visual_impairment,
            accessibility_autism = :accessibility_autism,
            accessibility_senior = :accessibility_senior,
            accessibility_cognitive = :accessibility_cognitive,
            special_notes = :special_notes
            WHERE id = :id';

        $statement = $pdo->prepare($sql);

        return $statement->execute([
            ':id' => $id,
            ':full_name' => $data['full_name'],
            ':phone' => $data['phone'],
            ':visit_date' => $data['visit_date'],
            ':num_people' => $data['num_people'],
            ':tour_type' => $data['tour_type'],
            ':payment_method' => $data['payment_method'],
            ':accessibility_wheelchair' => $data['accessibility_wheelchair'],
            ':accessibility_sign_language' => $data['accessibility_sign_language'],
            ':accessibility_visual_impairment' => $data['accessibility_visual_impairment'],
            ':accessibility_autism' => $data['accessibility_autism'],
            ':accessibility_senior' => $data['accessibility_senior'],
            ':accessibility_cognitive' => $data['accessibility_cognitive'],
            ':special_notes' => $data['special_notes'],
        ]);
    }

    public function delete(int $id): bool
    {
        $pdo = getDatabaseConnection();
        $sql = 'DELETE FROM reservations WHERE id = :id';
        $statement = $pdo->prepare($sql);

        return $statement->execute([':id' => $id]);
    }

    public function countAll(): int
    {
        $pdo = getDatabaseConnection();
        $sql = 'SELECT COUNT(*) AS total FROM reservations';
        $statement = $pdo->query($sql);
        $result = $statement->fetch();

        return (int) ($result['total'] ?? 0);
    }

    public function countPending(): int
    {
        $statusColumn = $this->getStatusColumn();
        if ($statusColumn === null) {
            return $this->countAll();
        }

        $pdo = getDatabaseConnection();
        $sql = "SELECT COUNT(*) AS total FROM reservations WHERE LOWER({$statusColumn}) IN ('pendiente', 'pending')";
        $statement = $pdo->query($sql);
        $result = $statement->fetch();

        return (int) ($result['total'] ?? 0);
    }

    public function pending(): array
    {
        $statusColumn = $this->getStatusColumn();
        if ($statusColumn === null) {
            return $this->all();
        }

        $pdo = getDatabaseConnection();
        $sql = "SELECT * FROM reservations WHERE LOWER({$statusColumn}) IN ('pendiente', 'pending') ORDER BY created_at DESC";
        $statement = $pdo->query($sql);

        return $statement->fetchAll();
    }

    public function updateStatus(int $id, string $status): bool
    {
        $statusColumn = $this->getStatusColumn();
        if ($statusColumn === null) {
            return false;
        }

        $pdo = getDatabaseConnection();
        $sql = "UPDATE reservations SET {$statusColumn} = :status WHERE id = :id";
        $statement = $pdo->prepare($sql);

        return $statement->execute([
            ':status' => $status,
            ':id' => $id,
        ]);
    }

    public function getStatusColumn(): ?string
    {
        $columns = $this->getColumns();

        foreach (['status', 'estado'] as $candidate) {
            if (in_array($candidate, $columns, true)) {
                return $candidate;
            }
        }

        return null;
    }

    public function getColumns(): array
    {
        if ($this->columnsCache !== null) {
            return $this->columnsCache;
        }

        $pdo = getDatabaseConnection();
        $statement = $pdo->query('SHOW COLUMNS FROM reservations');
        $columns = $statement->fetchAll();

        $this->columnsCache = array_map(
            static fn (array $column): string => (string) ($column['Field'] ?? ''),
            $columns
        );

        return $this->columnsCache;
    }
}
