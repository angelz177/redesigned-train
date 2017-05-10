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
        $I->fillField('Username', 'angelz177');
        $I->see('Username is already taken');
    }
}
