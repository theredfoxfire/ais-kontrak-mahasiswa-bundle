<?php

namespace Ais\KontrakMahasiswaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Request\ParamFetcherInterface;

use Symfony\Component\Form\FormTypeInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Ais\KontrakMahasiswaBundle\Exception\InvalidFormException;
use Ais\KontrakMahasiswaBundle\Form\KontrakMahasiswaType;
use Ais\KontrakMahasiswaBundle\Model\KontrakMahasiswaInterface;


class KontrakMahasiswaController extends FOSRestController
{
    /**
     * List all kontrak_mahasiswas.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing kontrak_mahasiswas.")
     * @Annotations\QueryParam(name="limit", requirements="\d+", default="5", description="How many kontrak_mahasiswas to return.")
     *
     * @Annotations\View(
     *  templateVar="kontrak_mahasiswas"
     * )
     *
     * @param Request               $request      the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function getKontrakMahasiswasAction(Request $request, ParamFetcherInterface $paramFetcher)
    {
        $offset = $paramFetcher->get('offset');
        $offset = null == $offset ? 0 : $offset;
        $limit = $paramFetcher->get('limit');

        return $this->container->get('ais_kontrak_mahasiswa.kontrak_mahasiswa.handler')->all($limit, $offset);
    }

    /**
     * Get single KontrakMahasiswa.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Gets a KontrakMahasiswa for a given id",
     *   output = "Ais\KontrakMahasiswaBundle\Entity\KontrakMahasiswa",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the kontrak_mahasiswa is not found"
     *   }
     * )
     *
     * @Annotations\View(templateVar="kontrak_mahasiswa")
     *
     * @param int     $id      the kontrak_mahasiswa id
     *
     * @return array
     *
     * @throws NotFoundHttpException when kontrak_mahasiswa not exist
     */
    public function getKontrakMahasiswaAction($id)
    {
        $kontrak_mahasiswa = $this->getOr404($id);

        return $kontrak_mahasiswa;
    }

    /**
     * Presents the form to use to create a new kontrak_mahasiswa.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\View(
     *  templateVar = "form"
     * )
     *
     * @return FormTypeInterface
     */
    public function newKontrakMahasiswaAction()
    {
        return $this->createForm(new KontrakMahasiswaType());
    }
    
    /**
     * Presents the form to use to edit kontrak_mahasiswa.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "AisKontrakMahasiswaBundle:KontrakMahasiswa:editKontrakMahasiswa.html.twig",
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     * @param int     $id      the kontrak_mahasiswa id
     *
     * @return FormTypeInterface|View
     *
     * @throws NotFoundHttpException when kontrak_mahasiswa not exist
     */
    public function editKontrakMahasiswaAction($id)
    {
		$kontrak_mahasiswa = $this->getKontrakMahasiswaAction($id);
		
        return array('form' => $this->createForm(new KontrakMahasiswaType(), $kontrak_mahasiswa), 'kontrak_mahasiswa' => $kontrak_mahasiswa);
    }

    /**
     * Create a KontrakMahasiswa from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Creates a new kontrak_mahasiswa from the submitted data.",
     *   input = "Ais\KontrakMahasiswaBundle\Form\KontrakMahasiswaType",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "AisKontrakMahasiswaBundle:KontrakMahasiswa:newKontrakMahasiswa.html.twig",
     *  statusCode = Codes::HTTP_BAD_REQUEST,
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     */
    public function postKontrakMahasiswaAction(Request $request)
    {
        try {
            $newKontrakMahasiswa = $this->container->get('ais_kontrak_mahasiswa.kontrak_mahasiswa.handler')->post(
                $request->request->all()
            );

            $routeOptions = array(
                'id' => $newKontrakMahasiswa->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('api_1_get_kontrak_mahasiswa', $routeOptions, Codes::HTTP_CREATED);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * Update existing kontrak_mahasiswa from the submitted data or create a new kontrak_mahasiswa at a specific location.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "Ais\KontrakMahasiswaBundle\Form\KontrakMahasiswaType",
     *   statusCodes = {
     *     201 = "Returned when the KontrakMahasiswa is created",
     *     204 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "AisKontrakMahasiswaBundle:KontrakMahasiswa:editKontrakMahasiswa.html.twig",
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     * @param int     $id      the kontrak_mahasiswa id
     *
     * @return FormTypeInterface|View
     *
     * @throws NotFoundHttpException when kontrak_mahasiswa not exist
     */
    public function putKontrakMahasiswaAction(Request $request, $id)
    {
        try {
            if (!($kontrak_mahasiswa = $this->container->get('ais_kontrak_mahasiswa.kontrak_mahasiswa.handler')->get($id))) {
                $statusCode = Codes::HTTP_CREATED;
                $kontrak_mahasiswa = $this->container->get('ais_kontrak_mahasiswa.kontrak_mahasiswa.handler')->post(
                    $request->request->all()
                );
            } else {
                $statusCode = Codes::HTTP_NO_CONTENT;
                $kontrak_mahasiswa = $this->container->get('ais_kontrak_mahasiswa.kontrak_mahasiswa.handler')->put(
                    $kontrak_mahasiswa,
                    $request->request->all()
                );
            }

            $routeOptions = array(
                'id' => $kontrak_mahasiswa->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('api_1_get_kontrak_mahasiswa', $routeOptions, $statusCode);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * Update existing kontrak_mahasiswa from the submitted data or create a new kontrak_mahasiswa at a specific location.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "Ais\KontrakMahasiswaBundle\Form\KontrakMahasiswaType",
     *   statusCodes = {
     *     204 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "AisKontrakMahasiswaBundle:KontrakMahasiswa:editKontrakMahasiswa.html.twig",
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     * @param int     $id      the kontrak_mahasiswa id
     *
     * @return FormTypeInterface|View
     *
     * @throws NotFoundHttpException when kontrak_mahasiswa not exist
     */
    public function patchKontrakMahasiswaAction(Request $request, $id)
    {
        try {
            $kontrak_mahasiswa = $this->container->get('ais_kontrak_mahasiswa.kontrak_mahasiswa.handler')->patch(
                $this->getOr404($id),
                $request->request->all()
            );

            $routeOptions = array(
                'id' => $kontrak_mahasiswa->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('api_1_get_kontrak_mahasiswa', $routeOptions, Codes::HTTP_NO_CONTENT);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * Fetch a KontrakMahasiswa or throw an 404 Exception.
     *
     * @param mixed $id
     *
     * @return KontrakMahasiswaInterface
     *
     * @throws NotFoundHttpException
     */
    protected function getOr404($id)
    {
        if (!($kontrak_mahasiswa = $this->container->get('ais_kontrak_mahasiswa.kontrak_mahasiswa.handler')->get($id))) {
            throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.',$id));
        }

        return $kontrak_mahasiswa;
    }
    
    public function postUpdateKontrakMahasiswaAction(Request $request, $id)
    {
		try {
            $kontrak_mahasiswa = $this->container->get('ais_kontrak_mahasiswa.kontrak_mahasiswa.handler')->patch(
                $this->getOr404($id),
                $request->request->all()
            );

            $routeOptions = array(
                'id' => $kontrak_mahasiswa->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('api_1_get_kontrak_mahasiswa', $routeOptions, Codes::HTTP_NO_CONTENT);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
	}
}
