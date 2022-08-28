<?php

namespace App\Shared\Rules;

use Illuminate\Contracts\Validation\Rule;

class DomainNameRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(
        private $caption = 'Website'
    ) {
        $this->caption = $caption;
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
        return preg_match("/^((https?:\/\/)?([w]{3}[\.])?)?[a-zA-Z0-9\-_]{2,}[\.][a-zA-Z]{2,4}([\.][a-zA-Z]{2,6})?$/", $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return @implode('<br>', [
            "{$this->caption} - Invalid",
            "- Can start with 'http://www' or 'https://www'",
            "- Must has a domain name (google | microsoft | yahoo | .etc)",
            "- Must end with domain type (.com | .co.in | .online | .etc)",
            "- Special characters allowed: _-",
            "e.g. https://www.google.com | https://www.google.co.in"
        ]);
    }
}