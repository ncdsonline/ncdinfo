<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
<?php $this->head() ?>



    </head>
    <body>

            <?php $this->beginBody() ?>
        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => 'NCD Info',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            if (Yii::$app->user->isGuest) {

                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => [
                        ['label' => 'Home', 'url' => ['/site/index']],
                        ['label' => 'About', 'url' => ['/site/about']],
                        ['label' => 'Signup', 'url' => ['/site/signup']],
                        Yii::$app->user->isGuest ?
                                ['label' => 'Login', 'url' => ['/site/login']] :
                                ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                    ],
                ]);
            } else if (Yii::$app->user->identity->profile->office_id == 10727) {
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => [
                        ['label' => 'Home', 'url' => ['/site/index']],
                        ['label' => 'UploadLab', 'url' => ['/site/uploadlabdata'],
                        // 'visible'=>!Yii::$app->user->isGuest
                        //visible'=>Yii::app()->user->checkAccess('account')
                        // 'visible'=>  Yii::$app->user->identity->profile->office_id==10727
                        ],
                        // ['label' => 'Contact', 'url' => ['/site/contact']],
                        Yii::$app->user->isGuest ?
                                ['label' => 'Login', 'url' => ['/site/login']] :
                                ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                    ],
                ]);
            } else {

                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => [
                        ['label' => 'Home', 'url' => ['/site/index']],
                        ['label' => 'Chronics', 'url' => ['/chronicsprevalence/index']],
                        ['label' => 'Diabetes', 'url' => ['/dmprevalence/index']],
                        ['label' => 'Hypertension', 'url' => ['/htprevalence/index']],
                        ['label' => 'Ncdscreen', 'url' => ['/screenncd/index']],
                        ['label' => 'Prediabetes', 'url' => ['/prediabetes/index']],
                        ['label' => 'Prehypertension', 'url' => ['/prehypertension/index']],

                       // ['label' => 'Report', 'url' => ['/site/report']],

                        Yii::$app->user->isGuest ?
                                ['label' => 'Login', 'url' => ['/site/login']] :
                                ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                    ],
                ]);
            }

            NavBar::end();
            ?>

            <div class="container">

            <?=
            Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ])
            ?>
            <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; เครือข่ายบริการสุขภาพอำเภอเมืองเพชรบูรณ์ <?= date('Y').' - '.(date('Y')+5)  ?> </p>
                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>

                <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
