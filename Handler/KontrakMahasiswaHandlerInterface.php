<?php

namespace Ais\KontrakMahasiswaBundle\Handler;

use Ais\KontrakMahasiswaBundle\Model\KontrakMahasiswaInterface;

interface KontrakMahasiswaHandlerInterface
{
    /**
     * Get a KontrakMahasiswa given the identifier
     *
     * @api
     *
     * @param mixed $id
     *
     * @return KontrakMahasiswaInterface
     */
    public function get($id);

    /**
     * Get a list of KontrakMahasiswas.
     *
     * @param int $limit  the limit of the result
     * @param int $offset starting from the offset
     *
     * @return array
     */
    public function all($limit = 5, $offset = 0);

    /**
     * Post KontrakMahasiswa, creates a new KontrakMahasiswa.
     *
     * @api
     *
     * @param array $parameters
     *
     * @return KontrakMahasiswaInterface
     */
    public function post(array $parameters);

    /**
     * Edit a KontrakMahasiswa.
     *
     * @api
     *
     * @param KontrakMahasiswaInterface   $kontrak_mahasiswa
     * @param array           $parameters
     *
     * @return KontrakMahasiswaInterface
     */
    public function put(KontrakMahasiswaInterface $kontrak_mahasiswa, array $parameters);

    /**
     * Partially update a KontrakMahasiswa.
     *
     * @api
     *
     * @param KontrakMahasiswaInterface   $kontrak_mahasiswa
     * @param array           $parameters
     *
     * @return KontrakMahasiswaInterface
     */
    public function patch(KontrakMahasiswaInterface $kontrak_mahasiswa, array $parameters);
}
