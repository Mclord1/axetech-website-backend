<?php

namespace App\Traits;

trait ValidationRules
{
    protected const RULE_REQUIRED_STRING = 'required|string';
    protected const RULE_REQUIRED_STRING_MAX_255 = 'required|string|max:255';
    protected const RULE_OPTIONAL_STRING = 'nullable|string';
    protected const RULE_OPTIONAL_STRING_MAX_255 = 'nullable|string|max:255';
    protected const RULE_OPTIONAL_BOOLEAN = 'nullable|boolean';
}
