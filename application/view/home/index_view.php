<?php if(!defined('APP_PATH')) { die('can not access'); } ?>
<main class="my-5">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<h1>This is demo MVC - <?= $name; ?></h1>
				<form action="?c=login&m=handle" method="post">
					<label for="user"> User </label>
					<input type="text" name="user" id="user">
					<br><br>
					<label for="pass"> Password </label>
					<input type="password" name="pass" id="pass">
					<br><br>
					<button type="submit" name="btnLogin"> Login </button>
				</form>
			</div>
		</div>
		<div class="row mt-5">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<table class="table">
					<thead>
						<tr>
							<th>MSV</th>
							<th>HT</th>
							<th>Email</th>
							<th>Dia chi</th>
							<th>Hoc bong</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($info as $key => $item): ?>
						<tr>
							<td><?= $item['msv'] ?></td>
							<td><?= $item['name'] ?></td>
							<td><?= $item['email'] ?></td>
							<td><?= $item['address'] ?></td>
							<td><?= $item['money'] ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>			
		</div>
	</div>
</main>
