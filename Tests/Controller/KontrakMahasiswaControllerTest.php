<?php

namespace Ais\KontrakMahasiswaBundle\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase as WebTestCase;
use Ais\KontrakMahasiswaBundle\Tests\Fixtures\Entity\LoadKontrakMahasiswaData;

class KontrakMahasiswaControllerTest extends WebTestCase
{
    public function setUp()
    {
        $this->auth = array(
            'PHP_AUTH_USER' => 'user',
            'PHP_AUTH_PW'   => 'userpass',
        );

        $this->client = static::createClient(array(), $this->auth);
    }

    public function testJsonGetKontrakMahasiswaAction()
    {
        $fixtures = array('Ais\KontrakMahasiswaBundle\Tests\Fixtures\Entity\LoadKontrakMahasiswaData');
        $this->loadFixtures($fixtures);
        $kontrak_mahasiswas = LoadKontrakMahasiswaData::$kontrak_mahasiswas;
        $kontrak_mahasiswa = array_pop($kontrak_mahasiswas);

        $route =  $this->getUrl('api_1_get_kontrak_mahasiswa', array('id' => $kontrak_mahasiswa->getId(), '_format' => 'json'));

        $this->client->request('GET', $route, array('ACCEPT' => 'application/json'));
        $response = $this->client->getResponse();
        $this->assertJsonResponse($response, 200);
        $content = $response->getContent();

        $decoded = json_decode($content, true);
        $this->assertTrue(isset($decoded['id']));
    }

    public function testHeadRoute()
    {
        $fixtures = array('Ais\KontrakMahasiswaBundle\Tests\Fixtures\Entity\LoadKontrakMahasiswaData');
        $this->loadFixtures($fixtures);
        $kontrak_mahasiswas = LoadKontrakMahasiswaData::$kontrak_mahasiswas;
        $kontrak_mahasiswa = array_pop($kontrak_mahasiswas);

        $this->client->request('HEAD',  sprintf('/api/v1/kontrak_mahasiswas/%d.json', $kontrak_mahasiswa->getId()), array('ACCEPT' => 'application/json'));
        $response = $this->client->getResponse();
        $this->assertJsonResponse($response, 200, false);
    }

    public function testJsonNewKontrakMahasiswaAction()
    {
        $this->client->request(
            'GET',
            '/api/v1/kontrak_mahasiswas/new.json',
            array(),
            array()
        );

        $this->assertJsonResponse($this->client->getResponse(), 200, true);
        $this->assertEquals(
            '{"children":{"title":{},"body":{}}}',
            $this->client->getResponse()->getContent(),
            $this->client->getResponse()->getContent());
    }

    public function testJsonPostKontrakMahasiswaAction()
    {
        $this->client->request(
            'POST',
            '/api/v1/kontrak_mahasiswas.json',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"title":"title1","body":"body1"}'
        );

        $this->assertJsonResponse($this->client->getResponse(), 201, false);
    }

    public function testJsonPostKontrakMahasiswaActionShouldReturn400WithBadParameters()
    {
        $this->client->request(
            'POST',
            '/api/v1/kontrak_mahasiswas.json',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"titles":"title1","bodys":"body1"}'
        );

        $this->assertJsonResponse($this->client->getResponse(), 400, false);
    }

    public function testJsonPutKontrakMahasiswaActionShouldModify()
    {
        $fixtures = array('Ais\KontrakMahasiswaBundle\Tests\Fixtures\Entity\LoadKontrakMahasiswaData');
        $this->loadFixtures($fixtures);
        $kontrak_mahasiswas = LoadKontrakMahasiswaData::$kontrak_mahasiswas;
        $kontrak_mahasiswa = array_pop($kontrak_mahasiswas);

        $this->client->request('GET', sprintf('/api/v1/kontrak_mahasiswas/%d.json', $kontrak_mahasiswa->getId()), array('ACCEPT' => 'application/json'));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), $this->client->getResponse()->getContent());

        $this->client->request(
            'PUT',
            sprintf('/api/v1/kontrak_mahasiswas/%d.json', $kontrak_mahasiswa->getId()),
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"title":"abc","body":"def"}'
        );

        $this->assertJsonResponse($this->client->getResponse(), 204, false);
        $this->assertTrue(
            $this->client->getResponse()->headers->contains(
                'Location',
                sprintf('http://localhost/api/v1/kontrak_mahasiswas/%d.json', $kontrak_mahasiswa->getId())
            ),
            $this->client->getResponse()->headers
        );
    }

    public function testJsonPutKontrakMahasiswaActionShouldCreate()
    {
        $id = 0;
        $this->client->request('GET', sprintf('/api/v1/kontrak_mahasiswas/%d.json', $id), array('ACCEPT' => 'application/json'));

        $this->assertEquals(404, $this->client->getResponse()->getStatusCode(), $this->client->getResponse()->getContent());

        $this->client->request(
            'PUT',
            sprintf('/api/v1/kontrak_mahasiswas/%d.json', $id),
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"title":"abc","body":"def"}'
        );

        $this->assertJsonResponse($this->client->getResponse(), 201, false);
    }

    public function testJsonPatchKontrakMahasiswaAction()
    {
        $fixtures = array('Ais\KontrakMahasiswaBundle\Tests\Fixtures\Entity\LoadKontrakMahasiswaData');
        $this->loadFixtures($fixtures);
        $kontrak_mahasiswas = LoadKontrakMahasiswaData::$kontrak_mahasiswas;
        $kontrak_mahasiswa = array_pop($kontrak_mahasiswas);

        $this->client->request(
            'PATCH',
            sprintf('/api/v1/kontrak_mahasiswas/%d.json', $kontrak_mahasiswa->getId()),
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"body":"def"}'
        );

        $this->assertJsonResponse($this->client->getResponse(), 204, false);
        $this->assertTrue(
            $this->client->getResponse()->headers->contains(
                'Location',
                sprintf('http://localhost/api/v1/kontrak_mahasiswas/%d.json', $kontrak_mahasiswa->getId())
            ),
            $this->client->getResponse()->headers
        );
    }

    protected function assertJsonResponse($response, $statusCode = 200, $checkValidJson =  true, $contentType = 'application/json')
    {
        $this->assertEquals(
            $statusCode, $response->getStatusCode(),
            $response->getContent()
        );
        $this->assertTrue(
            $response->headers->contains('Content-Type', $contentType),
            $response->headers
        );

        if ($checkValidJson) {
            $decode = json_decode($response->getContent());
            $this->assertTrue(($decode != null && $decode != false),
                'is response valid json: [' . $response->getContent() . ']'
            );
        }
    }
}
