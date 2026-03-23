<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FormationTestFonctionnel extends WebTestCase
{
    public function testAccueilAccessible(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('body');
    }

    public function testFormationsPageAccessible(): void
    {
        $client = static::createClient();
        $client->request('GET', '/formations');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('body');
    }

    public function testTriFormationsPageLoads(): void
    {
        $client = static::createClient();
        $client->request('GET', '/formations?tri=title&ordre=ASC');

        $this->assertResponseIsSuccessful();
    }

    public function testFilterFormationsPageLoads(): void
    {
        $client = static::createClient();
        $client->request('GET', '/formations?categorie=PHP');

        $this->assertResponseIsSuccessful();
    }
}
