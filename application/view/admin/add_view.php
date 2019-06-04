<?php if(!defined('APP_PATH')) { die('can not access'); } ?>
<main class="my-5">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-xl-12">
				<h2 class="text-center">Form add Admin</h2>
				<form action="?c=admin&m=handleAdd" method="POST" class="mt-5">
					 <div class="form-group">
					    <label for="txtUser">Username</label>
					    <input type="text" class="form-control" id="txtUser" name="user">
					  </div>
					  <div class="form-group">
					    <label for="txtPass">Password</label>
					    <input type="password" class="form-control" id="txtPass" placeholder="Password" name="password">
					  </div>
					  <div class="form-group">
					    <label for="txtEmail">Email</label>
					    <input type="email" class="form-control" id="txtEmail" placeholder="Email" name="email">
					  </div>
					  <div class="form-group">
					    <label for="txtPhone">Phone</label>
					    <input type="text" class="form-control" id="txtPhone" placeholder="Phone" name="phone">
					  </div>
					  <div class="form-group">
					    <label for="txtRole">Role</label>
					    <select name="role" id="txtRole" class="form-control">
					    	<option value="-1">Super Admin</option>
					    	<option value="1">Admin</option>
					    </select>
					  </div>
					  <div class="form-group">
					  	<label for="txtAddress">Address</label>
					  	<textarea class="form-control" id="txtAddress" name="address" rows="5"></textarea>
					  </div>
					  <button name="btnAdd" type="submit" class="btn btn-primary">Add</button>
				</form>
			</div>
		</div>
	</div>
</main>