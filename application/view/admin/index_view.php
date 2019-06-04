<?php if(!defined('APP_PATH')) { die('can not access'); } ?>
<main class="my-5">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-xl-12">
				<h2 class="text-center">This is admin</h2>
				<a href="?c=admin&m=add" class="btn btn-primary"> Add Admin +</a>
			</div>
		</div>
		<div class="row mt-5">
			<div class="col-lg-12 col-xl-12">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Username</th>
							<th>Email</th>
							<th>Role</th>
							<th>Phone</th>
							<th>Status</th>
							<th>Address</th>
							<th width="5%" colspan="2">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($infoAdmins as $key => $item): ?>
						<tr>
							<td><?= $key + 1; ?></td>
							<td><?= $item['username']; ?></td>
							<td><?= $item['email']; ?></td>
							<td><?= $item['role'] == -1 ? 'Super Admin' : 'Admin'; ?></td>
							<td><?= $item['phone']; ?></td>
							<td><?= $item['status'] == 1 ? 'Active' : 'Deactive'; ?></td>
							<td><?= $item['address']; ?></td>
							<td>
								<a href="?c=admin&m=edit&id=<?= $item['id']; ?>" class="btn btn-info"> Edit</a>
							</td>
							<td>
								<button class="btn btn-danger">Delete</button>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</main>