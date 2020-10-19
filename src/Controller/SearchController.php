<?php



namespace App\Controller;
use App\Entity\Number;
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
     * @Route("/product/{name}", name="product_show")
     * @param $name
     * @return NotFoundHttpException|Response
     */
    public function show($name)
    {
        $product = $this->getDoctrine()
            ->getRepository(Number::class)
            ->find($name);

        if (!$product) {
            throw $this->createNotFoundException(
                'No number found for '.$name
            );
        }

        return $this->render('product/show.html.twig', ['product' => $product]);
    }
}