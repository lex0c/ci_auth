<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * PHP Encrypter
 * Generates an encrypted hash of 108 byte
 * @link https://github.com/lleocastro/php-encrypter
 * @license https://github.com/lleocastro/php-encrypter/blob/master/LICENSE
 * @copyright 2016 Leonardo Carvalho <leonardo_carvalho@outlook.com>
 */

class Hash
{
    /**
     * Encryption prefix
     * @see http://www.php.net/security/crypt_blowfish.php
     * @var string
     */
    protected $prefix = '2a';

    /**
     * Salt [MTc2MzMxNDQ4NTdmZDg4Yz]
     * @see http://www.php.net/security/crypt_blowfish.php
     * @var string
     */
    protected $salt = '';

    /**
     * Custo default '8' [4 <> 31]
     * @see http://www.php.net/security/crypt_blowfish.php
     * @var int
     */
    protected $cust = 8;

    /**
     * Encrypter Factory
     *
     * @param string $prefix
     * @param string $salt
     * @param string $cust
     */
    public function __construct($prefix = '', $salt = '', $cust = '')
    {
        $this->prefix = ($prefix == '' ? $this->prefix='2a' : $this->prefix = $prefix);
        $this->salt   = ($salt   == '' ? $this->salt = $this->generateHash() : $this->salt = $salt);
        $this->cust   = ($cust   == '' ? $this->cust='8' : $this->cust = $cust);
    }

    /**
     * Encrypt Generate
     *
     * @param string $value
     *
     * @return string encrypted
     */
    public function generate($value)
    {
        return str_replace('=', '', strrev($this->inverse(
            crypt(
                (string) trim(htmlentities(strrev($value))),
                $this->generateHash()
            )
        )));
    }

    /**
     * Compare hashes
     *
     * @param string $value
     * @param string $hash
     *
     * @return boolean
     */
    public function isEquals($value, $hash)
    {
        $v = (string) trim(htmlentities(strrev($value)));
        $h = $this->reverse((string) trim(htmlentities(strrev($hash))));

        if(crypt($v, $h) === $h):
            return true;
        endif;

        return false;
    }

    /**
     * Generate a random salt
     *
     * @return string
     */
    protected function generateSalt()
    {
        return substr(base64_encode(uniqid(mt_rand(), true)), 0, 22);
    }

    /**
     * Build a hash string for crypt
     *
     * @return string
     */
    protected function generateHash()
    {
        return sprintf('$%s$%02d$%s$', $this->prefix, $this->cust, $this->generateSalt());
    }


    /**
     * Hard hash encryptation
     *
     * @param string $encryptedData
     *
     * @return string encrypted
     */
    protected function inverse($encryptedData)
    {
        return base64_encode(strrev(
                substr($encryptedData, (strlen($encryptedData)/2)-strlen($encryptedData), strlen($encryptedData)).
                substr($encryptedData, 0, (strlen($encryptedData)/2)-strlen($encryptedData)))
        );
    }

    protected function reverse($encryptedData)
    {
        $encryptedData = base64_decode($encryptedData);
        return strrev(
            substr($encryptedData, (strlen($encryptedData)/2)-strlen($encryptedData),strlen($encryptedData)).
            substr($encryptedData, 0, (strlen($encryptedData)/2)-strlen($encryptedData))
        );
    }

}
