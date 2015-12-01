<?php

namespace Ais\KontrakMahasiswaBundle\Tests\Handler;

use Ais\KontrakMahasiswaBundle\Handler\KontrakMahasiswaHandler;
use Ais\KontrakMahasiswaBundle\Model\KontrakMahasiswaInterface;
use Ais\KontrakMahasiswaBundle\Entity\KontrakMahasiswa;

class KontrakMahasiswaHandlerTest extends \PHPUnit_Framework_TestCase
{
    const DOSEN_CLASS = 'Ais\KontrakMahasiswaBundle\Tests\Handler\DummyKontrakMahasiswa';

    /** @var KontrakMahasiswaHandler */
    protected $kontrak_mahasiswaHandler;
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $om;
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $repository;

    public function setUp()
    {
        if (!interface_exists('Doctrine\Common\Persistence\ObjectManager')) {
            $this->markTestSkipped('Doctrine Common has to be installed for this test to run.');
        }
        
        $class = $this->getMock('Doctrine\Common\Persistence\Mapping\ClassMetadata');
        $this->om = $this->getMock('Doctrine\Common\Persistence\ObjectManager');
        $this->repository = $this->getMock('Doctrine\Common\Persistence\ObjectRepository');
        $this->formFactory = $this->getMock('Symfony\Component\Form\FormFactoryInterface');

        $this->om->expects($this->any())
            ->method('getRepository')
            ->with($this->equalTo(static::DOSEN_CLASS))
            ->will($this->returnValue($this->repository));
        $this->om->expects($this->any())
            ->method('getClassMetadata')
            ->with($this->equalTo(static::DOSEN_CLASS))
            ->will($this->returnValue($class));
        $class->expects($this->any())
            ->method('getName')
            ->will($this->returnValue(static::DOSEN_CLASS));
    }


    public function testGet()
    {
        $id = 1;
        $kontrak_mahasiswa = $this->getKontrakMahasiswa();
        $this->repository->expects($this->once())->method('find')
            ->with($this->equalTo($id))
            ->will($this->returnValue($kontrak_mahasiswa));

        $this->kontrak_mahasiswaHandler = $this->createKontrakMahasiswaHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);

