<div id="add_data_Modal" class="modal fade">
    <div class="modal-dialog">
         <div class="modal-content">
              <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                   <h4 class="modal-title">PHP Ajax Update MySQL Data Through Bootstrap Modal</h4>
              </div>
              <div class="modal-body">
                   <form method="post" id="insert_form">
                        <label>Enter Employee Name</label>
                        <input type="text" name="name" id="name" class="form-control" />
                        <br />
                        <label>Enter Employee Address</label>
                        <textarea name="address" id="address" class="form-control"></textarea>
                        <br />
                        <label>Select Gender</label>
                        <select name="gender" id="gender" class="form-control">
                             <option value="Male">Male</option>
                             <option value="Female">Female</option>
                        </select>
                        <br />
                        <label>Enter Designation</label>
                        <input type="text" name="designation" id="designation" class="form-control" />
                        <br />
                        <label>Enter Age</label>
                        <input type="text" name="age" id="age" class="form-control" />
                        <br />
                        <input type="hidden" name="employee_id" id="employee_id" />
                        <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />
                   </form>
              </div>
              <div class="modal-footer">
                   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
         </div>
    </div>
</div>  
