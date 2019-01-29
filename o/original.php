<?php

class Programmer
{
    public function code()
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


class ProjectManagement
{
    public function process($member)
    {
        if($member instanceof Programmer)
        {
            return $member->code();
        }
        elseif($member instanceof Tester)
        {
            return $member->test();
        }

        throw new Exception('Je ne sais pas qui vous êtes !');
    }
}


// (...)

$programmer1 = new Programmer();
$programmer2 = new Programmer();

$tester1 = new Tester();

$project = new ProjectManagement();
echo $project->process($programmer1);
echo $project->process($programmer2);
echo $project->process($tester1);