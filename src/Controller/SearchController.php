<?php



namespace App\Controller;
use App\Entity\Number;
use App\Repository\NumberRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;



/**
 * @method getDoctrine()
 * @method createNotFoundException(string $string)
 * @Route("/search")
 */
class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="numbersearch", methods={"GET","POST"})
     * @param Request $request
     * @param $searchvalue
     */
    public function search(Request $request)
    {
        $input = $request->request->get('searchvalue');
        $results = $this->getDoctrine()->getRepository(Number::class)->findNumbersBySearch($input);

        return $this->render('search/search.html.twig', [
            'results'=>$results
        ]);
    }
    }

// Old search function;
//    public function search(Request $request, $searchvalue)
//    {
//        $request->query->get($searchvalue);
//        $this->findNumbersBySearch($searchvalue);
//        foreach($searchvalue as $searchvalues){
//            $output[] = array($searchvalues->getName());
//        }
//        return $this->render('search/search.html.twig', [
//            'number' => $output->findAll(),
//        ]);
//
//    }
//}










