<?php
namespace Boom\Bundle\FrontBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Description of DefaultControllerTest
 *
 * @author daniel
 */
class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertGreaterThan(0, $crawler->filter('html:contains("7boom")')->count());
    }
}