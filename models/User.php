<?php

declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';

class User
{
    private PDO $pdo;
    private ?string $table = null;
    private array $columns = [];

    public function __construct(?PDO $pdo = null)
    {
        $this->pdo = $pdo ?? getDatabaseConnection();
        $this->table = $this->resolveTableName();
        $this->columns = $this->table ? $this->fetchColumns($this->table) : [];
    }

    public function exists(): bool
    {
        return $this->table !== null;
    }

    public function findByIdentifier(string $identifier): ?array
    {
        if ($this->table === null) {
            return null;
        }

        $whereParts = [];
        $params = [':identifier' => $identifier];

        foreach (['email', 'username', 'name'] as $field) {
            if ($this->hasColumn($field)) {
                $whereParts[] = "{$field} = :identifier";
            }
        }

        if ($whereParts === []) {
            return null;
        }

        $whereSql = implode(' OR ', $whereParts);

        if ($this->hasColumn('is_active')) {
            $whereSql = "({$whereSql}) AND is_active = 1";
        }

        if ($this->hasColumn('role')) {
            $whereSql = "({$whereSql}) AND role = 'admin'";
        }

        $sql = "SELECT * FROM {$this->table} WHERE {$whereSql} LIMIT 1";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($params);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return $user ?: null;
    }

    public function verifyPassword(array $user, string $password): bool
    {
        $passwordField = $this->hasColumn('password_hash') ? 'password_hash' : 'password';
        if (!isset($user[$passwordField])) {
            return false;
        }

        return password_verify($password, (string) $user[$passwordField]);
    }

    public function getTableName(): ?string
    {
        return $this->table;
    }

    public function hasColumn(string $column): bool
    {
        return in_array($column, $this->columns, true);
    }

    private function resolveTableName(): ?string
    {
        foreach (['users', 'usuarios'] as $candidate) {
            $statement = $this->pdo->prepare('SHOW TABLES LIKE :table');
            $statement->execute([':table' => $candidate]);
            if ($statement->fetchColumn() !== false) {
                return $candidate;
            }
        }

        return null;
    }

    private function fetchColumns(string $table): array
    {
        $statement = $this->pdo->query("SHOW COLUMNS FROM {$table}");
        $columns = $statement->fetchAll(PDO::FETCH_ASSOC);

        return array_map(
            static fn (array $column): string => (string) ($column['Field'] ?? ''),
            $columns
        );
    }
}
