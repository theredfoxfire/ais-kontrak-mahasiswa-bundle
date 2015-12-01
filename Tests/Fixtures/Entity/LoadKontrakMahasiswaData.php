<?php

namespace Ais\KontrakMahasiswaBundle\Tests\Fixtures\Entity;

use Ais\KontrakMahasiswaBundle\Entity\KontrakMahasiswa;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadKontrakMahasiswaData implements FixtureInterface
{
    static public $kontrak_mahasiswas = array();

    public function load(ObjectManager $manager)
    {
        $kontrak_mahasiswa = new KontrakMahasiswa();
        $kontrak_mahasiswa->setTitle('title');
        $kontrak_mahasiswa->setBody('body');

        $manager->persist($kontrak_mahasiswa);
        $manager->flush();

        self::$kontrak_mahasiswas[] = $kontrak_mahasiswa;
    }
}
