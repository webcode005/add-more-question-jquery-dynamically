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
                                          <p>faq Text</p>
                                           <div class="form-group col-md-12">
                                              
                                                 

                                           <table>
                                                <tr>
                                                  <th>#</th>
                                                  <th>Question</th>
                                                  <th>Answer</th>
                                                </tr>

                                                <tbody id="tbody"></tbody>
                                            </table>

                                              <p>
                                                <button type="button" class="btn btn-success mt-3" onclick="addItem();">Add Question</button>
                                              </p>





                                            </div>


                                        </div>
                                      
                                      <button type="submit" name="submit" class="btn btn-primary mt-3">Submit</button>
                                    </form>

                            </div>

                        </div>
</div>
</div>
</div>


            <div class="col-md-12">
                <div class="card card-topline-red">
                    <div class="card-head">
                        <header>faq Table</header>

                    </div>
                    <div class="card-body ">
                       <table class="table table-striped table-bordered table-hover table-checkable order-column" style="width: 100%" id="example4">
                            <thead>
                                <tr>

                                    <th> Sno </th>
                                    <th>Product Name</th>
                                    <th> Question </th>
                                    <th> Answer </th>
                                    <th> Actions </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                        $ii='1';
                        

                    $sql=$conn->query("SELECT * FROM `tbl_faq` ORDER BY `fid` DESC");
                                while($row=$sql->fetch_assoc())
                                {                                  
                                  $iiid=$row['product_id'];
                                  $sqlp=$conn->query("SELECT title FROM `tl_product` WHERE detail_id='$iiid' ORDER BY `detail_id` DESC");
                                $rowp=$sqlp->fetch_assoc();

                               ?>

                                <tr class="odd gradeX">
                                    <td><span><?= $ii++;?></span>
                                    </td>
                                    
                                    <td> <span> <?= $rowp['title'];?> </span> </td>
                                     <td> <span> <?= $row['question'];?> </span> </td>
                                      <td> <span> <?= $row['answer'];?> </span> </td>
                                   
                                    
                                    <td class="valigntop">
                                        <div class="btn-group">
                                            <button class="btn btn-xs deepPink-bgcolor dropdown-toggle no-margin" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-left" role="menu">
                                                <li>
                                                    <a href="faq_edit.php?id=<?= $row['fid'];?>">
                                                        <i class="icon-docs"></i> Edit </a>
                                                </li>
                                                
                                                <li>
                                                    <a href="faq_delete.php?id=<?= $row['fid'];?>" onclick="return confirm('Are you sure?')">
                                                        <i class="icon-trash"></i> Delete </a>
                                                </li>

                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                                    }

                                                    // while end
                                            ?>

                                
                            </tbody>
                        </table>
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
<script>
  var items = 0;
  function addItem() {
    items++;

    var html = "<tr>";
      html += "<td>" + items + "</td>";
      html += "<td> <input type='text' class='form-control' required name='question[]' id='inputAddress2' placeholder='Question'></td>";
      html += "<td><textarea class='form-control'  name='answer[]' id='answer"+ items +"' placeholder='Reply'></textarea></td>";
    html += "</tr>";

    var row = document.getElementById("tbody").insertRow();
    row.innerHTML = html;
    
    CKEDITOR.replace( "answer"+ items +"");
    
  }
</script>
