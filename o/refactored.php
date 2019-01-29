<?php

interface IEmployee
{
    public function work();
}


class Programmer implements IEmployee
{
    public function work()
    {
        return '<h2>Je code !</h2>';
    }
}


class Tester implements IEmployee
{
    public function work()
    {
        return '<h2>Je teste !</h2>';
    }
}


class GraphicsDesigner implements IEmployee
{
    public function work()
    {
        return '<h2>Je rend ça beau !</h2>';
    }
}


class ProjectManagement
{
    public function process(IEmployee $member)
    {
        return $member->work();
    }
}


// (...)

$programmer1 = new Programmer();
$programmer2 = new Programmer();

$tester1 = new Tester();

$graphicsDesigner1 = new GraphicsDesigner();

$project = new ProjectManagement();
echo $project->process($programmer1);
echo $project->process($programmer2);
echo $project->process($tester1);
echo $project->process($graphicsDesigner1);