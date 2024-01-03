<?php 
use RobThree\Auth\TwoFactorAuth;
class TwoFactor
{
    protected $tfa;
    public $label;
    public $secret;
    //0.5是30秒 ，1是60秒，2是120秒
    public $time = 0.5;

    public function init()
    {
        $this->label = $this->label?:get_config("authenticator_name");
        $this->tfa = new TwoFactorAuth($this->label);
        $this->secret();
    }
    /**
     * 生成secret
     */
    public function secret()
    {
        $secret = $this->tfa->createSecret();
        $this->secret = $secret;
        return $secret;
    }
    /**
     * 生成二维码内容
     */
    public function text()
    {
        return $this->tfa->getQRText($this->label, $this->secret);
    }
    /**
     * 验证
     * @param $code 用户输入的一次性密码
     */
    public function verify($code)
    {
        $is_valid = $this->tfa->verifyCode(
            $this->secret,
            $code,
            $this->time
        );
        return $is_valid;
    }

}
