<?php



namespace App\Controller;
use App\Entity\Number;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method getDoctrine()
 * @method render(string $string, array $array)
 * @method createNotFoundException(string $string)
 */
class SearchController
{

    /**
     * @Route("/search}", name="number_search")
     * @param Request $request
     * @param $searchvalue
     * @return Request
     */
    public function index(Request $request, $searchvalue)
    {
        $request->query->get($searchvalue);
        return $request;
    }
}