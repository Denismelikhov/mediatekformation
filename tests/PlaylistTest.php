<?php

namespace App\Tests;

use App\Entity\Playlist;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PlaylistValidationTest extends KernelTestCase
{
    private ValidatorInterface $validator;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->validator = static::getContainer()->get(ValidatorInterface::class);
    }

    public function testPlaylistNameNotBlank(): void
    {
        $playlist = new Playlist();
        $playlist->setName('');

        $errors = $this->validator->validate($playlist);

        $this->assertGreaterThan(0, count($errors));
    }

    public function testPlaylistNameValid(): void
    {
        $playlist = new Playlist();
        $playlist->setName('Playlist Symfony');

        $errors = $this->validator->validate($playlist);

        $this->assertCount(0, $errors);
    }
}
