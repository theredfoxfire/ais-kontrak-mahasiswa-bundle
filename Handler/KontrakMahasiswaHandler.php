<?php

namespace Ais\KontrakMahasiswaBundle\Handler;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormFactoryInterface;
use Ais\KontrakMahasiswaBundle\Model\KontrakMahasiswaInterface;
use Ais\KontrakMahasiswaBundle\Form\KontrakMahasiswaType;
use Ais\KontrakMahasiswaBundle\Exception\InvalidFormException;

class KontrakMahasiswaHandler implements KontrakMahasiswaHandlerInterface
{
    private $om;
    private $entityClass;
    private $repository;
    private $formFactory;

    public function __construct(ObjectManager $om, $entityClass, FormFactoryInterface $formFactory)
    {
        $this->om = $om;
        $this->entityClass = $entityClass;
        $this->repository = $this->om->getRepository($this->entityClass);
        $this->formFactory = $formFactory;
    }

    /**
     * Get a KontrakMahasiswa.
     *
     * @param mixed $id
     *
     * @return KontrakMahasiswaInterface
     */
    public function get($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Get a list of KontrakMahasiswas.
     *
     * @param int $limit  the limit of the result
     * @param int $offset starting from the offset
     *
     * @return array
     */
    public function all($limit = 5, $offset = 0)
    {
        return $this->repository->findBy(array(), null, $limit, $offset);
    }

    /**
     * Create a new KontrakMahasiswa.
     *
     * @param array $parameters
     *
     * @return KontrakMahasiswaInterface
     */
    public function post(array $parameters)
    {
        $kontrak_mahasiswa = $this->createKontrakMahasiswa();

        return $this->processForm($kontrak_mahasiswa, $parameters, 'POST');
    }

    /**
     * Edit a KontrakMahasiswa.
     *
     * @param KontrakMahasiswaInterface $kontrak_mahasiswa
     * @param array         $parameters
     *
     * @return KontrakMahasiswaInterface
     */
    public function put(KontrakMahasiswaInterface $kontrak_mahasiswa, array $parameters)
    {
        return $this->processForm($kontrak_mahasiswa, $parameters, 'PUT');
    }

    /**
     * Partially update a KontrakMahasiswa.
     *
     * @param KontrakMahasiswaInterface $kontrak_mahasiswa
     * @param array         $parameters
     *
     * @return KontrakMahasiswaInterface
     */
    public function patch(KontrakMahasiswaInterface $kontrak_mahasiswa, array $parameters)
    {
        return $this->processForm($kontrak_mahasiswa, $parameters, 'PATCH');
    }

    /**
     * Processes the form.
     *
     * @param KontrakMahasiswaInterface $kontrak_mahasiswa
     * @param array         $parameters
     * @param String        $method
     *
     * @return KontrakMahasiswaInterface
     *
     * @throws \Ais\KontrakMahasiswaBundle\Exception\InvalidFormException
     */
    private function processForm(KontrakMahasiswaInterface $kontrak_mahasiswa, array $parameters, $method = "PUT")
    {
        $form = $this->formFactory->create(new KontrakMahasiswaType(), $kontrak_mahasiswa, array('method' => $method));
        $form->submit($parameters, 'PATCH' !== $method);
        if ($form->isValid()) {

            $kontrak_mahasiswa = $form->getData();
            $this->om->persist($kontrak_mahasiswa);
            $this->om->flush($kontrak_mahasiswa);

            return $kontrak_mahasiswa;
        }

        throw new InvalidFormException('Invalid submitted data', $form);
    }

    private function createKontrakMahasiswa()
    {
        return new $this->entityClass();
    }

}
