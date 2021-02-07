<?php 
  require 'db_conn.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/styles.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <title>TO DO LIST</title>
  </head>
  <body>
    <div class="mt-5 m-auto card" style="width: 80%;">
      <div class="card-body">
      <form action="add.php" method="POST" autocomplete="off" id="add_form">
        <h3>TODO LIST</h3>
        <div class="add-section">
            <?php if(isset($_GET['mess']) && $_GET['mess'] == 'error'){?>
              <div class="m-auto row" style="width: 80%;">
                <input type="text" class="form-control" name='empty_des' style="border-color: #ff9999;" placeholder='Please fill in a task'/>
                <input type="submit" value="Add" id="empty_Add"/>
              </div>
            <?php } else{?>
              <div class="m-auto row" style="width: 80%;">
                <input type="text" class="form-control" name='des' id="des_input_id" placeholder='Enter a task to do'/>
                <button type="submit" id="fill_Add">Add</button>
                </div>
            <?php }?>
        </div>
        <?php $tasks = $pdo->query("SELECT * FROM tasks ORDER BY id DESC");?>
          <div class="show-todo-section">
            <?php if($tasks->rowCount()=== 0){?>
              <div class="todo-item"> 
                <div type="empty">
                  <h2>Your tasks will show here</h2>
                  <small>task creation time will be shown here</small>
                </div>
              </div>
            <?php } ?>
            <?php while($task = $tasks->fetch(PDO::FETCH_ASSOC)){?>
              <div class="todo-item">
                <span id="<?php echo $task['id'];?>" class="remove-to-do">
                  <i class="fa fa-window-close-o"></i>
                </span>
                <?php if($task['checked']){ ?>
                    <input type="checkbox" id="<?php echo $task['id'];?>"
                    class="check-box" checked/>
                    <h2 class="des checked" >"<?php echo $task['des']?>"</h2>
                    <?php }else{?>
                      <input type="checkbox" id="<?php echo $task['id'];?>" class="check-box"/>
                      <h2 class="des" >"<?php echo $task['des']?>"</h2>
                      
                <?php } ?>
                    <div class="d-flex flex-row">
                    <!-- <form action="edit.php" method="POST" > -->
                      <small>created: <?php echo $task['date_time']?></small>
                      <input edit_id="<?php echo $task['id'];?>" 
                        edit_text="<?php echo $task['des'];?>" value="edit" type="button" class="btn btn-primary edit_task"/>
                        <input update_id="<?php echo $task['id'];?>" 
                        update_text="<?php echo $task['des'];?>"
                        formaction="edit.php" value="update" type="button" name="update_name" class="btn btn-warning update_task"/>
                        <!-- <i class="fa fa-pencil-square-o" aria-hidden="true"></i> -->
                    <!-- </form> -->

                    </div>
              </div>
            <?php }?>
        </div>
      </form>
      </div>
  </div>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
   
    <script src="js/jquery-min.js"></script>
    <script>
      $(document).ready(function(){
        var edit_clicked = false;
        var input_field_changed = false;
        
        $("#des_input_id").on("change paste keyup", function() {
          input_field_changed = true;
          });
          $(document).mousemove(function(event){
            if(edit_clicked && input_field_changed){
              $('#update_id').prop('disabled', 'false');
        }
          }); 

        setTimeout(function() {
          if(window.location.href=="http://localhost/todo/index.php?mess=error")
            window.location.href = "http://localhost/todo/index.php";
          }, 1000);
         $('.remove-to-do').click(function(e){
           const id = $(this).attr('id');
            $.post("remove.php",
            {
              id : id
            },(data) =>{
              $(this).parent().hide(300);
            });
         });

         $('.check-box').click(function(e){
          const _id = $(this).attr('id');
          $.post('check.php', {id: _id},(data)=>{
            if(data != 'error'){
              const h2 = $(this).next();
              if(data === '1'){
                h2.removeClass('checked')
              }else{
                h2.addClass('checked')
              }
            } 
          });
         });

        $('.update_task').on('click',function(e){
          e.preventDefault();
            $.ajax({
                type: "POST",
                url: "edit.php",
                data: { 
                    id: $(this).attr('update_id'), // < note use of 'this' here
                    des: document.getElementById('des_input_id').value 
                },
                success: function(result) {
                    // alert(result);
                    window.location.href = "http://localhost/todo/index.php";
                },
                error: function(result) {
                    alert('error');
                }
            });
        });

        $('.edit_task').on('click', function(){
          edit_clicked = true
          // var id = $(this).attr('edit_id');
          var des = $(this).attr('edit_text');
          $('input[name$="des"]').focus();
          document.getElementById('des_input_id').value = des;
          var new_des = document.getElementById('des_input_id').value
        });       
          });
    </script>
  </body>
</html>



