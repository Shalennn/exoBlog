<?php

namespace App\Controller;

use App\Service\ExempleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\WeatherType;


class ExempleController extends AbstractController
{
    public function __construct(
        private readonly ExempleService $exempleservice
    ){}

    #[Route('/exemple', name:'app_exemple_api')]
    public function showApi():Response{
        dd($this->exempleservice->getWeather());
        return new Response($this->exempleservice->test());
    }

    #[Route('/weather', name: 'app_weather')]
    public function showWeather(): Response
    {
        $donneMeteo = $this->exempleservice->getWeather();

        return $this->render('weather/weather.html.twig', [
            'ville' => $donneMeteo['name'],
            'temperature' => $donneMeteo['main']['temp'] - 273.15,
            'pays' => $donneMeteo['sys']['country'],
            'icon' => $donneMeteo['weather'][0]['icon'],
        ]);
    }

    #[Route('/meteo/city',name:'app_weather_city')]
    public function showWeatherByCity(Request $request) : Response {
        $meteo = "";
        $form = $this->createForm(WeatherType::class);
        $form->handleRequest($request);
        //Test si le formulaire est submit
        if($form->isSubmitted()) {
            //Récupération de la valeur de city
            //avec Request $request->request->all('weather')['city'],
            //avec Form $form->getData()['city'] 
            $meteo = $this->exempleservice->getWeatherByCity($form->getData()['city']);
        }
        return $this->render('weather/meteocity.html.twig',[
            'form' => $form,
            'meteo'=> $meteo
         ]);
    }
}

?>