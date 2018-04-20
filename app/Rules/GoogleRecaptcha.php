<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use ReCaptcha\ReCaptcha;

class GoogleRecaptcha implements Rule
{

    /*
     * Google ReCaptcha
     *
     * @var ReCaptcha\ReCaptcha
     */
    protected  $re_captcha;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->re_captcha = new ReCaptcha(env('NOCAPTCHA_SECRET'));
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
        return $this->captchaCheck($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Wrong captcha, please try again.';
    }

    /*
     * Helper method to check if ReCaptcha passed
     *
     * @param string $response
     * @return bool
     */
    protected function captchaCheck($response)
    {
        $resp = $this->re_captcha->verify($response, request()->ip());
        return $resp->isSuccess();
    }
}
