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
    public function send(PublisherInterface  $publisher, $room, SerializerInterface $serializer)
    {
        //$request = $this->get('request');
        $target = ["http://192.168.1.22/room/".$room];
        $jsonEncode = array(
            'room'=> $room,
            'message' => 'salut'
        );
        dump("http://192.168.1.22/room/".$room); 
        $update = new Update(
            "http://192.168.1.22/room/".$room,
            $serializer->serialize($jsonEncode, 'json'),
            $target
        );
        $publisher($update);
        return $this->redirectToRoute('room_show', array('id'=> $room));
    }
}
