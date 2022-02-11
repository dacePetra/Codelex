<?php
class TestAccountApplication
{
    private AccountApplication $app;

    public function __construct()
    {
        $this->app= new AccountApplication();
    }

    public function test()
    {
        $this->app->addAccount("Barto's", 100);
        $this->app->addAccount("Barto's Swiss", 1000000);
        echo "Initial state:" . PHP_EOL;
        $this->app->displayOneAccount("Barto's");
        $this->app->displayOneAccount("Barto's Swiss");
        $this->app->depositTo("Barto's Swiss", 20);
        $this->app->withdrawalFrom("Barto's", 30);
        echo "Withdraws 30 from Barto's account & deposits 20 in Barto's Swiss account" . PHP_EOL;
        echo "Final state:" . PHP_EOL;
        $this->app->displayOneAccount("Barto's");
        $this->app->displayOneAccount("Barto's Swiss");

        echo "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~" . PHP_EOL;

        $this->app->addAccount("Matt's", 1000);
        $this->app->addAccount("my", 0);
        echo "Initial state:" . PHP_EOL;
        $this->app->displayOneAccount("Matt's");
        $this->app->displayOneAccount("my");
        $this->app->depositTo("my", 100);
        $this->app->withdrawalFrom("Matt's", 100);
        echo "Withdraws 100.0 from Matt's account & Deposits 100.0 to My account" . PHP_EOL;
        echo "Final state:" . PHP_EOL;
        $this->app->displayOneAccount("Matt's");
        $this->app->displayOneAccount("my");

        echo "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~" . PHP_EOL;

        $this->app->addAccount("A", 100);
        $this->app->addAccount("B", 0);
        $this->app->addAccount("C", 0);
        echo "Initial state:" . PHP_EOL;
        $this->app->displayOneAccount("A");
        $this->app->displayOneAccount("B");
        $this->app->displayOneAccount("C");
        echo "Transfers 50.0 from account A to account B & Transfers 25.0 from account B to account C" . PHP_EOL;
        $this->app->transfer("A", "B", 50);
        $this->app->transfer("B", "C", 25);
        echo "Final state:" . PHP_EOL;
        $this->app->displayOneAccount("A");
        $this->app->displayOneAccount("B");
        $this->app->displayOneAccount("C");

    }

}