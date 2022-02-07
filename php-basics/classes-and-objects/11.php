<?php

class Account
{
    private string $name;
    private float $balance;

    public function __construct(string $name, float $balance)
    {
        $this->name = $name;
        $this->balance = $balance;

    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }

    public function deposit(float $amount): void
    {
        $this->balance += $amount;
    }

    public function withdrawal(float $amount): void
    {
        $this->balance -= $amount;
    }

}

class AccountApplication
{
    private array $allAccounts;

    public function __construct(array $allAccounts = [])
    {
        $this->allAccounts = $allAccounts;
    }

    public function getAllAccounts(): array
    {
        return $this->allAccounts;
    }

    public function displayAllAccounts()
    {
        foreach ($this->allAccounts as $account) {
            echo "Account '{$account->getName()}' balance: " . $account->getBalance() . PHP_EOL;
        }
    }

    public function displayOneAccount(string $accountName)
    {
        foreach ($this->allAccounts as $account) {
            if ($accountName === $account->getName())
            {
                echo "Account '{$account->getName()}' balance: " . $account->getBalance() . PHP_EOL;
            }
        }
    }

    public function run()
    {
        while (true) {
            echo "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~" . PHP_EOL;
            echo "Choose the operation you want to perform: " . PHP_EOL;
            echo "Choose [1] to create a new account" . PHP_EOL;
            echo "Choose [2] to display balance of all accounts" . PHP_EOL;
            echo "Choose [3] to withdraw money from account" . PHP_EOL;
            echo "Choose [4] to deposit money to account" . PHP_EOL;
            echo "Choose [5] to transfer money from one account to another account" . PHP_EOL;
            echo "Choose [6] to exit" . PHP_EOL;

            $command = (int)readline();

            switch ($command) {
                case 1:
                    $accountName = readline("Enter account's name: ");
                    $accountBalance = readline("Enter account's opening balance: ");
                    $this->addAccount($accountName, $accountBalance);
                    echo "The account has been created successfully." . PHP_EOL;
                    $this->displayAllAccounts();
                    break;
                case 2:
                    echo "All accounts:" . PHP_EOL;
                    $this->displayAllAccounts();
                    break;
                case 3:
                    $accountName = readline("Enter account's name you want to withdraw from: ");
                    if (!$this->accountIsRegistered($accountName))
                    {
                        echo "Please check the name of account. This account's name is not registered in our application." . PHP_EOL;
                        break;
                    }
                    $this->displayOneAccount($accountName);
                    $withdrawalAmount = readline("Enter the amount you would like to withdraw: ");
                    $this->withdrawalFrom($accountName, $withdrawalAmount);
                    $this->displayOneAccount($accountName);
                    break;
                case 4:
                    $accountName = readline("Enter account's name you want to deposit to: ");
                    if (!$this->accountIsRegistered($accountName))
                    {
                        echo "Please check the name of account. This account's name is not registered in our application." . PHP_EOL;
                        break;
                    }
                    $this->displayOneAccount($accountName);
                    $depositAmount = readline("Enter amount you would like to deposit: ");
                    $this->depositTo($accountName, $depositAmount);
                    $this->displayOneAccount($accountName);
                    break;
                case 5:
                    $fromAccountName = readline("Enter account's name you want to transfer from: ");
                    if (!$this->accountIsRegistered($fromAccountName))
                    {
                        echo "Please check the name of account. This account's name is not registered in our application." . PHP_EOL;
                        break;
                    }
                    $toAccountName = readline("Enter account's name you want to transfer to: ");
                    if (!$this->accountIsRegistered($toAccountName))
                    {
                        echo "Please check the name of account. This account's name is not registered in our application." . PHP_EOL;
                        break;
                    }
                    $this->displayOneAccount($fromAccountName);
                    $amount = readline("Enter amount you would like to transfer from '{$fromAccountName}' to '{$toAccountName}': ");
                    $this->transfer($fromAccountName, $toAccountName, $amount);
                    echo "The transfer has been successful." . PHP_EOL;
                    $this->displayOneAccount($fromAccountName);
                    break;
                case 6:
                    echo "Bye!" . PHP_EOL;
                    die;
                default:
                    echo "Sorry, I don't understand you." . PHP_EOL;
                    break;
            }
        }
    }

    public function addAccount(string $name, float $balance): void
    {
        $this->allAccounts [] = new Account($name, $balance);
    }

    public function depositTo(string $accountName, float $amount): void
    {
        foreach ($this->allAccounts as $account) {
            if ($account->getName() === $accountName) {
                $account->deposit($amount);
            }
        }
    }

    public function withdrawalFrom(string $accountName, float $amount): void
    {
        foreach ($this->allAccounts as $account) {
            if ($account->getName() === $accountName) {
                $account->withdrawal($amount);
            }
        }
    }

    public function transfer(string $fromAccountName, string $toAccountName, float $amount): void
    {

        foreach ($this->allAccounts as $account) {
            if ($account->getName() === $fromAccountName) {
                $account->withdrawal($amount);
            }
        }
        foreach ($this->allAccounts as $account) {
            if ($account->getName() === $toAccountName) {
                $account->deposit($amount);
            }
        }
    }

    private function accountIsRegistered(string $accountName): bool
    {
        foreach ($this->getAllAccounts() as $account) {
            if ($account->getName() === $accountName) {
                return true;
            }
        }
        return false;
    }

}

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

$app = new AccountApplication();
$app->run();

$test = new TestAccountApplication();
$test->test();

//Exercise #11
//The object of the class Account represents a bank account that has a balance (meaning some amount of money).
// The accounts are used as follows:
//
//$bartos_account = new Account("Barto's account", 100.00);
//$bartos_swiss_account = new Account("Barto's account in Switzerland", 1000000.00);
//
//echo "Initial state";
//echo $bartos_account;
//echo $bartos_swiss_account;
//
//$bartos_account->withdrawal(20);
//echo "Barto's account balance is now: " . $bartos_account->balance();
//$bartos_swiss_account->deposit(200);
//echo "Barto's Swiss account balance is now: ".$bartos_swiss_account->balance();
//
//echo "Final state";
//echo $bartos_account;
//echo $bartos_swiss_account;
//Your first account
//Create a program that creates an account with the balance of 100.0, deposits 20.0 and prints the account.
//
//Note! do all the steps described in the exercise exactly in the described order!
//
//Your first money transfer
//Create a program that:
//
//Creates an account named "Matt's account" with the balance of 1000
//Creates an account named "My account" with the balance of 0
//Withdraws 100.0 from Matt's account
//Deposits 100.0 to My account
//Prints both accounts
//Money transfers
//In the above program, you made a money transfer from one person to another.
// Let us next create a method that does the same!
//
//Create the method:
//
//function transfer(Account $from, Account $to, int $howMuch) { }
//The method transfers money from one account to another.
// You do not need to check that the from account has enough balance.
//
//After completing the above, make sure that your main method does the following:
//
//Creates an account "A" with the balance of 100.0
//Creates an account "B" with the balance of 0.0
//Creates an account "C" with the balance of 0.0
//Transfers 50.0 from account A to account B
//Transfers 25.0 from account B to account C