<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class allowedEmailDomain implements Rule
{
    protected $allowedDomains = [
        'somaiya.edu',
    ];
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $domain = substr(strrchr($value, "@"), 1);
        if (in_array($domain, $this->allowedDomains)) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'We appreciate your interest in joining, however at the moment we only offer this service to those with somaiya.edu email addresses.';
    }
}
