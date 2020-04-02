<?php

namespace App\Controller;

use App\Entity\Room;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mercure\PublisherInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class PublishController extends AbstractController
{
    /**
     * @Route("/send/{room}", name="send", methods={"POST"})
     */
    public function send(PublisherInterface  $publisher, Room $room, SerializerInterface $serializer)
    {
        $target = ["http://192.168.1.22/room/{$room->getId()}"];
        $update = new Update(
            "http://192.168.1.22/ping",
            $serializer->serialize($room, 'json', ['groups' => 'public']),
            $target
        );
        $publisher($update);
        return $this->redirectToRoute('room_show');
    }
}
