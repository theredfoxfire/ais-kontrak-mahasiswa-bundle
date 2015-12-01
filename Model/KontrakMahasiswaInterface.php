<?php

namespace Ais\KontrakMahasiswaBundle\Model;

Interface KontrakMahasiswaInterface
{
    /**
     * Get id
     *
     * @return integer
     */
    public function getId();

    /**
     * Set matakuliahId
     *
     * @param integer $matakuliahId
     *
     * @return KontrakMahasiswa
     */
    public function setMatakuliahId($matakuliahId);

    /**
     * Get matakuliahId
     *
     * @return integer
     */
    public function getMatakuliahId();

    /**
     * Set mahasiswaId
     *
     * @param integer $mahasiswaId
     *
     * @return KontrakMahasiswa
     */
    public function setMahasiswaId($mahasiswaId);

    /**
     * Get mahasiswaId
     *
     * @return integer
     */
    public function getMahasiswaId();

    /**
     * Set semesterId
     *
     * @param integer $semesterId
     *
     * @return KontrakMahasiswa
     */
    public function setSemesterId($semesterId);

    /**
     * Get semesterId
     *
     * @return integer
     */
    public function getSemesterId();

    /**
     * Set kelasId
     *
     * @param integer $kelasId
     *
     * @return KontrakMahasiswa
     */
    public function setKelasId($kelasId);

    /**
     * Get kelasId
     *
     * @return integer
     */
    public function getKelasId();

    /**
     * Set nilaiTugas
     *
     * @param string $nilaiTugas
     *
     * @return KontrakMahasiswa
     */
    public function setNilaiTugas($nilaiTugas);

    /**
     * Get nilaiTugas
     *
     * @return string
     */
    public function getNilaiTugas();

    /**
     * Set nilaiUas
     *
     * @param string $nilaiUas
     *
     * @return KontrakMahasiswa
     */
    public function setNilaiUas($nilaiUas);

    /**
     * Get nilaiUas
     *
     * @return string
     */
    public function getNilaiUas();

    /**
     * Set nilaiUts
     *
     * @param string $nilaiUts
     *
     * @return KontrakMahasiswa
     */
    public function setNilaiUts($nilaiUts);

    /**
     * Get nilaiUts
     *
     * @return string
     */
    public function getNilaiUts();

    /**
     * Set nilaiHuruf
     *
     * @param string $nilaiHuruf
     *
     * @return KontrakMahasiswa
     */
    public function setNilaiHuruf($nilaiHuruf);

    /**
     * Get nilaiHuruf
     *
     * @return string
     */
    public function getNilaiHuruf();

    /**
     * Set nilaiAngka
     *
     * @param string $nilaiAngka
     *
     * @return KontrakMahasiswa
     */
    public function setNilaiAngka($nilaiAngka);

    /**
     * Get nilaiAngka
     *
     * @return string
     */
    public function getNilaiAngka();

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return KontrakMahasiswa
     */
    public function setIsActive($isActive);

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive();

    /**
     * Set isDelete
     *
     * @param boolean $isDelete
     *
     * @return KontrakMahasiswa
     */
    public function setIsDelete($isDelete);

    /**
     * Get isDelete
     *
     * @return boolean
     */
    public function getIsDelete();
}
