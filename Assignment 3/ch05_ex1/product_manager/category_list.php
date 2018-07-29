<?php include '../view/header.php'; 
?>

<div id="main">

    <h1 class="top">Category List</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>&nbsp;</th>
        </tr>
    <!-- add categories table here -->
			<?php foreach ($categories as $category) : ?>
			<tr>
                    <td><?php echo $category['categoryName']; ?></td>
                    <td><form action="." method="post"
                              id="delete_category_form">
						<input type="hidden" name="action"
                           value="delete_category" />
                        <input type="hidden" name="category_id"
                               value="<?php echo $category['categoryID']; ?>" />
                        <input type="submit" value="Delete" />
                    </form></td>
			</tr>
			<?php endforeach; ?>
    </table>
    <br />

    <h2>Add Category</h2>
    <!-- add form for adding a category here -->
		<form action="." method="post"
                  id="add_category_form">
				 <input type="hidden" name="action" value="add_category" />
                <label>Category:</label>
                <input type="input" name="categoryName" />
                <input type="submit" value="Add" />
                <br />
        </form>
    <br />
    <p><a href="index.php?action=list_products">List Products</a></p>

</div>
<?php include '../view/footer.php'; ?>