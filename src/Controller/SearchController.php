<?php



namespace App\Controller;
use App\Repository\NumberRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;



/**
 * @method getDoctrine()
 * @method render(string $string, array $array)
 * @method createNotFoundException(string $string)
 * @Route("/search")
 */
class SearchController extends NumberRepository
{
    /**
     * @Route("/search", name="numbersearch", methods={"GET","POST"})
     * @param Request $request
     * @param $searchvalue
     */
    public function search(Request $request, $searchvalue)
    {
        $request->query->get($searchvalue);
        $this->findNumbersBySearch($searchvalue);
        foreach($searchvalue as $searchvalues){
            $output[] = array($searchvalues->getName());
        }
        return $this->render('search/search.html.twig', [
            'number' => $output->findAll(),
        ]);

    }


}