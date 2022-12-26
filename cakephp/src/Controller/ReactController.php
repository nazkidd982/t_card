<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\Component\ReactEmbedComponent;

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

    public function api(){
        $data = [
          'Card Distribution',
          'Current SQL',
          'New SQL'
        ];

        $this->set(compact('data'));
        $this->viewBuilder()->setOption('serialize', ['data']);

        if(!$this->request->is('ajax')){
            return $this->getResponse()
                ->withStringBody(
                    '<pre>'.
                    json_encode($data, JSON_PRETTY_PRINT)
                    .'</pre>'
                );
        }
    }
}
