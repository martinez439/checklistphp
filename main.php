<?php
require 'database.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo </title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/a57ee06e6c.js" crossorigin="anonymous"></script>
</head>
<style>
    div[class*="myModal"] {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
}

form.todoForm {
   display: none;
}
.todoText {
    display: inline;
}
table {
     border-collapse: collapse;
}
</style>

<body>
    <div class="mainForm">
      <div class="formItems">
    <h2>Todo List</h2> 
    <button class="addNewTodo"><i class="fa-solid fa-plus"></i></button>


    <!-- Add Form -->
    <form class="todoForm" method="post">
        
        <input type="text" name="task" placeholder="Add new item" required>
        <button type="submit" name="add">Add</button>
    </form>
</div>
</div>
   
<div class="container">
   <table>
     <thead>
    <tr>
      <th>Done
      <th>Task
      <th>Edit
      <th>Delete
  </thead>
    <tbody>
         <?php foreach ($todoItems as $item) : ?>
        <tr class=<?php echo $item["id"]; ?>>
       
            
            <td style="white-space:nowrap;" class="checky" >
            <input type="checkbox" name="settings" data-button-id="<?php echo $item["id"]; ?>"/>
              <td>  <div class="todoText" data-text-id="<?php echo $item["id"]; ?>">
                <?php echo $item["name"]; ?>
                </div>

                <td>     <button type="button" class="commonClass" data-button-id="<?php echo $item["id"]; ?>" novalidate> <i class="fa-solid fa-pencil"></i></button>


               <!-- </form> -->

                <!-- The Modal -->
                <div class="myModal" data-modal-id=<?php echo $item["id"];?> >

                    <!-- Modal content -->
                    <div class="modal-content">
                        <span class="close" data-span-id=<?php echo $item["id"];?>>&times;</span>
                        <p>Enter your information:</p>
                      <form method="post" style="display: inline;"> 
                        <input type="hidden" name="edit_id" value="<?php echo $item["id"]; ?>"> 
                        <input type="text" id="inputField" name="edited_task" placeholder="Edit task"> 
                        <button type="submit" id="submitBtn" name="edit" <?php echo $item["id"]; ?> novalidate>Submit</button>
                    </div>
                </div>



              <td>  <form method="post" style="display: inline;">
                    <input type="hidden" name="delete_id" value="<?php echo $item["id"]; ?>">
                    <button type="submit" name="delete"><i class="fa-solid fa-trash-can"></i></button>
                </form>
                <tr>
            
        <?php endforeach; ?>

            
    </tbody>
   </table>

<script src="script.js"></script> 
</div>
</body>

</html>




