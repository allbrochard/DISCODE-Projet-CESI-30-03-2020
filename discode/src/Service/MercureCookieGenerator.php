<?php


namespace App\Service;


use App\Entity\Room;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Hmac\Sha384;

class MercureCookieGenerator
{

    /**
     * @var string
     */
    private $secret;

    public function __construct(string $secret)
    {
        $this->secret = $secret;
    }

    public function generate(Room $room){

        $token = (new Builder())
            ->set('mercure', ['send'=>["http://127.0.0.1:8000/room/".$room->getId()]])
            ->sign(new Sha256(),$this->secret)
            ->getToken();
        return "mercureAuthorization={$token}; Path=/hub; HttpOnly;";
    }
}