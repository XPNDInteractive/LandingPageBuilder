<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Compressed implements Rule
{
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
        dd($value);
        $info = pathinfo($value);
        if($info['extension'] === 'zip' || $info['extension'] === '.zip'){
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
        return 'Invalid File Type';
    }
}
