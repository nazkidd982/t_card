<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\Component\ReactEmbedComponent;
use Exception;

/**
 * React Controller
 *
 * @property ReactEmbedComponent $ReactEmbed
 */
class ReactController extends AppController
{
    /**
     * Initialize controller
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('ReactEmbed');
    }

    public function frontPage()
    {
        $this->ReactEmbed->embedAssets('tyrell-react');
    }

//    public function api()
//    {
//        $data = [
//            'Card Distribution',
//            'Current SQL',
//            'New SQL'
//        ];
//
//        $this->set(compact('data'));
//        $this->viewBuilder()->setOption('serialize', ['data']);
//
//        if (!$this->request->is('ajax')) {
//            return $this->getResponse()
//                ->withStringBody(
//                    '<pre>' .
//                    json_encode($data, JSON_PRETTY_PRINT)
//                    . '</pre>'
//                );
//        }
//    }

//    public function cardDistribution($playerNumber)

    /**
     * @throws Exception
     */
    public function api($playerNumber = null)
    {
        $playerNumber = 0;

        /**
         * Spade = S, Heart = H, Diamond = D, Club = C
         * Card 2 to 9 are, as it is, 1=A,10=X,11=J,12=Q,13=K
         */
        $allCards = [
            'A-S', '2-S', '3-S', '4-S', '5-S', '6-S', '7-S', '8-S', '9-S', 'X-S', 'J-S', 'Q-S', 'K-S',
            'A-H', '2-H', '3-H', '4-H', '5-H', '6-H', '7-H', '8-H', '9-H', 'X-H', 'J-H', 'Q-H', 'K-H',
            'A-D', '2-D', '3-D', '4-D', '5-D', '6-D', '7-D', '8-D', '9-D', 'X-D', 'J-D', 'Q-D', 'K-D',
            'A-C', '2-C', '3-C', '4-C', '5-C', '6-C', '7-C', '8-C', '9-C', 'X-C', 'J-C', 'Q-C', 'K-C',
        ];

        shuffle($allCards);
        $data = [];

        if($playerNumber > 0) {
            $player = 0;
            foreach ($allCards as $cardKey => $card) {
                $data[$player][] = $card;
                unset($cardKey);
                if ($player < ($playerNumber - 1)) {
                    $player++;
                } else {
                    $player = 0;
                }
            }

            if($playerNumber > 52) {
                for($i = 52; $i <= $playerNumber; $i++){
                    $data[$i][] = 'Not enough card';
                }
            }
        } elseif ($playerNumber < 0) {
            throw new Exception('Invalid player number');
        } else {
            $data[] = ['No players'];
        }

        $this->set(compact('data'));
        $this->viewBuilder()->setOption('serialize', ['data']);

        if (!$this->request->is('ajax')) {
            return $this->getResponse()->withStringBody('<pre>' . json_encode($data, JSON_PRETTY_PRINT) . '</pre>');
        }
    }
}
