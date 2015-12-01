<?php

namespace Ais\KontrakMahasiswaBundle\Entity;

use Doctrine\ORM\Mapping;
use Ais\KontrakMahasiswaBundle\Model\KontrakMahasiswaInterface;

/**
 * KontrakMahasiswa
 */
class KontrakMahasiswa implements KontrakMahasiswaInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $matakuliah_id;

    /**
     * @var integer
     */
    private $mahasiswa_id;

    /**
     * @var integer
     */
    private $semester_id;

    /**
     * @var integer
     */
    private $kelas_id;

    /**
     * @var string
     */
    private $nilai_tugas;

    /**
     * @var string
     */
    private $nilai_uas;

    /**
     * @var string
     */
    private $nilai_uts;

    /**
     * @var string
     */
    private $nilai_huruf;

    /**
     * @var string
     */
    private $nilai_angka;

    /**
     * @var boolean
     */
    private $is_active;

    /**
     * @var boolean
     */
    private $is_delete;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set matakuliahId
     *
     * @param integer $matakuliahId
     *
     * @return KontrakMahasiswa
     */
    public function setMatakuliahId($matakuliahId)
    {
        $this->matakuliah_id = $matakuliahId;

        return $this;
    }

    /**
     * Get matakuliahId
     *
     * @return integer
     */
    public function getMatakuliahId()
    {
        return $this->matakuliah_id;
    }

    /**
     * Set mahasiswaId
     *
     * @param integer $mahasiswaId
     *
     * @return KontrakMahasiswa
     */
    public function setMahasiswaId($mahasiswaId)
    {
        $this->mahasiswa_id = $mahasiswaId;

        return $this;
    }

    /**
     * Get mahasiswaId
     *
     * @return integer
     */
    public function getMahasiswaId()
    {
        return $this->mahasiswa_id;
    }

    /**
     * Set semesterId
     *
     * @param integer $semesterId
     *
     * @return KontrakMahasiswa
     */
    public function setSemesterId($semesterId)
    {
        $this->semester_id = $semesterId;

        return $this;
    }

    /**
     * Get semesterId
     *
     * @return integer
     */
    public function getSemesterId()
    {
        return $this->semester_id;
    }

    /**
     * Set kelasId
     *
     * @param integer $kelasId
     *
     * @return KontrakMahasiswa
     */
    public function setKelasId($kelasId)
    {
        $this->kelas_id = $kelasId;

        return $this;
    }

    /**
     * Get kelasId
     *
     * @return integer
     */
    public function getKelasId()
    {
        return $this->kelas_id;
    }

    /**
     * Set nilaiTugas
     *
     * @param string $nilaiTugas
     *
     * @return KontrakMahasiswa
     */
    public function setNilaiTugas($nilaiTugas)
    {
        $this->nilai_tugas = $nilaiTugas;

        return $this;
    }

    /**
     * Get nilaiTugas
     *
     * @return string
     */
    public function getNilaiTugas()
    {
        return $this->nilai_tugas;
    }

    /**
     * Set nilaiUas
     *
     * @param string $nilaiUas
     *
     * @return KontrakMahasiswa
     */
    public function setNilaiUas($nilaiUas)
    {
        $this->nilai_uas = $nilaiUas;

        return $this;
    }

    /**
     * Get nilaiUas
     *
     * @return string
     */
    public function getNilaiUas()
    {
        return $this->nilai_uas;
    }

    /**
     * Set nilaiUts
     *
     * @param string $nilaiUts
     *
     * @return KontrakMahasiswa
     */
    public function setNilaiUts($nilaiUts)
    {
        $this->nilai_uts = $nilaiUts;

        return $this;
    }

    /**
     * Get nilaiUts
     *
     * @return string
     */
    public function getNilaiUts()
    {
        return $this->nilai_uts;
    }

    /**
     * Set nilaiHuruf
     *
     * @param string $nilaiHuruf
     *
     * @return KontrakMahasiswa
     */
    public function setNilaiHuruf($nilaiHuruf)
    {
        $this->nilai_huruf = $nilaiHuruf;

        return $this;
    }

    /**
     * Get nilaiHuruf
     *
     * @return string
     */
    public function getNilaiHuruf()
    {
        return $this->nilai_huruf;
    }

    /**
     * Set nilaiAngka
     *
     * @param string $nilaiAngka
     *
     * @return KontrakMahasiswa
     */
    public function setNilaiAngka($nilaiAngka)
    {
        $this->nilai_angka = $nilaiAngka;

        return $this;
    }

    /**
     * Get nilaiAngka
     *
     * @return string
     */
    public function getNilaiAngka()
    {
        return $this->nilai_angka;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return KontrakMahasiswa
     */
    public function setIsActive($isActive)
    {
        $this->is_active = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * Set isDelete
     *
     * @param boolean $isDelete
     *
     * @return KontrakMahasiswa
     */
    public function setIsDelete($isDelete)
    {
        $this->is_delete = $isDelete;

        return $this;
    }

    /**
     * Get isDelete
     *
     * @return boolean
     */
    public function getIsDelete()
    {
        return $this->is_delete;
    }
}

