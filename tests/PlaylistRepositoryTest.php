<?php

namespace App\Tests;

use App\Entity\Playlist;
use App\Repository\PlaylistRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PlaylistRepositoryTest extends KernelTestCase
{
    private EntityManagerInterface $entityManager;
    private PlaylistRepository $playlistRepository;
    private $playlistPHP = 'Playlist PHP ';

    protected function setUp(): void
    {
        self::bootKernel();

        $this->entityManager = static::getContainer()->get(EntityManagerInterface::class);
        $this->playlistRepository = static::getContainer()->get(PlaylistRepository::class);
    }

    public function testContainsPlaylist(): void
    {
        $suffix = uniqid();

        $playlist1 = new Playlist();
        $playlist1->setName($this->playlistPHP . $suffix);

        $playlist2 = new Playlist();
        $playlist2->setName('Playlist Symfony ' . $suffix);

        $this->entityManager->persist($playlist1);
        $this->entityManager->persist($playlist2);
        $this->entityManager->flush();

        $resultats = $this->playlistRepository->findByContainValue('name', $this->playlistPHP . $suffix);

        $this->assertCount(1, $resultats);
        $this->assertSame($this->playlistPHP . $suffix, $resultats[0]->getName());
    }
}
