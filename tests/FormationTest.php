<?php

namespace App\Tests;

use App\Entity\Formation;
use PHPUnit\Framework\TestCase;

class FormationTest extends TestCase
{
    public function testDateString(): void
    {
        $formation = new Formation();
        $formation->setPublishedAt(new \DateTime('2025-08-05'));

        $this->assertEquals('05/08/2025', $formation->getPublishedAtString());
    }

    public function testDateStringNull(): void
    {
        $formation = new Formation();
        $formation->setPublishedAt(null);

        $this->assertEquals('', $formation->getPublishedAtString());
    }
}
