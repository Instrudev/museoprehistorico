<?php

require_once __DIR__ . '/../config/database.php';

class Reserva
{
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
}
