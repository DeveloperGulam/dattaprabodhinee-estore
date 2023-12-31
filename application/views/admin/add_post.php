
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-30 page-title">Posts</h2>
                        <ol class="breadcrumb mb-30">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="posts.html">Posts</a></li>
                            <li class="breadcrumb-item active">Add New</li>
                        </ol>
                        <div class="row">
							<div class="col-lg-9 col-md-8">
								<div class="card card-static-2 mb-30">
									<div class="card-title-2">
										<h4>News Content</h4>
									</div>
									<div class="card-body-table">
										<div class="post-form">
											<div class="form-group">
												<label class="form-label">Title*</label>
												<input type="text" name="title" class="form-control" placeholder="News title here">
											</div>
											<div class="form-group">
												<label class="form-label">Content*</label>
												<div class="card card-editor">
													<div class="content-editor">
														 <div id='edit'></div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="card card-static-2 mb-30">
									<div class="card-title-2">
										<h4>Seo Manage</h4>
									</div>
									<div class="card-body-table">
										<div class="post-form">
											<div class="form-group">
												<label class="form-label">Allow search engines to show this service in search results*</label>
												<select id="seo" name="seo" class="form-control">
													<option selected>Yes</option>
													<option value="1">No</option>
												</select>
											</div>
											<div class="form-group">
												<label class="form-label">Seo Title*</label>
												<input type="text" class="form-control" placeholder="Seo title here">
											</div>
											<div class="form-group">
												<label class="form-label">Seo Content*</label>
												<div class="card card-editor">
													<div class="content-editor">
														<textarea class="text-control" placeholder="Enter Description"></textarea>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-md-4">
								<div class="card card-static-2 mb-30">
									<div class="card-title-2">
										<h4>Publish</h4>
									</div>
									<div class="card-body-table">
										<div class="news-content-right pd-20">
											<div class="custom-control custom-radio">
												<input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
												<label class="custom-control-label" for="customRadio1">Publish</label>
											</div>
											<div class="custom-control custom-radio">
												<input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
												<label class="custom-control-label" for="customRadio2">Draft</label>
											</div>
											<button class="save-btn hover-btn" type="submit">Save Changes</button>
										</div>
									</div>
								</div>
								<div class="card card-static-2 mb-30">
									<div class="card-title-2">
										<h4>Category</h4>
									</div>
									<div class="card-body-table">
										<div class="news-content-right pd-20">
											<div class="form-group">
												<select id="categeory" name="categeory" class="form-control">
													<option selected>--All Category--</option>
													<option value="1">Category 01</option>
													<option value="2">Category 02</option>
													<option value="3">Category 03</option>
													<option value="3">Category 04</option>
													<option value="3">Category 05</option>
												</select>
											</div>
											<div class="form-group">
												<label class="form-label">Tags*</label>
												<input type="text" class="form-control" placeholder="Enter tag">
											</div>
										</div>
									</div>
								</div>
								<div class="card card-static-2 mb-30">
									<div class="card-title-2">
										<h4>Featured Image</h4>
									</div>
									<div class="card-body-table">
										<div class="news-content-right pd-20 text-center">	
											<div class="fea-img">
												<img src="images/featured-img.jpg" alt="">
												<div class="img-add">													
													<input type="file" id="file">
													<label for="file">Upload Image</label>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
                        </div>
                    </div>
                </main>
