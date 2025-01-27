<?php

namespace App\Validation;

class CustomRules
{
    public function required_if_other_empty(string $value, string $otherField, array $data): bool
    {
        // Si el otro campo está vacío, el campo actual debe tener un valor
        if (!empty($data[$otherField])) {
            return empty($value);
        }

        // Si el otro campo no está vacío, el campo actual no es obligatorio
        return true;
    }
}
