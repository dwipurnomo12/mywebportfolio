		<!-- Sidebar -->
		<div class="sidebar">
			
			<div class="sidebar-background"></div>
			<div class="sidebar-wrapper scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="/dashboard/assets/img/profile.jpg" alt="." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									{{ auth()->user()->name }}
									<span class="user-level">Administrator</span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample">
								<ul class="nav">
									<li>
										<a href="/admin/profile">
											<span class="link-collapse">Profile</span>
										</a>
										<a href="/admin/update-password">
											<span class="link-collapse">Password</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav">
						<li class="nav-item active">
							<a href="/admin">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						</li>

						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Pengaturan Tampilan</h4>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#base">
								<i class="fas fa-layer-group"></i>
								<p>Landing Page</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="base">
								<ul class="nav nav-collapse">
									<li>
										<a href="/admin/section-about">
											<span class="sub-item">About section</span>
										</a>
									</li>
									<li>
										<a href="/admin/section-skill">
											<span class="sub-item">Skill section</span>
										</a>
									</li>
									<li>
										<a href="/admin/section-resume">
											<span class="sub-item">Resume section</span>
										</a>
									</li>
									<li>
										<a href="/admin/section-contact">
											<span class="sub-item">Contact section</span>
										</a>
									</li>
								</ul>
							</div>
						</li>

						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Publikasi</h4>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#post">
								<i class="fas fa-edit"></i>
								<p>Posts</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="post">
								<ul class="nav nav-collapse">
									<li>
										<a href="/admin/posts">
											<span class="sub-item">Semua Post</span>
										</a>
									</li>
									<li>
										<a href="/admin/posts/create">
											<span class="sub-item">Tambah Baru</span>
										</a>
									</li>
									<li>
										<a href="/admin/kategori/">
											<span class="sub-item">Kategori</span>
										</a>
									</li>
								</ul>
							</div>
						</li>

						<li class="nav-item">
							<a data-toggle="collapse" href="#project">
								<i class="fas fa-code"></i>
								<p>projects</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="project">
								<ul class="nav nav-collapse">
									<li>
										<a href="/admin/project">
											<span class="sub-item">Semua project</span>
										</a>
									</li>
									<li>
										<a href="/admin/project/create">
											<span class="sub-item">Tambah Baru</span>
										</a>
									</li>
								</ul>
							</div>
						</li>

						<li class="nav-item">
							<a href="/admin/media">
								<i class="fas fa-image"></i>
								<p>Media</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="/admin/komentar">
								<i class="fas fa-comments"></i>
								<p>Komentar</p>
							</a>
						</li>
						
					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->