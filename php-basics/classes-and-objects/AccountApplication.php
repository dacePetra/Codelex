<?php

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