<?php

namespace App\Controller;

use App\Entity\Playlist;
use App\Form\PlaylistType;
use App\Repository\PlaylistRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/playlist')]
class PlaylistsControllerAdmin extends AbstractController
{
    #[Route('/', name: 'playlist_index', methods: ['GET'])]
    public function index(PlaylistRepository $playlistRepository): Response
    {
        return $this->render('pages/playlist/index.html.twig', [
            'playlists' => $playlistRepository->findAll(),
        ]);
    }

    #[Route('/ajouter', name: 'playlist_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $playlist = new Playlist();
        $form = $this->createForm(PlaylistType::class, $playlist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($playlist);
            $entityManager->flush();

            return $this->redirectToRoute('playlist_index');
        }

        return $this->render('pages/playlist/new.html.twig', [
            'formPlaylist' => $form->createView(),
        ]);
    }

    #[Route('/modifier/{id}', name: 'playlist_edit', methods: ['GET', 'POST'])]
    public function edit(Playlist $playlist, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PlaylistType::class, $playlist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('playlist_index');
        }

        return $this->render('pages/playlist/edit.html.twig', [
            'formPlaylist' => $form->createView(),
            'playlist' => $playlist,
        ]);
    }

    #[Route('/supprimer/{id}', name: 'playlist_delete', methods: ['POST'])]
    public function delete(Playlist $playlist, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete_playlist_' . $playlist->getId(), $request->request->get('_token'))) {
            $entityManager->remove($playlist);
            $entityManager->flush();
        }

        return $this->redirectToRoute('playlist_index');
    }
}
