<?php

namespace App\Tests;

use App\Entity\Formation;
use App\Entity\Playlist;
use App\Repository\FormationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class FormationRepositoryTest extends KernelTestCase
{
    private EntityManagerInterface $entityManager;
    private FormationRepository $formationRepository;

    protected function setUp(): void
    {
        self::bootKernel();

        $this->entityManager = static::getContainer()->get(EntityManagerInterface::class);
        $this->formationRepository = static::getContainer()->get(FormationRepository::class);
    }

    public function testSortedByDate(): void
    {
        $suffix = uniqid();

        $playlist1 = new Playlist();
        $playlist1->setName('Playlist cible ' . $suffix);

        $playlist2 = new Playlist();
        $playlist2->setName('Autre playlist ' . $suffix);

        $formation1 = new Formation();
        $formation1->setTitle('Formation ancienne ' . $suffix);
        $formation1->setPublishedAt(new \DateTime('2025-01-10'));
        $formation1->setPlaylist($playlist1);

        $formation2 = new Formation();
        $formation2->setTitle('Formation récente ' . $suffix);
        $formation2->setPublishedAt(new \DateTime('2025-02-10'));
        $formation2->setPlaylist($playlist1);

        $formation3 = new Formation();
        $formation3->setTitle('Formation autre playlist ' . $suffix);
        $formation3->setPublishedAt(new \DateTime('2025-03-10'));
        $formation3->setPlaylist($playlist2);

        $this->entityManager->persist($playlist1);
        $this->entityManager->persist($playlist2);
        $this->entityManager->persist($formation1);
        $this->entityManager->persist($formation2);
        $this->entityManager->persist($formation3);
        $this->entityManager->flush();

        $resultats = $this->formationRepository->findAllForOnePlaylist($playlist1->getId());

        $this->assertCount(2, $resultats);
        $this->assertSame('Formation ancienne ' . $suffix, $resultats[0]->getTitle());
        $this->assertSame('Formation récente ' . $suffix, $resultats[1]->getTitle());
    }
}
