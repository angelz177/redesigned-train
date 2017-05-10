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
        $I->comment('start test');
        $I->wantTo('see the main Github page');
        $I->amOnPage('/');
        $I->seeInTitle('GitHub');
    }
}
