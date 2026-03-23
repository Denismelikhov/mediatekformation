<?php

namespace App\Tests;

use App\Entity\Categorie;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CategorieTest extends KernelTestCase
{
    private ValidatorInterface $validator;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->validator = static::getContainer()->get(ValidatorInterface::class);
    }

    public function testCategorieNameNotBlank(): void
    {
        $categorie = new Categorie();
        $categorie->setName('');

        $errors = $this->validator->validate($categorie);

        $this->assertGreaterThan(0, count($errors));
    }

    public function testCategorieNameValid(): void
    {
        $categorie = new Categorie();
        $categorie->setName('PHP');

        $errors = $this->validator->validate($categorie);

        $this->assertCount(0, $errors);
    }

    public function testCategorieNameMaxCharacters(): void
    {
        $categorie = new Categorie();
        $categorie->setName(str_repeat('a', 65));

        $errors = $this->validator->validate($categorie);

        $this->assertGreaterThan(0, count($errors));
    }
}
