<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IndiaPhoneNumber implements Rule
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
        $isValid = false;
       $splitedNum = str_split($value);
       if (isset($splitedNum[0]) && isset($splitedNum[1])){
           if ($splitedNum[0] == 9){
               $isValid = true;
           }elseif ($splitedNum[1] == 1){
               $isValid = true;
           }
       }
       return $isValid;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Please enter valid mobile number with prefix +91';
    }
}
