<?php
declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Http\Exception\NotFoundException;

/**
 * ReactEmbed component
 */
class ReactEmbedComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [];

    public function embedAssets($folderName)
    {
        $manifestFile = WWW_ROOT . $folderName . DS . 'asset-manifest.json';

        if (!file_exists($manifestFile)) {
            throw new NotFoundException('The file \'asset-manifest.json\' is not found in ' . $folderName);
        }

        $contents = file_get_contents($manifestFile);

        $assetManifest = json_decode($contents);

        $assets = collection($assetManifest->entrypoints)
            ->reduce(function ($accumulated, $entryPoint) use ($folderName) {
                $extension = pathinfo($entryPoint, PATHINFO_EXTENSION);
                return array_merge(
                    [
                        $extension => DS . $folderName . DS . $entryPoint
                    ],
                    $accumulated
                );
            }, []);

        $controller = $this->getController();

        $controller->set($assets);

    }
}
