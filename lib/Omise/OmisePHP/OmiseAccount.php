<?php

namespace Omise\OmisePHP;

use Omise\OmisePHP\Res\OmiseApiResourceSingleton;

class OmiseAccount extends OmiseApiResourceSingleton {
  const ENDPOINT = 'account';

  /**
   * Retrieves an account.
   * @param string $publickey
   * @param string $secretkey
   * @return OmiseAccount
   */
  public static function retrieve($publickey = null, $secretkey = null) {
    return parent::retrieve(get_class(), self::getUrl(), $publickey, $secretkey);
  }

  /**
   * (non-PHPdoc)
   * @see OmiseApiResource::reload()
   */
  public function reload() {
    parent::reload(self::getUrl());
  }

  /**
   *
   * @param string $cardID
   * @return string
   */
  private static function getUrl($id = '') {
    return OMISE_API_URL.self::ENDPOINT.'/'.$id;
  }
}
