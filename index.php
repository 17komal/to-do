<?php 

include('query.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <!-- Latest compiled and minified CSS -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">


</head>
<body>
<div class="container">
    <div>
        <h1 id='heading'>To Do List</h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-white">
                <div class="card-body">
                    <form action="javascript:void(0);">
                        <div id="Formfields">
                        <input type="text" class=" add-task" placeholder="New Task..." id='taskName'>
                        <button type="button" class="btn btn-outline-success" id="addTask"><i class="fas fa-plus"></i></button>
                        </div>
                        
                    </form>
                    <ul class="nav nav-pills todo-nav">
                        <li role="presentation" class="nav-item all-task active"><a href="#" class="nav-link">All</a></li>
                        <li role="presentation" class="nav-item active-task"><a href="#" class="nav-link">Active</a></li>
                        <li role="presentation" class="nav-item completed-task"><a href="#" class="nav-link">Completed</a></li>
                    </ul>
                    <div class="todo-list" id='todo-list'>
                                               
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


	
</body>
</html>
<script src="js/jquery.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>

<script>

$( document ).ready(function() {
    
    "use strict";
    getTask();
    var todo = function() { 
        $('.todo-list .todo-item input').click(function() {
        if($(this).is(':checked')) {
            $(this).parent().parent().parent().toggleClass('complete');
        } else {
            $(this).parent().parent().parent().toggleClass('complete');
        }
    });
    
    $('.todo-nav .all-task').click(function() {
        $('.todo-list').removeClass('only-active');
        $('.todo-list').removeClass('only-complete');
        $('.todo-nav li.active').removeClass('active');
        $(this).addClass('active');
    });
    
    $('.todo-nav .active-task').click(function() {
        $('.todo-list').removeClass('only-complete');
        $('.todo-list').addClass('only-active');
        $('.todo-nav li.active').removeClass('active');
        $(this).addClass('active');
    });
    
    $('.todo-nav .completed-task').click(function() {
        $('.todo-list').removeClass('only-active');
        $('.todo-list').addClass('only-complete');
        $('.todo-nav li.active').removeClass('active');
        $(this).addClass('active');
    });
    
    $('#uniform-all-complete input').click(function() {
        if($(this).is(':checked')) {
            $('.todo-item .checker span:not(.checked) input').click();
        } else {
            $('.todo-item .checker span.checked input').click();
        }
    });
    
    $('.remove-todo-item').click(function() {
        $(this).parent().remove();
    });
    };
    
    todo();
   
    
    
   
}); 
    function getTask()
    {
        $.get('query.php',{"getTask":"getTask"},function(res) {  
            
         
          var data = JSON.parse(res);
          if(data)
          {
            $('#todo-list').html('');
          }
          $.each(data, function(k,v)
          {
            if(v['status'] == 'Done')
            {
                var addTaskRow ='  <div class="todo-item complete"><div class="checker"></div><span>'+v['task']+'</span><button type="button" class="btn btn-outline-danger" id = "removeTask"  onclick="removeTask('+v['list_id']+');"><i class="fas fa-trash"></i></button><button type="button" class="btn btn-outline-success" id = "completeTask"  onclick="completeTask('+v['list_id']+');" disabled><i class="fas fa-thumbs-up"></i></button> </div>';
            }
            else
            {
                var addTaskRow ='  <div class="todo-item"><div class="checker"></div><span>'+v['task']+'</span><button type="button" class="btn btn-outline-danger" id = "removeTask"  onclick="removeTask('+v['list_id']+');"><i class="fas fa-trash"></i></button><button type="button" class="btn btn-outline-success" id = "completeTask"  onclick="completeTask('+v['list_id']+');" ><i class="fas fa-thumbs-up"></i></button></div>';
            }
          
            $('#todo-list').append(addTaskRow);
          })
            

        });
    }
    $('#addTask').click(function() 
    {
       var taskName = $('#taskName').val();
       if(taskName )
        {
            $.post('query.php',{'taskName':taskName},function(res)
            {
                if(res == 'Task Added')
                    {
                        alert('Task Added');
                        getTask();
                    }
                    else
                    {
                        alert('Something Went Wrong');
                    }
            }); 
        }
        else
        {
            alert('Please Add Task') ;
        }     
    });

    
    function removeTask(id)
    {
        if(id )
        {
            $.post('query.php',{'removeTask':id},function(res)
            {
                if(res == 1)
                    {
                        alert('Task Deleted');
                        getTask();
                    }
                    else
                    {
                        alert('Something Went Wrong');
                    }
            }); 
        }
        else
        {
            alert('Something Went Wrong') ;
        }
    }


    function completeTask(id)
    {
        if(id )
        {
            $.post('query.php',{'completeTask':id},function(res)
            {
                if(res == 1)
                    {
                        alert('Task Completed');
                        getTask();
                    }
                    else
                    {
                        alert('Something Went Wrong');
                    }
            }); 
        }
        else
        {
            alert('Something Went Wrong') ;
        }
    }


</script>