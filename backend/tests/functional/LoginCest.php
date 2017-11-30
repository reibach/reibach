<?php

namespace backend\tests\functional;

<<<<<<< HEAD
use \backend\tests\FunctionalTester;
use common\fixtures\User as UserFixture;
=======
use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;
>>>>>>> ed511c9143c4679677ed09aaca9b0b7fd28874c4

/**
 * Class LoginCest
 */
class LoginCest
{
<<<<<<< HEAD
    public function _before(FunctionalTester $I)
    {
        $I->haveFixtures([
=======

    /**
     * Load fixtures before db transaction begin
     * Called in _before()
     * @see \Codeception\Module\Yii2::_before()
     * @see \Codeception\Module\Yii2::loadFixtures()
     * @return array
     */
    public function _fixtures()
    {
        return [
>>>>>>> ed511c9143c4679677ed09aaca9b0b7fd28874c4
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'login_data.php'
            ]
<<<<<<< HEAD
        ]);
    }
=======
        ];
    }
    
>>>>>>> ed511c9143c4679677ed09aaca9b0b7fd28874c4
    /**
     * @param FunctionalTester $I
     */
    public function loginUser(FunctionalTester $I)
    {
        $I->amOnPage('/site/login');
        $I->fillField('Username', 'erau');
        $I->fillField('Password', 'password_0');
        $I->click('login-button');

        $I->see('Logout (erau)', 'form button[type=submit]');
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Signup');
    }
}
