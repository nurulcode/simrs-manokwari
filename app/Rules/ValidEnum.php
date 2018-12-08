<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidEnum implements Rule
{
    protected $enum;
    protected $strict;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(string $enum, bool $strict = false)
    {
        $this->enum   = $enum;
        $this->strict = $strict;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (is_array($value)) {
            $value = array_get($value, 'value');
        }

        return app($this->enum)::hasValue($value, $this->strict);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.in');
    }
}
