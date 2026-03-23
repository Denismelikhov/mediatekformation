<?php

namespace App\Tests;

use App\Entity\Categorie;
use App\Entity\Formation;
use App\Entity\Playlist;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CategorieRepositoryTest extends KernelTestCase
{
    private EntityManagerInterface $entityManager;
    private CategorieRepository $categorieRepository;

    protected function setUp(): void
    {
        self::bootKernel();

        $this->entityManager = static::getContainer()->get(EntityManagerInterface::class);
        $this->categorieRepository = static::getContainer()->get(CategorieRepository::class);
    }

    public function testFindAllForOnePlaylist(): void
    {
        $suffix = uniqid();

        $playlist = new Playlist();
        $playlist->setName('Playlist test ' . $suffix);

        $formation = new Formation();
        $formation->setTitle('Formation test ' . $suffix);
        $formation->setPublishedAt(new \DateTime('2025-01-10'));
        $formation->setPlaylist($playlist);

        $categorie1 = new Categorie();
        $categorie1->setName('Zoo ' . $suffix);

        $categorie2 = new Categorie();
        $categorie2->setName('Alpha ' . $suffix);

        $formation->addCategory($categorie1);
        $formation->addCategory($categorie2);

        $this->entityManager->persist($playlist);
        $this->entityManager->persist($formation);
        $this->entityManager->persist($categorie1);
        $this->entityManager->persist($categorie2);
        $this->entityManager->flush();

        $resultats = $this->categorieRepository->findAllForOnePlaylist($playlist->getId());

        $this->assertCount(2, $resultats);
        $this->assertSame('Alpha ' . $suffix, $resultats[0]->getName());
        $this->assertSame('Zoo ' . $suffix, $resultats[1]->getName());
    }
}
