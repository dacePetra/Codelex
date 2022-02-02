<?php

class Wallet
{
    public int $money;

    public function __construct(int $money)
    {
        $this->money = $money;
    }

    public function showWalletBalance(): int
    {
        return $this->money;
    }

    public function addToWallet(int $amount): string
    {
        $this->money += $amount;
        return $amount . " has been added to wallet." . PHP_EOL;
    }

    public function subtractFromWallet(int $amount):void
    {
        $this->money -= $amount;
    }

    public function checkEmptyWallet():void
    {
        if ($this->showWalletBalance() <= 0) {
            echo "The wallet is empty!" . PHP_EOL . "Thank you for playing!" . PHP_EOL;
            exit;
        }
    }
}

$wallet = new Wallet(100);

class SlotMachine
{
    public int $rows;
    public int $columns;
    public array $spinResult;
    public array $letters;

    public function addLetters($newLetter)
    {
        $this->letters [] = $newLetter;
    }

    public function getLetters(): array
    {
        return $this->letters;
    }
    function setRowsColumns(int $rows, int $columns): void
    {
        $this->rows = $rows-1;
        $this->columns = $columns-1;
    }
    function generateSpin(): void
    {
        foreach (range(0, $this->rows) as $row) {
            foreach (range(0, $this->columns) as $column) {
                $this->spinResult[$row][$column] = $this->getLetters()[array_rand($this->getLetters())];
            }
        }
    }

    function showSpin()
    {
        foreach ($this->spinResult as $key => $row) {
            foreach ($this->spinResult[$key] as $symbol) {
                echo " $symbol ";
            }
            echo PHP_EOL;
        }
    }
}
$board = new SlotMachine();
$board->addLetters("A");
$board->addLetters("B");
$board->addLetters("C");
$board->setRowsColumns(3,4);

class Payouts
{
    public array $payouts = [];

    public function __construct(array $payouts)
    {
        foreach ($payouts as $key => $payout) {
            $this->addPayout($key, $payout);
        }
    }

    public function addPayout(string $newLetter, int $newPayout): string
    {
        $this->payouts [$newLetter] = $newPayout;
        return $newLetter . "with payout" . $newPayout . " has been added." . PHP_EOL;
    }

    public function getPayouts(): array
    {
        return $this->payouts;
    }
}

$payouts = new Payouts([]);
$payouts->addPayout("A", 5);
$payouts->addPayout("B", 10);
$payouts->addPayout("C", 15);

$combinations = [
    [
        [0, 0], [0, 1], [0, 2], [0, 3]
    ],
    [
        [1, 0], [1, 1], [1, 2], [1, 3]
    ],
    [
        [2, 0], [2, 1], [2, 2], [2, 3]
    ],
    [
        [0, 0], [1, 1], [2, 2], [2, 3]
    ],
    [
        [2, 0], [1, 1], [0, 2], [0, 3]
    ],
];

echo "Welcome to my slot machine!" . PHP_EOL . PHP_EOL;

while (true) {
    echo '[1] Check wallet balance.' . PHP_EOL;
    echo '[2] Add money to wallet.' . PHP_EOL;
    echo '[3] Play!' . PHP_EOL;
    echo '[Any] Exit' . PHP_EOL;

    $option = (int)readline('Select an option: ');

    switch ($option) {
        case 1:
            echo "You have {$wallet->showWalletBalance()} EUR in your wallet." . PHP_EOL . PHP_EOL;
            break;
        case 2:
            $deposit = (int)readline("How much EUR would you like to deposit: ");
            echo PHP_EOL;
            $wallet->addToWallet($deposit);
            break;
        case 3: //Play
            $wallet->checkEmptyWallet();
            echo PHP_EOL . "Let's spin!" . PHP_EOL;
            echo "You have {$wallet->showWalletBalance()} EUR in your wallet." . PHP_EOL;

            $bet = (int)readline("Enter your bet: ");
            if ($bet === null || $bet <= 0) {
                echo "Please check your bet." . PHP_EOL . PHP_EOL;
                break;
            }
            if ($bet > $wallet->showWalletBalance()) {
                echo "You don't have enough money." . PHP_EOL . PHP_EOL;
                break;
            }
            readline("Press enter to spin!");
            $wallet->subtractFromWallet($bet);

            $board->generateSpin();
            $board->showSpin();

            for ($i = 0; $i < count($board->getLetters()); $i++) {
                foreach ($combinations as $combination) {
                    foreach ($combination as $item) {
                        [$r, $c] = $item;
                        if (($board->spinResult)[$r][$c] !== $board->getLetters()[$i]) {
                            break;
                        }
                        if (end($combination) === $item) {
                            echo "You have a line of {$board->getLetters()[$i]}! You have won {$payouts->getPayouts()[$board->getLetters()[$i]]} x {$bet} EUR." . PHP_EOL;
                            $wallet->addToWallet($payouts->getPayouts()[$board->getLetters()[$i]] * $bet);
                        }
                    }
                }
            };

            echo "You have {$wallet->showWalletBalance()} EUR in your wallet." . PHP_EOL . PHP_EOL;
            break;
        default:
            exit;
    };
}
