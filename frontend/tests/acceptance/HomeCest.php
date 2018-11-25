<?php
namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class HomeCest
{
    public function checkHome(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/index'));
        $I->see('My Application');

        $I->seeLink('About');
        $I->click('About');
        $I->wait(2); // wait for page to be opened
        $I->see('This is the About page.');

        $I->seeLink('Contact');
        $I->click('Contact');
        $I->wait(2); // wait for page to be opened
        $I->see('please fill out the following form to contact us');

        $I->seeLink('Signup');
        $I->click('Signup');
        $I->wait(2); // wait for page to be opened
        $I->see('Please fill out the following fields to signup:');

        $I->seeLink('Login');
        $I->click('Login');
        $I->wait(2); // wait for page to be opened
        $I->see('Please fill out the following fields to login:');
    }
}
