<?php 
$childs = array();

//Fork some process
for($i = 0; î < 10; $i++)
{
    $pid = pcntl_fork();
    if($pid == -1) die('could not fork');
    if($pid)
    {
        echo "Parent \n";
        $childs[] = $pid;
    } else {
        sleep($i + 1);
        exit();
    }
}

/*
while(count($childs) > 0)
{
    foreach($childs as $key => $pid)
    {
        $res = pcntl_waitpid($pid);
    }
}
*/
?>