<?php

namespace App\Controller;

use App\Entity\Message;
use App\Entity\Room;
use App\Form\RoomType;
use App\Repository\MessageRepository;
use App\Repository\RoomRepository;
use App\Repository\UserRepository;
use App\Service\MercureCookieGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mercure\PublisherInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @Route("/room")
 */
class RoomController extends AbstractController
{
    /**
     * @Route("/", name="room_index", methods={"GET"})
     */
    public function index(RoomRepository $roomRepository): Response
    {
        return $this->render('room/index.html.twig', [
            'rooms' => $roomRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="room_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $room = new Room();
        $form = $this->createForm(RoomType::class, $room);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($room);
            $entityManager->flush();

            return $this->redirectToRoute('room_index');
        }

        return $this->render('room/new.html.twig', [
            'room' => $room,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="room_show", methods={"GET"})
     */
    public function show(Room $room, MercureCookieGenerator $cookieGenerator, MessageRepository $messageRepository): Response
    {
        if($this->getUser() == null){
            return $this->redirectToRoute('app_login');
        }else{
            $messages = $messageRepository->findBy(
                array('room' => $room->getId()),
                array('id' => 'ASC'),
                20
            );
            $response = $this->render('room/show.html.twig', [
                'room' => $room,
                'messages' => $messages
            ]);
            $response->headers->set('set-cookie', $cookieGenerator->generate($room));
            return $response;
        }
    }

    /**
     * @Route("/send/{room}", name="send", methods={"POST"})
     */
    public function send(MessageBusInterface  $bus, $room, SerializerInterface $serializer, RoomRepository $roomRepository, UserRepository $userRepository)
    {
        $target = [];
        $jsonEncode = array(
            'room'=> $room,
            'message' => $_POST['sendMessage']
        );
        $userLogged = $this->getUser();
        $criteria = array();
        $orderBy = array();
        $message = new Message();
        $message->setDateCreation(new \DateTime())
            ->setMessage($_POST['sendMessage'])
            ->setEpingler(false)
            ->setRoomId($roomRepository->find($room))
            ->setUser($userLogged);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($message);
        $entityManager->flush();
        $update = new Update(
            "http://192.168.1.22/room/".$room,
            $serializer->serialize($jsonEncode, 'json'),
            $target
        );
        $bus->dispatch($update);
        return $this->redirectToRoute('room_show', array('id'=> $room));
    }
    /**
     * @Route("/{id}/edit", name="room_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Room $room): Response
    {
        $form = $this->createForm(RoomType::class, $room);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('room_index');
        }

        return $this->render('room/edit.html.twig', [
            'room' => $room,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="room_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Room $room): Response
    {
        if ($this->isCsrfTokenValid('delete'.$room->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($room);
            $entityManager->flush();
        }

        return $this->redirectToRoute('room_index');
    }
}
