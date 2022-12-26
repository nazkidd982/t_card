<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.10.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @var AppView $this
 */

use App\View\AppView;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;
use Cake\Routing\Router;

//$this->disableAutoLayout();

$this->Html->css($css, ['block' => true]);
$this->Html->script($js , ['block' => 'react-script']);

$checkConnection = function (string $name) {
    $error = null;
    $connected = false;
    try {
        $connection = ConnectionManager::get($name);
        $connected = $connection->connect();
    } catch (Exception $connectionError) {
        $error = $connectionError->getMessage();
        if (method_exists($connectionError, 'getAttributes')) {
            $attributes = $connectionError->getAttributes();
            if (isset($attributes['message'])) {
                $error .= '<br />' . $attributes['message'];
            }
        }
    }

    return compact('connected', 'error');
};

if (!Configure::read('debug')) :
    throw new NotFoundException('Please replace templates/Pages/home.php with your own version or re-enable debug mode.');
endif;

?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        Tyrell: Interview Assessment
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'cake', 'home']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
<header>
    <div class="container text-center">
        <a href="/" target="_self" rel="noopener">
            <img alt="CakePHP" src="https://cakephp.org/v2/img/logos/CakePHP_Logo.svg" width="350"/>
        </a>
        <h1>
            Tyrell: Interview Assessment
        </h1>
    </div>
</header>
<main class="main">
    <div class="container">
        <div class="content" style="margin-bottom: 50px;">
            <div class="row">
                <div class="column">
                    <h3>
                        React (Installed) Preview
                    </h3>
                    <div id="root" data-url="<?= Router::url(['controller' => 'React','action' => 'api'], true); ?>">

                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="row">
                <div class="column">
                    <h3>
                        CakePHP Server with Docker Summary
                    </h3>
                    <div id="url-rewriting-warning"
                         style="padding: 1rem; background: #fcebea; color: #cc1f1a; border-color: #ef5753;">
                        <ul>
                            <li class="bullet problem">
                                URL rewriting is not properly configured on your server.<br/>
                                1) <a target="_blank" rel="noopener"
                                      href="https://book.cakephp.org/4/en/installation.html#url-rewriting">Help me
                                    configure it</a><br/>
                                2) <a target="_blank" rel="noopener"
                                      href="https://book.cakephp.org/4/en/development/configuration.html#general-configuration">I
                                    don't / can't use URL rewriting</a>
                            </li>
                        </ul>
                    </div>
                    <?php Debugger::checkSecurityKeys(); ?>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <h4>Environment</h4>
                    <ul>
                        <li class="bullet success">
                            CakePHP <?= h(Configure::version()) ?> Strawberry (🍓)
                        </li>
                        <?php if (version_compare(PHP_VERSION, '7.4.0', '>=')) : ?>
                            <li class="bullet success">Your version of PHP is 7.4.0 or higher
                                (detected <?= PHP_VERSION ?>).
                            </li>
                        <?php else : ?>
                            <li class="bullet problem">Your version of PHP is too low. You need PHP 7.4.0 or higher to
                                use CakePHP (detected <?= PHP_VERSION ?>).
                            </li>
                        <?php endif; ?>

                        <?php if (extension_loaded('mbstring')) : ?>
                            <li class="bullet success">Your version of PHP has the mbstring extension loaded.</li>
                        <?php else : ?>
                            <li class="bullet problem">Your version of PHP does NOT have the mbstring extension
                                loaded.
                            </li>
                        <?php endif; ?>

                        <?php if (extension_loaded('openssl')) : ?>
                            <li class="bullet success">Your version of PHP has the openssl extension loaded.</li>
                        <?php elseif (extension_loaded('mcrypt')) : ?>
                            <li class="bullet success">Your version of PHP has the mcrypt extension loaded.</li>
                        <?php else : ?>
                            <li class="bullet problem">Your version of PHP does NOT have the openssl or mcrypt extension
                                loaded.
                            </li>
                        <?php endif; ?>

                        <?php if (extension_loaded('intl')) : ?>
                            <li class="bullet success">Your version of PHP has the intl extension loaded.</li>
                        <?php else : ?>
                            <li class="bullet problem">Your version of PHP does NOT have the intl extension loaded.</li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="column">
                    <h4>Filesystem</h4>
                    <ul>
                        <?php if (is_writable(TMP)) : ?>
                            <li class="bullet success">Your tmp directory is writable.</li>
                        <?php else : ?>
                            <li class="bullet problem">Your tmp directory is NOT writable.</li>
                        <?php endif; ?>

                        <?php if (is_writable(LOGS)) : ?>
                            <li class="bullet success">Your logs directory is writable.</li>
                        <?php else : ?>
                            <li class="bullet problem">Your logs directory is NOT writable.</li>
                        <?php endif; ?>

                        <?php $settings = Cache::getConfig('_cake_core_'); ?>
                        <?php if (!empty($settings)) : ?>
                            <li class="bullet success">The <em><?= h($settings['className']) ?></em> is being used for
                                core caching. To change the config edit config/app.php
                            </li>
                        <?php else : ?>
                            <li class="bullet problem">Your cache is NOT working. Please check the settings in
                                config/app.php
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="column">
                    <h4>Database</h4>
                    <?php
                    $result = $checkConnection('default');
                    ?>
                    <ul>
                        <?php if ($result['connected']) : ?>
                            <li class="bullet success">CakePHP is able to connect to the database.</li>
                        <?php else : ?>
                            <li class="bullet problem">CakePHP is NOT able to connect to the
                                database.<br/><?= h($result['error']) ?></li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="column">
                    <h4>DebugKit</h4>
                    <ul>
                        <?php if (Plugin::isLoaded('DebugKit')) : ?>
                            <li class="bullet success">DebugKit is loaded.</li>
                            <?php
                            $result = $checkConnection('debug_kit');
                            ?>
                            <?php if ($result['connected']) : ?>
                                <li class="bullet success">DebugKit can connect to the database.</li>
                            <?php else : ?>
                                <li class="bullet problem">DebugKit is <strong>not</strong> able to connect to the
                                    database.<br/><?= $result['error'] ?></li>
                            <?php endif; ?>
                        <?php else : ?>
                            <li class="bullet problem">DebugKit is <strong>not</strong> loaded.</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>
