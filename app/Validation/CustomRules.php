<?php

namespace App\Validation;

class CustomRules
{
    public function required_if_other_empty(string $value, string $otherField, array $data): bool
    {
        // Check if the other field is not empty
        if (!empty($data[$otherField])) {
            // If the other field is not empty, the current field must not be empty
            return empty($value);
        }

        // If the other field is not empty, the current field is not required
        return true;
    }
}
