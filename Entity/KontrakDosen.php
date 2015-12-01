<?php

namespace Ais\KontrakDosenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ais\KontrakDosenBundle\Model\KontrakDosenInterface;

/**
 * KontrakDosen
 */
class KontrakDosen implements KontrakDosenInterface
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
    private $dosen_id;

    /**
     * @var integer
     */
    private $semester_id;

    /**
     * @var integer
     */
    private $kelas_id;

    /**
     * @var integer
     */
    private $max_siswa;

    /**
     * @var integer
     */
    private $filter_id;

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
     * @return KontrakDosen
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
     * Set dosenId
     *
     * @param integer $dosenId
     *
     * @return KontrakDosen
     */
    public function setDosenId($dosenId)
    {
        $this->dosen_id = $dosenId;

        return $this;
    }

    /**
     * Get dosenId
     *
     * @return integer
     */
    public function getDosenId()
    {
        return $this->dosen_id;
    }

    /**
     * Set semesterId
     *
     * @param integer $semesterId
     *
     * @return KontrakDosen
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
     * @return KontrakDosen
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
     * Set maxSiswa
     *
     * @param integer $maxSiswa
     *
     * @return KontrakDosen
     */
    public function setMaxSiswa($maxSiswa)
    {
        $this->max_siswa = $maxSiswa;

        return $this;
    }

    /**
     * Get maxSiswa
     *
     * @return integer
     */
    public function getMaxSiswa()
    {
        return $this->max_siswa;
    }

    /**
     * Set filterId
     *
     * @param integer $filterId
     *
     * @return KontrakDosen
     */
    public function setFilterId($filterId)
    {
        $this->filter_id = $filterId;

        return $this;
    }

    /**
     * Get filterId
     *
     * @return integer
     */
    public function getFilterId()
    {
        return $this->filter_id;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return KontrakDosen
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
     * @return KontrakDosen
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

