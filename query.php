<?php 

include('database.php');

class query extends database
{
   
    public function addTask($task)
    {        
        $task = "'".$task."'";
        $addTask = 'Insert Into list(task) values ('.$task.')';   
    
        $res = $this->connect()->query($addTask);
        if( $res == 1)
        {
            echo 'Task Added';
        }
        else
        {
            echo 'Something went Wrong';
        }          
    }

    public function getAllTask()
    {
        $getTask = 'Select * from list where flag ="show"';   
        $finalTaskData=[];
        $res = $this->connect()->query($getTask);
        while($row=mysqli_fetch_assoc($res))
        {         
          array_push($finalTaskData,$row);          
        }
        return $finalTaskData;
       
    }
    public function removeTask($id)
    {
        $getTask = 'update list set flag ="Delete" where list_id ='.$id;     
        $res = $this->connect()->query($getTask);
        if( $res == 1)
        {
            echo $res;
        }
        else
        {
            echo 0;
        }
       
    }

    public function completeTask($id)
    {
        $getTask = 'update list set status ="Done" where list_id ='.$id;     
        $res = $this->connect()->query($getTask);
        if( $res == 1)
        {
            echo $res;
        }
        else
        {
            echo 0;
        }
       
    }
    public function editTask($id)
    {
        $getTask = 'update list set task ='.$task.' where list_id ='.$id;     
        $res = $this->connect()->query($getTask);
        if( $res == 1)
        {
            echo $res;
        }
        else
        {
            echo 0;
        }
       
    }
}
$obj = new query();
if(isset( $_POST['taskName']))
{
    $task = $_POST['taskName'];
    $res = $obj->addTask($task);
    echo $res;
}
if(isset( $_GET['getTask']))
{
    $finalTaskData = $obj->getAllTask();
    print_r(json_encode($finalTaskData) );
}

if(isset( $_POST['removeTask']))
{
    $taskId = $_POST['removeTask'];
    $res = $obj->removeTask($taskId);
    echo $res;
}

if(isset( $_POST['completeTask']))
{
    $taskId = $_POST['completeTask'];
    $res = $obj->completeTask($taskId);
    echo $res;
}
if(isset( $_POST['editTask']))
{
    $taskId = $_POST['editTask'];
    $res = $obj->editTask($taskId);
    echo $res;
}
?>