<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class VerifDate implements Rule
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
        $ajoudhuit = new \DateTime();
        $futur = new \DateTime($value);

        if($futur > $ajoudhuit){
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
        return 'La date doit être au futur.';
    }
}
