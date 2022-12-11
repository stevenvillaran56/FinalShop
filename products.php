<?php  
    session_start();
    require_once("connect.php"); 
    if (isset($_SESSION['userid'])&& isset($_SESSION['username'])) {
?>

<?php 
       
        if(isset($_POST['btnAdd'])) {
            $con = openConnection(); 
            
            $id = sanitizeInput($conn, $_POST['txtname']);
            $name = sanitizeInput($conn, $_POST['txtdetails']);
            $description = sanitizeInput($conn, $_POST['txtsizes']);
            $price= sanitizeInput($conn, $_POST['txtprice']);
           

            $err = [];

            if(empty($id))
                $err[] = "Product Name is required!";
            if(empty($name))
                $err[] = "Product Details is required!";
            if(empty($description))
                $err[] = "Product Sizes is required!";
            if(empty($price))
                $err[] = "Product Price is required!";
              
            if(empty($err)){
                 
                $strSql = "INSERT INTO products_table (id, name, description, price) VALUES ('$id', '$name', '$description', '$price')";

                if(mysqli_query($con, $strSql))
                    ;
                else
                    echo 'Error: Failed to insert Record!';          
            }              
            closeConnection($con);         
        }
?>

            <main class="col-md-6 ms-sm-auto col-lg-12 px-md-4">

                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2"><i class="fa fa-dashboard"></i> Add Products</h1>
                </div>

                    <form method="POST">

                        <div class="form-group row">
                            <label for="txtname" class="col-sm-2 col-form-label">Product name</label>
                            <div class="col-sm-10">
                                <input type="text" name="txtname" class="form-control" id="txtname">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="txtdetails" class="col-sm-2 col-form-label">Product Details</label>
                            <div class="col-sm-10">
                                <input type="text" name="txtdetails" class="form-control" id="txtdetails">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="txtsizes" class="col-sm-2 col-form-label">Product Sizes</label>
                            <div class="col-sm-10">
                                <input type="text" name="txtsizes" class="form-control" id="txtsizes">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="txtprice" class="col-sm-2 col-form-label">Product Price</label>
                            <div class="col-sm-10">
                                <input type="text" name="txtprice" class="form-control" id="txtprice">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="txtstocks" class="col-sm-2 col-form-label">Product Stocks</label>
                            <div class="col-sm-10">
                                <input type="text" name="txtstocks" class="form-control" id="txtstocks">
                            </div>
                        </div>

                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" name="btnAdd" class="btn btn-primary">Add Product</button>
                                </div>
                            </div>
                    </form>
            </main>

            <main class="col-md-6 ms-sm-auto col-lg-12 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2"><i class="fa fa-clipboard"></i> Products</h1>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Details</th>
                            <th scope="col">Sizes</th>
                            <th scope="col">Price</th>
                            <th scope="col">Stock</th>
                            <th scope="col">options</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php 
                                $con = openConnection(); 
                                $strSql = "SELECT * FROM tbl_products ORDER BY id, name, description,prices";
                                $rec = getRecord($con, $strSql);

                                if(!empty($rec)) {
                                    foreach ($rec as $key => $value) {

                                    echo '<tr>';
                                            echo '<td>' . $value['id'] . '</td>';
                                            echo '<td>' . $value['name'] . '</td>';
                                            echo '<td>' . $value['description'] . '</td>';
                                            echo '<td>' . $value['prices'] . '</td>';
                                            
                                            echo '<td>';
                                            echo '<a href="update-product.php?k=' . $value['product_ID'] . '" class="btn btn-success"><i class=fa fa-edit"></i> Edit</a>';
                                            echo '<a href="delete-product.php?k=' . $value['product_ID'] . '" class="btn btn-danger"><i class=fa fa-trash"></i> Remove</a>';
                                            echo '</td>';
                                    echo '</tr>';
                                    }    
                                }
                                else{

                                }
                                closeConnection($con);
                                      
                            ?>

                        </tbody>
                    </table>
                </div>    
            </main>


<?php require_once("footer.php"); ?>

<?php
    }else{
        header("Location: index.php");
        exit();
    }
?>