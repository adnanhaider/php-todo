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
        <h3>TODO LIST</h3>
        <div class="add-section">
          <form action="add.php" method="POST" autocomplete="off" id="add_form">
            <?php if(isset($_GET['mess']) && $_GET['mess'] == 'error'){?>
              <div class="m-auto row" style="width: 80%;">
                <input type="text" class="form-control" name='empty_des' style="border-color: #ff9999;" placeholder='Please fill in a task'/>
                <button type="submit" id="fill_Add">Add</button>
              </div>
            <?php } else{?>
              <div class="m-auto row" style="width: 80%;">
                <input type="text" class="form-control" name='des' id="des_input_id" placeholder='Enter a task to do'/>
                <button type="submit" id="fill_Add">
                  Add</button>
                </div>
            <?php }?>
          </form>
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
                      <small>created: <?php echo $task['date_time']?></small>
                      <span id="<?php echo $task['id']?>" 
                        value="<?php echo $task['des']?>" class="edit_task">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                      </span>
                    </div>
              </div>
            <?php }?>
        </div>
      </div>
  </div>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
   
    <script src="js/jquery-min.js"></script>
    <script>
      $(document).ready(function(){
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
          const id = $(this).attr('id');
          $.post('check.php', {id: id},(data)=>{
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
         $("#fill_Add").click(function () {
              $(this).text(function(i, text){
                  return text === "Update" ? "Add" : "Add";
              })
          });

         $("#fill_Add").click(function(){
            // $('#add_form').attr('action', 'add.php')
            const button_text = $('#fill_Add').text();
            if(button_text ==="Add"){
              $('#add_form').attr('action', 'add.php');
            }
            else if(button_text ==="Update"){
              $('#add_form').attr('action', 'edit.php');
              // $("#fill_Add").html("Add");
            }
          }); 
         $('.edit_task').click(function(e){
            const id = $(this).attr('id');
            const des = $(this).attr('value');
            $('input[name$="des"]').focus();
            // $('input[name$="des"]').val($('input[name$="des"]').val() + des);
            document.getElementById('des_input_id').value = des;
            $(this).parent().parent().hide(400)
            $("#fill_Add").html("Update");
          // });
          //   $.post("edit.php",
          // {
          //   id : id, 
          //   des: des
          // },(data) =>{
          //   // $(this).removeAttr("style");
          });
       
      });
    </script>
  </body>
</html>



