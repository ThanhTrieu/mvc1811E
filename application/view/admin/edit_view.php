<?php if(!defined('APP_PATH')) { die('can not access'); } ?>
<main class="my-5">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-xl-12">
				<h2 class="text-center">Form edit Admin</h2>

				<form action="?c=admin&m=handleEdit&id=<?= $info['id']; ?>" method="POST" class="mt-5">
					 <div class="form-group">
					    <label for="txtUser">Username</label>
					    <input type="text" class="form-control" id="txtUser" name="user" value="<?= $info['username']; ?>">
					  </div>
					  <div class="form-group">
					    <label for="txtPass">Password</label>
					    <input type="password" class="form-control" id="txtPass" placeholder="Password" name="password" value="<?= $info['password']; ?>">
					  </div>
					  <div class="form-group">
					    <label for="txtEmail">Email</label>
					    <input type="email" class="form-control" id="txtEmail" placeholder="Email" name="email" value="<?= $info['email']; ?>">
					  </div>
					  <div class="form-group">
					    <label for="txtPhone">Phone</label>
					    <input type="text" class="form-control" id="txtPhone" placeholder="Phone" name="phone" value="<?= $info['phone'] ?>">
					  </div>
					  <div class="form-group">
					    <label for="txtRole">Role</label>
					    <select name="role" id="txtRole" class="form-control">

					    	<option value="-1" <?= $info['role'] == -1 ? "selected" : ""; ?> >Super Admin</option>

					    	<option value="1" <?= $info['role'] == 1 ? "selected" : ""; ?>>Admin</option>

					    </select>
					  </div>
					  <div class="form-group">
					  	<label for="txtAddress">Address</label>
					  	<textarea class="form-control" id="txtAddress" name="address" rows="5">
					  		<?= $info['address']; ?>
					  	</textarea>
					  </div>

					  <div class="form-group">
					    <label for="txtStatus">Status</label>
					    <select name="status" id="txtStatus" class="form-control">

					    	<option value="1" <?= $info['status'] == 1 ? "selected" : ""; ?> >Active</option>

					    	<option value="0" <?= $info['status'] == 0 ? "selected" : ""; ?>>Deactive</option>

					    </select>
					  </div>

					  <button name="btnEdit" type="submit" class="btn btn-primary">Update</button>
				</form>
			</div>
		</div>
	</div>
</main>