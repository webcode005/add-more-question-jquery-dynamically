<?php 
include'include/connection.php';

if(isset($_POST['submit']))
{
     
     @$product_id=$_POST['product_id']; 
     $course_id=''; 


    for ($a = 0; $a < count($_POST["question"]); $a++)
    {
      $sql = "INSERT INTO tbl_faq (course_id, product_id,question,answer) VALUES ('$course_id','$product_id', '" . $_POST["question"][$a] . "', '" . $_POST["answer"][$a] . "')";
      mysqli_query($conn, $sql);
    }

    //echo "<p>faq has been added.</p>";

    echo "<script>alert('faq Added Successfully');window.location='faq.php'</script>";

     
    // if ($conn->query($sql)== TRUE) 
    // {
        

    //     echo "<script>alert('faq Added Successfully');window.location='faq.php'</script>";


    // } 
    // else 
    // {
    //     //echo "<script>alert('Failed to Insert Data');window.location='faq.php'</script>";


    //     echo "Error: " . $sql . "<br>" . $conn->error;
    // }
    


}
// Check Availability End

?>


<!-- end sidebar menu -->
<!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">FAQs</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>

                    <li class="active">FAQs</li>
                </ol>
            </div>
        </div>

        <div class="row">

                <div class="col-md-12">
                <div class="card card-topline-red">
                    <div class="card-head">
                        <header>Add faq Content For Product</header>

                    </div>
                    <div class="card-body ">
                        <div class="row p-b-20">
                            <div class="col-md-12 col-sm-12 col-12">

                                 <form method="post" enctype="multipart/form-data">

                                    <div class="form-row mb-4"> 

                                        <div class="form-group col-md-6">
                                                <label for="inputAddress2">Select Product</label>
                                                
                                                  <select  id="inputEmail4" class="form-control" required name="product_id">
                                                                                                        
                                                    <option value="">Select Product</option>
                                                    <?php 
                                                    $web_cat=$conn->query("SELECT * FROM `tl_product` ORDER BY detail_id DESC ");
                                                        while ($row=$web_cat->fetch_assoc()) {
                                                           ?>
                                                           <option value="<?= $row['detail_id'];?>"><?= $row['title'];?></option>
                                                           <?php
                                                        }
                                                    ?>
                                                    
                                                </select>
                                        </div>

                                        </div> 
                                   
    
                                  

                                        <div class="form-row mb-4">
                                          <a href="javascript:void(0);" id="addRow"  title="Add field" style="text-decoration: none;font-weight: 500;">
                                               <img src="http://127.0.0.1:8000/assets/images/add-icon.png"> Add Questions</a>
       

      
                                                   <div id="inputFormRow">
                                                           <div class="form-group">
                                                               <label>Quiz Title</label>
                                                               <input type="text" class="form-control" name="qtitle[]" required>
                                                           </div>
                                                           <div class="form-group">
                                                               <label>Quiz Options(Comma seperated)</label>
                                                               <input type="text" class="form-control" name="options[]" required>
                                                           </div>
                                                           <div class="row">
                                                               <div class="col-md-6">
                                                                   <div class="form-group">
                                                                       <label>Answers</label><br>
                                                                       <input type="text" class="form-control" name="answer[]" required>
                                                                   </div>
                                                               </div>
                                                               <div class="col-md-6">
                                                                   <div class="form-group">
                                                                       <label>Marks</label>
                                                                       <input type="text" class="form-control" name="marks[]"  required>
                                                                   </div>
                                                               </div>
                                                           </div>
                                                           <button id="removeRow" type="button" class="btn btn-danger">Remove</button>       
                                                   </div> 
                                                   <div id="newRow"></div>   



                                            </div>


                                        </div>
                                      
                                      <button type="submit" name="submit" class="btn btn-primary mt-3">Submit</button>
                                    </form>

                            </div>

                        </div>
</div>
</div>
</div>


         
            </div>
        </div>

    </div>
</div>
<!-- end page content -->

<!-- start footer -->

<?php include'include/footer.php';?>


<style type="text/css">
  table {
    width: 100%;
    border-collapse: collapse;
  }
  table tr td,
  table tr th {
    border: 1px solid black;
    padding: 15px;
        text-align: center;
  }
</style>

<script type="text/javascript">
        // add row
        $("#addRow").click(function () {
            var html = '';
            html += '<div id="inputFormRow">';
            html += '<div class="form-group">';
            html += '<label>Quiz Title</label>';
            html += '<input type="text" class="form-control" name="qtitle[]" required>';
            html += '</div>';
            html += '<div class="form-group">';
            html += '<label>Quiz Options(Comma seperated)</label>';
            html += '<input type="text" class="form-control" name="options[]" required>';
            html += '</div>';
            html += '<div class="row">';
            html += '<div class="col-md-6">';
            html += '<div class="form-group">';
            html += '<label>Answers</label><br>';
            html += '<input type="text" class="form-control" name="answer[]" required>';
            html += '</div>';
            html += '</div>';
            html += '<div class="col-md-6">';
            html += '<div class="form-group">';
            html += '<label>Marks</label>';
            html += '<input type="text" class="form-control" name="marks[]"  required>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>'; 
            html += '</div>';

            $('#newRow').append(html);
        });

        // remove row
        $(document).on('click', '#removeRow', function () {
            $(this).closest('#inputFormRow').remove();
        });
    </script>

