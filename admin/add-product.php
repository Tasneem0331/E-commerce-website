<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Product</h1>

        <br><br>
        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <table width=35%>
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Product">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the Product"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php
                               $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                $res = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($res);
                                if ($count > 0) 
                                {
                                    while ($row = mysqli_fetch_assoc($res)) 
                                        {
                                            $id = $row['category_id'];
                                             $title = $row['title'];
                                            echo "<option value='$id'>$title</option>";
                                         }
                               } 
                               else 
                               {
                                echo "<option value='1'>No Category Found</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>New Arrival:</td>
                    <td>
                        <input type="radio" name="new_arrival" value="Yes">Yes
                        <input type="radio" name="new_arrival" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Product" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $featured = isset($_POST['featured']) ? $_POST['featured'] : 'No';
            $new_arrival = isset($_POST['new_arrival']) ? $_POST['new_arrival'] : 'No';
            $active = isset($_POST['active']) ? $_POST['active'] : 'No';
            $image_name = "";

            if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
                $temp = explode('.', $_FILES['image']['name']);
                $ext = end($temp);
                $image_name = "Product_Name_" . rand(00000, 99999) . "." . $ext;
                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../image/products/" . $image_name;

                $upload = move_uploaded_file($source_path, $destination_path);
                if (!$upload) {
                    $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                    header('location:' . SITEURL . 'admin/add-product.php');
                    exit;
                }
            }

            $sql2 = "INSERT INTO tbl_product SET
                product_title='$title',
                description='$description',
                price=$price,
                image_name='$image_name',
                category_id=$category,
                featured='$featured',
                new_arrival='$new_arrival',
                active='$active'";

            $result = mysqli_query($conn, $sql2);

            if ($result) {
                $_SESSION['add'] = "<div class='success'>Product Added Successfully.</div>";
                header('location:' . SITEURL . 'admin/manage-product.php');
            } else {
                $_SESSION['add'] = "<div class='error'>Failed to Add Product.</div>";
                header('location:' . SITEURL . 'admin/manage-product.php');
            }
            exit;
        }
        ?>
    </div>
</div>
<?php include('partials/footer.php'); ?>
