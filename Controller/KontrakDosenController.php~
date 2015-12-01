<?php

namespace Ais\KontrakDosenBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Request\ParamFetcherInterface;

use Symfony\Component\Form\FormTypeInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Ais\KontrakDosenBundle\Exception\InvalidFormException;
use Ais\KontrakDosenBundle\Form\KontrakDosenType;
use Ais\KontrakDosenBundle\Model\KontrakDosenInterface;


class KontrakDosenController extends FOSRestController
{
    /**
     * List all kontrak_dosens.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing kontrak_dosens.")
     * @Annotations\QueryParam(name="limit", requirements="\d+", default="5", description="How many kontrak_dosens to return.")
     *
     * @Annotations\View(
     *  templateVar="kontrak_dosens"
     * )
     *
     * @param Request               $request      the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function getKontrakDosensAction(Request $request, ParamFetcherInterface $paramFetcher)
    {
        $offset = $paramFetcher->get('offset');
        $offset = null == $offset ? 0 : $offset;
        $limit = $paramFetcher->get('limit');

        return $this->container->get('ais_kontrak_dosen.kontrak_dosen.handler')->all($limit, $offset);
    }

    /**
     * Get single KontrakDosen.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Gets a KontrakDosen for a given id",
     *   output = "Ais\KontrakDosenBundle\Entity\KontrakDosen",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the kontrak_dosen is not found"
     *   }
     * )
     *
     * @Annotations\View(templateVar="kontrak_dosen")
     *
     * @param int     $id      the kontrak_dosen id
     *
     * @return array
     *
     * @throws NotFoundHttpException when kontrak_dosen not exist
     */
    public function getKontrakDosenAction($id)
    {
        $kontrak_dosen = $this->getOr404($id);

        return $kontrak_dosen;
    }

    /**
     * Presents the form to use to create a new kontrak_dosen.
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
    public function newKontrakDosenAction()
    {
        return $this->createForm(new KontrakDosenType());
    }
    
    /**
     * Presents the form to use to edit kontrak_dosen.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "AisKontrakDosenBundle:KontrakDosen:editKontrakDosen.html.twig",
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     * @param int     $id      the kontrak_dosen id
     *
     * @return FormTypeInterface|View
     *
     * @throws NotFoundHttpException when kontrak_dosen not exist
     */
    public function editKontrakDosenAction($id)
    {
		$kontrak_dosen = $this->getKontrakDosenAction($id);
		
        return array('form' => $this->createForm(new KontrakDosenType(), $kontrak_dosen), 'kontrak_dosen' => $kontrak_dosen);
    }

    /**
     * Create a KontrakDosen from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Creates a new kontrak_dosen from the submitted data.",
     *   input = "Ais\KontrakDosenBundle\Form\KontrakDosenType",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "AisKontrakDosenBundle:KontrakDosen:newKontrakDosen.html.twig",
     *  statusCode = Codes::HTTP_BAD_REQUEST,
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     */
    public function postKontrakDosenAction(Request $request)
    {
        try {
            $newKontrakDosen = $this->container->get('ais_kontrak_dosen.kontrak_dosen.handler')->post(
                $request->request->all()
            );

            $routeOptions = array(
                'id' => $newKontrakDosen->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('api_1_get_kontrak_dosen', $routeOptions, Codes::HTTP_CREATED);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * Update existing kontrak_dosen from the submitted data or create a new kontrak_dosen at a specific location.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "Ais\KontrakDosenBundle\Form\KontrakDosenType",
     *   statusCodes = {
     *     201 = "Returned when the KontrakDosen is created",
     *     204 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "AisKontrakDosenBundle:KontrakDosen:editKontrakDosen.html.twig",
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     * @param int     $id      the kontrak_dosen id
     *
     * @return FormTypeInterface|View
     *
     * @throws NotFoundHttpException when kontrak_dosen not exist
     */
    public function putKontrakDosenAction(Request $request, $id)
    {
        try {
            if (!($kontrak_dosen = $this->container->get('ais_kontrak_dosen.kontrak_dosen.handler')->get($id))) {
                $statusCode = Codes::HTTP_CREATED;
                $kontrak_dosen = $this->container->get('ais_kontrak_dosen.kontrak_dosen.handler')->post(
                    $request->request->all()
                );
            } else {
                $statusCode = Codes::HTTP_NO_CONTENT;
                $kontrak_dosen = $this->container->get('ais_kontrak_dosen.kontrak_dosen.handler')->put(
                    $kontrak_dosen,
                    $request->request->all()
                );
            }

            $routeOptions = array(
                'id' => $kontrak_dosen->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('api_1_get_kontrak_dosen', $routeOptions, $statusCode);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * Update existing kontrak_dosen from the submitted data or create a new kontrak_dosen at a specific location.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "Ais\KontrakDosenBundle\Form\KontrakDosenType",
     *   statusCodes = {
     *     204 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "AisKontrakDosenBundle:KontrakDosen:editKontrakDosen.html.twig",
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     * @param int     $id      the kontrak_dosen id
     *
     * @return FormTypeInterface|View
     *
     * @throws NotFoundHttpException when kontrak_dosen not exist
     */
    public function patchKontrakDosenAction(Request $request, $id)
    {
        try {
            $kontrak_dosen = $this->container->get('ais_kontrak_dosen.kontrak_dosen.handler')->patch(
                $this->getOr404($id),
                $request->request->all()
            );

            $routeOptions = array(
                'id' => $kontrak_dosen->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('api_1_get_kontrak_dosen', $routeOptions, Codes::HTTP_NO_CONTENT);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * Fetch a KontrakDosen or throw an 404 Exception.
     *
     * @param mixed $id
     *
     * @return KontrakDosenInterface
     *
     * @throws NotFoundHttpException
     */
    protected function getOr404($id)
    {
        if (!($kontrak_dosen = $this->container->get('ais_kontrak_dosen.kontrak_dosen.handler')->get($id))) {
            throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.',$id));
        }

        return $kontrak_dosen;
    }
    
    public function postUpdateKontrakDosenAction(Request $request, $id)
    {
		try {
            $kontrak_dosen = $this->container->get('ais_kontrak_dosen.kontrak_dosen.handler')->patch(
                $this->getOr404($id),
                $request->request->all()
            );

            $routeOptions = array(
                'id' => $kontrak_dosen->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('api_1_get_kontrak_dosen', $routeOptions, Codes::HTTP_NO_CONTENT);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
	}
}