        $this->kontrak_mahasiswaHandler->get($id);
    }

    public function testAll()
    {
        $offset = 1;
        $limit = 2;

        $kontrak_mahasiswas = $this->getKontrakMahasiswas(2);
        $this->repository->expects($this->once())->method('findBy')
            ->with(array(), null, $limit, $offset)
            ->will($this->returnValue($kontrak_mahasiswas));

        $this->kontrak_mahasiswaHandler = $this->createKontrakMahasiswaHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);

        $all = $this->kontrak_mahasiswaHandler->all($limit, $offset);

        $this->assertEquals($kontrak_mahasiswas, $all);
    }

    public function testPost()
    {
        $title = 'title1';
        $body = 'body1';

        $parameters = array('title' => $title, 'body' => $body);

        $kontrak_mahasiswa = $this->getKontrakMahasiswa();
        $kontrak_mahasiswa->setTitle($title);
        $kontrak_mahasiswa->setBody($body);

        $form = $this->getMock('Ais\KontrakMahasiswaBundle\Tests\FormInterface'); //'Symfony\Component\Form\FormInterface' bugs on iterator
        $form->expects($this->once())
            ->method('submit')
            ->with($this->anything());
        $form->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(true));
        $form->expects($this->once())
            ->method('getData')
            ->will($this->returnValue($kontrak_mahasiswa));

        $this->formFactory->expects($this->once())
            ->method('create')
            ->will($this->returnValue($form));

        $this->kontrak_mahasiswaHandler = $this->createKontrakMahasiswaHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);
        $kontrak_mahasiswaObject = $this->kontrak_mahasiswaHandler->post($parameters);

        $this->assertEquals($kontrak_mahasiswaObject, $kontrak_mahasiswa);
    }

    /**
     * @expectedException Ais\KontrakMahasiswaBundle\Exception\InvalidFormException
     */
    public function testPostShouldRaiseException()
    {
        $title = 'title1';
        $body = 'body1';

        $parameters = array('title' => $title, 'body' => $body);

        $kontrak_mahasiswa = $this->getKontrakMahasiswa();
        $kontrak_mahasiswa->setTitle($title);
        $kontrak_mahasiswa->setBody($body);

        $form = $this->getMock('Ais\KontrakMahasiswaBundle\Tests\FormInterface'); //'Symfony\Component\Form\FormInterface' bugs on iterator
        $form->expects($this->once())
            ->method('submit')
            ->with($this->anything());
        $form->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(false));

        $this->formFactory->expects($this->once())
            ->method('create')
            ->will($this->returnValue($form));

        $this->kontrak_mahasiswaHandler = $this->createKontrakMahasiswaHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);
        $this->kontrak_mahasiswaHandler->post($parameters);
    }

    public function testPut()
    {
        $title = 'title1';
        $body = 'body1';

        $parameters = array('title' => $title, 'body' => $body);

        $kontrak_mahasiswa = $this->getKontrakMahasiswa();
        $kontrak_mahasiswa->setTitle($title);
        $kontrak_mahasiswa->setBody($body);

        $form = $this->getMock('Ais\KontrakMahasiswaBundle\Tests\FormInterface'); //'Symfony\Component\Form\FormInterface' bugs on iterator
        $form->expects($this->once())
            ->method('submit')
            ->with($this->anything());
        $form->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(true));
        $form->expects($this->once())
            ->method('getData')
            ->will($this->returnValue($kontrak_mahasiswa));

        $this->formFactory->expects($this->once())
            ->method('create')
            ->will($this->returnValue($form));

        $this->kontrak_mahasiswaHandler = $this->createKontrakMahasiswaHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);
        $kontrak_mahasiswaObject = $this->kontrak_mahasiswaHandler->put($kontrak_mahasiswa, $parameters);

        $this->assertEquals($kontrak_mahasiswaObject, $kontrak_mahasiswa);
    }

    public function testPatch()
    {
        $title = 'title1';
        $body = 'body1';

        $parameters = array('body' => $body);

        $kontrak_mahasiswa = $this->getKontrakMahasiswa();
        $kontrak_mahasiswa->setTitle($title);
        $kontrak_mahasiswa->setBody($body);

        $form = $this->getMock('Ais\KontrakMahasiswaBundle\Tests\FormInterface'); //'Symfony\Component\Form\FormInterface' bugs on iterator
        $form->expects($this->once())
            ->method('submit')
            ->with($this->anything());
        $form->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(true));
        $form->expects($this->once())
            ->method('getData')
            ->will($this->returnValue($kontrak_mahasiswa));

        $this->formFactory->expects($this->once())
            ->method('create')
            ->will($this->returnValue($form));

        $this->kontrak_mahasiswaHandler = $this->createKontrakMahasiswaHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);
        $kontrak_mahasiswaObject = $this->kontrak_mahasiswaHandler->patch($kontrak_mahasiswa, $parameters);

        $this->assertEquals($kontrak_mahasiswaObject, $kontrak_mahasiswa);
    }


    protected function createKontrakMahasiswaHandler($objectManager, $kontrak_mahasiswaClass, $formFactory)
    {
        return new KontrakMahasiswaHandler($objectManager, $kontrak_mahasiswaClass, $formFactory);
    }

    protected function getKontrakMahasiswa()
    {
        $kontrak_mahasiswaClass = static::DOSEN_CLASS;

        return new $kontrak_mahasiswaClass();
    }

    protected function getKontrakMahasiswas($maxKontrakMahasiswas = 5)
    {
        $kontrak_mahasiswas = array();
        for($i = 0; $i < $maxKontrakMahasiswas; $i++) {
            $kontrak_mahasiswas[] = $this->getKontrakMahasiswa();
        }

        return $kontrak_mahasiswas;
    }
}

class DummyKontrakMahasiswa extends KontrakMahasiswa
{
}
