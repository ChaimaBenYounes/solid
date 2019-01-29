<?php
//http://www.lafabriquedecode.com/blog/2014/02/php-le-design-pattern-adaptateur/

interface IEmployee
{
    public function work();
}


class Programmer implements IEmployee
{
    public function work()
    {
        echo '<h2>Je code !</h2>';
    }
}


class Tester implements IEmployee
{
    public function work()
    {
        echo '<h2>Je teste !</h2>';
    }
}

class GraphicsDesigner implements IEmployee
{
    public function work()
    {
        echo '<h2>Je rend ça beau !</h2>';
    }
}


class ProjectManagement
{
    public function process(IEmployee $member)
    {
        return $member->work();
    }
}

class AdapterWork  {

    private $adapterWork;

    public function __construct(IEmployee $IEmployee){
        $this->adapterWork = $IEmployee;
    }
    public function work()
    {
        return $this->adapterWork->work();
    }
}

// (...)

$workers = [new Programmer(), new GraphicsDesigner() , new AdapterWork(new Tester())];

foreach($workers as $worker) {
    $worker->work();
}

// Correction

/*
class Programmer
{
    public function work()
    {
        return '<h2>Je code !</h2>';
    }
}


class Tester
{
    public function test()
    {
        return '<h2>Je teste !</h2>';
    }
}


class TesterAdaptater {

    private $tester;
    public function __construct(Tester $tester) {
        $this->tester = $tester;
    }

    public function work() {
        return $this->tester->test();
    }

}

$workers = [new Programmer(), new TesterAdaptater(new Tester())];

foreach($workers as $worker) {
    $worker->work();
}
*/