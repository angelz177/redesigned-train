<?php


class GithubCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->wantTo('see the username angelz177 is already taken');
        $I->amOnPage('/');
        $I->seeInTitle('GitHub');
        $I->click('Sign up for GitHub');

        $I->waitForElement('#user_login');
        $I->fillField('#user_login', 'angelz177');
        $I->waitForText('Username is already taken', 2);
    }
}
